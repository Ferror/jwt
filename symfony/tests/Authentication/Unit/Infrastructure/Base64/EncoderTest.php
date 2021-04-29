<?php
declare(strict_types=1);

namespace Ferror\Authentication\Unit\Infrastructure\Base64;

use Ferror\Authentication\Infrastructure\Base64\Encoder;
use Ferror\Authentication\Infrastructure\Memory\MemoryEncoder;
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
