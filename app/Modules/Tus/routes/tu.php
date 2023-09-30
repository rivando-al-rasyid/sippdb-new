<?php

use App\Modules\Tus\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'tu.auth', 'tu.verified'])->get('/tu', function () {
    return view('tu.dashboard');
})->name('tu.dashboard');

Route::group(['as' => 'tu.', 'prefix' => '/tu', 'middleware' => ['web', 'tu.auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
