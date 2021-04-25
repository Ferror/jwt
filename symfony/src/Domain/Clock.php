<?php
declare(strict_types=1);

namespace App\Domain;

interface Clock
{
    public function getTime(): int;
    public function addTime(int $time): Clock;
}
