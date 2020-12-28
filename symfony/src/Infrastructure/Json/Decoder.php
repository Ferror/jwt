<?php
declare(strict_types=1);

namespace App\Infrastructure\Json;

final class Decoder
{
    public function decode(string $json)
    {
        return json_decode($json, true);
    }
}
