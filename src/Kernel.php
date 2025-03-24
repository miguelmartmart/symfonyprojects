<?php
// src/Kernel.php
namespace App;

use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        // Establece el parámetro kernel.secret usando la variable de entorno APP_SECRET
        $container->parameters()->set('kernel.secret', $_ENV['APP_SECRET'] ?? 'ChangeMeToASecureValue');
        $container->import('../config/services.yaml');
    // Si tienes otros archivos de configuración, puedes importarlos aquí:
    // $container->import('../config/{packages}/*.yaml');
        // Si tienes archivos de configuración en config/, puedes importarlos aquí:
        // $container->import('../config/{packages}/*.yaml');
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        // Importa las rutas definidas por atributos en src/Controller
        $routes->import('../src/Controller/', 'attribute');
    }
}
