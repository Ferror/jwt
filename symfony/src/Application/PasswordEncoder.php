<?php
declare(strict_types=1);

namespace App\Application;

final class PasswordEncoder
{
    public function encode(string $data)
    {
        return \password_hash($data, PASSWORD_BCRYPT, ['options' => 12]);
    }
}
