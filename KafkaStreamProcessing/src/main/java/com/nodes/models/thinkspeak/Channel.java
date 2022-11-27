package com.nodes.models.thinkspeak;

import com.infoworks.lab.rest.models.Message;

public class Channel extends Message {
    /**
     *         "id": 1724422,
     *         "name": "Sustainable Crop 2",
     *         "description": "Sustainable Crop 2",
     *         "latitude": "0.0",
     *         "longitude": "0.0",
     *         "field1": "Temperature1",
     *         "field2": "Humidity1",
     *         "field3": "Temperature2",
     *         "field4": "Humidity2",
     *         "field5": "Temperature3",
     *         "field6": "Humidity3",
     *         "field7": "EC",
     *         "created_at": "2022-05-05T06:48:10Z",
     *         "updated_at": "2022-05-05T06:48:10Z",
     *         "last_entry_id": 235
     */

    private Long id;
    private String name;
    private String description;
    private String latitude;
    private String longitude;
    private String created_at;
    private String updated_at;
    private Long last_entry_id;

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getLatitude() {
        return latitude;
    }

    public void setLatitude(String latitude) {
        this.latitude = latitude;
    }

    public String getLongitude() {
        return longitude;
    }

    public void setLongitude(String longitude) {
        this.longitude = longitude;
    }

    public String getCreated_at() {
        return created_at;
    }

    public void setCreated_at(String created_at) {
        this.created_at = created_at;
    }

    public String getUpdated_at() {
        return updated_at;
    }

    public void setUpdated_at(String updated_at) {
        this.updated_at = updated_at;
    }

    public Long getLast_entry_id() {
        return last_entry_id;
    }

    public void setLast_entry_id(Long last_entry_id) {
        this.last_entry_id = last_entry_id;
    }
}
