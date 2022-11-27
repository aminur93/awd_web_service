package com.infoworks.lab.domain.repositories;

import com.infoworks.lab.domain.entities.AnemometerEntity;
import com.infoworks.lab.rest.repository.CqlRepository;
import com.it.soul.lab.cql.CQLExecutor;
import org.springframework.stereotype.Repository;

@Repository
public class AnemometerRepository implements CqlRepository<AnemometerEntity, String> {

    private CQLExecutor executor;

    public AnemometerRepository(CQLExecutor executor) {
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
    public Class<AnemometerEntity> getEntityType() {
        return AnemometerEntity.class;
    }
}
