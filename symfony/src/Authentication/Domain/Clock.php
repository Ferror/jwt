<?php
declare(strict_types=1);

namespace Ferror\Authentication\Domain;

interface Clock
{
    public function getTime(): int;
    public function addTime(int $time): Clock;
}
