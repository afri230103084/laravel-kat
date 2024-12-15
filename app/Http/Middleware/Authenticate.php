<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        if (Auth::guard('customer')->check()) {
            return route('frontend-daftar_pesananUser');
        }
        if (Auth::guard('user')->check()) {
            return route('dashboard');
        }

        return route('login');
    }
}
