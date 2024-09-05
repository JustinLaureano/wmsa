# WMS

## Installation

```bash
# Create environment files
cp .env.example .env
cp .env.worker.example .env.worker

# make sure all .sh files are LF for end of line sequence


# Make app-key

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
