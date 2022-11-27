package com.infoworks.lab.webapp;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.ComponentScan;

@SpringBootApplication
@ComponentScan(basePackages = {"com.infoworks.lab.webapp.config"})
public class ApiGatewayService {

    public static void main(String[] args) {
        SpringApplication.run(ApiGatewayService.class, args);
    }

}

