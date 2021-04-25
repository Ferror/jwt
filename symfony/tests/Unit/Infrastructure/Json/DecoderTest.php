<?php
declare(strict_types=1);

namespace App\Unit\Infrastructure\Json;

use App\Infrastructure\Json\Decoder;
use App\Infrastructure\Memory\MemoryDecoder;
use PHPUnit\Framework\TestCase;

final class DecoderTest extends TestCase
{
    private $decoder;

    protected function setUp(): void
    {
        $this->decoder = new Decoder(new MemoryDecoder());
    }

    public function testItDecodes(): void
    {
        self::assertEquals(null, $this->decoder->decode('data'));
    }
}
