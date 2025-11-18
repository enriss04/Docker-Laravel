FROM php:8.3-apache

ENV TZ=America/Mexico_City
ENV COMPOSER_ALLOW_SUPERUSER=1

#Id de usuario maquina fisica
ARG UID=my_id
ARG GID=my_id

#creacion de usuario especial para uso del contenedor y maquina fisica
RUN groupadd -g $GID laravel \
    && useradd -u $UID -g $GID -m laravel

# Instalar dependencias necesarias para php y laravel
RUN apt-get update && apt-get install -y \
    tzdata \
    curl \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    zip \
    unzip \
    nano \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo pdo_mysql gd

# Habilitar mod_rewrite y usar /public como DocumentRoot
RUN a2enmod rewrite \
    && sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|<Directory /var/www/>|<Directory /var/www/html>|' /etc/apache2/apache2.conf \
    && sed -i 's|AllowOverride None|AllowOverride All|' /etc/apache2/apache2.conf

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar nano
RUN apt-get update && apt-get install -y nano

# Establecer directorio de trabajo
WORKDIR /var/www/html

#Usando usuario laravel
USER laravel

EXPOSE 80

CMD ["apache2-foreground"]
