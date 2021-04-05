<?php
declare(strict_types=1);

namespace App\Framework;

final class Environment
{
    private const PRODUCTION = 'prod';
    private const DEVELOPMENT = 'dev';
    private const TESTING = 'test';
    private $environment;
    private $secret;

    public function __construct(string $environment, string $secret)
    {
        $this->environment = $environment;
        $this->secret = $secret;
    }

    public function getApplicationSecret(): string
    {
        return $this->secret;
    }

    public function isDevelopment(): bool
    {
        return $this->environment === self::DEVELOPMENT;
    }

    public function isTesting(): bool
    {
        return $this->environment === self::TESTING;
    }

    public function isProduction(): bool
    {
        return $this->environment === self::PRODUCTION;
    }
}
