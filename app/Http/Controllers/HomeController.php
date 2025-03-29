<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $featuredNews = News::orderBy('views', 'desc')->take(1)->get();
        $latestNews = News::latest()->take(5)->get();
        $popularNews = News::orderBy('views', 'desc')->take(2)->get(); // Dành cho aside
        return view('home', compact('categories', 'featuredNews', 'latestNews', 'popularNews'));
    }

    public function profile()
    {
        $categories = Category::all();
        return view('profile', compact('categories'));
    }
}
