<?php
declare(strict_types=1);

namespace App\Presenter\ErrorListener;

use App\Framework\Environment;
use App\Framework\Response\ErrorResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

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

//        if ($this->environment->isDevelopment()) {
//            $event->setResponse(new ErrorResponse($exception->getMessage(), 500));
//        }
//
//        if ($this->environment->isTesting()) {
//            $event->setResponse(new ErrorResponse($exception->getMessage(), 500));
//        }

        if ($this->environment->isProduction()) {
            $event->setResponse(new ErrorResponse('Unexpected error', 500));
        }
    }
}
