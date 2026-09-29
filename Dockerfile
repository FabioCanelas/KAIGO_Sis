FROM php:8.4-apache

# Update packages and install required dependencies
RUN apt-get update && apt-get install -y     libpng-dev     libjpeg-dev     libfreetype6-dev     libpq-dev     libicu-dev     libzip-dev     zip     unzip     git     curl

# Install Node.js for Vite compilation
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -     && apt-get install -y nodejs

# Install and configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg     && docker-php-ext-configure intl     && docker-php-ext-install gd pdo pdo_pgsql pdo_mysql intl zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Change Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e "s!/var/www/html!/var/www/html/public!g" /etc/apache2/sites-available/*.conf
RUN sed -ri -e "s!/var/www/!/var/www/html/public/!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html
COPY . .

# Install PHP dependencies with infinite memory
RUN php -d memory_limit=-1 /usr/bin/composer install --no-dev --optimize-autoloader

# Install Node dependencies and compile assets
RUN npm install && npm run build

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN php artisan storage:link
EXPOSE 80
