<?php

namespace App\Exceptions;

use Exception;

class CannotUpdateEmployeeException extends Exception
{
    public function __construct(string $message = "Не удалось обновить сотрудника", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
