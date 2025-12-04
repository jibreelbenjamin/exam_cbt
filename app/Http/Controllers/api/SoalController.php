<?php

namespace App\Http\Controllers\api;

use App\Models\Resource\Soal;
use Illuminate\Http\Request;

class SoalController
{
    protected array $rules = [
        'id_paket_soal' => 'required|integer|exists:exam_paket_soal,id_paket_soal',
        'teks_soal'     => 'required|string',
        'gambar'        => 'nullable|string',
    ];

    protected array $messages = [
        'id_paket_soal.required' => 'ID paket soal harus diisi.',
        'id_paket_soal.integer'  => 'ID paket soal harus berupa angka.',
        'id_paket_soal.exists'   => 'Paket soal tidak ditemukan.',

        'teks_soal.required'     => 'Teks soal harus diisi.',
        'teks_soal.string'       => 'Teks soal harus berupa teks.',
    ];

    /**
     * GET semua soal
     */
    public function index()
    {
        try {
            $data = Soal::with(['paket', 'pilihan'])->get();

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

    /**
     * POST tambah soal baru
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate($this->rules, $this->messages);

            $data = Soal::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Soal berhasil dibuat.',
                'data'    => $data,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat soal.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * GET detail soal
     */
    public function show($id)
    {
        try {
            $data = Soal::with(['paket', 'pilihan'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Soal tidak ditemukan.',
                'error'   => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * PUT update soal
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate($this->rules, $this->messages);

            $data = Soal::findOrFail($id);
            $data->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Soal berhasil diupdate.',
                'data'    => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate soal.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * DELETE hapus soal
     */
    public function destroy($id)
    {
        try {
            $data = Soal::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Soal berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus soal.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
