<?php
declare(strict_types=1);

namespace App\Unit\Application;

use App\Application\AuthenticationService;
use App\Application\WebTokenEncoder;
use App\Domain\User\UserIdentifier;
use App\Domain\WebToken;
use App\Domain\WebTokenPayload;
use App\Framework\Environment;
use App\Infrastructure\Memory\MemoryWebTokenStorage;
use PHPUnit\Framework\TestCase;

final class AuthenticationServiceTest extends TestCase
{
    private $service;

    protected function setUp(): void
    {
        $this->service = new AuthenticationService(
            new MemoryWebTokenStorage(),
            new Environment('test', 'secret'),
            new WebTokenEncoder()
        );
    }

    public function testIsValid(): void
    {
        $token = new WebToken(
            new WebToken\WebTokenHeader(new WebToken\Algorithm('SHA512')),
            new WebTokenPayload(1616500000, 1616503600, new UserIdentifier('id')),
            new WebToken\WebTokenSignature('08355ab23b8cccb9f395b9ccfe76337ecb4be9b5fffd95041da5ed2063186c142aa4f22d2896041ed75ad67378ba41bb8683094997b973ba4e1474708d111b13')
        );

        self::assertTrue($this->service->isValid($token));
    }
}
