<?php
declare(strict_types=1);

namespace App\Domain\WebToken;

final class Algorithm
{
    private $name;

    public static function sha512(): self
    {
        return new self('SHA512');
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function toString(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
