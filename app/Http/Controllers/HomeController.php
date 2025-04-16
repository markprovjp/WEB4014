<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // dd($categories);
        $featuredNews = News::where('status', 'published')->orderBy('views', 'desc')->take(5)->get();
        $latestNews = News::where('status', 'published')->latest()->take(8)->get();
        $popularNews = News::where('status', 'published')->orderBy('views', 'desc')->get(); // Hiển thị tất cả tin phổ biến
        return view('home', compact('categories', 'featuredNews', 'latestNews', 'popularNews'));
    }

    /**
     * Hiển thị trang thông tin cá nhân người dùng
     */
    public function profile()
    {
        $user = Auth::user();
        $categories = Category::all();
        $comments = Comment::where('user_id', $user->id)
            ->with('news')
            ->latest()
            ->paginate(5);

        return view('profile', compact('categories', 'comments'));
    }

    /**
     * Cập nhật thông tin người dùng
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'avatar.image' => 'File phải là hình ảnh',
            'avatar.mimes' => 'Định dạng hình ảnh phải là: jpeg, png, jpg, gif',
            'avatar.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Xử lý avatar
        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu có
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Lưu avatar mới
            $path = $request->file('avatar')->store('avatars', 'public');
            $userData['avatar'] = $path;
        }

        // Xử lý xóa avatar
        if ($request->has('remove_avatar') && $user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $userData['avatar'] = null;
        }

        $user->update($userData);

        return redirect()->route('profile.show')->with('success', 'Cập nhật thông tin thành công!');
    }

    /**
     * Đổi mật khẩu
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ]);

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show', ['#security'])->with('password_success', 'Đổi mật khẩu thành công!');
    }

    /**
     * Hiển thị bình luận của người dùng
     */
    public function comments()
    {
        $user = Auth::user();
        $categories = Category::all();
        $comments = Comment::where('user_id', $user->id)
            ->with('news')
            ->latest()
            ->paginate(10);

        return view('profile', compact('categories', 'comments'))->with('active_tab', 'comments');
    }

    /**
     * Cập nhật cài đặt thông báo
     */
    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        $settings = $request->notifications ?? [];
        $user->notification_settings = json_encode($settings);
        $user->save();

        return redirect()->route('profile.show', ['#notifications'])->with('success', 'Cập nhật cài đặt thông báo thành công!');
    }

    /**
     * Đăng ký nhận tin
     */
    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã đăng ký nhận tin',
        ]);

        // Nếu bạn có bảng newsletter_subscribers, thêm email vào đó
        // Nếu không, bạn có thể trả về thông báo thành công

        return back()->with('success', 'Đăng ký nhận tin thành công! Cảm ơn bạn đã đăng ký.');
    }
}
