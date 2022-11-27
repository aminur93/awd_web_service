package com.infoworks.lab.domain.repositories;

import com.infoworks.lab.domain.entities.LeafEntity;
import com.infoworks.lab.rest.repository.CqlRepository;
import com.it.soul.lab.cql.CQLExecutor;
import org.springframework.stereotype.Repository;

@Repository
public class LeafRepository implements CqlRepository<LeafEntity, String> {

    private CQLExecutor executor;

    public LeafRepository(CQLExecutor executor) {
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
    public Class<LeafEntity> getEntityType() {
        return LeafEntity.class;
    }

}
