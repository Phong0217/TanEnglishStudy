#!/bin/sh
set -eu

cd "$(dirname "$0")/.."
docker compose down

echo "Containers stopped. Named database and object-storage volumes were preserved."
