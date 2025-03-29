<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\CommentsController as AdminCommentsController;
use Illuminate\Support\Facades\Auth;
Route::get('/', [HomeController::class, 'index'])->name('home');
// profile
Route::get('/profile', [HomeController::class, 'profile'])->name('profile.show');
Route::post('/profile', [HomeController::class, 'updateProfile'])->name('profile.comments');
Route::post('/profiles', [HomeController::class, 'updateProfile'])->name('profile.update');
Route::post('/profiless', [HomeController::class, 'updateProfile'])->name('profile.change-password');
Route::post('/profisle', [HomeController::class, 'updateProfile'])->name('profile.notifications');

// Tin tức
Route::get('/news/{id}', [NewsController::class, 'detail'])->name('news.detail');
Route::get('/category/{category_id}', [NewsController::class, 'category'])->name('category.news');
Route::get('/search', [NewsController::class, 'search'])->name('news.search');

// Bình luận (yêu cầu đăng nhập)
Route::middleware('auth')->group(function () {
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
});

// Authentication - bật đăng ký
Auth::routes(); // Cho phép đăng ký người dùng

// Các routes quên mật khẩu
Route::get('/password/forgot', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/verify', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/password/verify', [App\Http\Controllers\Auth\ResetPasswordController::class, 'verifyToken'])->name('password.verify.submit');
Route::get('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('news', AdminNewsController::class);
    Route::resource('users', AdminUsersController::class);
    Route::resource('comments', AdminCommentsController::class);
    Route::post('comments/{comment}/approve', [AdminCommentsController::class, 'approve'])->name('comments.approve');
    Route::post('comments/{comment}/reject', [AdminCommentsController::class, 'reject'])->name('comments.reject');
    
});