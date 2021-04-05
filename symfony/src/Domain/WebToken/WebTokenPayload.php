<?php
declare(strict_types=1);

namespace App\Domain\WebToken;

final class WebTokenPayload implements \JsonSerializable
{
    private $createdAt;
    private $expiresAt;

    public function __construct(int $createdAt, int $expiresAt)
    {
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'created_at' => $this->createdAt,
            'expires_at' => $this->expiresAt,
            'payload' => 1,
        ];
    }
}
