<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarController;

use App\Http\Controllers\DashboardController;
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
    return view('depan.index');
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

// Route::get('/admin', [DashboardController::class, 'index'])->name('home');
// Route::get('/admin/detail/{id}', [DashboardController::class, 'detail'])->name('detail-peserta');
Route::patch('/admin/diterima/{id}', [DashboardController::class, 'terima'])->name('peserta-diterima');
Route::patch('/admin/ditolak/{id}', [DashboardController::class, 'ditolak'])->name('peserta-ditolak');
Route::get('/download', [DashboardController::class, 'download'])->name('download');

// Master Data
Route::resource('admin/user', 'UserController');
Route::resource('admin/pekerjaan_ortu', 'PekerjaanOrangTuaController');
Route::resource('admin/penghasilan_ortu', 'PenghasilanOrangtuaController');



require __DIR__ . '/auth.php';
