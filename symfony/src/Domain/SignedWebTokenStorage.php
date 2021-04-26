<?php
declare(strict_types=1);

namespace App\Domain;

interface SignedWebTokenStorage
{
    public function getUser(SignedWebToken $token): User;
}
