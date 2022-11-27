package com.nodes.events;

import com.nodes.entities.Parameter;
import com.nodes.entities.Unit;

public class Anemometer extends EventExt {
    private Parameter windSpeed;

    public Anemometer() {}

    public Anemometer(Object windSpeed) {
        this.windSpeed = new Parameter("windSpeed", windSpeed, Unit.WindSpeed);
    }

    public Parameter getWindSpeed() {
        return windSpeed;
    }

    public void setWindSpeed(Parameter windSpeed) {
        this.windSpeed = windSpeed;
    }
}
