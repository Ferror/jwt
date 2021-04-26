<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

use App\Domain\Login;
use App\Domain\PasswordHash;
use App\Domain\SignedWebToken;
use App\Domain\User;
use App\Domain\SignedWebTokenStorage;
use App\Domain\WebToken\WebTokenException;

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
     * @throws \App\Domain\WebToken\WebTokenException
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
