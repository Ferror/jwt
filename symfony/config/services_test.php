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
        ->set(\App\Infrastructure\Memory\MemoryFactory::class);

    $services
        ->set(\App\Domain\User\UserStorage::class)
        ->factory([service(\App\Infrastructure\Memory\MemoryFactory::class), 'createUserStorage']);
};
