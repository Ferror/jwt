<?php
declare(strict_types=1);

namespace Ferror\Authentication\Infrastructure\Memory;

use Ferror\Authentication\Domain\Login;
use Ferror\Authentication\Domain\PasswordHash;
use Ferror\Authentication\Domain\SignedWebToken;
use Ferror\Authentication\Domain\User;
use Ferror\Authentication\Domain\SignedWebTokenStorage;
use Ferror\Authentication\Domain\WebToken\WebTokenException;

final class MemorySignedWebTokenStorage implements SignedWebTokenStorage
{
    /**
     * @var SignedWebToken[]
     */
    private $memory;

    public function __construct(array $memory = [])
    {
        $this->memory = $memory;
    }

    /**
     * @throws \Ferror\Authentication\Domain\WebToken\WebTokenException
     */
    public function getUser(SignedWebToken $token): User
    {
        $result = \array_filter($this->memory, static function (SignedWebToken $memoryToken) use ($token) {
            return $memoryToken->equals($token);
        });

        if (empty($result)) {
            throw WebTokenException::createNotFound('');
        }

        return new User(
            new User\UserIdentifier('id'),
            new PasswordHash('$2y$10$5gIdNe3aQRFWW2VnFawdbejLdMkrjoBrmlMLXC9dEd8fX205bBhSy'), //password
            new Login('login')
        );
    }
}
