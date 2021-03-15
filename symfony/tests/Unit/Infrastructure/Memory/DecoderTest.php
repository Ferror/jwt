<?php
declare(strict_types=1);

namespace App\Unit\Infrastructure\Memory;

use App\Infrastructure\Memory\MemoryDecoder;
use PHPUnit\Framework\TestCase;

final class DecoderTest extends TestCase
{
    private $decoder;

    protected function setUp(): void
    {
        $this->decoder = new MemoryDecoder();
    }

    public function testItDecodes(): void
    {
        self::assertEquals("data", $this->decoder->decode("data"));
    }
}
