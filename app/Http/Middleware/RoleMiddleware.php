<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Periksa apakah jenis pengguna sesuai dengan peran yang diizinkan
        if (Auth::user()->jenis !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
