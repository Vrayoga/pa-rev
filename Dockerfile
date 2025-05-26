FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip xml bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache document root and ensure AllowOverride All for it
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
# Modifikasi 000-default.conf untuk mengganti DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# TAMBAHKAN BLOK INI untuk menyisipkan konfigurasi Directory
# Ini akan menambahkan blok <Directory> sebelum </VirtualHost> di 000-default.conf
RUN sed -i '/<\/VirtualHost>/i \
<Directory ${APACHE_DOCUMENT_ROOT}>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n' /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html

# Copy Laravel project files
COPY . .

# Install PHP dependencies
# RUN composer install --no-interaction --prefer-dist --optimize-autoloader
# Sebaiknya composer install dijalankan di docker-compose.yml command agar lebih fleksibel dan menggunakan volume

# Set permissions (biasanya lebih baik dijalankan saat runtime seperti di docker-compose command)
# RUN chown -R www-data:www-data storage bootstrap/cache \
# && chmod -R 775 storage bootstrap/cache

# Saat container start, jalankan permission fix dan apache
# CMD bash -c "chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache && apache2-foreground"
# CMD dari Dockerfile akan di-override oleh 'command' di docker-compose.yml