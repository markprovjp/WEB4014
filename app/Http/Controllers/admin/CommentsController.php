<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\News;

class CommentsController extends Controller
{
    /**
     * Hiển thị danh sách bình luận
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'news']);
        
        // Lọc theo trạng thái nếu có
        if ($request->has('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }
        
        $comments = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Giữ lại các query parameters khi phân trang
        $comments->appends($request->all());
        
        return view('admin.comments.index', compact('comments'));
    }
    /**
     * Hiển thị form tạo bình luận mới (nếu cần)
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $news = News::where('status', 'published')->pluck('title', 'id');
        return view('admin.comments.create', compact('news'));
    }

    /**
     * Lưu bình luận mới vào database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'news_id' => 'required|exists:news,id',
        ], [
            'content.required' => 'Nội dung bình luận không được để trống',
            'news_id.required' => 'Vui lòng chọn tin tức',
            'news_id.exists' => 'Tin tức không tồn tại',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['status'] = $request->has('status') ? 'approved' : 'pending';

        Comment::create($data);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Thêm bình luận thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa bình luận
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\View\View
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Cập nhật thông tin bình luận
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
        ], [
            'content.required' => 'Nội dung bình luận không được để trống',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status') ? 'approved' : 'pending';

        $comment->update($data);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Cập nhật bình luận thành công!');
    }

    /**
     * Xóa bình luận
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')
            ->with('success', 'Xóa bình luận thành công!');
    }

    /**
     * Cập nhật nhanh trạng thái bình luận
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function approve(Comment $comment)
    {
        $comment->status = 'approved';
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Bình luận đã được phê duyệt',
        ]);
    }

    /**
     * Từ chối bình luận
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(Comment $comment)
    {
        $comment->status = 'rejected';
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Bình luận đã bị từ chối',
        ]);
    }
}