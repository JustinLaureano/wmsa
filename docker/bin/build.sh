#!/bin/sh

# Use this script to build the containers for the application

docker-compose build --no-cache core
docker-compose build --no-cache web
docker-compose build --no-cache worker
docker-compose build --no-cache scheduler
docker-compose build --no-cache update
docker-compose build --no-cache reverb
docker-compose build --no-cache redis
docker-compose build --no-cache mysql
docker-compose build --no-cache mailpit
