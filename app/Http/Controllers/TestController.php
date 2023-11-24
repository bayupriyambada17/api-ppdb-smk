<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class TestController extends Controller
{

    public function view(Request $request)
    {
        // $login = Http::withHeaders([
        //     'Accept' => 'application/json'
        // ])->get("localhost:3008/api/v1/auth/login", [
        //     'email' => 'operatorppdb@sekolah.com',
        //     'password' => 'passwordppdb123'
        // ]);

        return view('welcome');
    }
    public function test()
    {
        return view('test');
    }
}
