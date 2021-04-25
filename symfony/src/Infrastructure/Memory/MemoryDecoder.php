<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

use App\Application\Decoder;

final class MemoryDecoder implements Decoder
{
    public function decode(string $data)
    {
        return $data;
    }
}
