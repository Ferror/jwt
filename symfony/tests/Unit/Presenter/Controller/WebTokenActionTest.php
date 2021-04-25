<?php
declare(strict_types=1);

namespace App\Unit\Presenter\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WebTokenActionTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjp7ImlkZW50aWZpZXIiOiJpZCJ9LCJjcmVhdGVkX2F0IjoxNjE2NTAwMDAwLCJleHBpcmVzX2F0IjoxNjE2NTAzNjAwfQ==.08355ab23b8cccb9f395b9ccfe76337ecb4be9b5fffd95041da5ed2063186c142aa4f22d2896041ed75ad67378ba41bb8683094997b973ba4e1474708d111b13';

    public function testItCreatesWebToken(): void
    {
        $client = self::createClient();
        $client->request('POST', '/authentication', [], [], [], '{"login":"login","password":"password"}');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
        self::assertEquals(self::TOKEN, (string) \json_decode((string) $client->getResponse()->getContent(), true)['token']);
    }

    public function testItCannotCreateWebToken(): void
    {
        $client = self::createClient();
        $client->request('POST', '/authentication', [], [], [], '{"login":"not-exist","password":"password"}');

        self::assertEquals(400, $client->getResponse()->getStatusCode());

        $client->request('POST', '/authentication', [], [], [], '{"login":"login","password":"not-exist"}');

        self::assertEquals(400, $client->getResponse()->getStatusCode());

        $client->request('POST', '/authentication', [], [], [], '');

        self::assertEquals(400, $client->getResponse()->getStatusCode());

        $client->request('POST', '/authentication', [], [], [], '{-asd');

        self::assertEquals(400, $client->getResponse()->getStatusCode());

        $client->request('GET', '/authentication', [], [], [], '');

        self::assertEquals(405, $client->getResponse()->getStatusCode());
    }
}
