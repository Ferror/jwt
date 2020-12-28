<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

final class TokenStorage
{
    public function get(): array
    {
        return [
            'uuid' => '27d100e2-47c6-4f5b-ac45-79e7bdca1fc1',
            'created_at' => 12000,
            'expired_at' => 12060,
        ];
    }
}
