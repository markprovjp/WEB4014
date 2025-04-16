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
use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Định nghĩa route upload ảnh - đặt ở đầu và miễn trừ khỏi CSRF
Route::post('/admin/upload-image', [UploadController::class, 'uploadImage'])
    ->name('admin.upload.image')
    ->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

// Profile routes - yêu cầu đăng nhập
Route::middleware('auth')->group(function () {
    // Trang profile
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile.show');
    // Cập nhật thông tin cá nhân
    Route::put('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');
    // Đổi mật khẩu
    Route::put('/profile/password', [HomeController::class, 'changePassword'])->name('profile.change-password');
    // Bình luận
    Route::get('/profile/comments', [HomeController::class, 'comments'])->name('profile.comments');
    // Cài đặt thông báo
    Route::put('/profile/notifications', [HomeController::class, 'updateNotifications'])->name('profile.notifications');
});

// Tin tức
Route::get('/news/{id}', [NewsController::class, 'detail'])->name('news.detail');
Route::get('/category/{category_id}', [NewsController::class, 'category'])->name('category.news');
Route::get('/search', [NewsController::class, 'search'])->name('news.search');
Route::get('/news/featured', [NewsController::class, 'featured'])->name('news.featured');
Route::get('/news/latest', [NewsController::class, 'latest'])->name('news.latest');

// Bình luận (yêu cầu đăng nhập)
Route::middleware('auth')->group(function () {
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
});

// Đăng ký newsletter
Route::post('/newsletter/subscribe', [HomeController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

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
    Route::get('/admin/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');

    Route::resource('categories', AdminCategoryController::class);
    Route::resource('news', AdminNewsController::class);
    Route::resource('users', AdminUsersController::class);
    Route::resource('comments', AdminCommentsController::class);
    Route::post('comments/{comment}/approve', [AdminCommentsController::class, 'approve'])->name('comments.approve');
    Route::post('comments/{comment}/reject', [AdminCommentsController::class, 'reject'])->name('comments.reject');

    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
});
