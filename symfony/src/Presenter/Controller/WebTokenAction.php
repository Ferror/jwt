<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use App\Infrastructure\Json\Encoder as JsonEncoder;
use App\Infrastructure\Base64\Encoder as Base64Encoder;
use App\Infrastructure\Memory\MemoryEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WebTokenAction extends AbstractController
{
    /**
     * @Route("/authentication")
     */
    public function __invoke(Request $request): Response
    {
        $header = [
            'alg' => 'SHA512',
        ];
        $payload = [
            'user' => 123,
            'expires_at' => '2021-03-01 12:10:20',
        ];
        $signature = hash_hmac($header['alg'], json_encode($header) . json_encode($payload), 'secret');

        return new JsonResponse(
            [
                'token' => $this->encode($header) . '.' . $this->encode($payload) . '.' . $signature,
                'debug' => [
                    'login' => $request->get('login'),
                    'password' => $request->get('password'),
                ]
            ],
            200
        );
    }

    private function encode($data): string
    {
        $encoder = new JsonEncoder(new Base64Encoder(new MemoryEncoder()));

        return $encoder->encode($data);
    }
}
