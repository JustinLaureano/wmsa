#!/bin/sh

CORE_ID=$(docker ps --filter "name=core" --format "{{.ID}}")

docker cp $CORE_ID:/var/www/html/vendor ./core
