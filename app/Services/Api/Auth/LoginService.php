<?php

namespace App\Services\Api\Auth;

use App\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    /**
     * @param array $data
     * @return bool
     * @throws InvalidCredentialsException
     */
    public function login(array $data): bool
    {
        if (Auth::attempt($data, true)) {
            return true;
        }

        throw new InvalidCredentialsException();
    }

}
