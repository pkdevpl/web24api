<?php

namespace App\EventListener;

use App\Lib\Response\JsonErrorResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $response = new JsonErrorResponse($exception);

        $event->setResponse($response);
    }
}