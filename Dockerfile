FROM php:8.2-cli-bookworm AS php-base

RUN apt-get update \
    && apt-get install -y --no-install-recommends libcurl4-openssl-dev libfreetype6-dev libicu-dev libjpeg62-turbo-dev libonig-dev libpng-dev libxml2-dev libzip-dev unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install bcmath curl dom gd intl mbstring opcache pcntl pdo_mysql xml zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

FROM php-base AS composer-build

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist --no-scripts
COPY . .
RUN composer dump-autoload --no-dev --optimize --classmap-authoritative --no-interaction

FROM node:20-alpine AS frontend-build

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY public ./public
COPY tsconfig.json vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build

FROM php-base AS runtime

WORKDIR /var/www/html
COPY --from=composer-build /app /var/www/html
COPY --from=frontend-build /app/public/build /var/www/html/public/build
COPY docker/entrypoint.sh /usr/local/bin/lms-entrypoint

RUN chmod +x /usr/local/bin/lms-entrypoint \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

USER www-data
EXPOSE 8000
ENTRYPOINT ["lms-entrypoint"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
