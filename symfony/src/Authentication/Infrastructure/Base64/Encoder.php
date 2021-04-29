<?php
declare(strict_types=1);

namespace Ferror\Authentication\Infrastructure\Base64;

use Ferror\Authentication\Application\Encoder as EncoderDecorator;

final class Encoder implements EncoderDecorator
{
    private $encoder;

    public function __construct(EncoderDecorator $encoder)
    {
        $this->encoder = $encoder;
    }

    public function encode($data): string
    {
        return base64_encode($this->encoder->encode($data));
    }
}
