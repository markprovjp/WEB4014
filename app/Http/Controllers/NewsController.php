<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Category;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function detail($id)
    {
        $categories = Category::all(); // Để menu hiển thị
        $news = News::findOrFail($id);
        $news->increment('views');
        $comments = Comment::where('news_id', $id)->with('user')->get();
        $popularNews = News::orderBy('views', 'desc')->take(5)->get(); // Dành cho aside
        return view('news.detail', compact('categories', 'news', 'comments', 'popularNews'));
    }

    public function category($category_id)
    {
        $categories = Category::all(); // Thêm dòng này để truyền categories vào view
        $category = Category::findOrFail($category_id);
        $news = News::where('category_id', $category_id)->get();
        $popularNews = News::orderBy('views', 'desc')->take(5)->get();
        return view('news.category', compact('categories', 'category', 'news', 'popularNews'));
    }
    public function search(Request $request)
    {
        $categories = Category::all(); // Để menu hiển thị
        $keyword = $request->input('keyword');
        $news = News::where('title', 'like', "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%")
                    ->get();
        $popularNews = News::orderBy('views', 'desc')->take(5)->get(); // Dành cho aside
        return view('news.search', compact('categories', 'news', 'keyword', 'popularNews'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
