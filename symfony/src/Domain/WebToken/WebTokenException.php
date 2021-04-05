<?php
declare(strict_types=1);

namespace App\Domain\WebToken;

final class WebTokenException extends \Exception
{
    public static function createInvalid(string $message): self
    {
        return new self("Invalid Web Token: $message");
    }
}
