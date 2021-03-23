<?php
declare(strict_types=1);

namespace App\Unit\Presenter\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class VerifyActionTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjoxMjMsImV4cGlyZXNfYXQiOjE2MTY1MDAwMDB9.c3803159c568bedeea4ec4aa9c5f9aaa2b759382a31d67f2c595923d50aa354857b2253061f4d7d5c50833f6ee3b86f1ab914907848a60b1eec88b1bf6c25f8c';

    public function testItVerifiesToken(): void
    {
        $client = self::createClient();

        $client->request('POST', '/verify', ['token' => self::TOKEN]);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
