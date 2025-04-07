FROM php:8.1-apache

# --- ARG y ENV configurables ---
ARG APP_ENV=prod
ARG DATABASE_URL=mysql://user:password@db:3306/car_workshop

ENV APP_ENV=${APP_ENV}
ENV DATABASE_URL=${DATABASE_URL}
ENV COMPOSER_ALLOW_SUPERUSER=1

# --- Instalación de dependencias del sistema ---
RUN apt-get update && apt-get install -y \
    libicu-dev libpq-dev libzip-dev unzip git curl \
    chromium chromium-driver fonts-liberation libappindicator3-1 xdg-utils \
    dos2unix \
    && docker-php-ext-install intl pdo pdo_mysql zip \
    && if [ "$APP_ENV" = "dev" ]; then \
         pecl install xdebug && docker-php-ext-enable xdebug; \
       fi

# --- Alias para Chrome ---
RUN ln -s /usr/bin/chromium /usr/bin/chrome || true

# --- Configuración Xdebug (solo se activa si está instalado) ---
RUN if [ "$APP_ENV" = "dev" ]; then \
    echo "zend_extension=xdebug.so" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/php.ini ; \
fi
# --- Apache ---
RUN a2enmod rewrite
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# --- Composer ---
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"
RUN composer --version

# --- Copiar código del proyecto ---
COPY . /var/www/html
WORKDIR /var/www/html

# --- Apache DocumentRoot ---
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# --- Permisos iniciales ---
RUN mkdir -p var/cache var/log && \
    chown -R www-data:www-data var && \
    chmod -R 775 var

# --- Composer preparación y seguridad ---
RUN mkdir -p /var/www/.cache/composer/files && \
    chown -R www-data:www-data /var/www && \
    git config --global --add safe.directory /var/www/html

# --- Instalar dependencias PHP según entorno ---
RUN if [ "$APP_ENV" = "prod" ]; then \
      composer install --no-dev --prefer-dist --optimize-autoloader; \
    else \
      composer install; \
    fi

# --- Instalar fixtures solo en desarrollo ---
RUN composer global config --no-plugins allow-plugins.symfony/flex true && \
    git config --global --add safe.directory /var/www/html && \
    if [ "$APP_ENV" = "dev" ]; then \
        composer require --dev doctrine/doctrine-fixtures-bundle; \
    fi

# --- Scripts y permisos ---
RUN find bin/ -type f -name "*.sh" -exec dos2unix {} \; && chmod +x bin/*.sh
RUN chown -R www-data:www-data /var/www/html/var && chmod -R 775 /var/www/html/var

# --- Configuración Apache extra ---
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# --- Preparar caché de Symfony ---
RUN echo "DATABASE_URL=$DATABASE_URL" > .env.local \
 && php bin/console cache:clear --env=$APP_ENV \
 && php bin/console cache:warmup --env=$APP_ENV

# --- Exponer puertos ---
EXPOSE 80
EXPOSE 9003
