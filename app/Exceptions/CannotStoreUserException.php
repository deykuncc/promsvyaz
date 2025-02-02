<?php

namespace App\Exceptions;

use Exception;

class CannotStoreUserException extends Exception
{
    public function __construct(string $message = "Не удалось создать сотрудника", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
