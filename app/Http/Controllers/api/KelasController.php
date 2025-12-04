<?php

namespace App\Http\Controllers\api;

use App\Models\Resource\Kelas;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KelasController
{
    protected array $rules = [
        'nama' => 'required|string|max:255',
    ];

    protected array $messages = [
        'nama.required' => 'Nama kelas harus diisi.',
        'nama.string'   => 'Nama kelas harus berupa teks.',
        'nama.max'      => 'Nama kelas tidak boleh lebih dari 255 karakter.',
    ];

    public function index()
    {
        try {
            $data = Kelas::with('peserta')->get();

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate($this->rules, $this->messages);

            $data = Kelas::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Kelas berhasil ditambahkan.',
                'data'    => $data,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $data = Kelas::with('peserta')->find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kelas tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate($this->rules, $this->messages);

            $data = Kelas::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kelas tidak ditemukan.',
                ], 404);
            }

            $data->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Kelas berhasil diperbarui.',
                'data'    => $data,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Kelas::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kelas tidak ditemukan.',
                ], 404);
            }

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kelas berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
