FROM php:8.4-cli-alpine

WORKDIR /app

RUN apk add --no-cache postgresql-dev libzip-dev unzip curl

RUN docker-php-ext-install pdo pdo_pgsql zip

RUN curl https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install

EXPOSE 8000

CMD ["sh", "-c", "php artisan migrate && php artisan db:seed && php artisan serve --host=0.0.0.0 --port=8000"]
