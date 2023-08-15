<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\web\HomeController;

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
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/show/{id}', [HomeController::class, 'show'])->name('show');
    Route::get('/create', [HomeController::class, 'create'])->name('create');
    Route::post('/store', [HomeController::class, 'store'])->name('store');
    Route::put('/update/{id}', [HomeController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('delete');
});
