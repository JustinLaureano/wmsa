# WMS

## Installation

```bash
cp .env.example .env
cp .env.worker.example .env.worker

# Make app-key

docker-compose up -d

chmod +x ./docker/bin/copy-deps.sh

./docker/bin/copy-deps.sh
```
