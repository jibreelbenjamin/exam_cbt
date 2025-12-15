<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $guard = active_guard();
        $user = auth_user();

        if (!$guard || !$user) {
            return redirect()->route('login.form')->withErrors([
                'message' => 'Login terlebih dahulu.'
            ]);
        }

        if (session('token')) {
            $token = session('token');
            $personalToken = PersonalAccessToken::findToken($token);

            if (!$personalToken || ($personalToken->expires_at && $personalToken->expires_at->isPast())) {

                Auth::guard($guard)->logout();
                session()->forget('token');

                return redirect()->route('login.form')->withErrors([
                    'message' => 'Sesi kadaluarsa. Silakan login ulang.'
                ]);
            }
        }

        $role = session('role');

        if (!in_array($role, $roles)) {
            return redirect()->route('dashboard.redirect')->withErrors([
                'message' => 'Tidak memiliki izin.'
            ]);
        }

        return $next($request);
    }
}
