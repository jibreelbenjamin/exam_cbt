<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Resource\PaketSoal;

class PaketSoalController
{
    protected $model = PaketSoal::class;
    protected $table_primary = 'id_paket_soal';
    protected $data_title = 'paket soal';
    protected $searchKeys = ['nama', 'deskripsi'];

    protected array $rules = [
        'nama'=> 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];
    protected array $messages = [
        'nama.required' => 'Nama paket soal harus diisi.',
        'nama.string' => 'Nama paket soal harus berupa teks.',
        'nama.max' => 'Nama paket soal tidak boleh lebih dari 255 karakter.',
    ];

    public function index()
    {
        try {
            $data = PaketSoal::withCount(['soal', 'guru', 'aksesPaketSoal'])->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data '.$this->data_title.' kosong',
                    'data' => [],
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data '.$this->data_title.' ditemukan',
                'total' => count($data),
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function indexByGuru(Request $request)
    {
        $user = $request->user();

        if ($user->tokenCan('admin')) {

            $paketSoal = PaketSoal::latest()->get();

        } elseif ($user->tokenCan('guru')) {

            $paketSoal = PaketSoal::whereHas('guru', function ($q) use ($user) {
                $q->where('exam_guru.id_guru', $user->id_guru);
            })->latest()->get();

        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tidak memiliki akses'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => $paketSoal
        ]);
    }

    public function showByGuru(Request $request, $id)
    {
        $user = $request->user();

        if ($user->tokenCan('admin')) {
            $paketSoal = PaketSoal::with([
                'soal',
                'soal.pilihan',
            ])->find($id);

            if (!$paketSoal) {
                return response()->json([
                    'status' => false,
                    'message' => 'Paket soal tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => $paketSoal
            ]);
        }

        if ($user->tokenCan('guru')) {
            $paketSoal = PaketSoal::where('id_paket_soal', $id)
                ->whereHas('guru', function ($q) use ($user) {
                    $q->where('exam_guru.id_guru', $user->id_guru);
                })
                ->with([
                    'soal',
                    'soal.pilihan',
                ])
                ->first();

            if (!$paketSoal) {
                $exists = PaketSoal::where('id_paket_soal', $id)->exists();

                return response()->json([
                    'status' => false,
                    'message' => $exists
                        ? 'Anda tidak memiliki akses ke paket soal ini'
                        : 'Paket soal tidak ditemukan'
                ], $exists ? 403 : 404);
            }

            return response()->json([
                'status' => true,
                'data' => $paketSoal
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Role tidak valid'
        ], 403);
    }


    public function search(Request $request)
    {
        try {
            $query = $request->query('search');
            $searchKeys = $this->searchKeys;

            $data = $this->model::when($query, function ($q) use ($query, $searchKeys) {
                $q->where(function ($sub) use ($query, $searchKeys) {
                    foreach ($searchKeys as $column) {
                        $sub->orWhere($column, 'like', "%{$query}%");
                    }
                });
            })->withCount('soal')->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => $query
                        ? 'Tidak ada '.$this->data_title.' yang cocok dengan kata kunci "' . $query . '".'
                        : 'Tidak ada data '.$this->data_title.' yang tersedia.',
                    'data' => [],
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => $query
                    ? 'Hasil pencarian '.$this->data_title.' ditemukan.'
                    : 'Data '.$this->data_title.' ditemukan.',
                'total' => $data->count(),
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengambil data '.$this->data_title.'.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate($this->rules, $this->messages);

            $data = $this->model::create($validate);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data '.$this->data_title.' gagal dibuat'
                ], 500);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data '.$this->data_title.' berhasil dibuat',
                'data' => $data
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Informasi '.$this->data_title.' tidak lengkap',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $data = $this->model::with(['soal', 'soal.pilihan', 'guru', 'aksesPaketSoal'])->find($id);

        if($data){
            return response()->json([
                'status' => true,
                'message' => 'Data '.$this->data_title.' ditemukan',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data '.$this->data_title.' tidak tersedia'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->model::where($this->table_primary, $id)->firstOrFail();

            $validate = $request->validate($this->rules, $this->messages);

            $data->update($validate);

            return response()->json([
                'status' => true,
                'message' => 'Data '.$this->data_title.' berhasil diperbarui',
                'data' => $data
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data '.$this->data_title.' tidak tersedia'
            ], 404);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Informasi '.$this->data_title.' tidak lengkap',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $data = $this->model::find($id);

        if(empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data '.$this->data_title.' tidak tersedia'
            ], 404);
        }

        try {
            $post = $data->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data '.$this->data_title.' berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
