<?php
declare(strict_types=1);

namespace Ferror\Authentication\Infrastructure\Memory;

use Ferror\Authentication\Domain\Login;
use Ferror\Authentication\Domain\PasswordHash;
use Ferror\Authentication\Domain\SignedWebToken;
use Ferror\Authentication\Domain\User;
use Ferror\Authentication\Domain\User\UserIdentifier;
use Ferror\Authentication\Domain\WebToken;
use Ferror\Authentication\Domain\WebToken\Algorithm;
use Ferror\Authentication\Domain\WebToken\WebTokenHeader;
use Ferror\Authentication\Domain\WebToken\WebTokenSignature;
use Ferror\Authentication\Domain\WebTokenPayload;

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

    public static function createSignedWebTokenStorage(): MemorySignedWebTokenStorage
    {
        return new MemorySignedWebTokenStorage(
            [
                new SignedWebToken(
                    new WebToken(
                        new WebTokenHeader(Algorithm::sha512()),
                        new WebTokenPayload(1616500000, 1616503600, new UserIdentifier('id'))
                    ),
                    new WebTokenSignature('b5add06f94999f91e545620594781fa31f7d13f251beeb49c91f89584fff02236d96a0e18789eec109eb57df3531edfab9d4920971c2aeaa2ab0eb705749b9ad')
                )
            ]
        );
    }
}
