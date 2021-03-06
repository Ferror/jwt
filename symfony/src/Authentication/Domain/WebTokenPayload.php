<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain;

use Ferror\Authentication\Domain\User\UserIdentifier;

final class WebTokenPayload implements \JsonSerializable
{
    private $createdAt;
    private $expiresAt;
    private $userIdentifier;

    public function __construct(int $createdAt, int $expiresAt, UserIdentifier $userIdentifier)
    {
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
        $this->userIdentifier = $userIdentifier;
    }

    public function jsonSerialize(): array
    {
        return [
            'user' => [
                'identifier' => $this->userIdentifier->toString(),
            ],
            'created_at' => $this->createdAt,
            'expires_at' => $this->expiresAt,
        ];
    }

    public function getExpireAt(): int
    {
        return $this->expiresAt;
    }
}
