<?php
declare(strict_types=1);

namespace App\Unit\Presenter\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WebTokenActionTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJzaGE1MTIifQ==.eyJ1c2VyIjp7ImlkZW50aWZpZXIiOiJpZCJ9LCJjcmVhdGVkX2F0IjoxNjE2NTAwMDAwLCJleHBpcmVzX2F0IjoxNjE2NTAzNjAwfQ==.b5add06f94999f91e545620594781fa31f7d13f251beeb49c91f89584fff02236d96a0e18789eec109eb57df3531edfab9d4920971c2aeaa2ab0eb705749b9ad';

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
