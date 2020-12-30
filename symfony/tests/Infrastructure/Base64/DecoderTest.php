<?php
declare(strict_types=1);

namespace App\Infrastructure\Base64;

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
        self::assertEquals('data', $this->decoder->decode('ZGF0YQ=='));
    }
}
