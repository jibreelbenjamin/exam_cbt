<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AksesPaketSoalController
{
    protected $base_url;
    protected $headers;
    protected $endpoint = 'akses-paket-soal';

    protected $rules = [
        'id_paket_soal' => 'required|integer',
        'id_guru' => 'required|integer',
    ];
    protected $messages = [
        'id_paket_soal.required' => 'Paket soal wajib dipilih.',
        'id_guru.required' => 'Guru wajib dipilih.',
    ];

    public function __construct(){
        $this->base_url = env('API_BASE_URL');
        $this->headers = [
            'Authorization' => 'Bearer ' . session('token'),
        ];
    }

    public function add(Request $request){
        $validate = $request->validate($this->rules, $this->messages);
        try {
            $response = (new Client())->post("{$this->base_url}/{$this->endpoint}", [
                'headers' => $this->headers,
                'form_params' => $validate
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data['status']) {
                return back()->withErrors(['message' => $data['message']]);
            }
        
            return redirect()->back()->with(['successToast' => $data['message']]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $body = json_decode($response->getBody(), true);

            if (isset($body['errors'])) {
                return back()->withErrors($body['errors'])->withInput();
            }

            return back()->withErrors([
                'message' => $body['message'] ?? 'Kesalahan koneksi, coba lagi...'
            ])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Terjadi kesalahan: '.$e->getMessage()]); 
        }
    }

    public function delete($id){
        try {
            $response = (new Client())->delete("{$this->base_url}/{$this->endpoint}/{$id}", [
                'headers' => $this->headers,
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data['status']) {
                return back()->withErrors(['message' => $data['message']]);
            }

            return redirect()->back()->with(['successToast' => $data['message']]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $body = json_decode($response->getBody(), true);

            if (isset($body['errors'])) {
                return back()->withErrors($body['errors'])->withInput();
            }

            return back()->withErrors([
                'message' => $body['message'] ?? 'Kesalahan koneksi, coba lagi...'
            ])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
