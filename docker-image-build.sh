#!/bin/bash

AppVersion="1.0.2"
DockerHubUser="devndl"
DockerHubRepoName="ndl-apps"
DockerHubRepository="${DockerHubUser}/${DockerHubRepoName}"
#
docker login --password 321@Devndl@456 --username ${DockerHubUser}
###
ApiGateway="api-gateway"
ApiGatewayDir="ApiGatewayService"
echo "Creating ${ApiGateway} Image"
# mvn -pl ${ApiGatewayDir} -am clean package -DskipTests
# docker image build -f ${ApiGatewayDir}/Dockerfile-embedded -t ${ApiGateway}:${AppVersion} ./${ApiGatewayDir}/
# docker image tag ${ApiGateway}:${AppVersion} ${DockerHubRepository}:${ApiGateway}-${AppVersion}
# docker push ${DockerHubRepository}:${ApiGateway}-${AppVersion}
#
###
AuthService="auth-service"
AuthServiceDir="barcAuthService"
echo "Creating ${AuthService} Image"
#mvn -pl ${AuthServiceDir} -am clean package -DskipTests
# docker image build --no-cache -f ${AuthServiceDir}/Dockerfile -t ${AuthService}:${AppVersion} ./${AuthServiceDir}/
# docker image tag ${AuthService}:${AppVersion} ${DockerHubRepository}:${AuthService}-${AppVersion}
# docker push ${DockerHubRepository}:${AuthService}-${AppVersion}
#
###
NotifyService="notify-service"
NotifyServiceDir="notificationService"
echo "Creating ${NotifyService} Image"
#mvn -pl ${NotifyServiceDir} -am clean package -DskipTests
# docker image build -f ${NotifyServiceDir}/Dockerfile -t ${NotifyService}:${AppVersion} ./${NotifyServiceDir}/
# docker image tag ${NotifyService}:${AppVersion} ${DockerHubRepository}:${NotifyService}-${AppVersion}
# docker push ${DockerHubRepository}:${NotifyService}-${AppVersion}
#
###
InfoService="info-service"
InfoServiceDir="infoBarc"
echo "Creating ${InfoService} Image"
#mvn -pl ${ContentServiceDir} -am clean package -DskipTests
# docker image build --no-cache -f ${InfoServiceDir}/Dockerfile -t ${InfoService}:${AppVersion} ./${InfoServiceDir}/
# docker image tag ${InfoService}:${AppVersion} ${DockerHubRepository}:${InfoService}-${AppVersion}
# docker push ${DockerHubRepository}:${InfoService}-${AppVersion}
#
###
MonitoringService="prometheus-db"
MonitoringServiceDir="monitoring"
echo "Creating ${MonitoringService} Image"
# docker image build -f ${MonitoringServiceDir}/Dockerfile -t ${MonitoringService}:${AppVersion} ./${MonitoringServiceDir}/
# docker image tag ${MonitoringService}:${AppVersion} ${DockerHubRepository}:${MonitoringService}-${AppVersion}
# docker push ${DockerHubRepository}:${MonitoringService}-${AppVersion}
#
###
AdminWebApp="admin-web-app"
AdminWebAppDir="barc_admin"
echo "Creating ${AdminWebApp} Image"
# docker image build -f ${AdminWebAppDir}/Dockerfile -t ${AdminWebApp}:${AppVersion} ./${AdminWebAppDir}/
# docker image tag ${AdminWebApp}:${AppVersion} ${DockerHubRepository}:${AdminWebApp}-${AppVersion}
# docker push ${DockerHubRepository}:${AdminWebApp}-${AppVersion}
#
###
kafkaStreamService="data-pipeline-kafka"
kafkaStreamServiceDir="KafkaStreamProcessing"
echo "Creating ${kafkaStreamService} Image"
mvn -pl ${kafkaStreamServiceDir} -am clean package -DskipTests
docker image build -f ${kafkaStreamServiceDir}/Dockerfile -t ${kafkaStreamService}:${AppVersion} ./${kafkaStreamServiceDir}/
docker image tag ${kafkaStreamService}:${AppVersion} ${DockerHubRepository}:${kafkaStreamService}-${AppVersion}
docker push ${DockerHubRepository}:${kafkaStreamService}-${AppVersion}
#
###End-Of-File###
