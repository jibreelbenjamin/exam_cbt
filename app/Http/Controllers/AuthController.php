<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $base_url;

    public function __construct()
    {
        $this->base_url = env('API_BASE_URL');
    }

    public function loginForm()
    {
        if (Auth::guard('peserta')->check()) {
            return redirect()->route('home'); 
        }
        return view('auth.login');
    }

    public function loginFormOperator()
    {
        if (Auth::guard('admin')->check() || Auth::guard('guru')->check()) {
            return redirect()->route('operator.home');
        }
        return view('auth.login_opeator');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [ 
            'username.required' => 'Username wajib diisi.', 
            'password.required' => 'Password wajib diisi.', 
        ]);

        $client = new Client();
        $url = "{$this->base_url}/login";

        $response = $client->post($url, [
            'form_params' => [
                'role'     => 'peserta',
                'username' => $request->username,
                'password' => $request->password,
            ],
            'http_errors' => false
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if (!($data['status'] ?? false)) {
            return back()->withInput()->withErrors(['message' => 'Username atau password salah.']);
        }

        $data_user = $data['data_user'];
        $user = new \App\Models\Users\Peserta;

        foreach ($data_user as $k => $v) {
            $user->$k = $v;
        }

        $user->exists = true;
        Auth::guard('peserta')->login($user);

        session(['role' => 'peserta', 'token' => $data['access_token'] ?? null]);

        return redirect()->route('home')->with('successToast', 'Selamat datang!');
    }

    public function loginOperator(Request $request)
    {
        $request->validate([
            'role'     => 'required|in:admin,guru',
            'username' => 'required',
            'password' => 'required',
        ], [ 
            'role.required' => 'Role wajib diisi.', 
            'role.in' => 'Role invalid.', 
            'username.required' => 'Username wajib diisi.', 
            'password.required' => 'Password wajib diisi.', 
        ]);

        $client = new Client();
        $url = "{$this->base_url}/login";

        $response = $client->post($url, [
            'form_params' => [
                'role'     => $request->role,
                'username' => $request->username,
                'password' => $request->password,
            ],
            'http_errors' => false
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if (!($data['status'] ?? false)) {
            return back()->withInput()->withErrors(['message' => 'Username atau password salah.']);
        }

        $data_user = $data['data_user'];
        
        $model = [
            'admin' => \App\Models\Users\Admin::class,
            'guru'  => \App\Models\Users\Guru::class,
        ][$data_user['role']];

        $user = new $model;

        foreach ($data_user as $k => $v) {
            $user->$k = $v;
        }

        $user->exists = true;
        Auth::guard($data_user['role'])->login($user);

        session(['role' => $data_user['role'], 'token' => $data['access_token'] ?? null]);

        return redirect()->route('operator.home')->with('successToast', 'Selamat datang!');
    }

    public function logout(Request $request)
    {
        $currentGuard =
            Auth::guard('peserta')->check() ? 'peserta' :
            (Auth::guard('admin')->check() ? 'admin' :
            (Auth::guard('guru')->check() ? 'guru' : null));

        if (!$currentGuard) {
            return redirect()->route('login.form');
        }

        $client = new Client();

        try {
            $client->post("{$this->base_url}/logout", [
                'headers' => [
                    'Authorization' => "Bearer " . session('token'),
                ],
                'http_errors' => false,
            ]);
        } catch (\Exception $e) {}

        Auth::guard($currentGuard)->logout();

        session()->forget(['token', 'role']);
        session()->invalidate();
        session()->regenerateToken();

        if ($currentGuard === 'peserta') {
            return redirect()->route('login.form')->with('successToast', 'Anda telah logout.');
        }

        return redirect()->route('operator.login.form')->with('successToast', 'Anda telah logout.');
    }
}
