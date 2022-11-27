package com.nodes.events;

import com.nodes.entities.Parameter;
import com.nodes.entities.Unit;

public class Solar extends EventExt {
    private Parameter radiation;

    public Solar() {}

    public Solar(Object radiation) {
        this.radiation = new Parameter("radiation", radiation, Unit.Radiation);
    }

    public Parameter getRadiation() {
        return radiation;
    }

    public void setRadiation(Parameter radiation) {
        this.radiation = radiation;
    }
}
