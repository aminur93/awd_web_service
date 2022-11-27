package com.infoworks.lab.domain.beans.tasks.events;

import com.infoworks.lab.beans.tasks.nuts.AbstractTask;
import com.infoworks.lab.domain.entities.SoilECEntity;
import com.infoworks.lab.rest.models.Message;
import com.infoworks.lab.rest.models.Response;
import com.it.soul.lab.cql.CQLExecutor;
import com.nodes.events.SoilEC;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.sql.SQLException;

public class SoilECTask extends AbstractTask<Message, Message> {

    private static final Logger LOG = LoggerFactory.getLogger(SoilECTask.class.getSimpleName());
    private CQLExecutor executor;

    public SoilECTask() {}

    public void setExecutor(CQLExecutor executor) {
        this.executor = executor;
    }

    @Override
    public Message execute(Message message) throws RuntimeException {
        Message<SoilEC> msg = getMessage();
        //TODO:
        LOG.info(msg.toString());
        SoilECEntity entity = new SoilECEntity();
        SoilEC soilec = msg.getEvent(SoilEC.class);
        entity.setUuid(soilec.getUuid());
        entity.setTimestamp(Long.valueOf(soilec.getTimestamp()));
        entity.setConductivity(Double.valueOf(soilec.getConductivity().getValue().toString()));
        entity.setChannelId(soilec.getChannelId());
        entity.setCreatedAt(soilec.getCreatedAt());
        //Calculate Y1, Y2, Y3 and Update Model:
        try {
            entity.insert(executor);
        } catch (SQLException e) { LOG.error(e.getMessage()); }
        return new Response().setStatus(200).setMessage("SoilECTask Under construction");
    }

    @Override
    public Message abort(Message message) throws RuntimeException {
        return new Response().setStatus(500).setError("Error: " + SoilECTask.class.getSimpleName());
    }
}
