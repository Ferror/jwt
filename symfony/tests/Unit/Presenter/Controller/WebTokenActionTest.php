<?php
declare(strict_types=1);

namespace App\Unit\Presenter\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WebTokenActionTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjp7ImlkZW50aWZpZXIiOjEyM30sImNyZWF0ZWRfYXQiOjE2MTY1MDAwMDAsImV4cGlyZXNfYXQiOjE2MTY1MDAwMDB9.f6085a7fdcece40e1c8061ac3aa4f32cc6145028f2f3e124c33a005694c520ed6c80ed794aac188ae583fdebaa7539b0797cd1e142751047c9fd6060abd9502f';

    public function testItCreatesWebToken(): void
    {
        $client = self::createClient();
        $client->request('POST', '/authentication', [], [], [], '{"login":"login","password":"password"}');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
        self::assertEquals(self::TOKEN, json_decode($client->getResponse()->getContent(), true)['token']);
    }
}
