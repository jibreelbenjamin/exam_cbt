<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\API\JawabanSiswaModel;
use Illuminate\Routing\Controller;

class JawabanSiswaController extends Controller
{
    // GET semua jawaban siswa
    public function index()
    {
        return response()->json(JawabanSiswaModel::all(), 200);
    }

    // GET jawaban siswa berdasarkan id
    public function show($id)
    {
        $data = JawabanSiswaModel::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($data, 200);
    }

    // POST untuk menyimpan jawaban siswa
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ujian' => 'required|integer',
            'id_siswa' => 'required|integer',
            'id_soal'  => 'required|integer',
            'jawaban'  => 'nullable|string',
            'is_correct' => 'nullable|boolean',
            'waktu_selesai' => 'required|date',
            'waktu_jawab' => 'nullable|date',
        ]);

        $data = JawabanSiswaModel::create($validated);

        return response()->json([
            'message' => 'Jawaban siswa berhasil disimpan',
            'data' => $data
        ], 201);
    }

    // PUT untuk update jawaban siswa
    public function update(Request $request, $id)
    {
        $data = JawabanSiswaModel::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data->update($request->all());

        return response()->json([
            'message' => 'Jawaban siswa berhasil diupdate',
            'data' => $data
        ], 200);
    }

    // DELETE data jawaban siswa
    public function destroy($id)
    {
        $data = JawabanSiswaModel::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Data jawaban siswa berhasil dihapus'], 200);
    }
}
