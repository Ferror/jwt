<?php
declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User;

interface UserStorage
{
    public function get(string $login): User;
}
