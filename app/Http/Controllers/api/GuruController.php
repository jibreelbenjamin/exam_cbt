<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Users\Guru;

class GuruController
{
    protected $model = Guru::class;
    protected $table_primary = 'id_guru';
    protected $data_title = 'guru';
    protected $searchKeys = ['username', 'nama'];

    protected $rules = [
        'nip' => 'required|string|max:50|unique:guru,nip',
        'nama' => 'required|string|max:255',
        'password' => 'required|string|min:4',
        'akses_paket_soal' => 'nullable|array', 
        'akses_paket_soal.*' => 'integer|distinct|exists:paket_soal,id_paket_soal',
    ];
    protected $messages = [
        'nip.required' => 'NIP wajib diisi.',
        'nip.unique' => 'NIP sudah terdaftar.',
        'nama.required' => 'Nama wajib diisi.',
        'akses_paket_soal.array' => 'Akses paket soal harus berupa array.',
        'akses_paket_soal.*.integer' => 'Setiap ID paket soal harus berupa angka.',
        'akses_paket_soal.*.exists' => 'ID paket soal tidak ditemukan.',
        'akses_paket_soal.*.distinct' => 'ID paket soal tidak boleh duplikat.',
    ];

    public function index()
    {
        try {
            $data = $this->model::all();

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
        $data = $this->model::find($id);

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
            $rules['nip'] = "required|string|max:50|unique:guru,nip,{$id},{$this->table_primary}";
            
            $validate = $request->validate($rules, $this->messages);

            $validate['password'] = bcrypt($validate['password']);

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
