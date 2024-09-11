<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//group of route protected by auth:sanctum middleware
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/testAuth', [TestController::class, 'testAuth']);

    Route::post('/addlink', [LinkController::class, 'store']);
    Route::get('/getlinks', [LinkController::class, 'getlinks']);
    Route::post('/updatelink/{id}', [LinkController::class, 'update']);
    Route::delete('/deletelink/{id}', [LinkController::class, 'delete']);

});

Route::get('/linkof/{id}', [LinkController::class, 'getAllLink']);