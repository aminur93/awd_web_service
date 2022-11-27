package com.infoworks.lab.webapp.config;

import org.springframework.boot.web.embedded.netty.NettyReactiveWebServerFactory;
import org.springframework.boot.web.reactive.server.ReactiveWebServerFactory;
import org.springframework.boot.web.server.WebServer;
import org.springframework.context.annotation.Configuration;
import org.springframework.core.env.Environment;
import org.springframework.http.server.reactive.HttpHandler;

import javax.annotation.PostConstruct;
import javax.annotation.PreDestroy;

/**
 * Redirect HTTP requests to HTTPS
 *
 * Now that we have enabled HTTPS in our Spring Boot application and blocked any HTTP request, we want to redirect all traffic to HTTPS.
 * Spring allows defining just one network connector in application.properties (or application.yml).
 * Since we have used it for HTTPS, we have to set the HTTP connector programmatically for our Tomcat web server.
 */

@Configuration
public class ServerConfig {

    private Environment env;
    private HttpHandler httpHandler;
    private WebServer webServer;

    public ServerConfig(Environment env, HttpHandler httpHandler) {
        this.env = env;
        this.httpHandler = httpHandler;
    }

    @PostConstruct
    public void start() {
        int httpPort = Integer.valueOf(env.getProperty("server.http.port"));
        ReactiveWebServerFactory factory = new NettyReactiveWebServerFactory(httpPort);
        webServer = factory.getWebServer(httpHandler);
        webServer.start();
    }

    @PreDestroy
    public void stop() {
        webServer.stop();
    }

    //Suggested but not working on this version: on http call its never triggered.
    /*@Bean
    public WebFilter httpsRedirectFilter() {
        return (ServerWebExchange exchange, WebFilterChain chain) -> {
            URI originalUri = exchange.getRequest().getURI();
            //here set your condition to http->https redirect
            List<String> forwardedValues = exchange.getRequest().getHeaders().get("x-forwarded-proto");
            if (forwardedValues != null && forwardedValues.contains("http")) {
                try {
                    URI mutatedUri = new URI("https",
                            originalUri.getUserInfo(),
                            originalUri.getHost(),
                            originalUri.getPort(),
                            originalUri.getPath(),
                            originalUri.getQuery(),
                            originalUri.getFragment());
                    ServerHttpResponse response = exchange.getResponse();
                    response.setStatusCode(HttpStatus.MOVED_PERMANENTLY);
                    response.getHeaders().setLocation(mutatedUri);
                    return Mono.empty();
                } catch (URISyntaxException e) {
                    throw new IllegalStateException(e.getMessage(), e);
                }
            }
            return chain.filter(exchange);
        };
    }*/

    /*
    @Bean
    public ServletWebServerFactory servletContainer() {
        TomcatServletWebServerFactory tomcat = new TomcatServletWebServerFactory() {
            @Override
            protected void postProcessContext(Context context) {
                SecurityConstraint securityConstraint = new SecurityConstraint();
                securityConstraint.setUserConstraint("CONFIDENTIAL");
                SecurityCollection collection = new SecurityCollection();
                collection.addPattern("/*");
                securityConstraint.addCollection(collection);
                context.addConstraint(securityConstraint);
            }
        };
        tomcat.addAdditionalTomcatConnectors(getHttpConnector());
        return tomcat;
    }

    private Connector getHttpConnector() {
        Connector connector = new Connector(TomcatServletWebServerFactory.DEFAULT_PROTOCOL);
        connector.setScheme("http");
        connector.setPort(Integer.valueOf(env.getProperty("server.http.port")));
        connector.setSecure(false);
        connector.setRedirectPort(Integer.valueOf(env.getProperty("server.port")));
        return connector;
    }
    */

}
