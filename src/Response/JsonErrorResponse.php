<?php

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Throwable;

class JsonErrorResponse extends JsonResponse
{
    public function __construct(Throwable $exception)
    {
        $type = get_class($exception);

        $data = [];

        switch ($type) {
            case ValidationFailedException::class:
                $data['error'] = 'Validation failed';
                foreach ($exception->getViolations() as $violation) {
                    $data['validation_errors'][$violation->getPropertyPath()] = $violation->getMessage();
                }
                $status = Response::HTTP_BAD_REQUEST;
                break;

            default:
                $data['error'] = 'Application Error';
                $status = Response::HTTP_BAD_REQUEST;
        }

        parent::__construct($data, $status);
    }
}