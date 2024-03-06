<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //simple controler return hello in laravel
    public function test()
    {
        return response()->json([
            'status' => true,
            'message' => 'Hello ça marche !!!'
        ], 200);
    }
    public function testAuth()
    {
        return response()->json([
            'status' => true,
            'message' => 'Hello World connecté'
        ], 200);
    }
}
