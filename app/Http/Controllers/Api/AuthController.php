<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Api\Auth\LoginService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private LoginService $loginService)
    {

    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if ($this->loginService->login($data)) {
            $request->session()->regenerate();

            return response()->json(['message' => "Вы успешно вошли в аккаунт"], 200);
        }

        return response()->json(['message' => 'Не удалось войти в аккаунт'], 500);
    }
}
