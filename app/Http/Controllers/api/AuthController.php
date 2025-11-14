<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Users\Admin;
use App\Models\Users\Guru;
use App\Models\Users\Siswa;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Validation\ValidationException;

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

        // if (!in_array($request->role, ['admin', 'guru', 'siswa'])) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Role tidak valid'
        //     ], 400);
        // }

        switch ($request->role) {
            case 'admin':
                $user = Admin::where('username', $request->username)->first();
                $userIdField = 'id_admin';
                break;

            case 'guru':
                $user = Guru::where('nip', $request->username)->first();
                $userIdField = 'id_guru';
                break;

            case 'siswa':
                $user = Siswa::where('nis', $request->username)->first();
                $userIdField = 'id_siswa';
                break;

            default: // pindah validasi role
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
            'id_user' => $user->{$userIdField},
            'nama' => $user->nama,
            'username' => $request->username,
            'role' => $request->role,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    }
}
