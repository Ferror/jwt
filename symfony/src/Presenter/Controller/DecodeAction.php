<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DecodeAction
{
    /**
     * @Route("/decode")
     */
    public function __invoke(): Response
    {
        $token = 'd42fda3e6fb23bd5d88d6441ec54837d99d095721ebf7ea1cd1d7718fa73a9901d2c18cf097dffd169d7079f1be509b563dc8d32ac04dd2dc5973aaaa95f9b59';
        var_dump(json_decode(base64_decode($token), true));

//        hash_hmac();

        return new Response();
    }
}
