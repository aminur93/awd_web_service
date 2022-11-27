package com.nodes.events;

import com.infoworks.lab.rest.models.events.Event;
import com.infoworks.lab.rest.models.events.EventType;

import java.util.Date;
import java.util.UUID;

public class EventExt extends Event {

    public EventExt() {
        setUuid(UUID.randomUUID().toString());
        setTimestamp(String.valueOf(new Date().getTime()));
        setEventType(EventType.CREATE);
    }

    public EventExt(Long channelId) {
        this();
        setChannelId(channelId);
    }

    public EventExt(Long channelId, String createdAt) {
        this(channelId);
        setCreatedAt(createdAt);
    }

    private Long channelId;
    private Long lastEntryId;
    private String createdAt;

    public Long getChannelId() {
        return channelId;
    }

    public void setChannelId(Long channelId) {
        this.channelId = channelId;
    }

    public Long getLastEntryId() {
        return lastEntryId;
    }

    public void setLastEntryId(Long lastEntryId) {
        this.lastEntryId = lastEntryId;
    }

    public String getCreatedAt() {
        return createdAt;
    }

    public void setCreatedAt(String createdAt) {
        this.createdAt = createdAt;
    }
}
