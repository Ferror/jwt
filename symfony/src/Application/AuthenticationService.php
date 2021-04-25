<?php
declare(strict_types=1);

namespace App\Application;

use App\Domain\WebToken;
use App\Domain\WebToken\WebTokenStorage;
use App\Framework\Environment;
use App\Infrastructure\Base64\Encoder as Base64Encoder;
use App\Infrastructure\Json\Encoder as JsonEncoder;
use App\Infrastructure\Memory\MemoryEncoder;

final class AuthenticationService
{
    private $storage;
    private $environment;
    private $encoder;

    public function __construct(WebTokenStorage $storage, Environment $environment)
    {
        $this->storage = $storage;
        $this->environment = $environment;
        $this->encoder = new JsonEncoder(new Base64Encoder(new MemoryEncoder()));
    }

    public function isValid(WebToken $token): bool
    {
        $user = $this->storage->getUser($token);

        if ($token->isValid($this->encoder, $this->environment)) {
            return true;
        }

//        $requestSignature = hash__hmac($jsonHeader['alg'] /* SHA512 */, $baseHeader . $basePayload, 'secret');
//
//        if ($signature !== $requestSignature) {
//            throw new \Exception('Invalid web token');
//        }

//        if ($jsonPayload['expires_at'] < $clock->getTime()) {
//            return new Response('Token expired', 400);
//        }

        //check token signature
        //check if token is expired

        return true;
    }
}
