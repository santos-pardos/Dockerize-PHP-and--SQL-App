# Use a base image with Apache and PHP
FROM php:8.1-apache

# Install necessary PHP extensions for MySQL/MariaDB client connectivity.
# We only need the client tools as the MariaDB server runs in a separate container.
# 'git' is included as a common utility, but not strictly required for app function.
RUN apt-get update && \
    apt-get install -y git && \
    docker-php-ext-install mysqli pdo pdo_mysql

# Copy your PHP application code to the Apache document root inside the container.
# In a development setup using docker-compose volumes, this COPY is often less critical
# as the local directory is mounted directly. However, it's good practice for
# building a standalone production image.
COPY . /var/www/html/

# Expose port 80, which is where Apache will be listening inside the container.
EXPOSE 80

# Enable the Apache rewrite module.
# This is commonly needed for many PHP frameworks or for clean URLs.
RUN a2enmod rewrite

# Define the command that runs when the container starts.
# 'apache2-foreground' keeps Apache running in the foreground,
# which is essential for Docker containers to remain active.
CMD ["apache2-foreground"]
