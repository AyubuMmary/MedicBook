FROM FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Fix permissions for Laravel folders
RUN chmod -R 775 storage bootstrap/cache

# Install PHP dependencies WITHOUT running Laravel's artisan scripts yet
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Expose port
EXPOSE 10000

# At container startup: finish Laravel setup, then run migrations, then start server
CMD php artisan package:discover --ansi && php artisan config:cache && php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 10000