<?php
declare(strict_types=1);

namespace App\Framework\ArgumentResolver;

use App\Domain\WebToken;
use App\Domain\WebToken\Algorithm;
use App\Domain\WebToken\WebTokenException;
use App\Domain\WebToken\WebTokenHeader;
use App\Domain\WebToken\WebTokenPayload;
use App\Domain\WebToken\WebTokenSignature;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class WebTokenArgumentResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === WebToken::class;
    }

    /**
     * @throws \App\Domain\WebToken\WebTokenException
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $token = $request->headers->get('TOKEN');

        if (empty($token)) {
            throw WebTokenException::createInvalid('Empty token');
        }

        $exploded = explode('.', $token);

        $header = $exploded[0];
        $payload = $exploded[1];
        $signature = $exploded[2];

        $baseHeader = base64_decode($header);
        $jsonHeader = json_decode($baseHeader, true);

        $basePayload = base64_decode($payload);
        $jsonPayload = json_decode($basePayload, true);

//        $requestSignature = hash_hmac($jsonHeader['alg'] /* SHA512 */, $baseHeader . $basePayload, 'secret');
//
//        if ($signature !== $requestSignature) {
//            throw new \Exception('Invalid web token');
//        }

//        if ($jsonPayload['expires_at'] < $clock->getTime()) {
//            return new Response('Token expired', 400);
//        }

        yield new WebToken(
            new WebTokenHeader(new Algorithm($jsonHeader['alg'])),
            new WebTokenPayload($jsonPayload['created_at'], $jsonPayload['expires_at']),
            new WebTokenSignature($signature)
        );
    }
}
