<?php

namespace App\Response;

use App\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Throwable;

class JsonErrorResponse extends JsonResponse
{
    public function __construct(Throwable $exception)
    {
        $type = get_class($exception);

        if ($type === HandlerFailedException::class) {
            $exception = $exception->getNestedExceptions()[0];
            $type = get_class($exception);
        }

        $data = [];

        switch ($type) {
            case ValidationFailedException::class:
                $data['error'] = 'Validation failed';
                foreach ($exception->getViolations() as $violation) {
                    $data['validation_errors'][$violation->getPropertyPath()] = $violation->getMessage();
                }
                $status = Response::HTTP_BAD_REQUEST;
                break;

            case NotFoundException::class:
                $data['error'] = 'Resource not found';
                if ($exception->getMessage()) {
                    $data['error'] = $exception->getMessage();
                }
                $status = Response::HTTP_NOT_FOUND;
                break;

            default:
                $data['error'] = 'Application Error';
                if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] === 'dev') {
                    $data['error'] = $exception->getMessage();
                }
                $status = Response::HTTP_BAD_REQUEST;
        }

        parent::__construct($data, $status);
    }
}