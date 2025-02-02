<?php

namespace App\Exceptions;

use Exception;

class CannotUpdateDepartmentsDublicateNameException extends Exception
{
    public function __construct(string $message = "Такое название уже существует", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
