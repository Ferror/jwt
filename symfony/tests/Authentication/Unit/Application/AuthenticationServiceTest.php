<?php
declare(strict_types=1);

namespace Ferror\Authentication\Unit\Application;

use Ferror\Authentication\Application\AuthenticationService;
use Ferror\Authentication\Application\WebTokenEncoder;
use Ferror\Authentication\Domain\SignedWebToken;
use Ferror\Authentication\Domain\User\UserIdentifier;
use Ferror\Authentication\Domain\WebToken;
use Ferror\Authentication\Domain\WebToken\Algorithm;
use Ferror\Authentication\Domain\WebToken\WebTokenHeader;
use Ferror\Authentication\Domain\WebToken\WebTokenSignature;
use Ferror\Authentication\Domain\WebTokenPayload;
use Ferror\Authentication\Framework\Environment;
use Ferror\Authentication\Infrastructure\Memory\MemoryClock;
use Ferror\Authentication\Infrastructure\Memory\MemorySignedWebTokenStorage;
use PHPUnit\Framework\TestCase;

final class AuthenticationServiceTest extends TestCase
{
    private $service;

    protected function setUp(): void
    {
        $this->service = new AuthenticationService(
            new MemorySignedWebTokenStorage([
                new SignedWebToken(
                    new WebToken(
                        new WebTokenHeader(Algorithm::sha512()),
                        new WebTokenPayload(1616500000, 1616503600, new UserIdentifier('id'))
                    ),
                    new WebTokenSignature('b5add06f94999f91e545620594781fa31f7d13f251beeb49c91f89584fff02236d96a0e18789eec109eb57df3531edfab9d4920971c2aeaa2ab0eb705749b9ad')
                )
            ]),
            new Environment('test', 'secret'),
            new WebTokenEncoder(),
            new MemoryClock(1616500000)
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

    public function testItIsExpired(): void
    {
        $token = new SignedWebToken(
            new WebToken(
                new WebTokenHeader(Algorithm::sha512()),
                new WebTokenPayload(1616400000, 1616500000, new UserIdentifier('id'))
            ),
            new WebTokenSignature('b5add06f94999f91e545620594781fa31f7d13f251beeb49c91f89584fff02236d96a0e18789eec109eb57df3531edfab9d4920971c2aeaa2ab0eb705749b9ad')
        );

        self::assertFalse($this->service->isValid($token));
    }
}
