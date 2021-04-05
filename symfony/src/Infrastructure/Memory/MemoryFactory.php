<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

use App\Domain\PasswordHash;
use App\Domain\User;

final class MemoryFactory
{
    public static function createUserStorage(): MemoryUserStorage
    {
        return new MemoryUserStorage(
            [
                new User(
                    new User\UserIdentifier('id'),
                    new PasswordHash('$2y$10$5gIdNe3aQRFWW2VnFawdbejLdMkrjoBrmlMLXC9dEd8fX205bBhSy'), //password
                    'login'
                )
            ]
        );
    }
}
