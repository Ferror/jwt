<?php
declare(strict_types=1);

namespace Ferror\Authentication\Unit\Application;

use Ferror\Authentication\Application\PasswordEncoder;
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
