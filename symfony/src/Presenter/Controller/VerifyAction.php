<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use App\Domain\Clock;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VerifyAction
{
    /**
     * @Route("/verify", methods={"POST"})
     */
    public function __invoke(Request $request, Clock $clock): Response
    {
        $token = $request->get('token');
        $exploded = explode('.', $token);

        if ($exploded === false || count($exploded) !== 3) {
            return new Response('Invalid token', 400);
        }

        $header = $exploded[0];
        $payload = $exploded[1];
        $signature = $exploded[2];

        $baseHeader = base64_decode($header);
        $jsonHeader = json_decode($baseHeader, true);

        $basePayload = base64_decode($payload);
        $jsonPayload = json_decode($basePayload, true);

        $requestSignature = hash_hmac($jsonHeader['alg'] /* SHA512 */, $baseHeader . $basePayload, 'secret');

        if ($signature === $requestSignature) {
            if ($jsonPayload['expires_at'] < $clock->getTime()) {
                return new Response('Token expired', 400);
            }

            return new Response('Signature is valid', 200);
        }

        return new Response();
    }
}
