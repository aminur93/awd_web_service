package com.infoworks.lab.domain.entities;

import com.it.soul.lab.cql.entity.CQLEntity;
import com.it.soul.lab.cql.entity.EnableTimeToLive;
import com.it.soul.lab.sql.entity.PrimaryKey;
import com.it.soul.lab.sql.entity.TableName;

import java.util.Date;

@TableName(value = "tbl_anemometer")
@EnableTimeToLive(2160000L) //TimeToLive 60*60*24*25 sec = 25 days
public class AnemometerEntity extends CQLEntity {
    @PrimaryKey(name="uuid")
    private String uuid;
    private Long timestamp = (new Date()).getTime();
    private Double windSpeed;

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

    public Double getWindSpeed() {
        return windSpeed;
    }

    public void setWindSpeed(Double windSpeed) {
        this.windSpeed = windSpeed;
    }
}
