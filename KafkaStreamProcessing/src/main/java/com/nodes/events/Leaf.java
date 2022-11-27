package com.nodes.events;

import com.nodes.entities.Parameter;
import com.nodes.entities.Unit;

public class Leaf extends EventExt {
    private Parameter wetness;
    private Parameter temperature;

    public Leaf() {}

    public Leaf(Object wetness, Object temperature) {
        this.wetness = new Parameter("wetness", wetness, Unit.Percentage);
        this.temperature = new Parameter("temperature", temperature, Unit.Temperature);
    }

    public Parameter getWetness() {
        return wetness;
    }

    public void setWetness(Parameter wetness) {
        this.wetness = wetness;
    }

    public Parameter getTemperature() {
        return temperature;
    }

    public void setTemperature(Parameter temperature) {
        this.temperature = temperature;
    }
}
