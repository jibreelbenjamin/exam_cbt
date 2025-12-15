<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeOperatorController
{
    protected $base_url;
    public function __construct(){
        $this->base_url = env('API_BASE_URL');;
    }
    
    public function home(){
        return view('dashboard.operator.home');
    }
}
