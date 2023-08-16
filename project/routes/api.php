<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\PersonalAccessTokenController;
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

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/show-all', [ItemController::class, 'showAll']);
    Route::get('/show/{id}', [ItemController::class, 'show']);
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/update/{id}', [ItemController::class, 'update']);
    Route::delete('/delete/{id}', [ItemController::class, 'delete']);
});
Route::post('personal-access-tokens', [PersonalAccessTokenController::class, 'getToken']);

