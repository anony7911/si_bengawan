<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManajuserController;
use App\Http\Livewire\DataBarang;
use App\Http\Livewire\DataLaporan;
use App\Http\Livewire\DataPelanggan;
use App\Http\Livewire\DataPembayaran;
use App\Http\Livewire\DataPesanan;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/manajuser', [App\Http\Controllers\ManajuserController::class, 'index'])->name('manajuser');
Route::get('/barang', DataBarang::class);
Route::get('/pelanggan', DataPelanggan::class);
Route::get('/pesanan', DataPesanan::class);
Route::get('/pembayaran', DataPembayaran::class);
Route::get('/laporan', DataLaporan::class);
