<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Resource\AksesPaketSoal;

class AksesPaketSoalController
{
    protected $model = AksesPaketSoal::class;
    protected $table_primary = 'id_akses_paket_soal';
    protected $data_title = 'akses paket soal';

    public function __construct()
    {
        $this->rules = [
            'id_paket_soal' => [
                'required',
                'exists:exam_paket_soal,id_paket_soal',
                Rule::unique('exam_akses_paket_soal')
                    ->where(fn ($query) => $query->where('id_guru', request('id_guru')))
            ],
            'id_guru' => [
                'required',
                'exists:exam_guru,id_guru',
            ],
        ];

        $this->messages = [
            'id_paket_soal.required' => 'id_paket_soal harus diisi',
            'id_paket_soal.exists' => 'Paket soal tidak ditemukan',
            'id_paket_soal.unique' => 'Akses sudah dimiliki',

            'id_guru.required' => 'id_guru harus diisi',
            'id_guru.exists' => 'Guru tidak ditemukan',
        ];
    }

    public function index()
    {
        try {
            $data = $this->model::with(['paketSoal', 'guru'])->get();

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
                'message' => 'Berhasil menambah akses',
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
        $data = $this->model::with(['paketSoal', 'guru'])->find($id);

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
                'message' => 'Berhasil menghapus akses',
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
