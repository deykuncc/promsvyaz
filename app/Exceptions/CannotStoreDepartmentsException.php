<?php

namespace App\Exceptions;

use Exception;

class CannotStoreDepartmentsException extends Exception
{
    public function __construct(string $message = "Не удалось добавить участок", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
