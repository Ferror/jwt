<?php
declare(strict_types=1);

namespace App\Application;

interface Encoder
{
    public function encode($data);
}