package com.infoworks.lab.controllers.rest;

import com.infoworks.lab.beans.tasks.definition.Task;
import com.infoworks.lab.beans.tasks.definition.TaskQueue;
import com.infoworks.lab.domain.beans.tasks.events.SoilECTask;
import com.infoworks.lab.domain.beans.tasks.events.SoilTask;
import com.infoworks.lab.rest.models.Message;
import com.it.soul.lab.sql.query.models.Row;
import com.nodes.events.EventExt;
import com.nodes.events.Soil;
import com.nodes.events.SoilEC;
import com.nodes.models.thinkspeak.Feed;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/crop")
public class SustainableCropImporter {

    private TaskQueue taskQueue;
    private static Logger LOG = LoggerFactory.getLogger(SustainableCropImporter.class);

    public SustainableCropImporter(@Qualifier("taskDispatchQueue") TaskQueue taskQueue) {
        this.taskQueue = taskQueue;
    }

    @PostMapping("/v1/import/{channelId}")
    public ResponseEntity<String> importData(
            @PathVariable("channelId") String channelId
            , @RequestParam("content") MultipartFile content) throws IOException {
        //Read From CSV File:
        List<List<String>> records = readFromStream(content.getInputStream());
        //Convert Records into List<Row>:
        final List<String> columnNames = records.remove(0);
        List<Row> rows = records.stream()
                .map(record -> convertIntoRow(record, columnNames))
                .collect(Collectors.toList());
        //Now Send the CSV Rows into Kafka-stream as Feed items:
        if (!rows.isEmpty()) {
            AtomicInteger count = new AtomicInteger(0);
            rows.stream().forEach(row -> {
                try {
                    long channelIdVal = Long.parseLong(channelId);
                    Feed feed = row.inflate(Feed.class);
                    List<EventExt> soils = feed.getSoils(channelIdVal);
                    List<EventExt> soilECs = feed.getSoilEC(channelIdVal);
                    List<EventExt> events = new ArrayList<>(soils);
                    events.addAll(soilECs);
                    sendSensorData(taskQueue, events);
                    count.incrementAndGet();
                } catch (InstantiationException e) {
                    LOG.error(e.getMessage());
                } catch (IllegalAccessException e) {
                    LOG.error(e.getMessage());
                } catch (NumberFormatException e) {
                    LOG.error(e.getMessage());
                }
            });
            return ResponseEntity.ok("For Channel: " + channelId + " Import Count: " + count.get());
        }
        //
        return ResponseEntity.ok(rows.size() + " Found!");
    }

    @PostMapping("/v2/import/{channelId}")
    public ResponseEntity<String> importDataV2(
            @PathVariable("channelId") String channelId
            , @RequestParam("content") MultipartFile content) throws IOException {
        //Read From CSV File:
        List<List<String>> records = readFromStream(content.getInputStream());
        //Convert Records into List<Row>:
        final List<String> columnNames = records.remove(0);
        //Now Send the CSV Rows into Kafka-stream as Feed items:
        if (!records.isEmpty()) {
            AtomicInteger count = new AtomicInteger(0);
            records.stream().forEach(record -> {
                try {
                    long channelIdVal = Long.parseLong(channelId);
                    Row row = convertIntoRow(record, columnNames);
                    Feed feed = row.inflate(Feed.class);
                    List<EventExt> soils = feed.getSoils(channelIdVal);
                    List<EventExt> soilECs = feed.getSoilEC(channelIdVal);
                    List<EventExt> events = new ArrayList<>(soils);
                    events.addAll(soilECs);
                    sendSensorData(taskQueue, events);
                    count.incrementAndGet();
                } catch (InstantiationException e) {
                    LOG.error(e.getMessage());
                } catch (IllegalAccessException e) {
                    LOG.error(e.getMessage());
                } catch (NumberFormatException e) {
                    LOG.error(e.getMessage());
                }
            });
            return ResponseEntity.ok("For Channel: " + channelId + " Import Count: " + count.get());
        }
        //
        return ResponseEntity.ok(records.size() + " Found!");
    }

    private List<List<String>> readFromStream(InputStream is) throws IOException {
        List<List<String>> records = new ArrayList<>();
        try (BufferedReader br = new BufferedReader(new InputStreamReader(is))) {
            String line;
            while ((line = br.readLine()) != null) {
                String[] values = line.split(",");
                records.add(Arrays.asList(values));
            }
        }
        return records;
    }

    private Row convertIntoRow(List<String> record, List<String> columnNames) {
        Row r = new Row();
        int order = 0;
        for (String val : record) {
            String colName = columnNames.get(order++);
            if (colName.equalsIgnoreCase("entry_id")){
                try { r.add(colName, Long.parseLong(val)); }
                catch (NumberFormatException e) {}
            }else {
                r.add(colName, val);
            }
        }
        return r;
    }

    @SuppressWarnings("Duplicates")
    private void sendSensorData(TaskQueue taskQueue, List<EventExt> events){
        events.forEach(event -> {
            if (event.getChannelId() != null && event.getChannelId() > 0l){
                Message message = new Message();
                message.setEvent(event);
                if (event instanceof Soil){
                    //socket.send("/iot/sensor/soil", message);
                    Task task = new SoilTask();
                    task.setMessage(message);
                    taskQueue.add(task);
                } else if(event instanceof SoilEC) {
                    //socket.send("/iot/sensor/soilec", message);
                    Task task = new SoilECTask();
                    task.setMessage(message);
                    taskQueue.add(task);
                }
                System.out.println(message.toString());
            } else {
                System.out.println("ChannelId is Null: Did not forward to BaseStation");
            }
        });
    }

}
