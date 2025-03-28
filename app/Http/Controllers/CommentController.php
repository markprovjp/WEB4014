<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'news_id' => 'required|exists:news,id'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'news_id' => $request->news_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Bình luận đã được đăng thành công!');
    }
}