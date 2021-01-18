<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use App\Domain\WebToken;
use App\Infrastructure\Json\Encoder;
use App\Infrastructure\Memory\MemoryEncoder;
use App\Infrastructure\Memory\TokenStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class WebTokenAction extends AbstractController
{
    /**
     * @Route("/authentication")
     */
    public function __invoke(Request $request): Response
    {
        $login = $request->get('login');
        $password = $request->get('password');

        var_dump($login, $password);

        $header = [
            'alg' => 'SHA512',
        ];
        $payload = [
            'user' => 123,
        ];
        $signature = hash_hmac('SHA512', json_encode($header) . json_encode($payload), 'secret');
//        $json = new Encoder();
//        $base = new \App\Infrastructure\Base64\Encoder();
//
//        $storage = new TokenStorage();
//        $token = $storage->get();
//
//        $jsonEncoded = $json->encode(new WebToken($token['created_at'], Uuid::fromString($token['uuid'])));
//        $baseDecoded = $base->encode($jsonEncoded);
//
//        return new JsonResponse(hash_hmac('SHA512', $baseDecoded, 'secret'));

        return new Response(
            $this->encode($header) . '.' . $this->encode($payload) . '.' . $signature,
            200
        );
    }

    private function encode($data): string
    {
        $encoder = new Encoder(new \App\Infrastructure\Base64\Encoder(new MemoryEncoder()));

        return $encoder->encode($data);
    }
}
