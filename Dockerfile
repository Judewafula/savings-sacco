FROM php:8.2-cli

# Install system dependencies including SQLite dev and Oniguruma
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libsqlite3-dev libonig-dev \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        zip \
        intl \
        mbstring

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy project files
COPY . .

# Ensure required directories exist
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
    database \
    && touch database/database.sqlite

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Fix permissions
RUN chmod -R 775 storage bootstrap/cache database

EXPOSE 10000

CMD php -S 0.0.0.0:10000 -t public
