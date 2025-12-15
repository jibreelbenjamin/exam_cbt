<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Users\Peserta;

class PesertaController
{
    protected $model = Peserta::class;
    protected $table_primary = 'id_peserta';
    protected $data_title = 'peserta';

    protected $rules = [
        'username' => 'required|string|max:50|unique:exam_peserta,username',
        'nama' => 'required|string|max:255',
        'id_kelas' => 'required|integer|exists:exam_kelas,id_kelas',
        'id_ruangan' => 'nullable|integer|exists:exam_ruangan,id_ruangan',
        'password' => 'required|string|min:4',
    ];
    protected $messages = [
        'username.required' => 'Username wajib diisi.',
        'username.unique' => 'Username sudah terdaftar.',
        'nama.required' => 'Nama peserta wajib diisi.',
        'id_kelas.required' => 'Kelas wajib dipilih.',
        'id_kelas.exists' => 'Kelas tidak ditemukan.',
        'id_ruangan.exists' => 'Ruangan tidak ditemukan.',
        'password.required' => 'Password wajib diisi.',
    ];


    public function index()
    {
        try {
            $data = $this->model::with(['kelas', 'ruangan'])->get();

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

            $validate['unhashed_password'] = $validate['password'];
            $validate['password'] = bcrypt($validate['password']);

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
        $data = $this->model::with(['kelas', 'ruangan'])->get()->find($id);

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
            
            $rules = $this->rules;
            $rules['username'] = "required|string|max:50|unique:exam_peserta,username,{$id},{$this->table_primary}";
            
            $validate = $request->validate($rules, $this->messages);

            $validate['unhashed_password'] = $validate['password'];
            $validate['password'] = bcrypt($validate['password']);

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
