<?php
declare(strict_types=1);

namespace Ferror\Authentication\Presenter\ErrorListener;

use Ferror\Authentication\Framework\Environment;
use Ferror\Authentication\Framework\Response\ErrorResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class ServerErrorListener
{
    private $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof MethodNotAllowedHttpException) {
            $event->setResponse(new ErrorResponse($exception->getMessage(), 405));

            return;
        }

        if ($this->environment->isDevelopment()) {
            $event->setResponse(new ErrorResponse($exception->getMessage(), 500));
        }

        if ($this->environment->isTesting()) {
            $event->setResponse(new ErrorResponse($exception->getMessage(), 500));
        }

        if ($this->environment->isProduction()) {
            $event->setResponse(new ErrorResponse('Unexpected error', 500));
        }
    }
}
