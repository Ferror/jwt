<?php
declare(strict_types=1);

namespace App\Domain\WebToken;

use App\Domain\User;
use App\Domain\WebToken;

interface WebTokenStorage
{
    public function getUser(WebToken $token): User;
}
