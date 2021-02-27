<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class VerifyActionTest extends WebTestCase
{
    public function testItVerifiesToken(): void
    {
        $client = self::createClient();

        $client->request('GET', '/verify');
    }
}
