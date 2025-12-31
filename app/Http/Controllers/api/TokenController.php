<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Resource\Token;

class TokenController
{
    protected $model = Token::class;
    protected $table_primary = 'id_token';
    protected $data_title = 'token';

    protected array $rules = [
        'id_admin' => 'required|integer|exists:exam_admin,id_admin',
        'id_ujian' => 'nullable|exists:exam_ujian,id_ujian',
        'token' => 'required|string|max:255',
        'durasi'=> 'required|integer|min:1',
        'token_expired_at' => 'required|date',
    ];
    protected array $messages = [
        'id_admin.required' => 'ID admin harus diisi.',
        'id_admin.integer' => 'ID admin harus berupa angka.',
        'id_admin.exists' => 'Admin tidak ditemukan.',

        'id_ujian.exists' => 'Ujian tidak ditemukan.',

        'token.required' => 'Token harus diisi.',
        'token.string' => 'Token harus berupa teks.',
        'token.max' => 'Token terlalu panjang.',

        'durasi.required' => 'Durasi harus diisi.',
        'durasi.integer' => 'Durasi harus berupa angka.',
        'durasi.min' => 'Durasi minimal adalah 1 menit.',

        'token_expired_at.required' => 'Tanggal kedaluwarsa harus diisi.',
        'token_expired_at.date' => 'Format tanggal kedaluwarsa tidak valid.',
    ];

    public function index()
    {
        try {
            $data = $this->model::with(['admin', 'ujian', 'ujian.paketUjian', 'ujian.paketSoal'])->get();

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
        $data = $this->model::with(['admin', 'ujian', 'ujian.paketUjian', 'ujian.paketSoal'])->find($id);

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
