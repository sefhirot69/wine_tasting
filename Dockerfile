FROM php:8.1-apache AS composer-vendor

# Install basic deps
RUN apt-get update -qq
RUN apt-get install -yq \
    git-all unzip libxml2-dev \
    --no-install-recommends

RUN docker-php-ext-install soap
WORKDIR /var/www/html

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY . /var/www/html/

# MAIN
FROM php:8.1-apache

RUN apt-get update -qq \
    && apt-get install -yq zlib1g-dev g++ libicu-dev zip libzip-dev zip libpq-dev\
    && pecl install apcu \
    && pecl install xdebug-3.1.2 \
    && docker-php-ext-enable apcu \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install intl opcache pdo pdo_pgsql pgsql\
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN a2enmod rewrite
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/php.ini
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/php.ini
RUN echo "memory_limit=512M"  >> /usr/local/etc/php/php.ini
RUN echo "max_execution_time=900" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /var/www/html
COPY . /var/www/html

COPY docker/vhost/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy composer and vendor
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=composer-vendor /var/www/html/vendor /var/www/html/vendor

RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R u+rwx /var/www/html/

# Expose port
EXPOSE 80

# Run application
ENTRYPOINT [ "apache2-foreground" ]