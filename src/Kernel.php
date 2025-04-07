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

    public function __construct(string $environment, bool $debug)
    {
        $debugFile = __DIR__ . '/Utils/Debug.php';

        if (file_exists($debugFile)) {
            require_once $debugFile;
        
            if (function_exists('debug_log')) {
                debug_log([
                    'APP_ENV' => $environment,
                    'APP_DEBUG' => $debug,
                    'DATABASE_URL' => $_ENV['DATABASE_URL'] ?? 'not set',
                ]);
            }
        }

        parent::__construct($environment, $debug);
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/' . $this->environment . '/*.yaml');
        $container->import('../config/services.yaml');

        $container->parameters()->set('kernel.secret', $_ENV['APP_SECRET'] ?? 'ChangeMeToASecureValue');
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../src/Controller/', 'attribute');
    }
}
