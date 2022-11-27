package com.infoworks.lab.domain.beans.tasks.events;

import com.infoworks.lab.beans.tasks.nuts.AbstractTask;
import com.infoworks.lab.domain.entities.SoilEntity;
import com.infoworks.lab.rest.models.Message;
import com.infoworks.lab.rest.models.Response;
import com.it.soul.lab.cql.CQLExecutor;
import com.nodes.events.Soil;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.sql.SQLException;

public class SoilTask extends AbstractTask<Message, Message> {

    private static final Logger LOG = LoggerFactory.getLogger(SoilTask.class.getSimpleName());
    private CQLExecutor executor;

    public SoilTask() {}

    public void setExecutor(CQLExecutor executor) {
        this.executor = executor;
    }

    @Override
    public Message execute(Message message) throws RuntimeException {
        Message<Soil> msg = getMessage();
        //TODO:
        LOG.info(msg.toString());
        SoilEntity entity = new SoilEntity();
        Soil soil = msg.getEvent(Soil.class);
        entity.setUuid(soil.getUuid());
        entity.setTimestamp(Long.valueOf(soil.getTimestamp()));
        entity.setTemperature(Double.valueOf(soil.getTemperature().getValue().toString()));
        entity.setHumidity(Double.valueOf(soil.getHumidity().getValue().toString()));
        entity.setMoisture(Double.valueOf(soil.getMoisture().getValue().toString()));
        entity.setPressure(Double.valueOf(soil.getPressure().getValue().toString()));
        entity.setDepth(Double.valueOf(soil.getDepth().getValue().toString()));
        entity.setChannelId(soil.getChannelId());
        entity.setCreatedAt(soil.getCreatedAt());
        //Calculate Y1, Y2, Y3 and Update Model:
        try {
            entity.insert(executor);
        } catch (SQLException e) { LOG.error(e.getMessage()); }
        return new Response().setStatus(200).setMessage("SoilTask Under construction");
    }

    @Override
    public Message abort(Message message) throws RuntimeException {
        return new Response().setStatus(500).setError("Error: " + SoilTask.class.getSimpleName());
    }
}
