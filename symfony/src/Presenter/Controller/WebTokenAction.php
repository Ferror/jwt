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
     * @Route("/authentication", methods={"POST"})
     */
    public function __invoke(Request $request): Response
    {
        if ($this->isValid($request->get('login', ''), ($request->get('password', '')))) {
            $header = [
                'alg' => 'SHA512',
            ];
            $payload = [
                'user' => 123,
                'expires_at' => 1616600000, //timestamp better
            ];
            $signature = hash_hmac($header['alg'], json_encode($header) . json_encode($payload), 'secret');

            return new JsonResponse(
                [
                    'token' => $this->encode($header) . '.' . $this->encode($payload) . '.' . $signature,
                ],
                200
            );
        }

        return new JsonResponse(['error' => ['message' => 'Could not authenticate']], 403);
    }

    private function encode($data): string
    {
        $encoder = new JsonEncoder(new Base64Encoder(new MemoryEncoder()));

        return $encoder->encode($data);
    }

    private function isValid(string $login, string $password): bool
    {
        return $login === 'login' && $password === 'password';
    }
}
