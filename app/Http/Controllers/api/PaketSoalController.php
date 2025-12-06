<?php

namespace App\Http\Controllers\api;

use App\Models\Resource\PaketSoal;
use Illuminate\Http\Request;

class PaketSoalController
{
    protected array $rules = [
        'nama'      => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected array $messages = [
        'nama.required' => 'Nama paket soal harus diisi.',
        'nama.string'   => 'Nama paket soal harus berupa teks.',
        'nama.max'      => 'Nama paket soal tidak boleh lebih dari 255 karakter.',
    ];

    public function index()
    {
        try {
            $data = PaketSoal::with(['soal', 'guru', 'aksesPaketSoal'])->get();

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

            $data = PaketSoal::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Paket soal berhasil dibuat.',
                'data'    => $data,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat paket soal.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $data = PaketSoal::with(['soal', 'guru', 'aksesPaketSoal'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Paket soal tidak ditemukan.',
                'error'   => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate($this->rules, $this->messages);

            $data = PaketSoal::findOrFail($id);
            $data->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Paket soal berhasil diupdate.',
                'data'    => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate paket soal.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = PaketSoal::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Paket soal berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus paket soal.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
