FROM php:8.1-apache

# Instala las dependencias necesarias, Chromium y Xdebug
RUN apt-get update && apt-get install -y \
    libicu-dev libpq-dev libzip-dev unzip git curl \
    chromium chromium-driver fonts-liberation libappindicator3-1 xdg-utils \
    && docker-php-ext-install intl pdo pdo_mysql zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN ln -s /usr/bin/chromium /usr/bin/chrome || true

# Configuración de Xdebug para depuración en Visual Studio Code
RUN echo "zend_extension=xdebug.so" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/php.ini

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Permitir overrides en Apache
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar el código del proyecto
COPY . /var/www/html

# Cambiar el DocumentRoot
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias de Composer
RUN composer install

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html/var && \
    chmod -R 775 /var/www/html/var

# Exponer puertos para Apache y Xdebug
EXPOSE 80
EXPOSE 9003

# Configuración adicional
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Marcar como segura la carpeta del proyecto
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html && \
    git config --global --add safe.directory /var/www/html
