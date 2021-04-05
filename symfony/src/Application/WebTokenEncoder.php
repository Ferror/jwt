<?php
declare(strict_types=1);

namespace App\Application;

use App\Infrastructure\Base64\Encoder as Base64Encoder;
use App\Infrastructure\Json\Encoder as JsonEncoder;
use App\Infrastructure\Memory\MemoryEncoder;

final class WebTokenEncoder
{
    private $encoder;

    public function __construct()
    {
        $this->encoder = new JsonEncoder(new Base64Encoder(new MemoryEncoder()));
    }

    public function encode(array $data)
    {
        return $this->encoder->encode($data);
    }
}
