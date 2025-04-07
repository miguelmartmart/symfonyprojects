FROM php:8.1-apache

# Instala dependencias del sistema, Chromium y Xdebug
RUN apt-get update && apt-get install -y \
    libicu-dev libpq-dev libzip-dev unzip git curl \
    chromium chromium-driver fonts-liberation libappindicator3-1 xdg-utils \
    dos2unix \
    && docker-php-ext-install intl pdo pdo_mysql zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Alias para Chrome
RUN ln -s /usr/bin/chromium /usr/bin/chrome || true

# Configuración de Xdebug para VSCode
RUN echo "zend_extension=xdebug.so" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/php.ini

# Activar mod_rewrite en Apache
RUN a2enmod rewrite

# Permitir .htaccess
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Instalar Composer
# Instalar Composer (versión estable)
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN composer --version


# Copiar el código del proyecto
COPY . /var/www/html

# Establecer directorio de trabajo y DocumentRoot
WORKDIR /var/www/html
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Asegurar permisos adecuados para Symfony (cache y logs)
RUN mkdir -p var/cache var/log && \
    chown -R www-data:www-data var && \
    chmod -R 775 var

# Marcar directorio como seguro para Git y preparar caché Composer
RUN mkdir -p /var/www/.cache/composer/files && \
    chown -R www-data:www-data /var/www && \
    git config --global --add safe.directory /var/www/html

# Instalar dependencias de PHP
RUN composer install

# Convertir scripts .sh a Unix (LF) y darles permisos de ejecución
RUN find bin/ -type f -name "*.sh" -exec dos2unix {} \; && \
    chmod +x bin/*.sh

# Ajustar permisos de Symfony
RUN chown -R www-data:www-data /var/www/html/var && \
    chmod -R 775 /var/www/html/var

# Configuración adicional Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN mkdir -p /var/www/html/var/cache/test && \
    chown -R www-data:www-data /var/www/html/var && \
    chmod -R 775 /var/www/html/var
    

    # Instalar Doctrine Fixtures Bundle (evita fallo por Git)
RUN git config --global --add safe.directory /var/www/html \
&& composer require --dev doctrine/doctrine-fixtures-bundle || true

RUN composer global config --no-plugins allow-plugins.symfony/flex true && \
    git config --global --add safe.directory /var/www/html && \
    composer require --dev doctrine/doctrine-fixtures-bundle


# Exponer puertos
EXPOSE 80
EXPOSE 9003
