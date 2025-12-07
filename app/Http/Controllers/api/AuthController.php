<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Validation\ValidationException;

use App\Models\Users\Admin;
use App\Models\Users\Guru;
use App\Models\Users\Peserta;

class AuthController
{
    public function login(Request $request)
    {
        if (!$request->role || !$request->username || !$request->password) {
            return response()->json([
                'status' => false,
                'message' => 'Informasi tidak lengkap'
            ], 400);
        }

        switch ($request->role) {
            case 'admin':
                $user = Admin::where('username', $request->username)->first();
                $userIdField = 'id_admin';
                break;

            case 'guru':
                $user = Guru::where('username', $request->username)->first();
                $userIdField = 'id_guru';
                break;

            case 'peserta':
                $user = Peserta::where('username', $request->username)->first();
                $userIdField = 'id_peserta';
                break;

            default:
                return response()->json([
                    'status' => false,
                    'message' => 'Role tidak valid'
                ], 400);
        }

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Akun tidak ditemukan'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Akun atau password salah'
            ], 401);
        }

        $tokenResult = $user->createToken('auth_token');
        $token = $tokenResult->plainTextToken;

        $tokenResult->accessToken->expires_at = now()->addDays(7); // 7 hari
        $tokenResult->accessToken->save();

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => '7 hari',
            'data_user' => [
                'id_'.$request->role => $user->{$userIdField},
                'nama' => $user->nama,
                'username' => $request->username,
                'role' => $request->role,
                'akses_paket_soal' => $akses_paket_soal ?? null,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    }
}
