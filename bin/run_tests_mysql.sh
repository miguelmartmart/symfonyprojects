#!/bin/bash

echo "🚀 Ejecutando tests Symfony en entorno test..."

# Establece entorno test
export APP_ENV=test
# Evita conflictos en Chrome con Panther
export PANTHER_CHROME_ARGUMENTS="--no-sandbox --headless --disable-gpu --user-data-dir=/tmp/panther-$RANDOM"

# Variables
RESET_DB=false
LOAD_FIXTURES=false

# Parámetros
for arg in "$@"; do
  if [[ "$arg" == "--reset" ]]; then
    RESET_DB=true
  elif [[ "$arg" == "--fixtures" ]]; then
    LOAD_FIXTURES=true
  fi
done

# Limpiar perfiles anteriores de Chrome (opcional pero recomendado)
rm -rf /tmp/.com.google.Chrome* /tmp/panther-*

# Limpiar caché
php bin/console cache:clear --env=test

# Resetear base de datos si se pide
if [ "$RESET_DB" = true ]; then
  echo "🧨 Reseteando base de datos..."
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
