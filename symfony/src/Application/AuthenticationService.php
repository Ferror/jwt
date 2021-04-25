<?php
declare(strict_types=1);

namespace App\Application;

use App\Domain\WebToken;
use App\Domain\WebToken\WebTokenStorage;
use App\Framework\Environment;

final class AuthenticationService
{
    private $storage;
    private $environment;
    private $encoder;

    public function __construct(WebTokenStorage $storage, Environment $environment, WebTokenEncoder $encoder)
    {
        $this->storage = $storage;
        $this->environment = $environment;
        $this->encoder = $encoder;
    }

    public function isValid(WebToken $token): bool
    {
        $user = $this->storage->getUser($token);

        //check token signature
        return $token->isValidSignature($this->encoder, $this->environment);

//        if ($jsonPayload['expires_at'] < $clock->getTime()) {
//            return new Response('Token expired', 400);
//        }

        //check if token is expired
    }
}
