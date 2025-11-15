<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Resource\Soal;

class SoalController
{    
    protected $model = Soal::class;
    protected $table_primary = 'id_soal';
    protected $data_title = 'soal';

    protected $rules = [
        'id_paket_soal' => 'required|exists:paket_soal,id_paket_soal',
        'id_guru' => 'required|exists:guru,id_guru',
        'pertanyaan' => 'required|string',
        'jawaban' => 'required|string',
        'jenis' => 'required|in:pilihan_ganda,essay',
        'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
    ];
    protected $messages = [
        'id_paket_soal.required' => 'Paket soal wajib diisi',
        'id_paket_soal.exists' => 'Paket soal tidak ditemukan',
        'id_guru.required' => 'Guru wajib diisi',
        'id_guru.exists' => 'Guru tidak ditemukan',
        'pertanyaan.required' => 'Pertanyaan wajib diisi',
        'jawaban.required' => 'Jawaban wajib diisi',
        'jenis.required' => 'Jenis soal wajib diisi',
        'jenis.in' => 'Jenis soal harus berupa pilihan_ganda atau essay',
        'gambar.file' => 'Gambar harus berupa file',
        'gambar.mimes' => 'Gambar harus berformat jpg, jpeg, atau png',
        'gambar.max' => 'Ukuran gambar maksimal 2048 KB',
    ];

    public function index()
    {
        try {
            $data = $this->model::with(['paketSoal', 'guru', 'pilihanJawaban'])->get();

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

            // Handle gambar
            if ($request->hasFile('gambar')) {
                $validate['gambar'] = $request->file('gambar')->store('gambar_soal', 'public');
            }

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
        $data = $this->model::with(['paketSoal', 'guru', 'pilihanJawaban'])->latest()->find($id);

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

            // Handle gambar
            if ($request->hasFile('gambar')) {
                $validate['gambar'] = $request->file('gambar')->store('gambar_soal', 'public');
            }

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
