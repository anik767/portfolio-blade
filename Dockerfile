# Stage 1: Build Stage with Composer
FROM composer:2 as composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Stage 2: Final Image with Apache & PHP
FROM php:8.2-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module for Laravel
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app from local directory to container
COPY . .

# Copy vendor from build stage
COPY --from=composer /app/vendor ./vendor

# Set correct permissions
RUN chown -R www-data:www-data \
    storage bootstrap/cache

# Update Apache's DocumentRoot to Laravel's public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Set environment to production
ENV APP_ENV=production

# Expose port 80
EXPOSE 80

# Default CMD (starts Apache in foreground)
CMD ["apache2-foreground"]
