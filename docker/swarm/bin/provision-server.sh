#!/bin/bash

set -e

USER="billy"
PASSWORD="dillydilly"
DOCKERHUB_USERNAME=""
DOCKERHUB_TOKEN=""

# Parse arguments
while [[ "$#" -gt 0 ]]; do
    case $1 in
        --user=*) USER="${1#*=}";;
        --password=*) PASSWORD="${1#*=}";;
        --dockerhub-username=*) DOCKERHUB_USERNAME="${1#*=}";;
        --dockerhub-token=*) DOCKERHUB_TOKEN="${1#*=}";;
        *) echo "Unknown parameter passed: $1"; exit 1;;
    esac
    shift
done

# Verify all variables are correct
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


# Create non-root user
adduser $USER

echo "$USER:$PASSWORD" | chpasswd

usermod -aG wheel $USER


# Create user directories
mkdir -p /home/$USER/.ssh
touch /home/$USER/.ssh/authorized_keys
chown -R $USER:$USER /home/$USER
chown -R $USER:$USER /usr/src
chmod 700 /home/$USER/.ssh
chmod 644 /home/$USER/.ssh/authorized_keys

# Copy ssh key from root to user
rsync --archive --chown=$USER:$USER ~/.ssh /home/$USER

dnf update -y

# Setup firewall
dnf install firewalld -y
systemctl start firewalld
firewall-cmd --permanent --add-service=http
#TODO: Setup https

firewall-cmd --reload



# Install Docker

dnf check-update
dnf config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
dnf install -y docker-ce docker-ce-cli containerd.io
systemctl start docker
systemctl enable docker
usermod -aG docker $USER



# Login to Dockerhub
touch ~/token.txt
echo $DOCKERHUB_TOKEN > ~/token.txt
cat ~/token.txt | docker login --username $DOCKERHUB_USERNAME --password-stdin
rm -f ~/token.txt


# Open up ports for swarm
# firewall-cmd --permanent --add-port=2376/tcp
firewall-cmd --permanent --add-port=2377/tcp
firewall-cmd --permanent --add-port=7946/tcp
firewall-cmd --permanent --add-port=80/tcp
firewall-cmd --permanent --add-port=7946/udp
firewall-cmd --permanent --add-port=4789/udp

firewall-cmd --reload
systemctl restart docker
