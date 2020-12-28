<?php
declare(strict_types=1);

namespace App\Domain;

use Symfony\Component\Uid\Uuid;

final class WebToken implements \JsonSerializable
{
    private $createdAt;
    private $identifier;

    public function __construct(int $createdAt, Uuid $identifier)
    {
        $this->createdAt = $createdAt;
        $this->identifier = $identifier;
    }

    public function jsonSerialize(): array
    {
        return [
            'created_at' => $this->createdAt,
            'expires_at' => $this->createdAt + 3600,
            'identifier' => $this->identifier->jsonSerialize(),
        ];
    }
}
