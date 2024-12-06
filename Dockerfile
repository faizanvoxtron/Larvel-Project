FROM php:8.2-fpm 

RUN RUN apt-get update && apt-get install -y \
git \
curl \
libpng-dev \
libonig-dev \
libxml2-dev \
zip \
unzip\
&&docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html/storage 
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

RUN composer-install

EXPOSE 80

CMD [ "php-fpm" ]

