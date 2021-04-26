<?php
declare(strict_types=1);

namespace App\Domain;

use App\Application\Encoder;
use App\Domain\WebToken\WebTokenSignature;
use App\Framework\Environment;

final class SignedWebToken
{
    private $signature;
    private $token;

    public function __construct(WebToken $token, WebTokenSignature $signature)
    {
        $this->token = $token;
        $this->signature = $signature;
    }

    public function equals(self $token): bool
    {
        return $this->signature->equals($token->signature);
    }

    public function serialize(Encoder $encoder): string
    {
        return \sprintf(
            '%s.%s',
            $this->token->serialize($encoder),
            $this->signature->toString()
        );
    }

    public function isValidSignature(Encoder $encoder, Environment $environment): bool
    {
        return $this->token->sign($encoder, $environment)->signature->equals($this->signature);
    }
}
