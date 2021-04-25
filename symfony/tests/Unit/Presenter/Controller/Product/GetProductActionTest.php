<?php
declare(strict_types=1);

namespace App\Unit\Presenter\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetProductActionTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjp7ImlkZW50aWZpZXIiOiJpZCJ9LCJjcmVhdGVkX2F0IjoxNjE2NTAwMDAwLCJleHBpcmVzX2F0IjoxNjE2NTAzNjAwfQ==.d247935aa3804c1054346f883fe5a83fd2d609fbfb69d87213c1ec5f9e38dfc345a64c93ec771685349b7e554765948eb789b38c42067d6d014aca3ea4552d13';

    public function testItGetProducts(): void
    {
        $client = self::createClient();
        $client->request('GET', '/products', [], [], ['HTTP_TOKEN' => self::TOKEN]);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
