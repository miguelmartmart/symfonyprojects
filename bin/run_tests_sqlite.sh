#!/bin/bash
echo "🚀 Ejecutando tests Symfony con SQLite (APP_ENV=test)..."

# Variables de entorno
export APP_ENV=test
export APP_DEBUG=1
export DATABASE_URL="sqlite:///%kernel.cache_dir%/test.db"

# Limpiar perfiles de navegador (Panther)
rm -rf /tmp/.com.google.Chrome* /tmp/panther-*

# Limpiar caché
php bin/console cache:clear --env=test

# Preparar esquema
echo "🛠️  Preparando esquema SQLite..."
php bin/console doctrine:schema:drop --env=test --force || true
php bin/console doctrine:schema:create --env=test

# Cargar fixtures si existen
if [ -d "src/DataFixtures" ]; then
  echo "📦 Cargando fixtures en SQLite..."
  php bin/console doctrine:fixtures:load --env=test --no-interaction || echo "⚠️ No se pudieron cargar los fixtures (posiblemente no haya ninguno)"
fi

# Ejecutar pruebas
echo "🧪 Ejecutando PHPUnit..."
./vendor/bin/phpunit --testdox
