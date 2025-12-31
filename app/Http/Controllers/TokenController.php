<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController
{
    protected $base_url;
    protected $headers;
    protected $endpoint = 'token';
    protected $searchKeys = ['token', 'ujian.nama', 'admin.nama'];
    protected $viewBaseScope = 'dashboard.operator.token';
    protected $routeBaseScope = 'operator.token';

    protected array $rules = [
        'id_admin' => 'required|integer',
        'id_ujian' => 'required',
        'token' => 'required|string|max:255',
        'durasi'=> 'required|integer|min:1',
        'token_expired_at' => 'required',
    ];
    protected array $messages = [
        'id_admin.required' => 'ID admin harus diisi.',
        'id_admin.integer' => 'ID admin harus berupa angka.',
        
        'id_ujian.required' => 'Ujian wajib dipilih.',

        'token.required' => 'Token harus diisi.',
        'token.string' => 'Token harus berupa teks.',
        'token.max' => 'Token terlalu panjang.',

        'durasi.required' => 'Durasi harus diisi.',
        'durasi.integer' => 'Durasi harus berupa angka.',
        'durasi.min' => 'Durasi minimal adalah 1 menit.',
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

    public function add(Request $request){
        if ($request->isRandom) {
            $request->merge([
                'token' => Str::upper(Str::random(6))
            ]);
        }

        $request->merge([
            'id_admin' => Auth::guard('admin')->user()->id_admin,
            'token_expired_at' => ((string) now()->addMinutes((int)$request->durasi))
        ]);
        
        $validate = $request->validate($this->rules, $this->messages);

        if ($validate['id_ujian'] === 'ALL') { 
            $validate['id_ujian'] = null;
        }

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
