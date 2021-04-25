<?php
declare(strict_types=1);

namespace App\Presenter\ErrorListener;

use App\Domain\CredentialsException;
use App\Domain\User\UserException;
use App\Domain\WebToken\WebTokenException;
use App\Framework\Response\ErrorResponse;
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
