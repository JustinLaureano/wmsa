#!/bin/sh

CORE_ID=$(docker ps --filter "name=core" --format "{{.ID}}")
WORKER_ID=$(docker ps --filter "name=worker" --format "{{.ID}}")
SCHEDULER_ID=$(docker ps --filter "name=scheduler" --format "{{.ID}}")

docker cp $CORE_ID:/var/www/html/vendor ./core
docker cp ./core/vendor $WORKER_ID:/var/www/html
docker cp ./core/vendor $SCHEDULER_ID:/var/www/html
