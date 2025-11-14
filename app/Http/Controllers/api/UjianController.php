<?php

namespace App\Http\Controllers\API;

use App\Models\API\UjianModel;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;

class UjianController extends Controller
{
    // GET /api/ujian
    public function index()
    {
        $ujian = UjianModel::with(['mapel', 'admin'])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $ujian
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

        $ujian = UjianModel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ujian berhasil dibuat',
            'data' => $ujian
        ], 201);
    }

    // GET /api/ujian/{id}
    public function show($id)
    {
        $ujian = UjianModel::with(['mapel', 'admin', 'soal'])->find($id);

        if (!$ujian) {
            return response()->json([
                'success' => false,
                'message' => 'Ujian tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ujian
        ]);
    }

    //  /api/ujian/{id}
    public function update(Request $request, $id)
    {
        $ujian = UjianModel::find($id);

        if (!$ujian) {
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

        $ujian->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ujian berhasil diupdate',
            'data' => $ujian
        ]);
    }

    // ini route nya /api/ujian/{id} | method DELETE
    public function destroy($id)
    {
        $ujian = UjianModel::find($id);

        if (!$ujian) {
            return response()->json([
                'success' => false,
                'message' => 'Ujian Tersebut tidak ditemukan'
            ], 404);
        }

        $ujian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ujian berhasil dihapus'
        ]);
    }
}
