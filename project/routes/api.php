<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/create', [\App\Http\Controllers\ItemController::class, 'create']);
Route::get('/item{id}', [\App\Http\Controllers\ItemController::class, 'show']);
Route::post('/edit{id}', [\App\Http\Controllers\ItemController::class, 'edit']);
Route::post('/store', [\App\Http\Controllers\ItemController::class, 'store']);
Route::post('/delete', [\App\Http\Controllers\ItemController::class, 'delete']);
