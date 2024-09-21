# Swarm Node Server Management

## Check cluster status on leader node

```bash
docker node ls
```

## Add another leader node to a stack

Run this command on the leader node to generate the command that is needed to add the new node as a manager (leader) node.

```bash
# On leader node
docker swarm join-token manager

# Example Output
To add a manager to this swarm, run the following command:

docker swarm join \
    --token SWMTKN-1-61ztec5kyafptydic6jfc1i33t37flcl4nuipzcusor96k7kby-5vy9t8u35tuqm7vh67lrz9xp6 \
    192.168.99.100:2377

```

Run the command on the new manager node to join it to the swarm.


## Promote a worker node to a manager node

If you have an existing worker node but want to promote it to the manager you can run this command on a manager node:

```bash
docker node promote <NODE_HOSTNAME>

# Example
docker node promote node02
```


## Demote a worker node to a manager node

If you have an existing manager node but want to demote it to a worker, you can run this command on the manager node:

```bash
docker node demote <NODE_HOSTNAME>

# Example
docker node promote node02
```


## Other commands

```bash
docker stack ls

docker service ls

docker service ps wmsa_core
docker service ps wmsa_web
docker service ps wmsa_mysql
docker service ps wmsa_redis
docker service ps wmsa_scheduler
docker service ps wmsa_worker
docker service ps wmsa_update


docker service logs wmsa_core
docker service logs wmsa_web
docker service logs wmsa_mysql
docker service logs wmsa_redis
docker service logs wmsa_scheduler
docker service logs wmsa_worker
docker service logs wmsa_update

docker container ls
docker exec -it wmsa_core.1.<ID> bash

docker stack rm wmsa
```
