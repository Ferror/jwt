<?php
declare(strict_types=1);

namespace App\Domain\WebToken;

final class WebTokenHeader implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [
            'header' => 1
        ];
    }
}
