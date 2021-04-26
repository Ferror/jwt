<?php
declare(strict_types=1);

namespace App\Domain\WebToken;

final class Algorithm
{
    private $name;

    public static function sha512(): self
    {
        return new self('sha512');
    }

    public function __construct(string $name)
    {
        if (!\in_array($name, \hash_hmac_algos(), true)) {
            throw new \InvalidArgumentException("$name is not valid hash algorithm");
        }

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
