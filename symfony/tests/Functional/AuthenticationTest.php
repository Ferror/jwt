<?php
declare(strict_types=1);

namespace App\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AuthenticationTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjoxMjMsImV4cGlyZXNfYXQiOjE2MTY2MDAwMDB9.956e8e557ed84f93f90a5865586d38010d8e22e974384f3d5fee0764e0bb6ba9c5ef86432bcf4d1d5c26e058d26aa42fc1e10de884a62bedaa6269c706877d36';

    public function testItIsAuthenticated(): void
    {
        $client = self::createClient();
        $client->request('POST', '/authentication', [
            'login' => 'login',
            'password' => 'password',
        ]);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
        self::assertEquals(self::TOKEN, json_decode($client->getResponse()->getContent(), true)['token']);

        $client->request('POST', '/verify', ['token' => self::TOKEN]);

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/products', ['token' => self::TOKEN]);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testItIsNotAuthenticated(): void
    {
        $client = self::createClient();
        $client->request('POST', '/authentication', [
            'login' => 'other',
            'password' => 'other',
        ]);

        self::assertEquals(403, $client->getResponse()->getStatusCode());

        $client->request('GET', '/products', ['token' => '']);

        self::assertEquals(403, $client->getResponse()->getStatusCode());
    }
}
