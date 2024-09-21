#!/bin/bash

set -e


SERVER_IP=""
USER="billy"
PASSWORD=""
DOCKERHUB_USERNAME=""
DOCKERHUB_TOKEN=""

# Parse arguments
while [[ "$#" -gt 0 ]]; do
    case $1 in
        --server-ip=*) SERVER_IP="${1#*=}";;
        --user=*) USER="${1#*=}";;
        --password=*) PASSWORD="${1#*=}";;
        --dockerhub-username=*) DOCKERHUB_USERNAME="${1#*=}";;
        --dockerhub-token=*) DOCKERHUB_TOKEN="${1#*=}";;
        *) echo "Unknown parameter passed: $1"; exit 1;;
    esac
    shift
done

# Verify all variables are correct
if [ -z "$SERVER_IP" ]; then
    echo "The --server-ip argument is required."
    exit 1
fi

if [ -z "$PASSWORD" ]; then
    echo "The --password argument is required."
    exit 1
fi

if [ -z "$DOCKERHUB_USERNAME" ]; then
    echo "The --dockerhub-username argument is required."
    exit 1
fi

if [ -z "$DOCKERHUB_TOKEN" ]; then
    echo "The --dockerhub-token argument is required."
    exit 1
fi


# chmod +x docker/swarm/bin/provision-node.sh

# Copy the script to the server
scp -C -o StrictHostKeyChecking=no docker/swarm/bin/rocky-9-setup.sh root@$SERVER_IP:./provision-node.sh

# Run to script
ssh -tt -o StrictHostKeyChecking=no root@$SERVER_IP "chmod +x ./provision-node.sh && ./provision-node.sh --user=\$USER --password=\$PASSWORD --dockerhub-username=\$DOCKERHUB_USERNAME --dockerhub-token=\$DOCKERHUB_TOKEN"