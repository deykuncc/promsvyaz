<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserWebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web')->check()) {
            if ($request->route()->getName() === 'login') {
                return redirect()->route('home');
            }

            return $next($request);
        }

        if ($request->route()->getName() === 'login') {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
