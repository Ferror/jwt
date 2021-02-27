<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WebTokenActionTest extends WebTestCase
{
    public function testItCreatesWebToken(): void
    {
        $client = self::createClient();

        $client->request('GET', '/authentication');
    }
}
