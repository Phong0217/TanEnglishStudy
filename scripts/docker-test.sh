#!/bin/sh
set -eu

cd "$(dirname "$0")/.."

docker compose exec mysql mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS english_center_lms_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; GRANT ALL PRIVILEGES ON english_center_lms_test.* TO 'lms'@'%';"
docker compose run --rm -T --no-deps \
    --user "$(id -u):$(id -g)" \
    --volume "$(pwd):/var/www/html" \
    -e APP_ENV=testing \
    -e DB_CONNECTION=mysql \
    -e DB_HOST=mysql \
    -e DB_PORT=3306 \
    -e DB_DATABASE=english_center_lms_test \
    -e DB_USERNAME=lms \
    -e DB_PASSWORD=lms \
    app php artisan test
