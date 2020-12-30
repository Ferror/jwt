<?php
declare(strict_types=1);

namespace App\Infrastructure\Json;

use App\Application\Encoder as EncoderDecorator;

final class Encoder implements EncoderDecorator
{
    private $encoder;

    public function __construct(EncoderDecorator $encoder)
    {
        $this->encoder = $encoder;
    }

    public function encode($data)
    {
        return json_encode($this->encoder->encode($data));
    }
}
