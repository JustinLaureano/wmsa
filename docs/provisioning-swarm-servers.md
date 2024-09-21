# Provisioning Docker Swarm Servers

This application is intended to be deployed in a Docker Swarm environment, so this guide covers how leader and worker node servers should be initially setup and provisioned to work correctly.

## Provision Base Docker Swarm Container

This section is intended to be followed as the initial setup for a new docker swarm node server.
As soon as the server has been created and is able to be accessed and used, these follow steps should be followed.


### Prerequisites:
- Rocky Linux 9 Server
- ssh keys installed for root user

To provison a brand new node server, run the following commands on your local machine from the root direction of the project.
Replace the `<VARIABLE_NAME>` with the appropriate values for the new node server.


```bash
chmod +x ./docker/swarm/bin/provision-node.sh

./docker/swarm/bin/provision-node.sh --user=<USER> --server-ip=<SERVER_IP> --password=<PASSWORD> --dockerhub-username=<DOCKERHUB_USERNAME> --dockerhub-token=<DOCKERHUB_TOKEN>
```


## SSH Authentication

You will first want to ensure you are making secure connections to the server, so setting up ssh key authentication will be the first step.

Use the `ssh-copy-id` command from the local machine to copy your ssh key to the node server.

```bash
ssh-copy-id root@<SERVER_IP>
```


Once the command has completed, test this authentication by attempting to login to the server and verify that it works correctly when you are not prompted for a password.

```bash
ssh root@<SERVER_IP>

# non-root user
ssh <USER>@<SERVER_IP>
```



## Provisioning Docker Swarm Leader Node

If thie swarm is just initially being created, the first server created needs to be designated at a leader node in the swarm.

To create the leader node, you will need to ssh onto the server that you are designating the leader.


```bash
ssh root@<SERVER_IP>
```

Then run the following command to initialize the cluster.

```bash
# On node server
docker swarm init --advertise-addr <SERVER_IP>
```

This will initialize the current node as the leader. The returned text will include a command statement to run to add other nodes to the swarm.

```bash
# ...

docker swarm join token --token <TOKEN> <SERVER_IP>:2377

# ...
```

The important takeaway from this text is the token value. Store that value in a secure location like a password safe as you will always need it to add nodes to this swarm cluster. You will also need to keep note of the leader node server ip.


## Provisioning Docker Swarm Worker Node

First login into the node server that has been designated as a worker node.

```bash
ssh root@<SERVER_IP>
```

Join the swarm cluster as a worker. You will need to have your swarm token and leader server IP address in order to join.

```bash
docker swarm join --token <TOKEN> <LEADER_SERVER_IP>:2377
```

You can check the status of the node on the leader manager by running:

```bash
docker node ls
```

### Adding label to node

If you need to add any labels to the worker node, you can do so now by running the following command, with the variables filled in appropriately.

```bash
docker node update --label-add <LABEL_NAME>=<LABEL_VALUE> <SERVER_IP

# Example
docker node update --label-add db=true node-3
```
