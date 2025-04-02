# Taller de Vehículos – Gestión de Citas

## Descripción
Aplicación responsive para la gestión de citas en un taller de vehículos. Permite:
- Visualizar y gestionar citas.
- Registrar clientes que llaman.
- Consultar un API externo para obtener información de modelos de vehículos (automóviles, motocicletas y otros) y calcular el tiempo de reparación.

## Estructura del Proyecto
- **config/packages/framework.yaml**: Configuración principal del framework Symfony.
- **config/packages/test/** y **test_mysql/**: Configuraciones específicas para los entornos de test (SQLite y MySQL respectivamente).
- **config/services.yaml**: Registro de servicios personalizados.
- **composer.json**: Define las dependencias del proyecto.
- **README.md**: Proporciona una descripción del proyecto, requisitos, y pasos de instalación y ejecución.
- **src/Controller/DefaultController.php**: Controlador principal que maneja la lógica de la página de inicio.
- **src/Entity/Appointment.php**: Define la entidad `Appointment` que representa una cita en el sistema.
- **src/Repository/AppointmentRepository.php**: Lógica de acceso a datos para las citas.
- **src/Service/VehicleInfoService.php**: Servicio para interactuar con el API externo y obtener información de vehículos.
- **bin/run_tests_sqlite.sh**: Script para ejecutar tests usando SQLite.
- **bin/run_tests_mysql.sh**: Script para ejecutar tests usando MySQL.

## Tecnologías Principales
- **Frontend**: Utiliza Twig para la generación de vistas (plantillas HTML).
- **Backend**: Desarrollado con Symfony 6.2, un framework PHP.
- **API Externa**: Consulta a un API externo para obtener información sobre modelos de vehículos y calcular tiempos de reparación.
- **Base de Datos**: Gestionada con Doctrine ORM.
- **Contenedorización**: Utiliza Docker para la contenedorización de la aplicación.
- **Pruebas**: PHPUnit para pruebas unitarias, funcionales y de aceptación.

## Servicios
- **VehicleInfoService**: Servicio encargado de interactuar con el API externo para obtener información de vehículos y calcular tiempos de reparación.
- **AppointmentService**: Servicio para la lógica de negocio relacionada con la gestión de citas.

## Funcionamiento
- **Gestión de Citas**: La aplicación permite visualizar, gestionar y registrar citas para un taller de vehículos.
- **Clientes**: Se pueden registrar clientes que llaman para solicitar citas.
- **API Externa**: Consulta a un API externo para obtener información de modelos de vehículos y calcular tiempos de reparación.
- **Página de Inicio**: Controlador principal que muestra un mensaje de bienvenida.

## Patrones de Diseño
- **MVC (Modelo-Vista-Controlador)**: Separación clara de responsabilidades en controladores, vistas y modelos.
- **Repository Pattern**: Uso de repositorios para la abstracción de la capa de acceso a datos.
- **Dependency Injection**: Implementado por Symfony para la gestión de dependencias.
- **Service Layer**: Uso de servicios para encapsular la lógica de negocio y facilitar la reutilización del código.

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
   ```bash
   git clone https://github.com/miguelmartmart/symfonyprojects.git
   ```
2. Acceder al directorio:
   ```bash
   cd taller-vehiculos
   ```
3. Levantar los contenedores:
   ```bash
   docker-compose up -d --build
   ```
4. Instalar dependencias PHP:
   ```bash
   docker-compose exec web composer install
   ```
5. Acceder a la aplicación en:
   [http://localhost:8000](http://localhost:8000)

## Configuración
### Variables de Entorno
- `.env`: Configuración base para desarrollo.
- `.env.override.local`: Variables locales específicas para desarrollo (opcional).
- `.env.test`: Variables para entorno de test (por defecto con MySQL).
- `.env.test.local`: Variables locales específicas para test (sobrescribe `.env.test`).

### Ejemplo de `.env.test.local` (SQLite)
```dotenv
APP_ENV=test
APP_DEBUG=1
DATABASE_URL=sqlite:///%kernel.project_dir%/var/data.db
```

### Ejemplo de `.env.test.local` (MySQL)
```dotenv
APP_ENV=test
APP_DEBUG=1
DATABASE_URL=mysql://user:password@db:3306/car_workshop_test
```

## Ejecución de Pruebas
### Test con SQLite (más rápido, sin borrar base de datos):
```bash
# Ejecuta los tests funcionales y unitarios
docker-compose exec web ./bin/run_tests_sqlite.sh
```

### Test con MySQL (útil para entorno real):
```bash
# Ejecuta los tests contra la base de datos MySQL de test
docker-compose exec web ./bin/run_tests_mysql.sh --reset --fixtures
```
Parámetros disponibles:
- `--reset`: elimina y recrea la base de datos.
- `--fixtures`: carga datos de ejemplo.

## Ficheros Clave
- **Dockerfile**: Define la imagen del contenedor PHP con Apache, Composer, Xdebug, Chromium, Panther y demás dependencias.
- **docker-compose.yml**: Define los servicios `web` (Symfony con Apache) y `db` (MySQL).
- **phpunit.xml.dist**: Configuración de PHPUnit.
- **config/packages/test/** y **config/packages/test_mysql/**: Contienen ajustes específicos para cada entorno de pruebas.
- **bin/run_tests_sqlite.sh**: Script de tests rápidos con SQLite.
- **bin/run_tests_mysql.sh**: Script de tests completos con MySQL y opciones de reset/fixtures.

## Documentación y Seguridad
- Revisa la documentación interna (comentarios en el código) para personalizar funcionalidades.
- Almacena credenciales y configuraciones sensibles en variables de entorno.

## Testing CI/CD
La configuración permite integración en pipelines de CI para ejecutar tests en SQLite o MySQL según necesidades. Usa `.env.test.local` para adaptar a cada entorno de ejecución.

---

¡Todo listo para desarrollar y probar tu aplicación Symfony de forma robusta y eficiente!

