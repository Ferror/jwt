<?php
declare(strict_types=1);

namespace Ferror\Authentication\Application;

use Ferror\Authentication\Domain\Clock;
use Ferror\Authentication\Domain\SignedWebToken;
use Ferror\Authentication\Domain\SignedWebTokenStorage;
use Ferror\Authentication\Domain\WebToken\WebTokenException;
use Ferror\Authentication\Framework\Environment;

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
        try {
            $this->storage->getUser($token);
        } catch (WebTokenException $e) {
            return false;
        }

        //check token signature & if is expired
        return $token->isValidSignature($this->encoder, $this->environment)
            && !$token->isExpired($this->clock);
    }
}
