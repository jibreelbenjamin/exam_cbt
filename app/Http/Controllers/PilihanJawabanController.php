<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PilihanJawabanController
{
    protected $base_url;
    protected $headers;
    protected $endpoint = 'pilihan-jawaban';
    protected $searchKeys = ['nama'];
    protected $viewBaseScope = 'dashboard.operator.pilihan-jawaban';
    protected $routeBaseScope = 'operator.soal';

    protected $rules = [
        'id_soal'   => 'required',
        'teks_jawaban'   => 'required|string',
        'benar' => 'required|boolean',
    ];
    protected $messages = [
        'id_soal.required' => 'Soal wajib diisi',
        'teks_jawaban.required' => 'Jawaban wajib diisi',
        'teks_jawaban.string' => 'Jawaban harus berupa string',
        'benar.required' => 'Pilihan benar wajib diisi',
        'benar.boolean' => 'Pilihan benar harus berupa boolean',
    ];

    public function __construct(){
        $this->base_url = env('API_BASE_URL');
        $this->headers = [
            'Authorization' => 'Bearer ' . session('token'),
        ];
    }

    public function create($idps, $ids){
        try {
            $response = (new Client())->get("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]);

            if(Auth::guard('guru')->check()){
                (new Client())->head("{$this->base_url}/soal/{$ids}/check", [
                    'headers' => $this->headers,
                ]); // check akses soal jika role guru
            }

            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return view($this->viewBaseScope.'.form', [
                'total' => count($data),
                'idps' => $idps,
                'ids' => $ids,
                'mode' => 'create',
                'data' => $data,
            ]);

        } catch (ClientException $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Data gagal dimuat, coba lagi...']);
        } catch (\Exception $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    public function updateForm($idps, $ids, $id){
        try {
            (new Client())->head("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]); // check akses paket soal

            if(Auth::guard('guru')->check()){
                (new Client())->head("{$this->base_url}/pilihan-jawaban/{$id}/check", [
                    'headers' => $this->headers,
                ]); // check akses pilihan jawaban jika role guru
            }

            $response = (new Client())->get("{$this->base_url}/{$this->endpoint}/detail/{$id}", [
                'headers' => $this->headers,
            ]);
            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return view($this->viewBaseScope.'.form', [
                'idps' => $idps,
                'ids' => $ids,
                'mode' => 'update',
                'data' => $data,
            ]);

        } catch (ClientException $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Data gagal dimuat, coba lagi...']);
        } catch (\Exception $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    public function add(Request $request, $idps, $ids){
        $request->merge([ 'id_soal' => $ids ]);
        $validate = $request->validate($this->rules, $this->messages);
        try {
            (new Client())->head("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]); // check akses paket soal

            if(Auth::guard('guru')->check()){
                (new Client())->head("{$this->base_url}/soal/{$ids}/check", [
                    'headers' => $this->headers,
                ]); // check akses soal jika role guru
            }

            $response = (new Client())->post("{$this->base_url}/{$this->endpoint}", [
                'headers' => $this->headers,
                'form_params' => $validate
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data['status']) {
                return back()->withErrors(['message' => $data['message']]);
            }

            return redirect()->route($this->routeBaseScope.'.setting', [$idps, $ids])->with(['successToast' => $data['message']]);
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

    public function update(Request $request, $idps, $ids, $id){
        $request->merge([ 'id_soal' => $ids ]);
        $validate = $request->validate($this->rules, $this->messages);
        try {
            (new Client())->head("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]); // check akses paket soal

            if(Auth::guard('guru')->check()){
                (new Client())->head("{$this->base_url}/pilihan-jawaban/{$id}/check", [
                    'headers' => $this->headers,
                ]); // check akses pilihan jawaban jika role guru
            }

            $response = (new Client())->put("{$this->base_url}/{$this->endpoint}/{$id}", [
                'headers' => $this->headers,
                'form_params' => $validate
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data['status']) {
                return back()->withErrors(['message' => $data['message']]);
            }

            return redirect()->route($this->routeBaseScope.'.setting', [$idps, $ids])->with(['successToast' => $data['message']]);
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

    public function delete($idps, $ids, $id){
        try {
            (new Client())->head("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]); // check akses paket soal

            if(Auth::guard('guru')->check()){
                (new Client())->head("{$this->base_url}/pilihan-jawaban/{$id}/check", [
                    'headers' => $this->headers,
                ]); // check akses pilihan jawaban jika role guru
            }
            
            $response = (new Client())->delete("{$this->base_url}/{$this->endpoint}/{$id}", [
                'headers' => $this->headers,
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data['status']) {
                return back()->withErrors(['message' => $data['message']]);
            }

            return redirect()->route($this->routeBaseScope.'.setting', [$idps, $ids])->with(['successToast' => $data['message']]);
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
