<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class ResetPasswordController extends Controller
{
    protected $redirectTo = '/';
    
    public function __construct()
    {
        // $this->middleware('guest');
    }
    
    public function showVerifyForm()
    {
        return view('auth.passwords.verify', [
            'email' => session('reset_email', '')
        ]);
    }
    
    // Xác minh token
    public function verifyToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'token.required' => 'Mã xác nhận không được để trống',
        ]);
        
        // Kiểm tra token
        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();
        
        if (!$tokenData) {
            return back()->withErrors(['token' => 'Mã xác nhận không hợp lệ hoặc đã hết hạn']);
        }
        
        // Kiểm tra thời gian hết hạn (1 giờ)
        $createdAt = Carbon::parse($tokenData->created_at);
        if (Carbon::now()->diffInMinutes($createdAt) > 60) {
            return back()->withErrors(['token' => 'Mã xác nhận đã hết hạn, vui lòng yêu cầu mã mới']);
        }
        
        // Lưu thông tin vào session để tiếp tục bước tiếp theo
        session(['reset_token' => $request->token, 'reset_email' => $request->email]);
        
        // Chuyển hướng với tham số giả
    return redirect()->route('password.reset', ['token' => 'verified']);
    }
    
    // Hiển thị form reset password
    public function showResetForm(Request $request)
    {
        // Kiểm tra xem có session token và email không
        if (!session('reset_token') || !session('reset_email')) {
            return redirect()->route('password.verify')
                ->withErrors(['token' => 'Vui lòng nhập mã xác nhận trước']);
        }
        
        return view('auth.passwords.reset', [
            'email' => session('reset_email')
        ]);
    }
    
    // Xử lý reset password
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
        ]);
        
        // Kiểm tra session
        if (!session('reset_token') || session('reset_email') != $request->email) {
            return redirect()->route('password.verify')
                ->withErrors(['token' => 'Vui lòng nhập mã xác nhận trước']);
        }
        
        // Cập nhật mật khẩu
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Không tìm thấy tài khoản với địa chỉ email này.']);
        }
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        // Xóa token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        
        // Xóa session
        session()->forget(['reset_token', 'reset_email']);
        
        return redirect()->route('login')
            ->with('success', 'Mật khẩu đã được đặt lại thành công. Bạn có thể đăng nhập ngay bây giờ.');
    }
}