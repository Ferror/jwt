<?php
declare(strict_types=1);

namespace App\Infrastructure\Json;

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
        return json_decode($this->decoder->decode($data), true);
    }
}
