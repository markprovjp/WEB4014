<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Thêm code của bạn vào đây
        View::composer('layouts.app', function($view) {
            $view->with('categories', Category::all());
            
            // Cũng cung cấp popularNews nếu có dùng
            $view->with('popularNews', \App\Models\News::orderBy('views', 'desc')->take(5)->get());
        });
    }
}