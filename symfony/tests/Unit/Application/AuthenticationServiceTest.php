<?php
declare(strict_types=1);

namespace App\Unit\Application;

use App\Application\AuthenticationService;
use App\Application\WebTokenEncoder;
use App\Domain\SignedWebToken;
use App\Domain\User\UserIdentifier;
use App\Domain\WebToken;
use App\Domain\WebToken\Algorithm;
use App\Domain\WebToken\WebTokenHeader;
use App\Domain\WebToken\WebTokenSignature;
use App\Domain\WebTokenPayload;
use App\Framework\Environment;
use App\Infrastructure\Memory\MemorySignedWebTokenStorage;
use PHPUnit\Framework\TestCase;

final class AuthenticationServiceTest extends TestCase
{
    private $service;

    protected function setUp(): void
    {
        $this->service = new AuthenticationService(
            new MemorySignedWebTokenStorage(),
            new Environment('test', 'secret'),
            new WebTokenEncoder()
        );
    }

    public function testIsValid(): void
    {
        $token = new SignedWebToken(
            new WebToken(
                new WebTokenHeader(Algorithm::sha512()),
                new WebTokenPayload(1616500000, 1616503600, new UserIdentifier('id'))
            ),
            new WebTokenSignature('b5add06f94999f91e545620594781fa31f7d13f251beeb49c91f89584fff02236d96a0e18789eec109eb57df3531edfab9d4920971c2aeaa2ab0eb705749b9ad')
        );

        self::assertTrue($this->service->isValid($token));
    }
}
