FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
  git \
  curl \
  unzip

RUN echo "memory_limit=512M" >> /usr/local/etc/php/php.ini
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www/

CMD ["php-fpm"]