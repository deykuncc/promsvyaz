<?php

namespace App\Exceptions;

use Exception;

class CannotUpdateDepartmentsException extends Exception
{
    public function __construct(string $message = "Не удалось обновить участок", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
