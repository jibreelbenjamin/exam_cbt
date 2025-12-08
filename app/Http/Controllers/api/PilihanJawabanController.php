<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        'gambar'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
    ];
    protected $messages = [
        'id_soal.required' => 'Soal wajib diisi',
        'id_soal.exists' => 'Soal tidak ditemukan',
        'teks_jawaban.required' => 'Jawaban wajib diisi',
        'teks_jawaban.string' => 'Jawaban harus berupa string',
        'benar.required' => 'Pilihan benar wajib diisi',
        'benar.boolean' => 'Pilihan benar harus berupa boolean',
        'gambar.file' => 'Gambar harus berupa file',
        'gambar.mimes' => 'Gambar harus berformat jpg, jpeg, atau png',
        'gambar.max' => 'Ukuran gambar maksimal 2048 KB',
    ];

    public function index()
    {
        try {
            $data = $this->model::with('soal')->get();

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
                $validated['gambar'] = $request->file('gambar')->store('pilihan_gambar', 'public');
            }

            // Jika set sebagai benar → kosongkan lainnya
            if ($request->benar) {
                $this->model::where('id_soal', $request->id_soal)
                    ->update(['benar' => false]);
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
        $data = $this->model::with(['soal'])->latest()->find($id);

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

            // Handle gambar
            if ($request->hasFile('gambar')) {
                $validated['gambar'] = $request->file('gambar')->store('pilihan_gambar', 'public');
            }

            // Jika set sebagai benar → kosongkan lainnya
            if ($request->is_correct) {
                $this->model::where('id_soal', $data->id_soal)
                    ->update(['is_correct' => false]);
            }
    
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