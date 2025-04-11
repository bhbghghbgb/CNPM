# Use the official PHP image as a base
FROM php:8.3.19-apache-bookworm

# Copy the content of your project to the /var/www/html directory in the container
# COPY . /var/www/html/

# # Copy database init
# COPY ./DatabaseServer/ql_cuahanggiay.sql /docker-entrypoint-initdb.d/ql_cuahanggiay.sql

# # Copy mysql config
# COPY ./my.cnf /etc/mysql/conf.d/my.cnf

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html