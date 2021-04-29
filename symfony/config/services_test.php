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
        ->set(\Ferror\Authentication\Infrastructure\Memory\MemoryFactory::class);

    $services
        ->set(\Ferror\Authentication\Domain\User\UserStorage::class)
        ->factory([service(\Ferror\Authentication\Infrastructure\Memory\MemoryFactory::class), 'createUserStorage']);
};
