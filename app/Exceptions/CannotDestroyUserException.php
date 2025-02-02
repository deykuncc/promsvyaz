<?php

namespace App\Exceptions;

use Exception;

class CannotDestroyUserException extends Exception
{
    public function __construct(string $message = "Не удалось удалить сотрудника", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
