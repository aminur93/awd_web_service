package com.infoworks.lab.domain.repositories;

import com.infoworks.lab.domain.entities.PluviometerEntity;
import com.infoworks.lab.rest.repository.CqlRepository;
import com.it.soul.lab.cql.CQLExecutor;
import org.springframework.stereotype.Repository;

@Repository
public class PluviometerRepository implements CqlRepository<PluviometerEntity, String> {

    private CQLExecutor executor;

    public PluviometerRepository(CQLExecutor executor) {
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
    public Class<PluviometerEntity> getEntityType() {
        return PluviometerEntity.class;
    }

}
