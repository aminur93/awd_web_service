package com.infoworks.lab.domain.beans.queue;

import com.infoworks.lab.beans.queue.AbstractTaskQueueManager;
import com.infoworks.lab.beans.tasks.definition.QueuedTaskLifecycleListener;
import com.infoworks.lab.beans.tasks.definition.Task;
import com.infoworks.lab.domain.beans.tasks.events.AlertTask;
import com.infoworks.lab.domain.beans.tasks.events.SoilECTask;
import com.infoworks.lab.domain.beans.tasks.events.SoilTask;
import com.it.soul.lab.cql.CQLExecutor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.kafka.annotation.KafkaListener;
import org.springframework.kafka.support.Acknowledgment;
import org.springframework.messaging.handler.annotation.Payload;
import org.springframework.stereotype.Component;

import java.io.IOException;
import java.lang.reflect.InvocationTargetException;
import java.util.logging.Level;
import java.util.logging.Logger;

@Component
public class TaskQueueManager extends AbstractTaskQueueManager {

    private static final Logger logger = Logger.getLogger("TaskQueueManager");
    private CQLExecutor cqlExecutor;

    public TaskQueueManager(@Autowired QueuedTaskLifecycleListener listener
            , CQLExecutor executor) {
        super(listener);
        this.cqlExecutor = executor;
    }

    @Override
    protected Task createTask(String text)
            throws ClassNotFoundException, IOException, IllegalAccessException, InstantiationException
            , NoSuchMethodException, InvocationTargetException {
        Task task = super.createTask(text);
        if (task instanceof SoilTask)
            ((SoilTask) task).setExecutor(cqlExecutor);
        else if (task instanceof SoilECTask)
            ((SoilECTask) task).setExecutor(cqlExecutor);
        else if (task instanceof AlertTask)
            ((AlertTask) task).setExecutor(cqlExecutor);
        return task;
    }

    @KafkaListener(topics = {"${topic.execute}"}, concurrency = "5")
    public void startListener(@Payload String message, Acknowledgment ack) {
        // retrieve the message content
        String text = message;
        logger.log(Level.INFO, "EXE-QUEUE: Message received {0} ", text);
        if (handleTextOnStart(text)){
            ack.acknowledge();
        }
    }

    @KafkaListener(topics = {"${topic.abort}"}, concurrency = "3")
    public void abortListener(@Payload String message, Acknowledgment ack) {
        // retrieve the message content
        String text = message;
        logger.log(Level.INFO, "ABORT-QUEUE: Message received {0} ", text);
        if (handleTextOnStop(text)){
            ack.acknowledge();
        }
    }

}
