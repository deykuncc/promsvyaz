<?php

namespace App\Exceptions;

use Exception;

class CannotDestroyItemException extends Exception
{
    public function __construct(string $message = "Не удалось удалить СИЗ", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
