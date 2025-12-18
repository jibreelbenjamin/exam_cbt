<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController
{
    protected $base_url;
    protected $headers;
    protected $endpoint = 'peserta';
    protected $searchKeys = ['username', 'nama', 'kelas.nama', 'ruangan.nama', 'peserta_count'];
    protected $viewBaseScope = 'dashboard.operator.peserta';
    protected $routeBaseScope = 'operator.peserta';

    protected $rules = [
        'username' => 'required|string|max:50',
        'nama' => 'required|string|max:255',
        'id_kelas' => 'required|integer',
        'id_ruangan' => 'nullable|integer',
        'password' => 'required|string',
    ];
    protected $messages = [
        'username.required' => 'Username wajib diisi.',
        'nama.required' => 'Nama peserta wajib diisi.',
        'id_kelas.required' => 'Kelas wajib dipilih.',
        'password.required' => 'Password wajib diisi.',
    ];

    public function __construct(){
        $this->base_url = env('API_BASE_URL');
        $this->headers = [
            'Authorization' => 'Bearer ' . session('token'),
        ];
    }
    
    public function index(){
        try {
            $response = (new Client())->get("{$this->base_url}/{$this->endpoint}", [
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
    
    public function create(){
        return view($this->viewBaseScope.'.form');
    }

    public function setting($id){
        try {
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

    public function add(Request $request){
        if ($request->isRandom) {
            $request->merge([
                'password' => Str::upper(Str::random(8))
            ]);
        }

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
        
            return redirect()->route($this->routeBaseScope)->with(['successToast' => $data['message']]);
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

    public function update(Request $request, $id){
        if ($request->isRandom) {
            $request->merge([
                'password' => Str::upper(Str::random(8))
            ]);
        }
        
        $validate = $request->validate($this->rules, $this->messages);
        try {
            $response = (new Client())->put("{$this->base_url}/{$this->endpoint}/{$id}", [
                'headers' => $this->headers,
                'form_params' => $validate
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data['status']) {
                return back()->withErrors(['message' => $data['message']]);
            }
        
            return redirect()->route($this->routeBaseScope)->with(['successToast' => $data['message']]);
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

            return redirect()->route($this->routeBaseScope)->with(['successToast' => $data['message']]);
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

    public function loadData(Request $request){
        $offset = (int) $request->query('offset', 0);
        $limit = (int) $request->query('limit', 10);
        $search = $request->query('search', null);

        try {
            $responses = Utils::unwrap([
                'result' => (new Client())->getAsync("{$this->base_url}/{$this->endpoint}", ['headers' => $this->headers]),
            ]);

            $data = json_decode($responses['result']->getBody(), true)['data'] ?? [];
            $data = collect($data);

            $flattenToString = function ($array) {
                return collect($array)->flatten()->implode(' ');
            };

             if ($search) {
                $search = strtolower($search);
                $searchKeys = $this->searchKeys;
                $data = $data->filter(function ($item) use ($search, $searchKeys) {

                    foreach ($searchKeys as $key) {
                        $value = data_get($item, $key);

                        if (is_string($value) && str_contains(strtolower($value), $search)) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            $data = $data
                ->reverse()
                ->slice($offset, $limit)
                ->values();

            return response()->json($data, 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengambil data data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
