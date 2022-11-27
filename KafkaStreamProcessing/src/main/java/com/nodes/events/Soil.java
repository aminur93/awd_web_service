package com.nodes.events;

import com.nodes.entities.Parameter;
import com.nodes.entities.Unit;

import java.text.SimpleDateFormat;

public class Soil extends EventExt {
    private Parameter moisture;
    private Parameter temperature;
    private Parameter humidity;
    private Parameter pressure;
    private Parameter depth;

    public Soil() {
        this(0.0, 0.0, 0.0, 0.0);
    }

    public Soil(Object moisture, Object temperature, Object humidity, Object pressure) {
        this(moisture, temperature, humidity, pressure, 0.0, 0l);
    }

    public Soil(Object moisture, Object temperature, Object humidity, Object pressure, Object depth, Long channelId) {
        this(moisture, temperature, humidity, pressure
                , depth
                , channelId
                , new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(System.currentTimeMillis()));
    }

    public Soil(Object moisture, Object temperature, Object humidity, Object pressure, Object depth, Long channelId, String createAt) {
        super(channelId, createAt);
        this.moisture = new Parameter("moisture", moisture, Unit.Percentage);
        this.temperature = new Parameter("temperature", temperature, Unit.Temperature);
        this.humidity = new Parameter("humidity", humidity, Unit.Humidity);
        this.pressure = new Parameter("pressure", pressure, Unit.Pressure);
        this.depth = new Parameter("depth", depth, Unit.Depth);
    }

    public Parameter getMoisture() {
        return moisture;
    }

    public void setMoisture(Parameter moisture) {
        this.moisture = moisture;
    }

    public Parameter getTemperature() {
        return temperature;
    }

    public void setTemperature(Parameter temperature) {
        this.temperature = temperature;
    }

    public Parameter getHumidity() {
        return humidity;
    }

    public void setHumidity(Parameter humidity) {
        this.humidity = humidity;
    }

    public Parameter getPressure() {
        return pressure;
    }

    public void setPressure(Parameter pressure) {
        this.pressure = pressure;
    }

    public Parameter getDepth() {
        return depth;
    }

    public void setDepth(Parameter depth) {
        this.depth = depth;
    }
}
