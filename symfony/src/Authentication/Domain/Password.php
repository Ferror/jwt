<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain;

use Ferror\Authentication\Application\PasswordEncoder;

final class Password
{
    private $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function hash(PasswordEncoder $encoder): PasswordHash
    {
        return new PasswordHash($encoder->encode($this->password));
    }

    public function toString(): string
    {
        return $this->password;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
