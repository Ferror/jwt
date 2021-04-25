<?php
declare(strict_types=1);

namespace App\Unit\Application;

use App\Application\PasswordEncoder;
use PHPUnit\Framework\TestCase;

final class PasswordEncoderTest extends TestCase
{
    private $passwordHash;

    protected function setUp(): void
    {
        $this->passwordHash = new PasswordEncoder();
    }

    public function testItHashesPassword(): void
    {
        ;
        self::assertTrue(\password_verify('password', $this->passwordHash->encode('password')));
    }
}
