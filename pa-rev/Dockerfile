FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip git zip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip xml bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache document root env & config
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -i 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Jangan COPY kode ke image karena pakai volume mount, supaya mudah git pull

# Saat container start, fix permission dan jalankan apache
CMD bash -c "chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache && apache2-foreground"
