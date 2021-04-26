<?php
declare(strict_types=1);

namespace App\Framework\ArgumentResolver;

use App\Domain\Credentials;
use App\Domain\CredentialsException;
use App\Domain\Login;
use App\Domain\Password;
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
     * @throws \App\Domain\CredentialsException
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
