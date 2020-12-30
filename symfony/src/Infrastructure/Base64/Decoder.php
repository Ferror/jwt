<?php
declare(strict_types=1);

namespace App\Infrastructure\Base64;

use App\Application\Decoder as DecoderDecorator;

final class Decoder implements DecoderDecorator
{
    private $decoder;

    public function __construct(DecoderDecorator $decoder)
    {
        $this->decoder = $decoder;
    }

    public function decode($data)
    {
        return base64_decode($this->decoder->decode($data), true);
    }
}
