<?php
declare(strict_types=1);

namespace App\Infrastructure\Base64;

final class Encoder
{
    public function encode(string $message): string
    {
        return base64_encode($message);
    }
}
