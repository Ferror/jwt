<?php
declare(strict_types=1);

namespace App\Unit\Domain\WebToken;

use App\Domain\WebToken\Algorithm;
use PHPUnit\Framework\TestCase;

final class AlgorithmTest extends TestCase
{
    public function testItValidatesAvailableAlgorithms(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Algorithm('NOT-EXISTS');

        $this->expectException(\InvalidArgumentException::class);
        new Algorithm('not-exists');

        $this->expectException(\InvalidArgumentException::class);
        new Algorithm('notexists');

        new Algorithm('sha512');
    }
}
