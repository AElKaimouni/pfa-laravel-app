FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Setup working directory
WORKDIR /var/www/

# Copy Project Files
COPY . .

# Grant Permissions
RUN chown -R www-data:www-data /var/www/
RUN chmod -R 775 /var/www/

# Switch User
USER www-data

# Install project dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install

# build resources using nodejs
RUN npm run prod

EXPOSE 9000

CMD ["php-fpm"]
