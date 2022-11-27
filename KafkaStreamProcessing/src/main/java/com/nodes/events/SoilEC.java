package com.nodes.events;

import com.nodes.entities.Parameter;
import com.nodes.entities.Unit;

import java.text.SimpleDateFormat;

public class SoilEC extends EventExt {
    private Parameter conductivity;

    public SoilEC() {
        this(0.0);
    }

    public SoilEC(Object conductivity) {
        this(conductivity, 0l);
    }

    public SoilEC(Object conductivity, Long ChannelId) {
        this(conductivity, ChannelId
                , new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(System.currentTimeMillis()));
    }

    public SoilEC(Object conductivity, Long ChannelId, String createAt) {
        super(ChannelId, createAt);
        this.conductivity = new Parameter("conductivity", conductivity, Unit.ElectricConductivity);
    }

    public Parameter getConductivity() {
        return conductivity;
    }

    public void setConductivity(Parameter conductivity) {
        this.conductivity = conductivity;
    }
}
