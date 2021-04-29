<?php
declare(strict_types=1);

namespace Ferror\Authentication\Application;

interface Decoder
{
    public function decode(string $data);
}
