<?php

namespace App\Http\Controllers\API;

use App\Models\Resource\Soal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SoalController extends Controller
{
    // GET /api/soal
    public function index()
    {
        $data = Soal::with(['mapel', 'guru', 'pilihanJawaban'])->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // POST /api/soal
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mapel' => 'required|exists:mapel,id_mapel',
            'id_guru' => 'required|exists:guru,id_guru',
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
            'jenis' => 'required|in:pilihan_ganda,essay',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        // HANDLE GAMBAR
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar_soal', 'public');
        }

        $data = Soal::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Soal berhasil dibuat',
            'data' => $data
        ], 201);
    }

    // GET /api/soal/{id}
    public function show($id)
    {
        $data = Soal::with(['mapel', 'guru', 'pilihan'])->find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Soal tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // PUT /api/soal/{id}
    public function update(Request $request, $id)
    {
        $data = Soal::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Soal tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'id_mapel' => 'exists:mapel,id_mapel',
            'id_guru' => 'exists:guru,id_guru',
            'pertanyaan' => 'string',
            'jawaban' => 'string',
            'jenis' => 'in:pilihan_ganda,essay',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Update gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar_soal', 'public');
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Soal berhasil diupdate',
            'data' => $data
        ]);
    }

    // DELETE /api/soal/{id}
    public function destroy($id)
    {
        $data = Soal::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Soal tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Soal berhasil dihapus'
        ]);
    }
}
