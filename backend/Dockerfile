
FROM php:8.1

RUN docker-php-ext-install pdo pdo_mysql sockets

RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /usr/src/backend

COPY . .

RUN composer install

ENV PORT=8000

EXPOSE 8000

CMD [ "php", "artisan", "serve", "--host=0.0.0.0" ]