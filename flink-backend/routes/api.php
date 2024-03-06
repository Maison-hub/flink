<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\LinkController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/testAuth', [TestController::class, 'testAuth']);

    Route::post('/addlink', [LinkController::class, 'store']);
    Route::get('/getlinks', [LinkController::class, 'getlinks']);
    Route::post('/updatelink/{id}', [LinkController::class, 'update']);
    Route::delete('/deletelink/{id}', [LinkController::class, 'delete']);

});

Route::get('/test', [TestController::class, 'test']);

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);


Route::get('/alllinkof/{id}', [LinkController::class, 'alllinkof']);









