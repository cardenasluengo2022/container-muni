FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx wget

RUN apk update && apk add \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql \
    && apk --no-cache add nodejs npm

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /app
COPY . /app
COPY ./proyectoMuni-laravel /app

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN cd /app && \
    /usr/local/bin/composer install 

RUN chown -R www-data: /app

CMD php artisan voyager:controllers

CMD cd /app/public
CMD rm storage
CMD php artisan storage:link


CMD sh /app/docker/startup.sh