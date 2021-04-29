<?php
declare(strict_types=1);

namespace Ferror\Authentication\Presenter\ErrorListener;

use Ferror\Authentication\Domain\CredentialsException;
use Ferror\Authentication\Domain\User\UserException;
use Ferror\Authentication\Domain\WebToken\WebTokenException;
use Ferror\Authentication\Framework\Response\ErrorResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class AuthenticationErrorListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof UserException) {
            $event->setResponse(new ErrorResponse('Invalid Credentials', 400));
        }

        if ($exception instanceof WebTokenException) {
            $event->setResponse(new ErrorResponse('Invalid Credentials', 403));
        }

        if ($exception instanceof CredentialsException) {
            $event->setResponse(new ErrorResponse('Invalid Credentials', 400));
        }
    }
}
