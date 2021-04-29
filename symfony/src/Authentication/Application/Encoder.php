<?php
declare(strict_types=1);

namespace Ferror\Authentication\Application;

interface Encoder
{
    public function encode($data);
}
