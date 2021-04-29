<?php
declare(strict_types=1);

namespace Ferror\Authentication\Unit\Infrastructure\Json;

use Ferror\Authentication\Infrastructure\Json\Decoder;
use Ferror\Authentication\Infrastructure\Memory\MemoryDecoder;
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
