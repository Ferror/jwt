<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

use App\Domain\User;
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
     * @throws User\UserException
     */
    public function get(string $login): User
    {
        $result = \array_filter($this->memory, static function (User $user) use ($login) {
            return $user->getLogin() === $login;
        });

        if (empty($result)) {
            throw User\UserException::createNotFound($login);
        }

        return $result[0];
    }

    public function add(User $user): void
    {
        $this->memory[] = $user;
    }
}
