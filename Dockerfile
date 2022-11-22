FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y libzip-dev libsodium-dev \
    && docker-php-ext-install -j$(nproc) mysqli pdo_mysql sockets sodium \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip


WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://get.symfony.com/cli/installer | bash &&  mv /root/.symfony5/bin/symfony /usr/local/bin/symfony