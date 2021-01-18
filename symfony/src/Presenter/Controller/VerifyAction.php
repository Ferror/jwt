<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use App\Domain\WebToken;
use App\Infrastructure\Json\Encoder;
use App\Infrastructure\Memory\TokenStorage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class VerifyAction
{
    /**
     * @Route("/verify")
     */
    public function __invoke(Request $request): Response
    {
//        $json = new Encoder();
//        $base = new \App\Infrastructure\Base64\Encoder();
//
//        $storage = new TokenStorage();
//        $token = $storage->get();
//
//        $jsonEncoded = $json->encode(new WebToken($token['created_at'], Uuid::fromString($token['uuid'])));
//        $baseDecoded = $base->encode($jsonEncoded);
//
//        //przy JWT hash_hmac nie jest potrzebny?
//        return new JsonResponse(
//            hash_hmac('SHA512', $baseDecoded, 'secret') === $request->get('token')
//        );
        return new Response();
    }
}
