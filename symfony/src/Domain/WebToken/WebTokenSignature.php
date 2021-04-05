<?php
declare(strict_types=1);

namespace App\Domain\WebToken;

final class WebTokenSignature
{
    private $signature;

    public function __construct(string $signature)
    {
        $this->signature = $signature;
    }
}
