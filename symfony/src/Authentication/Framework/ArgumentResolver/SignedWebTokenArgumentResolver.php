<?php
declare(strict_types=1);

namespace Ferror\Authentication\Framework\ArgumentResolver;

use Ferror\Authentication\Domain\SignedWebToken;
use Ferror\Authentication\Domain\User\UserIdentifier;
use Ferror\Authentication\Domain\WebToken;
use Ferror\Authentication\Domain\WebToken\Algorithm;
use Ferror\Authentication\Domain\WebToken\WebTokenException;
use Ferror\Authentication\Domain\WebToken\WebTokenHeader;
use Ferror\Authentication\Domain\WebToken\WebTokenSignature;
use Ferror\Authentication\Domain\WebTokenPayload;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class SignedWebTokenArgumentResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === SignedWebToken::class;
    }

    /**
     * @throws \Ferror\Authentication\Domain\WebToken\WebTokenException
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $token = $request->headers->get('TOKEN');

        if (empty($token)) {
            throw WebTokenException::createInvalid('Empty token');
        }

        $exploded = \explode('.', $token);

        if ($exploded === false || \count($exploded) !== 3) {
            throw WebTokenException::createInvalid('Invalid token');
        }

        $header = $exploded[0];
        $payload = $exploded[1];
        $signature = $exploded[2];

        $baseHeader = \base64_decode($header);
        $jsonHeader = \json_decode($baseHeader, true);

        $basePayload = \base64_decode($payload);
        $jsonPayload = \json_decode($basePayload, true);

        //VALIDATE STRUCTURE OF JSON PAYLOAD
        yield new SignedWebToken(
            new WebToken(
                new WebTokenHeader(new Algorithm($jsonHeader['alg'])),
                new WebTokenPayload(
                    $jsonPayload['created_at'],
                    $jsonPayload['expires_at'],
                    new UserIdentifier($jsonPayload['user']['identifier'])
                )
            ),
            new WebTokenSignature($signature)
        );
    }
}
