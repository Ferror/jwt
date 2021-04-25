<?php
declare(strict_types=1);

namespace App\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AuthenticationTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjp7ImlkZW50aWZpZXIiOiJpZCJ9LCJjcmVhdGVkX2F0IjoxNjE2NTAwMDAwLCJleHBpcmVzX2F0IjoxNjE2NTAzNjAwfQ==.d247935aa3804c1054346f883fe5a83fd2d609fbfb69d87213c1ec5f9e38dfc345a64c93ec771685349b7e554765948eb789b38c42067d6d014aca3ea4552d13';

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
