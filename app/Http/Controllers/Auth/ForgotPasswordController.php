<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
    }
    
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Không tìm thấy tài khoản với địa chỉ email này.']);
        }
        
        // Tạo token random
        $token = Str::random(60);
        
        // Lưu token vào database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token, 
                'created_at' => Carbon::now()
            ]
        );
        
        // Gửi email
        Mail::to($request->email)->send(new ResetPasswordMail($token, $user));
        
        // Lưu email vào session để điền sẵn vào form verify
        session(['reset_email' => $request->email]);
        
        // Chuyển hướng đến trang xác minh token thay vì quay lại
        return redirect()->route('password.verify')
            ->with('status', 'Chúng tôi đã gửi mã xác nhận đến email của bạn!');
    }
}