<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\User\UserIdentifier;

final class User
{
    private $identifier;
    private $hash;
    private $login;

    public function __construct(UserIdentifier $identifier, PasswordHash $hash, string $login)
    {
        $this->identifier = $identifier;
        $this->hash = $hash;
        $this->login = $login;
    }

    public function isPasswordValid(Password $password): bool
    {
        return \password_verify($password->toString(), $this->hash->toString());
    }

    public function getLogin(): string
    {
        return $this->login;
    }
}
