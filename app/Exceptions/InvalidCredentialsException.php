<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function __construct(string $message = "Неправильный логин или пароль", int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
