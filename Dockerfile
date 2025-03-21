FROM php:8.1-apache

# Instala las dependencias necesarias y extensiones PHP
RUN apt-get update && apt-get install -y \
    libicu-dev libpq-dev libzip-dev unzip git curl && \
    docker-php-ext-install intl pdo pdo_mysql zip

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia el código de tu proyecto al directorio de Apache
COPY . /var/www/html

# Cambia el DocumentRoot a la carpeta "public" (si tu front controller está allí)
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Ejecuta Composer para instalar las dependencias (asegúrate de tener composer.json en la raíz)
RUN composer install

EXPOSE 80

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
