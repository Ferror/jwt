<?php
declare(strict_types=1);

namespace Ferror\Authentication\Infrastructure\Memory;

use Ferror\Authentication\Application\Encoder;

final class MemoryEncoder implements Encoder
{
    public function encode($data)
    {
        return $data;
    }
}
