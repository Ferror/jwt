<?php
declare(strict_types=1);

namespace App\Domain\User;

final class UserException extends \Exception
{
    public static function createNotFound(string $login): self
    {
        return new self("User not found for $login");
    }
}
