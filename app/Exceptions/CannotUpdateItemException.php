<?php

namespace App\Exceptions;

use Exception;

class CannotUpdateItemException extends Exception
{
    public function __construct(string $message = "Не удалось обновить СИЗ", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
