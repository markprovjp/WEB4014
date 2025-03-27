<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TinController;

Route::get('/', [TinController::class, 'index']);
Route::get('/tin/{id}', [TinController::class, 'chiTiet']);
Route::get('/cat/{idLT}', [TinController::class, 'tinTrongLoai']);