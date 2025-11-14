<?php

namespace App\Http\Controllers\API;

use App\Models\Resource\PilihanJawaban;
use App\Models\Resource\Soal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PilihanJawabanController extends Controller
{
    // GET /api/pilihan-jawaban/{id_soal}
    public function index($id_soal)
    {
        $data = PilihanJawaban::where('id_soal', $id_soal)->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // POST /api/pilihan-jawaban
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_soal'   => 'required|exists:soal,id_soal',
            'jawaban'   => 'required|string',
            'is_correct' => 'boolean',
            'gambar'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('pilihan_gambar', 'public');
        }

        // Jika pilihan ini benar → kosongkan pilihan lain
        if ($request->is_correct) {
            PilihanJawaban::where('id_soal', $request->id_soal)
                ->update(['is_correct' => false]);
        }

        $pilihan = PilihanJawaban::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pilihan jawaban berhasil ditambahkan',
            'data' => $pilihan
        ], 201);
    }

    // GET /api/pilihan-jawaban/detail/{id}
    public function show($id)
    {
        $pilihan = PilihanJawaban::find($id);

        if (!$pilihan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pilihan
        ]);
    }

    // PUT /api/pilihan-jawaban/{id}
    public function update(Request $request, $id)
    {
        $pilihan = PilihanJawaban::find($id);

        if (!$pilihan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'jawaban'   => 'string',
            'is_correct' => 'boolean',
            'gambar'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Update gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('pilihan_gambar', 'public');
        }

        // Jika set sebagai benar → kosongkan lainnya
        if ($request->is_correct) {
            PilihanJawaban::where('id_soal', $pilihan->id_soal)
                ->update(['is_correct' => false]);
        }

        $pilihan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pilihan jawaban diperbarui',
            'data' => $pilihan
        ]);
    }

    // DELETE /api/pilihan-jawaban/{id}
    public function destroy($id)
    {
        $pilihan = PilihanJawaban::find($id);

        if (!$pilihan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $pilihan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pilihan jawaban dihapus'
        ]);
    }
}
