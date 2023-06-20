FROM php:8.2-apache
RUN apt-get update && apt upgrade -y
RUN apt-get install -y apache2

RUN docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /var/www/html

COPY . .

RUN chown www-data:www-data -R /var/www/html/

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]

