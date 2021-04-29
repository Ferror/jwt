<?php
declare(strict_types=1);

namespace Ferror\Authentication\Infrastructure\Memory;

use Ferror\Authentication\Domain\Clock;

final class MemoryClock implements Clock
{
    private $time;

    public function __construct(int $time)
    {
        $this->time = $time;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function addTime(int $time): Clock
    {
        return new MemoryClock($this->time + $time);
    }
}
