package com.infoworks.lab.domain.entities;

import com.it.soul.lab.cql.entity.CQLEntity;
import com.it.soul.lab.cql.entity.ClusteringKey;
import com.it.soul.lab.cql.entity.EnableTimeToLive;
import com.it.soul.lab.sql.entity.Column;
import com.it.soul.lab.sql.entity.PrimaryKey;
import com.it.soul.lab.sql.entity.TableName;

import java.util.Date;

@TableName(value = "tbl_sensor_alert")
@EnableTimeToLive(2160000L) //TimeToLive 60*60*24*25 sec = 25 days
public class SensorDownAlert extends CQLEntity {
    @PrimaryKey(name="uuid")
    private String uuid;
    @ClusteringKey(name = "channelId")
    private String channelId;
    private Long timestamp = (new Date()).getTime();
    private String action;
    @Column(name = "last_entry_id")
    private String lastEntryId;

    public String getUuid() {
        return uuid;
    }

    public void setUuid(String uuid) {
        this.uuid = uuid;
    }

    public Long getTimestamp() {
        return timestamp;
    }

    public void setTimestamp(Long timestamp) {
        this.timestamp = timestamp;
    }

    public String getChannelId() {
        return channelId;
    }

    public void setChannelId(String channelId) {
        this.channelId = channelId;
    }

    public String getAction() {
        return action;
    }

    public void setAction(String action) {
        this.action = action;
    }

    public String getLastEntryId() {
        return lastEntryId;
    }

    public void setLastEntryId(String lastEntryId) {
        this.lastEntryId = lastEntryId;
    }
}
