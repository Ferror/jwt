<?php
declare(strict_types=1);

namespace App\Infrastructure\Base64;

use App\Infrastructure\Memory\MemoryEncoder;
use PHPUnit\Framework\TestCase;

final class EncoderTest extends TestCase
{
    private $encoder;

    protected function setUp()
    {
        $this->encoder = new Encoder(new MemoryEncoder());
    }

    public function testItEncodes(): void
    {
        self::assertEquals('ZGF0YQ==', $this->encoder->encode('data'));
    }
}
