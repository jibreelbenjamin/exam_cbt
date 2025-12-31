<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Resource\Ujian;

class UjianController
{
    protected $model = Ujian::class;
    protected $table_primary = 'id_ujian';
    protected $data_title = 'ujian';
    protected $searchKeys = ['token'];

    protected array $rules = [
        'id_paket_ujian' => 'nullable|integer|exists:exam_paket_ujian,id_paket_ujian',
        'id_paket_soal' => 'required|integer|exists:exam_paket_soal,id_paket_soal',
        'nama' => 'required|string|max:255',
        'token' => 'required|boolean',
        'durasi' => 'required|integer|min:0',
        'acak_soal' => 'required|boolean',
        'jadwal_mulai' => 'required|date',
        'jadwal_selesai' => 'required|date|after_or_equal:jadwal_mulai',
    ];
    protected array $messages = [
        'id_paket_ujian.integer' => 'ID paket ujian harus berupa angka.',
        'id_paket_ujian.exists' => 'Paket ujian tidak ditemukan.',

        'id_paket_soal.required' => 'ID paket soal harus diisi.',
        'id_paket_soal.integer' => 'ID paket soal harus berupa angka.',
        'id_paket_soal.exists' => 'Paket soal tidak ditemukan.',

        'nama.required' => 'Nama ujian harus diisi.',
        'nama.max' => 'Nama ujian tidak boleh lebih dari 255 karakter.',

        'token.required' => 'Pengaturan token harus diisi.',
        'token.boolean' => 'Pengaturan token harus berupa true/false.',

        'durasi.required' => 'Durasi ujian harus diisi.',
        'durasi.integer' => 'Durasi harus berupa angka.',
        'durasi.min' => 'Durasi minimal adalah 0 menit.',

        'acak_soal.required' => 'Pengaturan acak soal harus diisi.',
        'acak_soal.boolean' => 'Pengaturan acak soal harus berupa true/false.',

        'jadwal_mulai.required' => 'Jadwal mulai ujian harus diisi.',
        'jadwal_mulai.date' => 'Format tanggal mulai tidak valid.',
        'jadwal_selesai.required' => 'Jadwal selesai ujian harus diisi.',
        'jadwal_selesai.date' => 'Format tanggal selesai tidak valid.',
        'jadwal_selesai.after_or_equal' => 'Waktu selesai harus setelah atau sama dengan waktu mulai.',
    ];

    public function index()
    {
        try {
            $data = $this->model::with(['paketUjian', 'paketSoal'])->get();

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
            })->get();

            $data->prepend([ // untuk kebutuhan rule pada controller web
                'id_ujian' => 'ALL',
                'nama' => 'SEMUA UJIAN',
            ]);

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
        $data = $this->model::with(['paketUjian', 'paketSoal'])->find($id);

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
