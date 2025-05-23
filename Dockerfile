FROM php:8.3-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpq-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel files
COPY . /var/www/html/

WORKDIR /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Laravel setup
RUN composer install --no-dev --optimize-autoloader \
    && cp .env.example .env \
    && php artisan key:generate
