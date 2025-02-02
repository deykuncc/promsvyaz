<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Вход'];
        return view('auth.login', $data);
    }
}
