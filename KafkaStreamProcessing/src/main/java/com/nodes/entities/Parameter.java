package com.nodes.entities;

import com.it.soul.lab.sql.query.models.DataType;
import com.it.soul.lab.sql.query.models.Property;

import java.io.IOException;
import java.io.ObjectInput;
import java.io.ObjectOutput;
import java.util.HashMap;
import java.util.Map;

public class Parameter extends Property {
    private Unit unit;

    public Parameter() {}

    public Parameter(String key, Object value, Unit unit) {
        super(key, value);
        this.unit = unit;
    }

    public Unit getUnit() {
        return unit;
    }

    public void setUnit(Unit unit) {
        this.unit = unit;
    }

    public void writeExternal(ObjectOutput out) throws IOException {
        Map<String, Object> props = new HashMap();
        props.put("key", this.getKey());
        props.put("value", this.getValue());
        props.put("type", this.getType().name());
        props.put("unit", this.getUnit().name());
        out.writeObject(props);
    }

    public void readExternal(ObjectInput in) throws IOException, ClassNotFoundException {
        Object object = in.readObject();
        if (object instanceof Map) {
            Map<String, Object> data = (Map)object;
            this.setKey(data.get("key").toString());
            this.setValue(data.get("value"));
            this.setType(DataType.valueOf(data.get("type").toString()));
            this.setUnit(Unit.valueOf(data.get("unit").toString()));
        }

    }
}
