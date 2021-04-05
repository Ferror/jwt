<?php
declare(strict_types=1);

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use function dirname;
use function is_file;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import(dirname(__DIR__).'/config/{packages}/*.yaml');
        $container->import(dirname(__DIR__).'/config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(dirname(__DIR__).'/config/services.yaml')) {
            $container->import(dirname(__DIR__).'/config/services.yaml');
            $container->import(dirname(__DIR__).'/config/{services}_'.$this->environment.'.yaml');
        } elseif (is_file($path = dirname(__DIR__).'/config/services.php')) {
            (require $path)($container->withPath($path), $this);

            if (is_file($path = dirname(__DIR__).'/config/services_'.$this->environment.'.php')) {
                (require $path)($container->withPath($path), $this);
            }
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import(dirname(__DIR__).'/config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(dirname(__DIR__).'/config/routes.yaml')) {
            $routes->import(dirname(__DIR__).'/config/routes.yaml');
        } elseif (is_file($path = dirname(__DIR__).'/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}
