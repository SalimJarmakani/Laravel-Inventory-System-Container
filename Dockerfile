FROM php:8.2-fpm

# Set the working directory inside the container
WORKDIR /var/www

# Install system dependencies for Composer
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the entire application into the container
COPY . .

# Install Composer dependencies
RUN composer install


# Expose the port the app runs on
EXPOSE 8000
# Wait for MySQL to be ready using Laravel's custom command and then run migrations and start the server
CMD ["sh", "-c", "php artisan db:wait && php artisan migrate && php artisan serve --host=0.0.0.0 --port=8000"]