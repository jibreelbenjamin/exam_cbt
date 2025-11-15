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

    protected $rules = [
        'id_paket_soal' => 'required|exists:paket_soal,id_paket_soal',
        'id_admin' => 'required|exists:admin,id_admin',
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'waktu_mulai' => 'required|date',
        'waktu_selesai' => 'required|date|after:waktu_mulai',
        'durasi_menit' => 'required|integer|min:1',
        'acak_soal' => 'boolean',
        'status' => 'in:aktif,nonaktif'
    ];
    protected $messages = [
        'id_paket_soal.required' => 'paket_soal wajib diisi',
        'id_paket_soal.exists' => 'paket_soal tidak ditemukan',
        'id_admin.required' => 'Admin wajib diisi',
        'id_admin.exists' => 'Admin tidak ditemukan',
        'nama.required' => 'Nama ujian wajib diisi',
        'nama.max' => 'Nama ujian maksimal 255 karakter',
        'waktu_mulai.required' => 'Waktu mulai wajib diisi',
        'waktu_selesai.required' => 'Waktu selesai wajib diisi',
        'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai',
        'durasi_menit.required' => 'Durasi ujian wajib diisi',
        'durasi_menit.integer' => 'Durasi ujian harus berupa angka',
        'durasi_menit.min' => 'Durasi ujian minimal 1 menit',
        'acak_soal.boolean' => 'Acak soal harus berupa nilai boolean',
        'status.in' => 'Status harus berupa aktif atau nonaktif',
    ];

    public function index()
    {
        try {
            $data = $this->model::with(['paketSoal', 'admin'])->latest()->get();

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
        $data = $this->model::with(['paketSoal', 'admin'])->latest()->find($id);

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
                'success' => true,
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
