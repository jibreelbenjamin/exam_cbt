<?php

namespace App\Http\Controllers\api;

use App\Models\Resource\AksesPaketSoal;
use Illuminate\Support\Facades\Request;

class AksesPaketSoalController
{
    protected $rules = [
        'id_paket_soal' => 'required|exists:exam_paket_soal,id_paket_soal',
        'id_guru'       => 'required|exists:exam_guru,id_guru',
    ];

    protected $messages = [
        'id_paket_soal.required' => 'id_paket_soal harus diisi.',
        'id_paket_soal.exists'   => 'Paket soal tidak ditemukan.',
        'id_guru.required'       => 'id_guru harus diisi.',
        'id_guru.exists'         => 'Guru tidak ditemukan.',
    ];

    public function index()
    {
        try {
            $data = AksesPaketSoal::with(['paketSoal', 'guru'])->get();

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $data = AksesPaketSoal::with(['paketSoal', 'guru'])->find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses Paket Soal tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate($this->rules, $this->messages);

            // Cek duplikasi
            $exists = AksesPaketSoal::where('id_paket_soal', $validated['id_paket_soal'])
                ->where('id_guru', $validated['id_guru'])
                ->first();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ini sudah ada.'
                ], 409);
            }

            $akses = AksesPaketSoal::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Akses berhasil ditambahkan.',
                'data' => $akses
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $akses = AksesPaketSoal::find($id);

            if (!$akses) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }

            $validated = $request->validate($this->rules, $this->messages);

            // Cek duplikasi kombinasi kecuali data sendiri
            $exists = AksesPaketSoal::where('id_paket_soal', $validated['id_paket_soal'])
                ->where('id_guru', $validated['id_guru'])
                ->where('id_akses_paket_soal', '!=', $id)
                ->first();

            if ($exists) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'Akses dengan kombinasi tersebut sudah ada.'
                ], 409);
            }

            $akses->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Akses berhasil diperbarui.',
                'data' => $akses
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $akses = AksesPaketSoal::find($id);

            if (!$akses) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }

            $akses->delete();

            return response()->json([
                'success' => true,
                'message' => 'Akses berhasil dihapus.'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }
}
