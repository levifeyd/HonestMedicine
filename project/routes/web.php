<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Web\CrudItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::middleware('auth:sanctum')->group( function () {
    Route::get('/home', [CrudItemController::class, 'index'])->name('home');
    Route::get('/show/{id}', [CrudItemController::class, 'show'])->name('show');
    Route::get('/create', [CrudItemController::class, 'create'])->name('create');
    Route::post('/store', [CrudItemController::class, 'store'])->name('store');
    Route::put('/update/{id}', [CrudItemController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [CrudItemController::class, 'delete'])->name('delete');
});
