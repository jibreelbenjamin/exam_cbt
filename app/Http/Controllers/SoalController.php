<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoalController
{
    protected $base_url;
    protected $headers;
    protected $endpoint = 'soal';
    protected $searchKeys = ['nama', 'deskripsi'];
    protected $viewBaseScope = 'dashboard.operator.soal';
    protected $routeBaseScope = 'operator.soal';

    protected array $rules = [
        'id_paket_soal' => 'required|integer',
        'teks_soal' => 'required|string',
        'gambar' => 'nullable|string',
        'tipe_jawaban' => 'required|integer|in:1,2',
    ];
    protected array $messages = [
        'id_paket_soal.required' => 'ID paket soal harus diisi.',
        'id_paket_soal.integer' => 'ID paket soal harus berupa angka.',

        'teks_soal.required'  => 'Teks soal harus diisi.',
        'teks_soal.string' => 'Teks soal harus berupa teks.',

        'gambar.string' => 'Path gambar harus berupa teks.',

        'tipe_jawaban.required' => 'Tipe jawaban harus diisi.',
        'tipe_jawaban.integer' => 'Tipe jawaban harus berupa angka.',
        'tipe_jawaban.in' => 'Tipe jawaban tidak valid.',
    ];

    public function __construct(){
        $this->base_url = env('API_BASE_URL');
        $this->headers = [
            'Authorization' => 'Bearer ' . session('token'),
        ];
    }

    public function index(){
        try {
            $response = (new Client())->get("{$this->base_url}/paket-soal/guru", [
                'headers' => $this->headers,
            ]);
            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return view($this->viewBaseScope.'.daftar', [
                'total' => count($data),
                'data' => $data,
            ]);

        } catch (ClientException $e) {
            return view($this->viewBaseScope.'.daftar', [
                'total' => 0,
                'data' => [],
                'erros' => 'Kesalahan koneksi API, coba lagi...'
            ]);
        } catch (\Exception $e) {
            return view($this->viewBaseScope.'.daftar', [
                'total' => 0,
                'data' => [],
                'erros' => 'Terjadi kesahalan: '.$e->getMessage()
            ]);
        }
    }

    public function create($idps){
        try {
            $response = (new Client())->get("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]);
            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return view($this->viewBaseScope.'.form', [
                'total' => count($data),
                'data' => $data,
            ]);

        } catch (ClientException $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Data gagal dimuat, coba lagi...']);
        } catch (\Exception $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    public function list($idps){
        try {
            $response = (new Client())->get("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]);
            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return view($this->viewBaseScope.'.soal-list', [
                'total' => count($data),
                'data' => $data,
            ]);

        } catch (ClientException $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Data gagal dimuat, coba lagi...']);
        } catch (\Exception $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    public function setting($idps, $id){
        try {
            (new Client())->head("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]); // check akses paket soal

            if(Auth::guard('guru')->check()){
                (new Client())->head("{$this->base_url}/soal/{$id}/check", [
                    'headers' => $this->headers,
                ]); // check akses soal jika role guru
            }

            $response = (new Client())->get("{$this->base_url}/{$this->endpoint}/{$id}", [
                'headers' => $this->headers,
            ]);
            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return view($this->viewBaseScope.'.setting', [
                'total' => count($data),
                'data' => $data,
            ]);

        } catch (ClientException $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Data gagal dimuat, coba lagi...']);
        } catch (\Exception $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    public function add(Request $request, $idps){
        $request->merge([ 'id_paket_soal' => $idps ]);
        $validate = $request->validate($this->rules, $this->messages);
        try {
            (new Client())->head("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]); // check akses paket soal

            $response = (new Client())->post("{$this->base_url}/{$this->endpoint}", [
                'headers' => $this->headers,
                'form_params' => $validate
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data['status']) {
                return back()->withErrors(['message' => $data['message']]);
            }

            if($request->tipe_jawaban == 1){ // jika memilih tipe pilihan ganda langusung direct ke setting
                return redirect()->route($this->routeBaseScope.'.setting', [$idps, $data['data']['id_soal']])->with(['successToast' => $data['message']]);
            }

            return redirect()->route($this->routeBaseScope.'.list', $idps)->with(['successToast' => $data['message']]);
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

    public function update(Request $request, $idps, $id){
        $request->merge([ 'id_paket_soal' => $idps ]);
        $validate = $request->validate($this->rules, $this->messages);
        try {
            (new Client())->head("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]); // check akses paket soal

            if(Auth::guard('guru')->check()){
                (new Client())->head("{$this->base_url}/soal/{$id}/check", [
                    'headers' => $this->headers,
                ]); // check akses soal jika role guru
            }

            $response = (new Client())->put("{$this->base_url}/{$this->endpoint}/{$id}", [
                'headers' => $this->headers,
                'form_params' => $validate
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data['status']) {
                return back()->withErrors(['message' => $data['message']]);
            }

            if($request->tipe_jawaban == 1){ // jika memilih tipe pilihan ganda langusung direct ke setting
                return redirect()->route($this->routeBaseScope.'.setting', [$idps, $id])->with(['successToast' => $data['message']]);
            }

            return redirect()->route($this->routeBaseScope.'.list', $idps)->with(['successToast' => $data['message']]);
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

    public function delete($idps, $id){
        try {
            (new Client())->head("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]); // check akses paket soal

            if(Auth::guard('guru')->check()){
                (new Client())->head("{$this->base_url}/soal/{$id}/check", [
                    'headers' => $this->headers,
                ]); // check akses soal jika role guru
            }
            
            $response = (new Client())->delete("{$this->base_url}/{$this->endpoint}/{$id}", [
                'headers' => $this->headers,
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data['status']) {
                return back()->withErrors(['message' => $data['message']]);
            }

            return redirect()->route($this->routeBaseScope.'.list', $idps)->with(['successToast' => $data['message']]);
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

    public function loadSoal($id){
        try {
            $response = (new Client())->get("{$this->base_url}/paket-soal/guru/{$id}", [
                'headers' => $this->headers,
            ]);
            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return [
                'total' => count($data),
                'data' => $data,
            ];

        } catch (ClientException $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Data gagal dimuat, coba lagi...']);
        } catch (\Exception $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    public function print(Request $request, $idps){
        try {
            $response = (new Client())->get("{$this->base_url}/paket-soal/guru/{$idps}", [
                'headers' => $this->headers,
            ]);
            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return view($this->viewBaseScope.'.print', [
                'data' => $data,
                'pilihan_jawaban' => $request->pj,
                'acak_soal' => $request->as,
                'jawaban' => $request->j,
            ]);

        } catch (ClientException $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Data gagal dimuat, coba lagi...']);
        } catch (\Exception $e) {
            return redirect()->route($this->routeBaseScope)->withErrors(['message' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }
}
