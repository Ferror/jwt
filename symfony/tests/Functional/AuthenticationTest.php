<?php
declare(strict_types=1);

namespace App\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AuthenticationTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjp7ImlkZW50aWZpZXIiOiJpZCJ9LCJjcmVhdGVkX2F0IjoxNjE2NTAwMDAwLCJleHBpcmVzX2F0IjoxNjE2NTAzNjAwfQ==.08355ab23b8cccb9f395b9ccfe76337ecb4be9b5fffd95041da5ed2063186c142aa4f22d2896041ed75ad67378ba41bb8683094997b973ba4e1474708d111b13';

    public function testItIsAuthenticated(): void
    {
        $client = self::createClient();
        $client->request('POST', '/authentication', [], [], [], '{"login":"login","password":"password"}');

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        self::assertEquals(self::TOKEN, \json_decode($client->getResponse()->getContent(), true)['token']);

        $client->request('GET', '/products', [], [], ['HTTP_TOKEN' => self::TOKEN]);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testItIsNotAuthenticated(): void
    {
        $client = self::createClient();
        $client->request('POST', '/authentication', [], [], [], '{"login":"other","password":"other"}');

        self::assertEquals(400, $client->getResponse()->getStatusCode());

        $client->request('GET', '/products', [], [], ['HTTP_TOKEN' => '']);

        self::assertEquals(403, $client->getResponse()->getStatusCode());

        $client->request('GET', '/products');

        self::assertEquals(403, $client->getResponse()->getStatusCode());
    }
}
