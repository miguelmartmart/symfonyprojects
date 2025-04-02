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
    // Carga todos los archivos de config/packages/*.yaml (incluye framework.yaml con http_client)
    $container->import('../config/{packages}/*.yaml');
    $container->import('../config/{packages}/'.$this->environment.'/*.yaml');

    // Luego carga services.yaml
    $container->import('../config/services.yaml');

    // Define el secret (kernel.secret)
    $container->parameters()->set('kernel.secret', $_ENV['APP_SECRET'] ?? 'ChangeMeToASecureValue');
}
    

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        // Importa las rutas definidas por atributos en src/Controller
        $routes->import('../src/Controller/', 'attribute');
    }
}
