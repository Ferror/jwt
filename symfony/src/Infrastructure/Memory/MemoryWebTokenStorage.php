<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

use App\Domain\PasswordHash;
use App\Domain\User;
use App\Domain\WebToken;
use App\Domain\WebToken\WebTokenStorage;

final class MemoryWebTokenStorage implements WebTokenStorage
{
    /**
     * @var WebToken[]
     */
    private $memory;

    public function __construct(array $memory = [])
    {
        $this->memory = $memory;
    }

    public function getUser(WebToken $token): User
    {
        return new User(
            new User\UserIdentifier('id'),
            new PasswordHash('$2y$10$5gIdNe3aQRFWW2VnFawdbejLdMkrjoBrmlMLXC9dEd8fX205bBhSy'), //password
            'login'
        );
    }
}
