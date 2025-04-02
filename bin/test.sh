#!/bin/bash

echo "🚀 Ejecutando tests Symfony en entorno test..."

export APP_ENV=test
export DATABASE_URL="mysql://user:password@db:3306/car_workshop_test"

php bin/console cache:clear --env=test

php bin/console doctrine:database:drop --env=test --force --if-exists
php bin/console doctrine:database:create --env=test
php bin/console doctrine:schema:create --env=test

# (Opcional)
if [ "$1" == "--fixtures" ]; then
  php bin/console doctrine:fixtures:load --env=test --no-interaction
fi

./vendor/bin/phpunit --testdox
