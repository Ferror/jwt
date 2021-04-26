<?php
declare(strict_types=1);

namespace App\Domain;

use App\Application\Encoder;
use App\Domain\WebToken\WebTokenHeader;
use App\Domain\WebToken\WebTokenSignature;
use App\Framework\Environment;

final class WebToken
{
    private $header;
    private $payload;

    public function __construct(WebTokenHeader $header, WebTokenPayload $payload)
    {
        $this->header = $header;
        $this->payload = $payload;
    }

    public function serialize(Encoder $encoder): string
    {
        return \sprintf(
            '%s.%s',
            $encoder->encode($this->header->jsonSerialize()),
            $encoder->encode($this->payload->jsonSerialize())
        );
    }

    public function sign(Encoder $encoder, Environment $environment): SignedWebToken
    {
        return new SignedWebToken(
            $this,
            new WebTokenSignature(
                \hash_hmac(
                    $this->header->getAlgorithm()->toString(),
                    $this->serialize($encoder),
                    $environment->getApplicationSecret()
                )
            )
        );
    }
}
