package com.nodes.events;

import com.nodes.entities.Parameter;
import com.nodes.entities.Unit;

public class Pluviometer extends EventExt {
    private Parameter windVane;
    private Parameter rainfall;

    public Pluviometer() {}

    public Pluviometer(Object windVane, Unit windVaneDirection, Object rainfall) {
        this.windVane = new Parameter("windVane", windVane, windVaneDirection);
        this.rainfall = new Parameter("rainfall", rainfall, Unit.RainFall);
    }

    public Parameter getWindVane() {
        return windVane;
    }

    public void setWindVane(Parameter windVane) {
        this.windVane = windVane;
    }

    public Parameter getRainfall() {
        return rainfall;
    }

    public void setRainfall(Parameter rainfall) {
        this.rainfall = rainfall;
    }
}
