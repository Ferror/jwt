<?php
declare(strict_types=1);

namespace App\Application;

use App\Domain\Clock;
use App\Domain\SignedWebToken;
use App\Domain\SignedWebTokenStorage;
use App\Framework\Environment;

final class AuthenticationService
{
    private $storage;
    private $environment;
    private $encoder;
    private $clock;

    public function __construct(
        SignedWebTokenStorage $storage,
        Environment $environment,
        WebTokenEncoder $encoder,
        Clock $clock
    ) {
        $this->storage = $storage;
        $this->environment = $environment;
        $this->encoder = $encoder;
        $this->clock = $clock;
    }

    public function isValid(SignedWebToken $token): bool
    {
//        $user = $this->storage->getUser($token);

        //check token signature
        return $token->isValidSignature($this->encoder, $this->environment)
            && !$token->isExpired($this->clock);

//        if ($jsonPayload['expires_at'] < $clock->getTime()) {
//            return new Response('Token expired', 400);
//        }

        //check if token is expired
    }
}
