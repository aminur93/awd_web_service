package com.infoworks.lab.domain.repositories;


import com.infoworks.lab.domain.entities.SolarEntity;
import com.infoworks.lab.rest.repository.CqlRepository;
import com.it.soul.lab.cql.CQLExecutor;
import org.springframework.stereotype.Repository;

@Repository
public class SolarRepository implements CqlRepository<SolarEntity, String> {

    private CQLExecutor executor;

    public SolarRepository(CQLExecutor executor) {
        this.executor = executor;
    }

    @Override
    public CQLExecutor getExecutor() {
        return executor;
    }

    @Override
    public String getPrimaryKeyName() {
        return "uuid";
    }

    @Override
    public Class<SolarEntity> getEntityType() {
        return SolarEntity.class;
    }

}
