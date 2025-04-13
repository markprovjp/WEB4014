<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuanTriTinController;
use App\Http\Middleware\Quantri;
use App\Http\Middleware\Admin;
use App\Http;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/tin-tuc', [QuanTriTinController::class, 'index'])->name('tin-tuc');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('download', function () {
    return view('download');
})->middleware(['auth', 'verified'])->name('download');

Route::get('/quantri', function () {
    return view('quantri');

})->middleware(['auth', App\Http\Middleware\Quantri::class])->name('quantri');

Route::get('/dl', function () {
    return view('dl');
})->middleware('auth.basic')->name('dl');
require __DIR__.'/auth.php';
