<?php
declare(strict_types=1);

namespace App\Domain;

use App\Application\WebTokenEncoder;
use App\Domain\WebToken\Algorithm;
use App\Domain\WebToken\WebTokenHeader;
use App\Framework\Environment;

final class SignedWebTokenFactory
{
    private $algorithm;
    private $clock;
    private $environment;
    private $encoder;

    public function __construct(Algorithm $algorithm, Clock $clock, Environment $environment, WebTokenEncoder $encoder)
    {
        $this->algorithm = $algorithm;
        $this->clock = $clock;
        $this->environment = $environment;
        $this->encoder = $encoder;
    }

    public function create(User $user): SignedWebToken
    {
        $token = new WebToken(
            new WebTokenHeader($this->algorithm),
            new WebTokenPayload(
                $this->clock->getTime(),
                $this->clock->addTime(3600)->getTime(),
                $user->getIdentifier()
            )
        );

        return new SignedWebToken(
            $token,
            new WebToken\WebTokenSignature(
                \hash_hmac(
                    $this->algorithm->toString(),
                    $token->serialize($this->encoder),
                    $this->environment->getApplicationSecret()
                )
            )
        );
    }
}
