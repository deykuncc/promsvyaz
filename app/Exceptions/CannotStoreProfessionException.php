<?php

namespace App\Exceptions;

use Exception;

class CannotStoreProfessionException extends Exception
{
    public function __construct(string $message = "Не удалось создать профессию", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
