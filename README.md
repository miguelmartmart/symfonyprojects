# Taller de Vehículos – Gestión de Citas

## Descripción
Aplicación responsive para la gestión de citas en un taller de vehículos. Permite:
- Visualizar y gestionar citas.
- Registrar clientes que llaman.
- Consultar un API externo para obtener información de modelos de vehículos (automóviles, motocicletas y otros) y calcular el tiempo de reparación.

## Estructura del Proyecto
- **config/packages/framework.yaml**: Configuración principal del framework Symfony.
- **composer.json**: Define las dependencias del proyecto.
- **README.md**: Proporciona una descripción del proyecto, requisitos, y pasos de instalación y ejecución.
- **src/Controller/DefaultController.php**: Controlador principal que maneja la lógica de la página de inicio.
- **src/Entity/Appointment.php**: Define la entidad `Appointment` que representa una cita en el sistema.
- **src/Repository/AppointmentRepository.php**: Lógica de acceso a datos para las citas.
- **src/Service/VehicleInfoService.php**: Servicio para interactuar con el API externo y obtener información de vehículos.

## Tecnologías Principales
- **Frontend**: Utiliza Twig para la generación de vistas (plantillas HTML).
- **Backend**: Desarrollado con Symfony 6.2, un framework PHP.
- **API Externa**: Consulta a un API externo para obtener información sobre modelos de vehículos y calcular tiempos de reparación.
- **Base de Datos**: Gestionada con Doctrine ORM.
- **Contenedorización**: Utiliza Docker para la contenedorización de la aplicación.
- **Pruebas**: PHPUnit para pruebas unitarias.

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
