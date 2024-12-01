<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        if ($request->is('backend/login') && auth()->check()) {
            // Jika user sudah login dan mengakses /backend/login, arahkan ke /backend/beranda
            return route('backend.beranda');
        }

        if ($request->is('backend/*') && !auth()->check()) {
            // Jika user belum login dan mengakses /backend/beranda, arahkan ke /backend/login
            return route('backend.login');
        }

        // Default redirect
        return route('backend.login');
    }
}
