<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain\User;

use Ferror\Authentication\Domain\User;

interface UserStorage
{
    public function get(string $login): User;
}
