<?php
declare(strict_types=1);

namespace App\Infrastructure\Json;

final class Encoder
{
    public function encode(\JsonSerializable $json): string
    {
        return json_encode($json->jsonSerialize());
    }
}
