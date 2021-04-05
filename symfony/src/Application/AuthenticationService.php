<?php
declare(strict_types=1);

namespace App\Application;

use App\Domain\WebToken;
use App\Domain\WebToken\WebTokenStorage;

final class AuthenticationService
{
    private $storage;

    public function __construct(WebTokenStorage $storage)
    {
        $this->storage = $storage;
    }

    public function isValid(WebToken $token): bool
    {
        $user = $this->storage->getUser($token);

//        $requestSignature = hash_hmac($jsonHeader['alg'] /* SHA512 */, $baseHeader . $basePayload, 'secret');
//
//        if ($signature !== $requestSignature) {
//            throw new \Exception('Invalid web token');
//        }

        //check token signature
        //check if token is expired

        return true;
    }
}
