<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\EmailVerificationController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;


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
    //update profil
    Route::post('/updateprofil', [AuthController::class, 'updateProfil']);

    Route::post('/addlink', [LinkController::class, 'store']);
    Route::get('/getlinks', [LinkController::class, 'getlinks']);
    Route::post('/updatelink/{id}', [LinkController::class, 'update']);
    Route::delete('/deletelink/{id}', [LinkController::class, 'delete']);

});

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['api.signed'])
    ->name('verification.verify');

Route::get('/test', [TestController::class, 'test']);

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);


Route::get('/alllinkof/{id}', [LinkController::class, 'alllinkof']);









