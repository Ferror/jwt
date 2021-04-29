<?php
declare(strict_types=1);

namespace Ferror\Authentication\Framework\ArgumentResolver;

use Ferror\Authentication\Domain\Credentials;
use Ferror\Authentication\Domain\CredentialsException;
use Ferror\Authentication\Domain\Login;
use Ferror\Authentication\Domain\Password;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class CredentialsArgumentResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === Credentials::class;
    }

    /**
     * @throws \Ferror\Authentication\Domain\CredentialsException
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $body = $request->getContent(false);
        $result = \json_decode($body, true);

        if (!$result) {
            throw new CredentialsException('Invalid Credentials');
        }

        yield new Credentials(new Login($result['login']), new Password($result['password']));
    }
}
