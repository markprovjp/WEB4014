<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Hiển thị danh sách tin tức
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $news = News::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Hiển thị form tạo tin tức mới
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }

    /**
     * Lưu tin tức mới vào database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048', // max 2MB
            'slug' => 'nullable|unique:news,slug',
            'hot' => 'boolean',
            'status' => 'required|in:draft,published',
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'category_id.required' => 'Vui lòng chọn loại tin',
            'category_id.exists' => 'Loại tin không tồn tại',
            'thumbnail.image' => 'File phải là hình ảnh',
            'thumbnail.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
            'slug.unique' => 'Slug đã tồn tại',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ]);

        $data = $request->all();
        
        // Tự động tạo slug nếu không có
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        // Xử lý thumbnail nếu có
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        }
        
        // Thêm user_id của người tạo
        $data['user_id'] = Auth::id();
        
        // Thiết lập giá trị mặc định cho hot (nếu không có)
        $data['hot'] = $request->has('hot') ? 1 : 0;
        
        News::create($data);
        
        return redirect()->route('admin.news.index')
            ->with('success', 'Thêm tin tức thành công!');
    }

 

    /**
     * Hiển thị form chỉnh sửa tin tức
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\View\View
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Cập nhật thông tin tin tức
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048', // max 2MB
            'slug' => 'nullable|unique:news,slug,' . $news->id,
            'summary' => 'nullable',
            'hot' => 'boolean',
            'status' => 'required|in:draft,published',
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'category_id.required' => 'Vui lòng chọn loại tin',
            'category_id.exists' => 'Loại tin không tồn tại',
            'thumbnail.image' => 'File phải là hình ảnh',
            'thumbnail.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
            'slug.unique' => 'Slug đã tồn tại',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ]);

        $data = $request->all();
        // dd($data);
        // Tự động tạo slug nếu không có
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        // Xử lý thumbnail nếu có
        if ($request->hasFile('thumbnail')) {
            // Xóa thumbnail cũ nếu có
            if ($news->thumbnail) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        }
        
        // Thiết lập giá trị cho hot
        $data['hot'] = $request->has('hot') ? 1 : 0;
        
        $news->update($data);
        // dd($news);
        return redirect()->route('admin.news.index')
            ->with('success', 'Cập nhật tin tức thành công!');
    }

    /**
     * Xóa tin tức
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        // Xóa thumbnail nếu có
        if ($news->thumbnail) {
            Storage::disk('public')->delete($news->thumbnail);
        }
        
        // Xóa tin tức
        $news->delete();
        
        return redirect()->route('admin.news.index')
            ->with('success', 'Xóa tin tức thành công!');
    }
}