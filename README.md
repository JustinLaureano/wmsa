# WMSA

## Installation

Clone project locally

```bash
git clone <project-url>
```

Run installation commands

```bash
cd <project-dir>

# Create environment files
cp .env.example .env
cp .env.worker.example .env.worker

# make sure all .sh files are LF for end of line sequence

# Build images
chmod +x ./docker/bin/build.sh

./docker/bin/build.sh

# Start containers
docker-compose up -d

# Copy package dependencies to local file system
chmod +x ./docker/bin/copy-deps.sh

./docker/bin/copy-deps.sh
```

Enter main app container
```bash
docker exec -it wmsa-core bash
```

Run artisan commands to finish setup
```bash
php artisan key:generate
php artisan db:seed
```



## Starting Project

```bash
docker-compose up -d
```


## Running Commands

```bash
docker-exec -it wmsa-core bash
```


## Stopping Project

```bash
docker-compose down
```




## Building Deployment Images


Prerequisites:
- Docker account
- Repositories for the images


### Core

Build core php-fpm server and push to repo

```bash
docker build --no-cache -t justinlaureano/wmsa-core:latest --target=core -f ./Dockerfile.core .

docker build -t justinlaureano/wmsa-core:latest --target=core -f ./Dockerfile.core .


docker push justinlaureano/wmsa-core:latest
```


### Web

Build web server and push to repo

```bash
docker build --no-cache -t justinlaureano/wmsa-web:latest -f ./Dockerfile.nginx .

docker push justinlaureano/wmsa-web:latest
```


### MySQL

Build mysql server and push to repo

```bash
docker build --no-cache -t justinlaureano/wmsa-mysql:latest -f ./Dockerfile.mysql --build-arg password=<mysql_root_password> .

docker push justinlaureano/wmsa-mysql:latest
```


### Reverb

Build reverb server and push to repo

```bash
docker build --no-cache -t justinlaureano/wmsa-reverb:latest --target=reverb -f ./Dockerfile.core .


docker push justinlaureano/wmsa-reverb:latest
```


### Scheduler

Build scheduler server and push to repo

```bash
docker build --no-cache -t justinlaureano/wmsa-scheduler:latest --target=scheduler -f ./Dockerfile.core .


docker push justinlaureano/wmsa-scheduler:latest
```


### Worker

Build worker server and push to repo

```bash
docker build --no-cache -t justinlaureano/wmsa-worker:latest --target=worker -f ./Dockerfile.core .


docker push justinlaureano/wmsa-worker:latest
```


### Update

Build update server and push to repo

```bash
docker build --no-cache -t justinlaureano/wmsa-update:latest --target=base -f ./Dockerfile.core .


docker push justinlaureano/wmsa-update:latest
```




## Deploy to Docker Swarm


Copy over .env file to manager node

```bash
scp .env.prod user@1.2.3.4:/usr/src/.env
```

Copy over compose files to manager node

```bash
scp docker-compose.prod.yml user@1.2.3.4:/usr/src

scp docker-compose.monitor.yml user@1.2.3.4:/usr/src
```


run stack on manager node

```bash
export $(cat .env)

docker stack deploy --with-registry-auth --detach=true -c docker-compose.prod.yml wmsa
```


run monitoring stack on manager node

```bash
docker stack deploy --detach=true -c docker-compose.monitor.yml monitor
```

view monitoring on port `8080` of manager server ip address


Other commands

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
