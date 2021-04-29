<?php
declare(strict_types=1);

namespace Ferror\Authentication\Infrastructure\Memory;

use Ferror\Authentication\Domain\Login;
use Ferror\Authentication\Domain\User;
use Ferror\Authentication\Domain\User\UserException;
use Ferror\Authentication\Domain\User\UserStorage;

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
