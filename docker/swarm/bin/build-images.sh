#!/bin/sh

# Login to Dockerhub account
## TODO: add login script and arguments to script


# Use this script to build the containers for the application

docker build -t justinlaureano/wmsa-core:latest --target=core -f ./Dockerfile.core .
docker push justinlaureano/wmsa-core:latest


# TODO: finish these images
# docker-compose build --no-cache web
# docker-compose build --no-cache worker
# docker-compose build --no-cache scheduler
# docker-compose build --no-cache update
# docker-compose build --no-cache reverb
# docker-compose build --no-cache redis
# docker-compose build --no-cache mysql
# docker-compose build --no-cache mailpit
