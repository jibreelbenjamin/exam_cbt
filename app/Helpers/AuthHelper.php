<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('active_guard')) {
    function active_guard()
    {
        foreach (['admin', 'guru', 'peserta'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }
        return null;
    }
}

if (!function_exists('auth_user')) {
    function auth_user()
    {
        $guard = active_guard();
        return $guard ? Auth::guard($guard)->user() : null;
    }
}
