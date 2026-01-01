<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    protected $base_url;
    protected $id;
    protected $endpoint = 'ujian';
    protected $viewBaseScope = 'dashboard.peserta';
    protected $routeBaseScope = 'onexam';

    public function __construct(){
        $this->base_url = env('API_BASE_URL');
        $this->id = Auth::guard('peserta')->user()->id_peserta;
        $this->headers = [
            'Authorization' => 'Bearer ' . session('token'),
        ];
    }
    
    public function home(){
        try {
            $response = (new Client())->get("{$this->base_url}/onexam/ujian/{$this->id}", [
                'headers' => $this->headers,
            ]);
            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return view($this->viewBaseScope.'.home', [
                'total' => count($data),
                'data' => $data,
            ]);

        } catch (ClientException $e) {
            return view($this->viewBaseScope.'.home', [
                'total' => 0,
                'data' => [],
                'erros' => 'Kesalahan koneksi API, coba lagi...'
            ]);
        } catch (\Exception $e) {
            return view($this->viewBaseScope.'.home', [
                'total' => 0,
                'data' => [],
                'erros' => 'Terjadi kesahalan: '.$e->getMessage()
            ]);
        }
    }

    public function confirm($id_ujian){
        try {
            $response = (new Client())->get("{$this->base_url}/onexam/ujian/confirm/{$this->id}/{$id_ujian}", [
                'headers' => $this->headers,
            ]);
            $data = json_decode($response->getBody(), true)['data'] ?? [];

            return view($this->viewBaseScope.'.konfirmasi', [
                'data' => $data,
                'a' => $id_ujian
            ]);

        } catch (ClientException $e) {
            $response = $e->getResponse();
            $body = json_decode($response->getBody(), true);

            if (isset($body['errors'])) {
                return back()->withErrors($body['errors'])->withInput();
            }

            return redirect()->route($this->routeBaseScope.'.home')->withErrors([
                'message' => $body['message'] ?? 'Kesalahan koneksi, coba lagi...'
            ])->withInput();
        } catch (\Exception $e) {
            return redirect()->route($this->routeBaseScope.'.home')->withErrors(['message' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

}
