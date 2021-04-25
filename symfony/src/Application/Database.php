<?php
declare(strict_types=1);

namespace App\Application;

interface Database
{
    public function execute(Query $query): Result;
}
