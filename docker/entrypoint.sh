#!/bin/sh
set -eu

mkdir -p \
    storage/app/private \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

php artisan config:clear >/dev/null
php artisan route:clear >/dev/null

# Queue and scheduler containers may start while a brand-new database is still
# being migrated by scripts/docker-up.sh. Keep them alive and quiet until the
# database-backed cache table exists instead of entering a restart loop.
case " $* " in
    *" artisan queue:work "*|*" artisan schedule:work "*)
        echo "Waiting for database migrations..."
        until php artisan migrate:status --no-ansi 2>/dev/null | grep -q "create_cache_table.*Ran"; do
            sleep 2
        done
        ;;
esac

exec "$@"
