
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function showForm()
    {
        return view('email-form');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $mailData = [
            'title' => $request->subject,
            'body' => $request->message
        ];

        Mail::to($request->email)->send(new TestMail($mailData));

        return redirect()->back()->with('success', 'Email đã được gửi thành công!');
    }
}