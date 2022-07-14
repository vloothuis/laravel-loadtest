FROM php:8.1.6-apache AS base

# Install packages and extensions
RUN apt-get -qq update && \
    apt-get -y install curl wget vim unzip libzip-dev libpq-dev libicu-dev apt-transport-https apt-transport-https \
                       ca-certificates gnupg npm libaio1 iproute2 libxml2-dev locales locales-all && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install zip opcache pdo pdo_pgsql soap sockets pcntl intl

ENV PATH $PATH:/root/.composer/vendor/bin


# ============================================================ Backend Packages
FROM composer:2.3.5 as backend

COPY composer.json composer.lock /app/
RUN composer install \
        --ignore-platform-reqs \
        --no-ansi \
        --no-autoloader \
        --no-interaction \
        --no-dev \
        --no-scripts

COPY . /app/

# Optimized autoloader
RUN composer dump-autoload --optimize --classmap-authoritative

# ============================================================ App

FROM base as app
RUN a2enmod rewrite

COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

COPY --from=backend /app/ /var/www/html/
RUN chown -R www-data:www-data /var/www/html
