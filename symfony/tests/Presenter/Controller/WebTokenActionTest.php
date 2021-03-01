<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WebTokenActionTest extends WebTestCase
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjoxMjMsImV4cGlyZXNfYXQiOiIyMDIxLTAzLTAxIDEyOjEwOjIwIn0=.9dd1f5d98753c955bab229eaa5c363bd36e5cc2988a6b537122bd9d6bddf589bd19deadd0981d41ab823ccef1c1a23e8e1923b998acb85e4b9104e7b37dd6acf';

    public function testItCreatesWebToken(): void
    {
        $client = self::createClient();

        $client->request('GET', '/authentication');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
        self::assertEquals(
            '{"token":"eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjoxMjMsImV4cGlyZXNfYXQiOiIyMDIxLTAzLTAxIDEyOjEwOjIwIn0=.9dd1f5d98753c955bab229eaa5c363bd36e5cc2988a6b537122bd9d6bddf589bd19deadd0981d41ab823ccef1c1a23e8e1923b998acb85e4b9104e7b37dd6acf","debug":{"login":null,"password":null}}',
            $client->getResponse()->getContent()
        );
    }
}
