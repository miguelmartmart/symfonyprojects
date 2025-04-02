#!/bin/bash
echo "🚀 Ejecutando tests Symfony con SQLite (APP_ENV=test)..."

export APP_ENV=test
# Ver doctrine.yaml en config test
# Limpiar y preparar base de datos SQLite
php bin/console cache:clear --env=test
php bin/console doctrine:schema:create --env=test

# Ejecutar pruebas
./vendor/bin/phpunit --testdox
