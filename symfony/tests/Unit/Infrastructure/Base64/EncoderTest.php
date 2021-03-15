<?php
declare(strict_types=1);

namespace App\Unit\Infrastructure\Base64;

use App\Infrastructure\Base64\Encoder;
use App\Infrastructure\Memory\MemoryEncoder;
use PHPUnit\Framework\TestCase;

final class EncoderTest extends TestCase
{
    private $encoder;

    protected function setUp(): void
    {
        $this->encoder = new Encoder(new MemoryEncoder());
    }

    public function testItEncodes(): void
    {
        self::assertEquals('ZGF0YQ==', $this->encoder->encode('data'));
    }
}
