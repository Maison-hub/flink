<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\Auth\LoginUserController;


//--------------------Auth---------------------
Route::post('/login', [LoginUserController::class, 'login'])
    ->middleware('guest')
    ->name('login');


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//group of route protected by auth:sanctum middleware
Route::middleware('auth:sanctum')->group(function () {

    //Route::get('/testAuth', [TestController::class, 'testAuth']);

    //--------------------Links---------------------
    //TODO maybe concatenate post and patch ito put method
    Route::get('/links', [LinkController::class, 'getlinks']);
    Route::post('/links', [LinkController::class, 'store']);
    Route::patch('/links/{id}', [LinkController::class, 'update']);
    Route::delete('/links/{id}', [LinkController::class, 'delete']);

});

//--------------------Views---------------------
Route::get('/views/users/{userId}/links', [LinkController::class, 'getAllLink']);
