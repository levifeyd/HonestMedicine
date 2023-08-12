<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\PersonalAccessTokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/create', [\App\Http\Controllers\ItemController::class, 'create']);
    Route::get('/item{id}', [\App\Http\Controllers\ItemController::class, 'show']);
    Route::put('/update{id}', [\App\Http\Controllers\ItemController::class, 'update']);
    Route::post('/store', [\App\Http\Controllers\ItemController::class, 'store']);
    Route::delete('/delete', [\App\Http\Controllers\ItemController::class, 'delete']);
    Route::post('personal-access-tokens', [PersonalAccessTokenController::class, 'store']);
});

