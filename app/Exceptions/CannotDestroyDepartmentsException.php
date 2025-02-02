<?php

namespace App\Exceptions;

use Exception;

class CannotDestroyDepartmentsException extends Exception
{
    public function __construct(string $message = "Не удалось удалить участок", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
