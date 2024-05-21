# Menggunakan image PHP 8.3.7 FPM
FROM php:8.3.7-fpm

# Install dependensi yang diperlukan
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy aplikasi Laravel
COPY . /var/www/html

# Install dependensi PHP menggunakan Composer
RUN composer install --no-scripts --no-autoloader

# Copy konfigurasi PHP
# COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Generate autoloader
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
