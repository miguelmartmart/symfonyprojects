# Taller de Vehículos – Gestión de Citas

## Descripción
Aplicación responsive para la gestión de citas en un taller de vehículos. Permite:
- Visualizar y gestionar citas.
- Registrar clientes que llaman.
- Consultar un API externo para obtener información de modelos de vehículos (automóviles, motocicletas y otros) y calcular el tiempo de reparación.

## Requisitos
- Docker y Docker Compose.
- Visual Studio Code.
- Extensiones recomendadas:
  - PHP Intelephense
  - Symfony Extension Pack
  - Docker
  - PHP Debug
  - ESLint
  - Prettier – Code formatter
  - GitLens – Git supercharged

## Instalación y Ejecución
1. Clonar el repositorio:
   git clone https://github.com/tuusuario/taller-vehiculos.git
2. Acceder al directorio:
   cd taller-vehiculos
3. Levantar los contenedores:
   docker-compose up -d
4. Instalar dependencias de PHP (si es necesario):
   docker-compose exec web composer install
5. Acceder a la aplicación en http://localhost:8000

## Ejecución de Pruebas
Ejecutar tests con PHPUnit:
docker-compose exec web ./vendor/bin/phpunit

## Configuración
- Las variables de entorno se configuran en el archivo .env.
- La URL del API externo se define en la variable VEHICLE_API_URL.

## Documentación y Seguridad
- Revisa la documentación interna (comentarios en el código) para personalizar funcionalidades.
- Almacena credenciales y configuraciones sensibles en variables de entorno.
