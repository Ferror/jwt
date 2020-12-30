<?php
declare(strict_types=1);

namespace App\Domain\WebToken;

final class WebTokenPayload implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [
            'payload' => 1
        ];
    }
}
