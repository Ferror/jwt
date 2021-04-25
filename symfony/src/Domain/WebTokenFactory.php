<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\WebToken\Algorithm;
use App\Domain\WebToken\WebTokenHeader;
use App\Framework\Environment;

final class WebTokenFactory
{
    private $algorithm;
    private $clock;
    private $environment;

    public function __construct(Algorithm $algorithm, Clock $clock, Environment $environment)
    {
        $this->algorithm = $algorithm;
        $this->clock = $clock;
        $this->environment = $environment;
    }

    public function create(User $user): WebToken
    {
        $header = new WebTokenHeader($this->algorithm);
        $payload = new WebTokenPayload(
            $this->clock->getTime(),
            $this->clock->addTime(3600)->getTime(),
            $user->getIdentifier()
        );

        return new WebToken(
            $header,
            $payload,
            new WebToken\WebTokenSignature(
                \hash_hmac(
                    $this->algorithm->toString(),
                    \json_encode($header->jsonSerialize()) . \json_encode($payload->jsonSerialize()),
                    $this->environment->getApplicationSecret()
                )
            )
        );
    }
}
