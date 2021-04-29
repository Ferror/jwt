<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain;

use Ferror\Authentication\Application\Encoder;
use Ferror\Authentication\Domain\WebToken\WebTokenHeader;
use Ferror\Authentication\Domain\WebToken\WebTokenSignature;
use Ferror\Authentication\Framework\Environment;

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

    public function isExpired(Clock $time): bool
    {
        return $this->payload->getExpireAt() <= $time->getTime();

    }
}
