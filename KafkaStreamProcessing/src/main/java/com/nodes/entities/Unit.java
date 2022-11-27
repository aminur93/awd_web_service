package com.nodes.entities;

public enum Unit {

    WindVaneNorth("North"),
    WindVaneSouth("South"),
    WindVaneEast("EAST"),
    WindVaneWEST("WEST"),
    RainFall("mm"),
    WindSpeed("km/h"),
    Radiation("μmol*m-2*s-1"),
    ElectricConductivity("μS/cm"),
    Pressure("Pascale"),
    Humidity("%RH"),
    Percentage("%"),
    Temperature("C"),
    Depth("cm");

    private String unitVal;

    Unit(String unitVal) {
        this.unitVal = unitVal;
    }

    public String value(){
        return unitVal;
    }
}
