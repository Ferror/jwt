<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain;

use Ferror\Authentication\Domain\WebToken\Algorithm;
use Ferror\Authentication\Domain\WebToken\WebTokenHeader;

final class WebTokenFactory
{
    private $algorithm;
    private $clock;

    public function __construct(Algorithm $algorithm, Clock $clock)
    {
        $this->algorithm = $algorithm;
        $this->clock = $clock;
    }

    public function create(User $user): WebToken
    {
        $header = new WebTokenHeader($this->algorithm);
        $payload = new WebTokenPayload(
            $this->clock->getTime(),
            $this->clock->addTime(3600)->getTime(),
            $user->getIdentifier()
        );

        return new WebToken($header, $payload);
    }
}
