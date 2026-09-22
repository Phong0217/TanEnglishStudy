#!/bin/sh
set -eu

cd "$(dirname "$0")/.."

if ! command -v docker >/dev/null 2>&1; then
    echo "Docker is not installed. Install Docker Engine with the Compose plugin first." >&2
    exit 1
fi

if [ ! -f .env ]; then
    cp .env.example .env
fi

if ! grep -Eq '^APP_KEY=base64:.+' .env; then
    if command -v php >/dev/null 2>&1 && [ -f vendor/autoload.php ]; then
        php artisan key:generate
    else
        echo "APP_KEY is missing. Run composer install and php artisan key:generate once." >&2
        exit 1
    fi
fi

# The application image contains the Laravel/PHP source and compiled frontend
# (the compose file intentionally does not bind-mount the repository). Start
# dependencies normally, then always rebuild/recreate only application
# containers so a Builder fix cannot be hidden behind a stale image while the
# database/object-storage volumes remain untouched.
docker compose up -d mysql redis minio minio-init mailpit
docker compose up -d --build --force-recreate app queue scheduler

# The service containers run as www-data. Because storage/logs is bind-mounted
# for local visibility, initialise its ownership after every fresh checkout.
# This keeps service logs writable without weakening permissions globally.
docker compose exec -u root -T app sh -lc '
  mkdir -p storage/logs/application storage/logs/auth storage/logs/assignment \
    storage/logs/lesson storage/logs/question-bank storage/logs/ai storage/logs/import \
    storage/logs/submission storage/logs/grading storage/logs/queue storage/logs/integration \
    storage/logs/error
  chown -R www-data:www-data storage/logs
  chmod 775 storage/logs
' >/dev/null

docker compose exec app php artisan migrate --force

if [ "${1:-}" = "--seed" ]; then
    docker compose exec app php artisan db:seed --force
fi

docker compose ps
echo "Application: http://localhost:${APP_PORT:-8000}"
echo "Mailpit:     http://localhost:${FORWARD_MAILPIT_PORT:-8025}"
echo "MinIO:       http://localhost:${FORWARD_MINIO_CONSOLE_PORT:-9001}"
