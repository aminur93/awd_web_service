package com.infoworks.lab.webapp.config;

import io.github.resilience4j.circuitbreaker.CircuitBreakerConfig;
import io.github.resilience4j.timelimiter.TimeLimiterConfig;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.cloud.circuitbreaker.resilience4j.ReactiveResilience4JCircuitBreakerFactory;
import org.springframework.cloud.circuitbreaker.resilience4j.Resilience4JConfigBuilder;
import org.springframework.cloud.client.circuitbreaker.Customizer;
import org.springframework.cloud.gateway.filter.GatewayFilter;
import org.springframework.cloud.gateway.filter.ratelimit.KeyResolver;
import org.springframework.cloud.gateway.filter.ratelimit.RedisRateLimiter;
import org.springframework.cloud.gateway.route.RouteLocator;
import org.springframework.cloud.gateway.route.builder.RouteLocatorBuilder;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.PropertySource;
import org.springframework.web.reactive.function.client.WebClient;
import reactor.core.publisher.Mono;

import java.time.Duration;

@Configuration
@PropertySource("classpath:service-names.properties")
public class SpringCloudConfig {

    @Value("${app.authentication.url}")
    private String authenticationURL;

    @Value("${app.authentication.validation.url}")
    private String authValidationURL;

    @Value("${app.authentication.has.permission.url}")
    private String accessPermissionURL;

    @Value("${app.info.url}")
    private String infoURL;

    @Value("${app.notification.url}")
    private String notificationURL;

    @Value("${app.data.pipeline.url}")
    private String dataPipelineURL;

    /*@Bean
    public GlobalFilter globalFilter() {
        return (exchange, chain) -> {
            System.out.println("Pre Global filter");
            return chain.filter(exchange).then(Mono.fromRunnable(() -> {
                //
                System.out.println("Post Global filter");
            }));
        };
    }*/

    @Bean("CustomAuthFilter")
    public GatewayFilter getAuthFilter(WebClient.Builder builder){
        return AuthFilter.createGatewayFilter(builder, authValidationURL);
    }

    @Bean("CustomPermissionFilter")
    public GatewayFilter getAccessPermissionFilter(WebClient.Builder builder){
        return AccessPermissionFilter.createGatewayFilter(builder, accessPermissionURL);
    }

    @Bean
    public RouteLocator gatewayRoutes(RouteLocatorBuilder builder
                        , @Qualifier("CustomAuthFilter") GatewayFilter authFilter
                        , RedisRateLimiter rateLimiter) {
        return builder.routes()
                .route("loginRateLimiter"
                        , r -> r.path("/api/auth/auth/v1/login")
                                .filters(f -> f.requestRateLimiter(c -> c.setRateLimiter(rateLimiter))
                                .dedupeResponseHeader("Access-Control-Allow-Origin", "RETAIN_UNIQUE"))
                                .uri(authenticationURL))
                .route("authService"
                        , r -> r.path("/api/auth/**")
                                .filters(f -> f.circuitBreaker(c -> c.setName("id-auth-circuit")
                                        .setFallbackUri("/api/fallback/messages/unreachable"))
                                        .dedupeResponseHeader("Access-Control-Allow-Origin", "RETAIN_UNIQUE"))
                                .uri(authenticationURL))
                .route("barcInfoService"
                        , r -> r.path("/api/info/**")
                                .filters(f -> f.requestRateLimiter(config -> config.setRateLimiter(rateLimiter))
                                        .filter(authFilter)
                                        .dedupeResponseHeader("Access-Control-Allow-Origin", "RETAIN_UNIQUE"))
                                .uri(infoURL))
                .route("notificationModule"
                        , r -> r.path("/api/notify/**")
                                .filters(f -> f.requestRateLimiter(c -> c.setRateLimiter(rateLimiter))
                                        .filter(authFilter)
                                        .dedupeResponseHeader("Access-Control-Allow-Origin", "RETAIN_UNIQUE"))
                                .uri(notificationURL))
                .route("dataPipelineModule"
                        , r -> r.path("/api/data/pipeline/**")
                                .filters(f -> f.filter(authFilter))
                                .uri(dataPipelineURL))
                .build();
    }

    @Bean
    public Customizer<ReactiveResilience4JCircuitBreakerFactory> defaultCircuitBreakerFactory() {
        return (factory) -> factory.configureDefault(id -> {
            //Code breakdown for readability:
            Duration timeout = Duration.ofMillis(2100); //For testing replace with 5100ms.
            return new Resilience4JConfigBuilder(id)
                    .circuitBreakerConfig(CircuitBreakerConfig.ofDefaults())
                    .timeLimiterConfig(TimeLimiterConfig.custom()
                            .timeoutDuration(timeout)
                            .build())
                    .build();
        });
    }

    @Bean
    public RedisRateLimiter redisRateLimiter(){
        /**
         * defaultReplenishRate: Default number of request an user can do in a second without dropping any request.
         * defaultBurstCapacity: Maximum number of request an user allowed to do in a second.
         */
        return new RedisRateLimiter(10, 15);
    }

    @Bean
    public KeyResolver userKeyResolver(){
        return (exchange) -> Mono.just("rate-limiter-key");
        /*if (!exchange.getRequest().getHeaders().containsKey(HttpHeaders.AUTHORIZATION)){
            return Mono.just("rate-limiter-key");
        }
        String authHeader = exchange.getRequest().getHeaders().get(HttpHeaders.AUTHORIZATION).get(0);
        if (authHeader == null || authHeader.isEmpty()
                || !authHeader.startsWith("Bearer")){
            return Mono.just("rate-limiter-key");
        }
        //
        try {
            String token = TokenValidator.parseToken(authHeader, "Bearer ");
            JWTPayload payload = TokenValidator.parsePayload(token, JWTPayload.class);
            String username = payload.getIss();
            return Mono.just(username);
        } catch (RuntimeException e) {
            return Mono.just("rate-limiter-key");
        }*/
    }

}