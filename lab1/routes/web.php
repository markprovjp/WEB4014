<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TinController;
use App\Http\Controllers\InfoController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [TinController::class, 'index']);
Route::get('/lien-he', [TinController::class, 'lienHe']);
Route::get('/show/{id}', [TinController::class, 'show']);
Route::get('/info', [InfoController::class, 'info']);