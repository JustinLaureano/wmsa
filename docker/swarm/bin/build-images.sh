#!/bin/bash

set -e

DOCKERHUB_USERNAME=""
DOCKERHUB_TOKEN=""
MYSQL_ROOT_PASSWORD=""

# Parse arguments
while [[ "$#" -gt 0 ]]; do
    case $1 in
        --dockerhub-username=*) DOCKERHUB_USERNAME="${1#*=}";;
        --dockerhub-token=*) DOCKERHUB_TOKEN="${1#*=}";;
        --mysql-root-password=*) MYSQL_ROOT_PASSWORD="${1#*=}";;
        *) echo "Unknown parameter passed: $1"; exit 1;;
    esac
    shift
done


# Login to Dockerhub account

touch ./token.txt
echo $DOCKERHUB_TOKEN > ~/token.txt
cat ./token.txt | docker login --username $DOCKERHUB_USERNAME --password-stdin
rm -f ./token.txt


# Build images and push to docker account

echo "Building wmsa-core image..."
docker build -t justinlaureano/wmsa-core:latest --target=core -f ./Dockerfile.core .
docker push justinlaureano/wmsa-core:latest
echo "Build of wmsa-core image complete."



echo "Building wmsa-web image..."
docker build -t justinlaureano/wmsa-web:latest -f ./Dockerfile.nginx .
docker push justinlaureano/wmsa-web:latest
echo "Build of wmsa-web image complete."



echo "Building wmsa-worker image..."
docker build -t justinlaureano/wmsa-worker:latest --target=worker -f ./Dockerfile.core .
docker push justinlaureano/wmsa-worker:latest
echo "Build of wmsa-worker image complete."



echo "Building wmsa-scheduler image..."
docker build -t justinlaureano/wmsa-scheduler:latest --target=scheduler -f ./Dockerfile.core .
docker push justinlaureano/wmsa-scheduler:latest
echo "Build of wmsa-scheduler image complete."



echo "Building wmsa-update image..."
docker build -t justinlaureano/wmsa-update:latest --target=base -f ./Dockerfile.core .
docker push justinlaureano/wmsa-update:latest
echo "Build of wmsa-update image complete."



echo "Building wmsa-reverb image..."
docker build -t justinlaureano/wmsa-reverb:latest --target=reverb -f ./Dockerfile.core .
docker push justinlaureano/wmsa-reverb:latest
echo "Build of wmsa-reverb image complete."



echo "Building wmsa-mysql image..."
docker build -t justinlaureano/wmsa-mysql:latest -f ./Dockerfile.mysql --build-arg password=$MYSQL_ROOT_PASSWORD .
docker push justinlaureano/wmsa-mysql:latest
echo "Build of wmsa-mysql image complete."



echo "All images builds complete."
