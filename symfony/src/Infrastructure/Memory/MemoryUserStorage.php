<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

use App\Domain\Login;
use App\Domain\User;
use App\Domain\User\UserException;
use App\Domain\User\UserStorage;

final class MemoryUserStorage implements UserStorage
{
    /**
     * @var User[]
     */
    private $memory;

    public function __construct(array $memory = [])
    {
        $this->memory = $memory;
    }

    /**
     * @throws UserException
     */
    public function get(string $login): User
    {
        $result = \array_filter($this->memory, static function (User $user) use ($login) {
            return $user->getLogin()->equals(new Login($login));
        });

        if (empty($result)) {
            throw UserException::createNotFound($login);
        }

        return $result[0];
    }

    public function add(User $user): void
    {
        $this->memory[] = $user;
    }
}
