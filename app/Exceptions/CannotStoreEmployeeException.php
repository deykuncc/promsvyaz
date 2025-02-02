<?php

namespace App\Exceptions;

use Exception;

class CannotStoreEmployeeException extends Exception
{
    public function __construct(string $message = "Не удалось добавить сотрудника", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
