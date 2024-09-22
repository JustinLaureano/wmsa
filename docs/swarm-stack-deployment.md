# Swarm Stack Deployment


## Copy local file to Leader

The production compose and environment files need to be copied over to the leader node so that the stack can be created.


Copy over production .env file to manager node.

```bash
scp .env.prod <USER>@<LEADER_SERVER_IP>:/usr/src/.env
```

Copy over production compose files to manager node.

```bash
scp docker-compose.prod.yml <USER>@<LEADER_SERVER_IP>:/usr/src

scp docker-compose.monitor.yml <USER>@<LEADER_SERVER_IP>:/usr/src
```


## Deploy the stack

To deploy the stack on the leader node, you will first need to ssh into the server.

```bash
ssh <USER>@<LEADER_SERVER_IP>
```

After that the environment variables need loaded into the session so that the compose file can read them

```bash
export $(cat .env)
```

And finally, you can deploy the stack for the main application.

```bash
docker stack deploy --with-registry-auth --detach=true -c docker-compose.prod.yml wmsa
```


Once the stack is running, you can deploy the monitoring stack as well.

```bash
docker stack deploy --detach=true -c docker-compose.monitor.yml monitor
```

You can view the server and swarm monitoring tools by default on port `8080`.


## Commands to monitor the stack

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
