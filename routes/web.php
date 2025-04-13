<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuanTriTinController;
use App\Http\Controllers\HsController;
use App\Http\Controllers\SvController;
use App\Http\Middleware\Quantri;
use App\Http\Middleware\Admin;
use App\Http;
Route::get('/', function () {
    return view('welcome');
});
Route::get("hs",[App\Http\Controllers\HsController::class,'hs']);
Route::post("hs",[App\Http\Controllers\HsController::class,'hs_store'])->name('hs_store');

Route::get("sv",[App\Http\Controllers\SvController::class,'sv']);
Route::post("sv",[App\Http\Controllers\SvController::class,'sv_store'])->name('sv_store');



Route::get('/email', [App\Http\Controllers\MailController::class, 'showForm'])->name('email.form');
Route::post('/send-email', [App\Http\Controllers\MailController::class, 'sendEmail'])->name('email.send');


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
