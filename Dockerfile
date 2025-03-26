FROM php:8.1-apache

# Instala las dependencias necesarias y extensiones PHP
RUN apt-get update && apt-get install -y \
    libicu-dev libpq-dev libzip-dev unzip git curl && \
    docker-php-ext-install intl pdo pdo_mysql zip

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Permitir overrides en Apache
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia el código de tu proyecto al directorio de Apache
COPY . /var/www/html

# Cambia el DocumentRoot a la carpeta "public"
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Ejecuta Composer para instalar las dependencias
RUN composer install

# Ajusta la propiedad y permisos del directorio var para producción
RUN chown -R www-data:www-data /var/www/html/var \
    && chmod -R 775 /var/www/html/var

EXPOSE 80

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Corrige permisos y marca como segura la carpeta del proyecto
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html && \
    git config --global --add safe.directory /var/www/html
