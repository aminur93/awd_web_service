package com.infoworks.lab.domain.repositories;

import com.infoworks.lab.domain.entities.SoilEntity;
import com.infoworks.lab.rest.repository.CqlRepository;
import com.it.soul.lab.cql.CQLExecutor;
import org.springframework.stereotype.Repository;

@Repository
public class SoilRepository implements CqlRepository<SoilEntity, String> {

    private CQLExecutor executor;

    public SoilRepository(CQLExecutor executor) {
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
    public Class<SoilEntity> getEntityType() {
        return SoilEntity.class;
    }

}
