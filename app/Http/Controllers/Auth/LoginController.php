<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        // Middleware guest sẽ chỉ cho phép truy cập khi chưa đăng nhập
        // $this->middleware('guest')->except('logout');
    }
    
    // Kiểm tra đầu vào khi đăng nhập
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);
    }
    
    // Hiển thị thông báo lỗi đăng nhập
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => 'Thông tin đăng nhập không chính xác'];
        
        // Kiểm tra nếu người dùng tồn tại nhưng chưa kích hoạt
        $user = User::where($this->username(), $request->{$this->username()})->first();
        
        if ($user && !$user->active) {
            $errors = [$this->username() => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email để kích hoạt.'];
        }
        
        throw ValidationException::withMessages($errors);
    }

    // Tùy chỉnh đăng nhập
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Kiểm tra giới hạn số lần đăng nhập (từ trait AuthenticatesUsers)
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // Tăng số lần thử đăng nhập
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    
    // Xử lý đăng nhập thành công
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return redirect()->intended($this->redirectTo)
            ->with('success', 'Đăng nhập thành công!');
    }
    
    // Thêm điều kiện active vào thông tin đăng nhập
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        // dd($credentials);
        $credentials['active'] = 1; // Chỉ cho phép đăng nhập các tài khoản đã kích hoạt
        return $credentials;
    }
}