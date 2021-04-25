<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function(ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services
        ->set(\App\Domain\Clock::class)
        ->class(\App\Infrastructure\Memory\MemoryClock::class)
        ->args([1616500000]);

    $services
        ->load('App\\Presenter\\Controller\\', '../src/Presenter/Controller/')
        ->tag('controller.service_arguments');

    $services
        ->set(\App\Presenter\ErrorListener\ServerErrorListener::class)
        ->tag('kernel.event_listener', ['event' => 'kernel.exception', 'priority' => 0]);

    $services
        ->set(\App\Presenter\ErrorListener\AuthenticationErrorListener::class)
        ->tag('kernel.event_listener', ['event' => 'kernel.exception', 'priority' => 1]);

    $services
        ->set(\App\Framework\Environment::class)
        ->class(\App\Framework\Environment::class)
        ->args(['%env(APP_ENV)%', '%env(APP_SECRET)%']);

    $services
        ->set(\App\Domain\WebToken\WebTokenStorage::class)
        ->class(\App\Infrastructure\Memory\MemoryWebTokenStorage::class);

    $services
        ->set(\App\Domain\User\UserStorage::class)
        ->class(\App\Infrastructure\Memory\MemoryUserStorage::class);

    $services
        ->set(\App\Application\PasswordEncoder::class);

    $services
        ->set(\App\Presenter\Console\CreatePasswordHashCommand::class);

    $services
        ->set(\App\Presenter\Console\CreateWebTokenCommand::class);

    $services
        ->set(\App\Framework\ArgumentResolver\WebTokenArgumentResolver::class);

    $services
        ->set(\App\Framework\ArgumentResolver\CredentialsArgumentResolver::class);

    $services
        ->set(\App\Application\AuthenticationService::class);

    $services
        ->set(\App\Application\WebTokenEncoder::class);

    $services
        ->set(\App\Domain\WebToken\Algorithm::class)
        ->factory([\App\Domain\WebToken\Algorithm::class, 'sha512']);

    $services
        ->set(\App\Domain\WebTokenFactory::class);
};
