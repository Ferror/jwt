<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain\WebToken;

final class WebTokenSignature
{
    private $signature;

    public function __construct(string $signature)
    {
        $this->signature = $signature;
    }

    public function equals(self $signature): bool
    {
        return $this->signature === $signature->signature;
    }

    public function toString(): string
    {
        return $this->signature;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
