<?php

namespace App\Http\Controllers\API;

use App\Models\Resource\Mapel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MapelController extends Controller
{
    // route nya /api/mapel | method nya GET
    public function index()
    {
        try {
            $data = Mapel::latest()->get();
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => false,
                'message' => 'Gagal mengambil data',
                'error' => $e->getMessage()
            ]);
        }
    }

    // routenya /api/mapel | methodnya POST
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        try {
            $data = Mapel::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Mapel berhasil dibuat',
                'data' => $data
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pembuatan Mapel Gagal dibuat',
                'data' => false,
                'error' => $e->getMessage()
            ], 201);
        }
    }

    // routenya /api/mapel/{id} | methodnya GET
    public function show($id)
    {
        $data = Mapel::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Mapel tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // routenya /api/mapel/{id} | methodnya UPDATE
    public function update(Request $request, $id)
    {
        $data = Mapel::find($id);

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Mapel Tersebut tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama' => 'string|required|max:255',
        ]);

        try {
            $data->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Mapel berhasil diupdate',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Mapel gagal di update',
                'data' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    // ini route nya /api/mapel/{id} | method DELETE
    public function destroy($id)
    {
        $data = Mapel::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Mapel Tersebut tidak ditemukan'
            ], 404);
        }

        try {
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Mapel berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Mapel gagal dihapus',
                'error' => $e->getMessage()
            ]);
        }
    }
}
