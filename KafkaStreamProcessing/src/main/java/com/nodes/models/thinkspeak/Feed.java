package com.nodes.models.thinkspeak;

import com.infoworks.lab.rest.models.Message;
import com.nodes.events.EventExt;
import com.nodes.events.Soil;
import com.nodes.events.SoilEC;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class Feed extends Message {
    /**
     *      "field1": "Temperature1",
     *      "field2": "Humidity1",
     *      "field3": "Temperature2",
     *      "field4": "Humidity2",
     *      "field5": "Temperature3",
     *      "field6": "Humidity3",
     *      "field7": "EC",
     */
    /**
     *      "created_at": "2022-05-16T08:33:23Z",
     *      "entry_id": 235,
     *      "field1": "31.62500",
     *      "field2": "1.00000",
     *      "field3": "31.18750",
     *      "field4": "0.00000",
     *      "field5": "31.37500",
     *      "field6": "0.00000",
     *      "field7": "3.43496"
     */

    private String created_at;
    private Long entry_id;
    private String field1;
    private String field2;
    private String field3;
    private String field4;
    private String field5;
    private String field6;
    private String field7;

    public static final String FIRST_DEPTH = "10";
    public static final String SECOND_DEPTH = "15";
    public static final String THIRD_DEPTH = "20";

    public List<EventExt> getSoils(Long channelId){
        List<EventExt> data = new ArrayList<>();
        if (field1 != null && !field1.isEmpty()){
            data.add(new Soil(0.0, field1, field2, 0.0, FIRST_DEPTH, channelId, created_at));
        }
        if (field3 != null && !field3.isEmpty()){
            data.add(new Soil(0.0, field3, field4, 0.0, SECOND_DEPTH, channelId, created_at));
        }
        if (field5 != null && !field5.isEmpty()){
            data.add(new Soil(0.0, field5, field6, 0.0, THIRD_DEPTH, channelId, created_at));
        }
        return data;
    }

    public List<EventExt> getSoilEC(Long channelId) {
        if (field7 == null
                || field7.isEmpty()
                || field7.toLowerCase().contains("null"))
            return Arrays.asList(new SoilEC());
        //
        return Arrays.asList(new SoilEC(field7, channelId, created_at));
    }

    public String getCreated_at() {
        return created_at;
    }

    public void setCreated_at(String created_at) {
        this.created_at = created_at;
    }

    public Long getEntry_id() {
        return entry_id;
    }

    public void setEntry_id(Long entry_id) {
        this.entry_id = entry_id;
    }

    public String getField1() {
        return field1;
    }

    public void setField1(String field1) {
        this.field1 = field1;
    }

    public String getField2() {
        return field2;
    }

    public void setField2(String field2) {
        this.field2 = field2;
    }

    public String getField3() {
        return field3;
    }

    public void setField3(String field3) {
        this.field3 = field3;
    }

    public String getField4() {
        return field4;
    }

    public void setField4(String field4) {
        this.field4 = field4;
    }

    public String getField5() {
        return field5;
    }

    public void setField5(String field5) {
        this.field5 = field5;
    }

    public String getField6() {
        return field6;
    }

    public void setField6(String field6) {
        this.field6 = field6;
    }

    public String getField7() {
        return field7;
    }

    public void setField7(String field7) {
        this.field7 = field7;
    }
}
