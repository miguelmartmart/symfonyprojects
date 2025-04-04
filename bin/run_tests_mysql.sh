#!/bin/bash
echo "🚀 Ejecutando tests Symfony con MySQL (APP_ENV=test)..."

# Variables de entorno
export APP_ENV=test
export APP_DEBUG=1
export DATABASE_URL="mysql://user:password@db:3306/car_workshop_test"

# Variables de control
RESET_DB=false
LOAD_FIXTURES=false

# Opciones del usuario
for arg in "$@"; do
  if [[ "$arg" == "--reset" ]]; then
    RESET_DB=true
  elif [[ "$arg" == "--fixtures" ]]; then
    LOAD_FIXTURES=true
  fi
done

# Limpiar perfiles de navegador (Panther)
rm -rf /tmp/.com.google.Chrome* /tmp/panther-*

# Limpiar caché
php bin/console cache:clear --env=test

# Resetear DB si se pide
if [ "$RESET_DB" = true ]; then
  echo "🧨 Reseteando base de datos MySQL..."
  php bin/console doctrine:database:drop --env=test --force --if-exists
  php bin/console doctrine:database:create --env=test
  php bin/console doctrine:schema:create --env=test
fi

# Cargar fixtures si se pide
if [ "$LOAD_FIXTURES" = true ]; then
  echo "📦 Cargando fixtures..."
  php bin/console doctrine:fixtures:load --env=test --no-interaction
fi

# Ejecutar tests
echo "🧪 Ejecutando PHPUnit..."
./vendor/bin/phpunit --testdox
