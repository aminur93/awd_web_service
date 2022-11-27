package com.infoworks.lab.webapp.config;

import org.springframework.beans.factory.annotation.Value;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.HashMap;
import java.util.Map;

@RestController
@RequestMapping("/api/version")
public class VersionInfoController {

    @Value("${app.version}")
    private String version;

    @Value("${app.build.name}")
    private String buildName;

    @Value("${app.build.version}")
    private String buildVersion;

    @GetMapping
    public ResponseEntity<Map> version() {
        Map<String, String> version = new HashMap<>();
        version.put("app.version", this.version);
        version.put("app.build.name", buildName);
        version.put("app.build.version", buildVersion);
        return ResponseEntity.ok(version);
    }

}
