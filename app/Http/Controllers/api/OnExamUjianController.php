<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Resource\Ujian;

class OnExamUjianController
{
    protected $model = Ujian::class;
    protected $table_primary = 'id_ujian';
    protected $data_title = 'ujian';

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
            $now = Carbon::now();

            $data = $this->model::with(['paketUjian'])
                ->where('jadwal_mulai', '<=', $now->copy()->addMinutes(30))
                ->where('jadwal_selesai', '>=', $now->copy()->subDays(1.5))
                ->orderBy('jadwal_mulai', 'desc')
                ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data '.$this->data_title.' kosong',
                    'data' => [],
                ], 404);
            }

            $data->transform(function ($item) use ($now) {
                $mulai   = Carbon::parse($item->jadwal_mulai);
                $selesai = Carbon::parse($item->jadwal_selesai);

                if ($now->between($mulai, $selesai)) {
                    $item->status = 'berjalan';
                }
                elseif ($now->lt($mulai)) {
                    $item->status = 'persiapan';
                }
                else {
                    $item->status = 'selesai';
                }

                return $item;
            });


            return response()->json([
                'status' => true,
                'message' => 'Data '.$this->data_title.' ditemukan',
                'total' => $data->count(),
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

    public function show($id_peserta, $id_ujian)
    {
        $data = $this->model::with(['paketUjian', 'paketSoal.soal'])->find($id_ujian);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data '.$this->data_title.' tidak tersedia'
            ], 404);
        }

        $now = Carbon::now();
        $mulai = Carbon::parse($data->jadwal_mulai);
        $selesai = Carbon::parse($data->jadwal_selesai);

        if ($now->lt($mulai)) {
            return response()->json([
                'status' => false,
                'message' => 'Ujian belum dimulai'
            ], 403);
        }

        if ($now->gt($selesai)) {
            return response()->json([
                'status' => false,
                'message' => 'Ujian telah berakhir'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data '.$this->data_title.' ditemukan',
            'data' => $data
        ]);
    }
}
