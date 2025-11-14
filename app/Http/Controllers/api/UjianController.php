<?php

namespace App\Http\Controllers\API;

use App\Models\Resource\Ujian;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;

class UjianController extends Controller
{
    // GET /api/ujian
    public function index()
    {
        $data = Ujian::with(['mapel', 'admin'])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // POST /api/ujian
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mapel' => 'required|exists:mapel,id_mapel',
            'id_admin' => 'required|exists:admin,id_admin',
            'nama_ujian' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'durasi_menit' => 'required|integer|min:1',
            'acak_soal' => 'boolean',
            'status' => 'in:aktif,nonaktif'
        ]);

        $data = Ujian::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ujian berhasil dibuat',
            'data' => $data
        ], 201);
    }

    // GET /api/ujian/{id}
    public function show($id)
    {
        $data = Ujian::with(['mapel', 'admin', 'soal'])->find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Ujian tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    //  /api/ujian/{id}
    public function update(Request $request, $id)
    {
        $data = Ujian::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Ujian Tersebut tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'id_mapel' => 'exists:mapel,id_mapel',
            'id_admin' => 'exists:admin,id_admin',
            'nama_ujian' => 'string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_mulai' => 'date',
            'waktu_selesai' => 'date|after:waktu_mulai',
            'durasi_menit' => 'integer|min:1',
            'acak_soal' => 'boolean',
            'status' => 'in:aktif,nonaktif'
        ]);

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ujian berhasil diupdate',
            'data' => $data
        ]);
    }

    // ini route nya /api/ujian/{id} | method DELETE
    public function destroy($id)
    {
        $data = Ujian::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Ujian Tersebut tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ujian berhasil dihapus'
        ]);
    }
}
