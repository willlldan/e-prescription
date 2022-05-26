<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ObatAlkesController;
use App\Http\Controllers\RacikanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SignaController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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
    return redirect(url('/dashboard'));
});

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);



Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index', [
            'title' => "Dashboard"
        ]);
    });

    Route::resource('/obatalkes', ObatAlkesController::class);
    Route::resource('/signa', SignaController::class);
    Route::resource('/racikan', RacikanController::class);
    Route::get('/transaksi/history', [TransaksiController::class, 'index']);
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak']);
    Route::get('/transaksi', [TransaksiController::class, 'create']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
});
