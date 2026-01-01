<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

                return redirect()->route('login.form')->with([
                    'warningToast' => 'Sesi kadaluarsa. Silakan login ulang.'
                ]);
            }
        }

        $role = session('role');

        if (!in_array($role, $roles)) {
            if (Auth::guard('peserta')->check()) {
                return redirect()
                    ->route('onexam.home')
                    ->with('warningToast', 'Akses halaman dilindungi');
            }

            if (Auth::guard('admin')->check() || Auth::guard('guru')->check()) {
                return redirect()
                    ->route('operator.home')
                    ->with('warningToast', 'Tidak memiliki akses');
            }

            return redirect()
                ->route('login.form')
                ->with('warningToast', 'Akses halaman dilindungi');
        }

        return $next($request);
    }
}
