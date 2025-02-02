<?php

namespace App\Exceptions;

use Exception;

class CannotUpdateUserLoginException extends Exception
{
    public function __construct(string $message = "Логин уже существует", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
