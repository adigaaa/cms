<?php
namespace Api\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Exception;

class UnprocessableEntityHttpException extends ResourceException
{
 public function __construct($message = null, $errors = null, $statusCode = 422 , Exception $previous = null, $headers = [], $code = 0)
    {
        parent::__construct($message, $errors, $statusCode, $previous, $headers, $code);
    }
}
