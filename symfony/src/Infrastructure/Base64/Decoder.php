<?php
declare(strict_types=1);

namespace App\Infrastructure\Base64;

final class Decoder
{
    public function decode(string $code)
    {
        return base64_decode($code, true);
    }
}
