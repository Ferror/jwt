<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

use App\Application\Encoder;

final class MemoryEncoder implements Encoder
{
    public function encode($data)
    {
        return $data;
    }
}
