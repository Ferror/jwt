<?php
declare(strict_types=1);

namespace App\Domain;

use App\Application\Encoder;
use App\Domain\WebToken\WebTokenHeader;
use App\Domain\WebToken\WebTokenSignature;
use App\Framework\Environment;

//Create WebToken and SignedWebToken decorator
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
        return \sprintf(
            '%s.%s.%s',
            $encoder->encode($this->header->jsonSerialize()),
            $encoder->encode($this->payload->jsonSerialize()),
            $this->signature->toString()
        );
    }

    public function isValidSignature(Encoder $encoder, Environment $environment): bool
    {

        return $this->signature->compare(
            new WebTokenSignature(
                \hash_hmac(
                    $this->header->getAlgorithm()->toString(),
                    \sprintf('%s%s', $encoder->encode($this->header), $encoder->encode($this->payload)),
                    $environment->getApplicationSecret()
                )
            )
        );
    }
}
