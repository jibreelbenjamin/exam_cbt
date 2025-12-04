<?php

namespace App\Http\Controllers\api;


use Illuminate\Support\Facades\Request;
use App\Models\Resource\Ruangan;
use Illuminate\Validation\ValidationException;

class RuanganController
{
    protected array $rules = [
        'nama' => 'required|string|max:255',
    ];

    protected array $messages = [
        'nama.required' => 'Nama ruangan harus diisi.',
        'nama.string'   => 'Nama ruangan harus berupa teks.',
        'nama.max'      => 'Nama ruangan tidak boleh lebih dari 255 karakter.',
    ];

    public function index()
    {
        try {
            $data = Ruangan::with('peserta')->get();

            return response()->json([
                'success' => true,
                'data'    => $data
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

            $data = Ruangan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Ruangan berhasil ditambahkan.',
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
            $data = Ruangan::with('peserta')->find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ruangan tidak ditemukan.',
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

            $data = Ruangan::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ruangan tidak ditemukan.',
                ], 404);
            }

            $data->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Ruangan berhasil diperbarui.',
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
            $data = Ruangan::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ruangan tidak ditemukan.',
                ], 404);
            }

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ruangan berhasil dihapus.',
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
