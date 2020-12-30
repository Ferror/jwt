<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use App\Domain\WebToken;
use App\Infrastructure\Json\Encoder;
use App\Infrastructure\Memory\TokenStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class WebTokenAction extends AbstractController
{
    /**
     * @Route("/token")
     */
    public function __invoke(): Response
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
//        return new JsonResponse(hash_hmac('SHA512', $baseDecoded, 'secret'));

        return new Response();
    }
}
