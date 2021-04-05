<?php
declare(strict_types=1);

namespace App\Domain;

final class Login
{
    private $login;

    public function __construct(string $login)
    {
        $this->login = $login;
    }

    public function toString(): string
    {
        return $this->login;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
