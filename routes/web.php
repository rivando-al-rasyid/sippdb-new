<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PekerjaanOrtuController;
use App\Http\Controllers\PenghasilanOrtuController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.index');
})->name('landing.page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/daftar', [DaftarController::class, 'index'])->name('daftar');
Route::get('/hasil', [DaftarController::class, 'hasil'])->name('hasil');
Route::post('/daftar', [DaftarController::class, 'daftar'])->name('daftar.kirim');

// Master Data

Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');

Route::get('/dash', [DashboardController::class, 'index'])->name('home');
Route::get('/dash/detail/{id}', [DashboardController::class, 'detail'])->name('detail-peserta');
Route::patch('/dash/diterima/{id}', [DashboardController::class, 'terima'])->name('peserta-diterima');
Route::patch('/dash/ditolak/{id}', [DashboardController::class, 'ditolak'])->name('peserta-ditolak');
Route::get('/download', [DashboardController::class, 'download'])->name('download');

// Master Data
Route::resource('dash/pekerjaan_ortu', PekerjaanOrtuController::class);
Route::resource('dash/penghasilan_ortu', PenghasilanOrtuController::class);

require __DIR__ . '/auth.php';
