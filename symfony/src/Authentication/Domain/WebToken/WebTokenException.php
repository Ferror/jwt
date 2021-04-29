<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain\WebToken;

final class WebTokenException extends \Exception
{
    public static function createInvalid(string $message): self
    {
        return new self("Invalid Web Token: $message");
    }

    public static function createNotFound(string $message): self
    {
        return new self("Token not found: $message");
    }
}
