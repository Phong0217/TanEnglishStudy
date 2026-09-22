# English Center LMS

English Center LMS is a modular-monolith Laravel 12 + Inertia React LMS for English centers serving Grades 1–12. It provides one primary role per user (`ADMIN`, `TEACHER`, or `STUDENT`), center isolation, immutable assignment snapshots, server-authoritative attempts, auto/manual grading, private document parsing, and review-first AI question generation.

## Requirements

Docker Engine 24+ with the Docker Compose plugin is the recommended local runtime. A native setup requires PHP 8.2+, Composer 2, Node.js 20+, npm 10+, MySQL 8+, and Redis 7+.

## Setup

Docker-first setup builds the Laravel application and frontend, starts MySQL, Redis, MinIO, Mailpit, the queue worker and scheduler, then migrates the persistent database:

```bash
cp .env.example .env
composer install
php artisan key:generate
./scripts/docker-up.sh --seed
```

Use `--seed` only for a new local database. On later starts run `./scripts/docker-up.sh` without that flag. MySQL is available to host tools at `127.0.0.1:3307`; containers connect internally to `mysql:3306`. The named `mysql_data` volume survives container restarts and `docker compose down`.

The application source is baked into the image (it is not bind-mounted). After changing Laravel or React code, run `./scripts/docker-up.sh` so the app/queue/scheduler images are rebuilt and recreated; `docker compose restart app` alone only restarts the previous image.

The local seed creates `admin@example.com`, `teacher1@example.com`, `teacher2@example.com`, and `student1@example.com` through `student10@example.com`, each with password `password`. These credentials are local/testing only. In a real environment use `php artisan app:create-admin`, which prompts for name, email, password and confirmation, checks duplicates, assigns `ADMIN`, and never logs the password.

## Running and services

For the Docker runtime, all long-running processes are managed by Compose:

```bash
./scripts/docker-up.sh
docker compose ps
docker compose logs -f app queue
./scripts/docker-down.sh
```

Open the application at `http://localhost:8000`, Mailpit at `http://localhost:8025`, and the MinIO console at `http://localhost:9001`. Services use `restart: unless-stopped`; configure Docker itself to start at login/boot so they return automatically after a reboot.

Native host development remains available when required:

```bash
php artisan serve
npm run dev
php artisan queue:work --tries=3 --timeout=180
php artisan schedule:work
```

`PRIVATE_FILESYSTEM_DISK=private` stores uploads outside public storage. Set it to `s3` with the MinIO/S3 variables for object storage. Use Mailpit locally with `MAIL_MAILER=smtp`, `MAIL_HOST=127.0.0.1`, `MAIL_PORT=1025`. `AI_PROVIDER=mock` is deterministic for local/test; `AI_PROVIDER=openai` requires `AI_MODEL` and `AI_API_KEY` from secret management. AI jobs are queued and generated questions always start `IN_REVIEW`.

If Laravel reports `Connection refused`, first run `docker compose ps`. The MySQL service must be healthy and port `3307` must not be occupied by another local process. Never point host Laravel at container-only hostname `mysql`; host Laravel uses `127.0.0.1:3307`, while Compose overrides app containers to `mysql:3306`. Do not use `docker compose down -v` unless you intentionally want to permanently delete local database and object-storage volumes.

## Verification

```bash
php artisan about
php artisan route:list
./scripts/docker-test.sh
vendor/bin/pint --test
vendor/bin/phpstan analyse --memory-limit=1G
npm run lint
npm run type-check
npm run test
npm run build
```

Use `migrate:fresh --seed` only on local/test databases; never use it or `db:wipe` in production.

## Documentation

- [Architecture](docs/architecture.md)
- [Database](docs/database.md)
- [RBAC](docs/rbac.md)
- [Manual testing](docs/manual-testing.md)
- [Implementation progress](docs/implementation-progress.md)

Laravel/Inertia routes are the navigation source of truth; React Router is intentionally not installed. Controllers are thin, Form Requests validate, policies authorize, actions/services own business rules, and queue workers handle parsing/AI work.
