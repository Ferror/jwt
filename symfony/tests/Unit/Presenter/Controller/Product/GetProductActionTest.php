<?php
declare(strict_types=1);

namespace App\Unit\Presenter\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetProductActionTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJzaGE1MTIifQ==.eyJ1c2VyIjp7ImlkZW50aWZpZXIiOiJpZCJ9LCJjcmVhdGVkX2F0IjoxNjE2NTAwMDAwLCJleHBpcmVzX2F0IjoxNjE2NTAzNjAwfQ==.b5add06f94999f91e545620594781fa31f7d13f251beeb49c91f89584fff02236d96a0e18789eec109eb57df3531edfab9d4920971c2aeaa2ab0eb705749b9ad';

    public function testItGetProducts(): void
    {
        $client = self::createClient();
        $client->request('GET', '/products', [], [], ['HTTP_TOKEN' => self::TOKEN]);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
