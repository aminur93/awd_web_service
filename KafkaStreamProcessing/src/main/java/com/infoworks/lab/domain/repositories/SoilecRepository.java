package com.infoworks.lab.domain.repositories;

import com.infoworks.lab.domain.entities.SoilECEntity;
import com.infoworks.lab.rest.repository.CqlRepository;
import com.it.soul.lab.cql.CQLExecutor;
import org.springframework.stereotype.Repository;

@Repository
public class SoilecRepository implements CqlRepository<SoilECEntity, String> {

    private CQLExecutor executor;

    public SoilecRepository(CQLExecutor executor) {
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
    public Class<SoilECEntity> getEntityType() {
        return SoilECEntity.class;
    }

}
