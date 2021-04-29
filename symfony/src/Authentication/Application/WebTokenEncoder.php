<?php
declare(strict_types=1);

namespace Ferror\Authentication\Application;

use Ferror\Authentication\Infrastructure\Base64\Encoder as Base64Encoder;
use Ferror\Authentication\Infrastructure\Json\Encoder as JsonEncoder;
use Ferror\Authentication\Infrastructure\Memory\MemoryEncoder;

final class WebTokenEncoder implements Encoder
{
    private $encoder;

    public function __construct()
    {
        $this->encoder = new JsonEncoder(new Base64Encoder(new MemoryEncoder()));
    }

    public function encode($data)
    {
        return $this->encoder->encode($data);
    }
}
