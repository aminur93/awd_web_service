package com.infoworks.lab.domain.beans.tasks.events;

import com.infoworks.lab.beans.tasks.nuts.AbstractTask;
import com.infoworks.lab.domain.entities.SensorDownAlert;
import com.infoworks.lab.rest.models.Message;
import com.infoworks.lab.rest.models.Response;
import com.it.soul.lab.cql.CQLExecutor;
import com.nodes.events.EventExt;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.sql.SQLException;

public class AlertTask extends AbstractTask<Message, Message> {

    private static final Logger LOG = LoggerFactory.getLogger(AlertTask.class.getSimpleName());
    private CQLExecutor executor;

    public AlertTask() {}

    public void setExecutor(CQLExecutor executor) {
        this.executor = executor;
    }

    @Override
    public Message execute(Message message) throws RuntimeException {
        Message<EventExt> msg = getMessage();
        LOG.info(msg.toString());
        EventExt event = msg.getEvent(EventExt.class);
        SensorDownAlert alert = new SensorDownAlert();
        alert.setUuid(event.getUuid());
        alert.setChannelId(event.getChannelId() + "");
        alert.setAction(event.getEventType().name());
        alert.setLastEntryId(event.getLastEntryId() + "");
        try {
            alert.insert(executor);
        } catch (SQLException e) { LOG.error(e.getMessage()); }
        return new Response().setStatus(200).setMessage("AlertTask Under construction");
    }

    @Override
    public Message abort(Message message) throws RuntimeException {
        return new Response().setStatus(500).setError("Error: " + AlertTask.class.getSimpleName());
    }
}
