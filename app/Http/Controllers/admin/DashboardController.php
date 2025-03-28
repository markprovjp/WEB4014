<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Hiển thị dashboard cho admin
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Đếm số lượng tin, loại tin, người dùng, bình luận
        $newsCount = News::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $commentCount = Comment::count();
        
        // Lấy 5 tin mới nhất
        $latestNews = News::with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Thống kê tin theo loại tin
        $newsByCategory = DB::table('categories')
            ->leftJoin('news', 'categories.id', '=', 'news.category_id')
            ->select('categories.name', DB::raw('count(news.id) as count'))
            ->groupBy('categories.name')
            ->get();
        
        // Thống kê người dùng đăng ký theo tháng (năm hiện tại)
        $userRegistrations = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
            
        // Map để có đủ 12 tháng
        $usersByMonth = array_fill(1, 12, 0);
        foreach ($userRegistrations as $data) {
            $usersByMonth[$data->month] = $data->count;
        }
        
        return view('admin.dashboard', compact(
            'newsCount', 
            'categoryCount', 
            'userCount', 
            'commentCount', 
            'latestNews', 
            'newsByCategory',
            'usersByMonth'
        ));
    }
}