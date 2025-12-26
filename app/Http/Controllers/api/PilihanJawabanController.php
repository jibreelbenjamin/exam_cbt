<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Resource\Soal;
use App\Models\Resource\PaketSoal;
use App\Models\Resource\PilihanJawaban;

class PilihanJawabanController
{    
    protected $model = PilihanJawaban::class;
    protected $table_primary = 'id_pilihan_jawaban';
    protected $data_title = 'pilihan jawaban';

    protected $rules = [
        'id_soal'   => 'required|exists:exam_soal,id_soal',
        'teks_jawaban'   => 'required|string',
        'benar' => 'required|boolean',
    ];
    protected $messages = [
        'id_soal.required' => 'Soal wajib diisi',
        'id_soal.exists' => 'Soal tidak ditemukan',
        'teks_jawaban.required' => 'Jawaban wajib diisi',
        'teks_jawaban.string' => 'Jawaban harus berupa string',
        'benar.required' => 'Pilihan benar wajib diisi',
        'benar.boolean' => 'Pilihan benar harus berupa boolean',
    ];

    public function index()
    {
        try {
            $data = $this->model::with('soal')->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => ucfirst($this->data_title).' kosong',
                    'data' => [],
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => ucfirst($this->data_title).' ditemukan',
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

    public function checkPilihanJawaban(Request $request, $id){
        $user = $request->user();

        $ids = $this->model
            ::where('id_pilihan_jawaban', $id)
            ->latest()
            ->value('id_soal');

        $idps = Soal::where('id_soal', $ids)
            ->latest()
            ->value('id_paket_soal');

        $check = PaketSoal::where('id_paket_soal', $idps)
                ->whereHas('guru', function ($q) use ($user) {
                    $q->where('exam_guru.id_guru', $user->id_guru);
                })
                ->with([
                    'soal',
                    'soal.pilihan',
                ])
                ->first();

        if (!$check) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak memiliki akses soal',
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Memiliki akses soal',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate($this->rules, $this->messages);

            $data = $this->model::create($validate);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => ucfirst($this->data_title).' gagal dibuat'
                ], 500);
            }

            return response()->json([
                'status' => true,
                'message' => ucfirst($this->data_title).' berhasil dibuat',
                'data' => $data
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Informasi '.ucfirst($this->data_title).' tidak lengkap',
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
        $data = $this->model::with(['soal'])->latest()->find($id);

        if($data){
            return response()->json([
                'status' => true,
                'message' => ucfirst($this->data_title).' ditemukan',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => ucfirst($this->data_title).' tidak tersedia'
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
                'message' => ucfirst($this->data_title).' berhasil diperbarui',
                'data' => $data
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => ucfirst($this->data_title).' tidak tersedia'
            ], 404);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Informasi '.ucfirst($this->data_title).' tidak lengkap',
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
                'message' => ucfirst($this->data_title).' tidak tersedia'
            ], 404);
        }
        
        try {
            $post = $data->delete();
            return response()->json([
                'status' => true,
                'message' => ucfirst($this->data_title).' berhasil dihapus',
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