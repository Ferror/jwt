<?php
declare(strict_types=1);

namespace Ferror\Authentication\Infrastructure\Memory;

use Ferror\Authentication\Application\Decoder;

final class MemoryDecoder implements Decoder
{
    public function decode(string $data)
    {
        return $data;
    }
}
