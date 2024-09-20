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


    //TODO maybe concatenate post and patch ito put method
    Route::post('/user/link', [LinkController::class, 'store']);
    Route::patch('/user/link/{id}', [LinkController::class, 'update']);

    Route::get('/user/links', [LinkController::class, 'getlinks']);
    Route::delete('/link/{id}', [LinkController::class, 'delete']);

});

Route::get('/link/{id}', [LinkController::class, 'getAllLink']);