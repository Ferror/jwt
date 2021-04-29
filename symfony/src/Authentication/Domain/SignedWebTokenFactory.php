<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain;

use Ferror\Authentication\Application\WebTokenEncoder;
use Ferror\Authentication\Domain\WebToken\Algorithm;
use Ferror\Authentication\Domain\WebToken\WebTokenHeader;
use Ferror\Authentication\Framework\Environment;

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

        return $token->sign($this->encoder, $this->environment);
    }
}
