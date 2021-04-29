<?php
declare(strict_types=1);

namespace Ferror\Authentication\Infrastructure\Memory;

use Ferror\Authentication\Domain\Login;
use Ferror\Authentication\Domain\PasswordHash;
use Ferror\Authentication\Domain\User;

final class MemoryFactory
{
    public static function createUserStorage(): MemoryUserStorage
    {
        return new MemoryUserStorage(
            [
                new User(
                    new User\UserIdentifier('id'),
                    new PasswordHash('$2y$10$5gIdNe3aQRFWW2VnFawdbejLdMkrjoBrmlMLXC9dEd8fX205bBhSy'), //password
                    new Login('login')
                )
            ]
        );
    }
}
