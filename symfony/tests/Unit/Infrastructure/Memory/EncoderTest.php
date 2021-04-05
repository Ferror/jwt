<?php
declare(strict_types=1);

namespace App\Unit\Infrastructure\Memory;

use App\Infrastructure\Memory\MemoryEncoder;
use PHPUnit\Framework\TestCase;

final class EncoderTest extends TestCase
{
    private $encoder;

    protected function setUp(): void
    {
        $this->encoder = new MemoryEncoder();
    }

    public function testItEncodes(): void
    {
        self::assertEquals('data', $this->encoder->encode('data'));
    }
}