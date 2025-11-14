<?php

namespace App\Http\Controllers\API;

use App\Models\API\MapelModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MapelController extends Controller
{
    // route nya /api/mapel | method nya GET
    public function index()
    {
        try {
            $mapel = MapelModel::latest()->get();
            return response()->json([
                'success' => true,
                'data' => $mapel
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => false,
                'message' => $e->getMessage()
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
            $mapel = MapelModel::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Mapel berhasil dibuat',
                'data' => $mapel
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
        $mapel = MapelModel::find($id);

        if (!$mapel) {
            return response()->json([
                'success' => false,
                'message' => 'Mapel tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mapel
        ]);
    }

    // routenya /api/mapel/{id} | methodnya UPDATE
    public function update(Request $request, $id)
    {
        $mapel = MapelModel::find($id);

        if (empty($mapel)) {
            return response()->json([
                'success' => false,
                'message' => 'Mapel Tersebut tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama' => 'string|required|max:255',
        ]);

        try {
            $mapel->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Mapel berhasil diupdate',
                'data' => $mapel
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
        $mapel = MapelModel::find($id);

        if (!$mapel) {
            return response()->json([
                'success' => false,
                'message' => 'Mapel Tersebut tidak ditemukan'
            ], 404);
        }

        try {
            $mapel->delete();
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
