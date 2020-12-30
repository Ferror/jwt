<?php
declare(strict_types=1);

namespace App\Domain;

use App\Application\Encoder;
use App\Domain\WebToken\WebTokenHeader;
use App\Domain\WebToken\WebTokenPayload;
use App\Domain\WebToken\WebTokenSignature;

final class WebToken
{
    private $header;
    private $payload;
    private $signature;

    public function __construct(WebTokenHeader $header, WebTokenPayload $payload, WebTokenSignature $signature)
    {
        $this->header = $header;
        $this->payload = $payload;
        $this->signature = $signature;
    }

    public function serialize(Encoder $encoder): string
    {
        return sprintf('%s.%s.%s', $encoder->encode($this->header), $this->payload, $this->signature);
    }
}
