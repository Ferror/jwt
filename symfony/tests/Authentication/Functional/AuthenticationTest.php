<?php
declare(strict_types=1);

namespace Ferror\Authentication\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AuthenticationTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJzaGE1MTIifQ==.eyJ1c2VyIjp7ImlkZW50aWZpZXIiOiJpZCJ9LCJjcmVhdGVkX2F0IjoxNjE2NTAwMDAwLCJleHBpcmVzX2F0IjoxNjE2NTAzNjAwfQ==.b5add06f94999f91e545620594781fa31f7d13f251beeb49c91f89584fff02236d96a0e18789eec109eb57df3531edfab9d4920971c2aeaa2ab0eb705749b9ad';

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
