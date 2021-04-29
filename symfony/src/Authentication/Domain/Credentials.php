<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain;

final class Credentials
{
    private $login;
    private $password;

    public function __construct(Login $login, Password $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin(): Login
    {
        return $this->login;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }
}
