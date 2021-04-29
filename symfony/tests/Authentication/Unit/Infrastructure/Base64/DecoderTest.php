<?php
declare(strict_types=1);

namespace Ferror\Authentication\Unit\Infrastructure\Base64;

use Ferror\Authentication\Infrastructure\Base64\Decoder;
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
        self::assertEquals('data', $this->decoder->decode('ZGF0YQ=='));
    }
}
