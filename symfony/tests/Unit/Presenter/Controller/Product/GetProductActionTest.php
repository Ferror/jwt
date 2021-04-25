<?php
declare(strict_types=1);

namespace App\Unit\Presenter\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetProductActionTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjp7ImlkZW50aWZpZXIiOiJpZCJ9LCJjcmVhdGVkX2F0IjoxNjE2NTAwMDAwLCJleHBpcmVzX2F0IjoxNjE2NTAzNjAwfQ==.08355ab23b8cccb9f395b9ccfe76337ecb4be9b5fffd95041da5ed2063186c142aa4f22d2896041ed75ad67378ba41bb8683094997b973ba4e1474708d111b13';

    public function testItGetProducts(): void
    {
        $client = self::createClient();
        $client->request('GET', '/products', [], [], ['HTTP_TOKEN' => self::TOKEN]);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
