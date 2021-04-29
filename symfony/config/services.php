<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function(ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services
        ->set(\Ferror\Authentication\Domain\Clock::class)
        ->class(\Ferror\Authentication\Infrastructure\Memory\MemoryClock::class)
        ->args([1616500000]);

    $services
        ->load('Ferror\\Authentication\\Presenter\\Controller\\', '%kernel.project_dir%'.'/src/Authentication/Presenter/Controller/')
        ->tag('controller.service_arguments');

    $services
        ->set(\Ferror\Authentication\Presenter\ErrorListener\ServerErrorListener::class)
        ->tag('kernel.event_listener', ['event' => 'kernel.exception', 'priority' => 0]);

    $services
        ->set(\Ferror\Authentication\Presenter\ErrorListener\AuthenticationErrorListener::class)
        ->tag('kernel.event_listener', ['event' => 'kernel.exception', 'priority' => 1]);

    $services
        ->set(\Ferror\Authentication\Framework\Environment::class)
        ->class(\Ferror\Authentication\Framework\Environment::class)
        ->args(['%env(APP_ENV)%', '%env(APP_SECRET)%']);

    $services
        ->set(\Ferror\Authentication\Domain\SignedWebTokenStorage::class)
        ->class(\Ferror\Authentication\Infrastructure\Memory\MemorySignedWebTokenStorage::class);

    $services
        ->set(\Ferror\Authentication\Domain\User\UserStorage::class)
        ->class(\Ferror\Authentication\Infrastructure\Memory\MemoryUserStorage::class);

    $services
        ->set(\Ferror\Authentication\Application\PasswordEncoder::class);

    $services
        ->set(\Ferror\Authentication\Presenter\Console\CreatePasswordHashCommand::class);

    $services
        ->set(\Ferror\Authentication\Presenter\Console\CreateWebTokenCommand::class);

    $services
        ->set(\Ferror\Authentication\Framework\ArgumentResolver\SignedWebTokenArgumentResolver::class);

    $services
        ->set(\Ferror\Authentication\Framework\ArgumentResolver\CredentialsArgumentResolver::class);

    $services
        ->set(\Ferror\Authentication\Application\AuthenticationService::class);

    $services
        ->set(\Ferror\Authentication\Application\WebTokenEncoder::class);

    $services
        ->set(\Ferror\Authentication\Domain\WebToken\Algorithm::class)
        ->factory([\Ferror\Authentication\Domain\WebToken\Algorithm::class, 'sha512']);

    $services
        ->set(\Ferror\Authentication\Domain\WebTokenFactory::class);

    $services
        ->set(\Ferror\Authentication\Domain\SignedWebTokenFactory::class);
};
