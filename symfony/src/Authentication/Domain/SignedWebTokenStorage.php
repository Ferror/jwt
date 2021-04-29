<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain;

interface SignedWebTokenStorage
{
    public function getUser(SignedWebToken $token): User;
}
