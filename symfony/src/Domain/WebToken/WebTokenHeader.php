<?php
declare(strict_types=1);

namespace App\Domain\WebToken;

final class WebTokenHeader implements \JsonSerializable
{
    private $algorithm;

    public function __construct(Algorithm $algorithm)
    {
        $this->algorithm = $algorithm;
    }

    public function jsonSerialize(): array
    {
        return ['alg' => $this->algorithm->toString()];
    }

    public function getAlgorithm(): Algorithm
    {
        return $this->algorithm;
    }
}
