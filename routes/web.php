<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Middleware\AdminMiddleware;

// Route trang chủ - không yêu cầu auth
Route::get('/', function () {
    return view('home');
})->name('index');

// Guest routes - for unauthenticated users
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Client routes
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::resource('expenses', ExpenseController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Admin routes
    Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        // Admin dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        // User management
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        
        // Reports
        Route::get('/reports', [ReportController::class, 'adminIndex'])->name('reports');
        
        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
        Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    });
});

Route::get('/debug-middleware', function () {
    dd(app()->make(\Illuminate\Routing\Router::class)->getMiddleware());
});