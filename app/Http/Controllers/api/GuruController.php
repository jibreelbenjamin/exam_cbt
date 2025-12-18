<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Users\Guru;

class GuruController
{
    protected $model = Guru::class;
    protected $table_primary = 'id_guru';
    protected $data_title = 'guru';
    protected $searchKeys = ['username', 'nama'];
    
    // khusus controller api dan front-end rule message dibedakan setiap funciton
    protected $rules = [
        'username' => 'required|string|max:50|unique:exam_guru,username',
        'nama' => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ];
    protected $messages = [
        'username.required' => 'Username wajib diisi.',
        'username.unique' => 'Username sudah terdaftar.',
        'nama.required' => 'Nama wajib diisi.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
    ];

    public function index()
    {
        try {
            $data = $this->model::withCount('aksesPaketSoal')->get();

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
        $data = $this->model::with('aksesPaketSoal.paketSoal')->find($id);

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

            $rules = [
                'username' => "required|string|max:50|unique:exam_guru,username,{$id},{$this->table_primary}",
                'nama' => 'required|string|max:255',
            ];

            $messages = [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah terdaftar.',
                'nama.required' => 'Nama wajib diisi.',
            ];

            $validate = $request->validate($rules, $messages);

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

    public function updatePassword(Request $request, $id)
    {
        try {
            $data = $this->model::where($this->table_primary, $id)->firstOrFail();

            $rules = [
                'password' => 'required|string|min:8|confirmed',
            ];
            $messages = [
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
            ];

            $validate = $request->validate($rules, $messages);

            if (Hash::check($validate['password'], $data->password)) {
                throw ValidationException::withMessages([
                    'password' => ['Password baru tidak boleh sama dengan password lama.']
                ]);
            }

            $data->update([
                'password' => bcrypt($validate['password']),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Password berhasil diperbarui'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data '.$this->data_title.' tidak tersedia'
            ], 404);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Password tidak valid',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function resetPassword(Request $request, $id)
    {
        try {
            $data = $this->model::where($this->table_primary, $id)->firstOrFail();

            $rules = [
                'old_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ];
            $messages = [
                'old_password.required' => 'Password lama wajib diisi.',
                'new_password.required' => 'Password baru wajib diisi.',
                'new_password.min' => 'Password baru minimal 8 karakter.',
                'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
            ];

            $validate = $request->validate($rules, $messages);

            if (!Hash::check($validate['old_password'], $data->password)) {
                throw ValidationException::withMessages([
                    'old_password' => ['Password lama tidak sesuai.']
                ]);
            }

            if (Hash::check($validate['new_password'], $data->password)) {
                throw ValidationException::withMessages([
                    'new_password' => ['Password baru tidak boleh sama dengan password lama.']
                ]);
            }

            $data->update([
                'password' => bcrypt($validate['new_password']),
            ]);

            return response()->json([
                'stataus' => true,
                'message' => 'Password berhasil direset'
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
