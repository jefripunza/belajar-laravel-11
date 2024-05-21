# Menggunakan image PHP dengan Apache
FROM php:8.3.7-apache

# Install dependencies yang diperlukan
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev \
    mariadb-client \
    && docker-php-ext-install pdo pdo_pgsql pdo_sqlite zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy aplikasi Laravel
COPY . /var/www/html

# Install dependencies PHP menggunakan Composer
RUN composer install --no-scripts --no-autoloader

# Copy konfigurasi PHP jika ada (opsional)
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Generate autoloader
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Konfigurasi Apache
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog \${APACHE_LOG_DIR}/error.log\n\
    CustomLog \${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# 💯 Configuration
RUN sed -i 's#localhost#host.docker.internal#g' .env

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
