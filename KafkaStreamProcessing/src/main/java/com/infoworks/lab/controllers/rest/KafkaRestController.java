package com.infoworks.lab.controllers.rest;

import com.infoworks.lab.beans.tasks.definition.Task;
import com.infoworks.lab.beans.tasks.definition.TaskQueue;
import com.infoworks.lab.domain.beans.tasks.events.AlertTask;
import com.infoworks.lab.domain.beans.tasks.events.SoilECTask;
import com.infoworks.lab.domain.beans.tasks.events.SoilTask;
import com.infoworks.lab.domain.beans.tasks.mocks.ConsolePrintTask;
import com.infoworks.lab.rest.models.Message;
import kafka.admin.AdminUtils;
import kafka.admin.RackAwareMode;
import kafka.utils.ZkUtils;
import org.I0Itec.zkclient.ZkClient;
import org.I0Itec.zkclient.ZkConnection;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.kafka.core.KafkaTemplate;
import org.springframework.web.bind.annotation.*;
import scala.collection.JavaConversions;

import java.util.Properties;

@RestController
@RequestMapping("/v1/kafka")
public class KafkaRestController {

    private static Logger LOG = LoggerFactory.getLogger(KafkaRestController.class.getSimpleName());
    private ZkClient zooKeeper;
    private KafkaTemplate<String, String> kafkaTemplate;
    private TaskQueue taskQueue;

    @Value("${app.zookeeper.servers}")
    private String zookeeperServers;

    public KafkaRestController(@Qualifier("myZooKeeper") ZkClient zooKeeper
            , @Qualifier("kafkaTextTemplate") KafkaTemplate kafkaTemplate
            , @Qualifier("taskDispatchQueue") TaskQueue taskQueue) {
        this.zooKeeper = zooKeeper;
        this.kafkaTemplate = kafkaTemplate;
        this.taskQueue = taskQueue;
    }

    private boolean isTopicExist(String topic){
        ZkClient zkClient = zooKeeper;
        ZkUtils utils = new ZkUtils(zkClient, new ZkConnection(zookeeperServers), false);
        Iterable<String> topics = JavaConversions.asJavaIterable(utils.getAllTopics());
        boolean isMatched = false;
        for (String match : topics) {
            if (match.contains(topic)) {isMatched = true; break;}
        }
        return isMatched;
    }

    private void createTopic(String topicName, int partitions, int replications) throws RuntimeException{
        Properties topicConfig = new Properties();
        ZkUtils utils = new ZkUtils(zooKeeper, new ZkConnection(zookeeperServers), false);
        AdminUtils.createTopic(utils
                , topicName
                , partitions
                , replications
                , topicConfig
                , RackAwareMode.Enforced$.MODULE$);
    }

    @PostMapping("/create/topic/{topicName}")
    public ResponseEntity<String> createTopicRequest(@PathVariable String topicName
            , @RequestParam(name = "partitions", required = false, defaultValue = "1") int partitions
            , @RequestParam(name = "replications", required = false, defaultValue = "1") int replications){
        //
        try {
            if(isTopicExist(topicName)) {
                return ResponseEntity.status(HttpStatus.OK)
                        .body(String.format("Topic: %s already exist!", topicName));
            }
            createTopic(topicName, partitions, replications);
        } catch (Exception e){
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body(e.getMessage());
        }
        return ResponseEntity.ok(topicName + " is Created!");
    }

    @PostMapping("/post/message/{topicName}")
    public ResponseEntity<String> postMessage(@PathVariable String topicName
            , @RequestBody Message event){
        //
        if(!isTopicExist(topicName)) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND)
                    .body(String.format("Topic: %s does not exist.", topicName));
        }
        kafkaTemplate.send(topicName, event.toString());
        return ResponseEntity.ok("Message posted: " + topicName);
    }

    @PostMapping("/post/task/soil")
    public ResponseEntity<String> postToSoil(@RequestBody Message message){
        Task task = new SoilTask();
        task.setMessage(message);
        taskQueue.add(task);
        return new ResponseEntity("Message posted to Soil", HttpStatus.OK);
    }

    @PostMapping("/post/task/soilec")
    public ResponseEntity<String> postToSoilec(@RequestBody Message message){
        Task task = new SoilECTask();
        task.setMessage(message);
        taskQueue.add(task);
        return new ResponseEntity("Message posted to Soilec", HttpStatus.OK);
    }

    @PostMapping("/post/task/solar")
    public ResponseEntity<String> postToSolar(@RequestBody Message message){
        //TODO:
        Task task = new ConsolePrintTask();
        task.setMessage(message);
        taskQueue.add(task);
        return new ResponseEntity("Message posted to Solar", HttpStatus.OK);
    }

    @PostMapping("/post/task/pluviometer")
    public ResponseEntity<String> postToPluvio(@RequestBody Message message){
        //TODO:
        Task task = new ConsolePrintTask();
        task.setMessage(message);
        taskQueue.add(task);
        return new ResponseEntity("Message posted to Pluviometer", HttpStatus.OK);
    }

    @PostMapping("/post/task/leaf")
    public ResponseEntity<String> postToLeaf(@RequestBody Message message){
        //TODO:
        Task task = new ConsolePrintTask();
        task.setMessage(message);
        taskQueue.add(task);
        return new ResponseEntity("Message posted to Leaf", HttpStatus.OK);
    }

    @PostMapping("/post/task/anemometer")
    public ResponseEntity<String> postToAnemo(@RequestBody Message message){
        //TODO:
        Task task = new ConsolePrintTask();
        task.setMessage(message);
        taskQueue.add(task);
        return new ResponseEntity("Message posted to Anemometer", HttpStatus.OK);
    }

    @PostMapping("/post/task/alert")
    public ResponseEntity<String> postToAlert(@RequestBody Message message){
        Task task = new AlertTask();
        task.setMessage(message);
        taskQueue.add(task);
        return new ResponseEntity("Message posted to AlertTask", HttpStatus.OK);
    }
}
