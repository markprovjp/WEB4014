<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TinController;

// Route::get('/', [TinController::class, 'index']);
Route::get('/tin/ds', [TinController::class, 'index'])->name('tin.danhsach');
Route::get('/tin/them', [TinController::class, 'them'])->name('tin.them');
Route::post('/tin/them', [TinController::class, 'luu'])->name('tin.luu');
Route::get('/tin/sua/{id}', [TinController::class, 'sua'])->name('tin.sua');
Route::post('/tin/sua/{id}', [TinController::class, 'capNhat'])->name('tin.capnhat');
Route::post('/tin/xoa/{id}', [TinController::class, 'xoa'])->name('tin.xoa');
Route::get('/tin/{id}', [TinController::class, 'chiTiet']);
Route::get('/cat/{idLT}', [TinController::class, 'tinTrongLoai']);
Route::get('/storage/private/{path}', function ($path) {
    return response()->file(storage_path('app/private/' . $path));
})->where('path', '.*');