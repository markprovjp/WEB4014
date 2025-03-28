<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách loại tin
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::withCount('news')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo loại tin mới
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Lưu loại tin mới vào database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories',
            'slug' => 'nullable|max:255|unique:categories',
            'description' => 'nullable',
        ], [
            'name.required' => 'Tên loại tin không được để trống',
            'name.unique' => 'Tên loại tin đã tồn tại',
            'slug.unique' => 'Slug đã tồn tại',
        ]);

        $data = $request->all();
        
        // Tự động tạo slug nếu không có
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        Category::create($data);
        return redirect()->route('admin.categories.index')
            ->with('success', 'Thêm loại tin thành công!');
    }

    /**
     * Hiển thị thông tin chi tiết loại tin (nếu cần)
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        $news = $category->news()->paginate(10);
        return view('admin.categories.show', compact('category', 'news'));
    }

    /**
     * Hiển thị form chỉnh sửa loại tin
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Cập nhật thông tin loại tin
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable',
        ], [
            'name.required' => 'Tên loại tin không được để trống',
            'name.unique' => 'Tên loại tin đã tồn tại',
            'slug.unique' => 'Slug đã tồn tại',
        ]);

        $data = $request->all();
        
        // Tự động tạo slug nếu không có
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $category->update($data);
        return redirect()->route('categories.index')
            ->with('success', 'Cập nhật loại tin thành công!');
    }

    /**
     * Xóa loại tin
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        // Kiểm tra xem có tin tức thuộc loại này không
        if ($category->news()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Không thể xóa loại tin này vì đã có tin tức thuộc loại này!');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa loại tin thành công!');
    }
}