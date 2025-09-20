FROM php:8.3-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy app code into container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

