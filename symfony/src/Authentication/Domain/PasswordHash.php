<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain;

final class PasswordHash
{
    private $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public function toString(): string
    {
        return $this->hash;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
