<?php

namespace App\Exceptions;

use Exception;

class CannotStoreItemException extends Exception
{
    public function __construct(string $message = "Не удалось создать СИЗ", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
