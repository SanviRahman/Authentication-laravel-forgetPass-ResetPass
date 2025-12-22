<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Admin;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function login()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('Logout successful.');
    }

    public function forget_password()
    {
        return view('admin.forget_password');
    }


    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (! $admin) {
            return redirect()->back()->with('error', 'Email not found.');
        }

        $token        = hash('sha256', time());
        $admin->token = $token;
        $admin->save();

        $reset_link = route('admin_reset_password', ['token' => $token, 'email' => $request->email]);
        $subject    = 'Reset Password';
        $message    = 'Please click the button below to reset your password:';

        // ✅ সঠিকভাবে মেইল পাঠানো (লিংকটা তৃতীয় আর্গুমেন্ট হিসেবে পাঠানো হচ্ছে)
        Mail::to($request->email)->send(new Websitemail($subject, $message, $reset_link));

        return redirect()->back()->with('success', 'Reset password link has been sent to your email.');
    }

    public function reset_password($token, $email)
    {
        $admin = Admin::where('email', $email)->where('token', $token)->first();
        return view('admin.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        // প্রথমে চেক করো টোকেন এবং ইমেইল ভ্যালিড কিনা
        $admin = Admin::where('email', $email)->where('token', $token)->first();

        if (! $admin) {
            return redirect()->route('admin_login')->with('error', 'Invalid or expired reset link.');
        }

        // শুধুমাত্র ভ্যালিড হলে পাসওয়ার্ড আপডেট করো
        $admin->password = Hash::make($request->password);
        $admin->token    = '';
        $admin->save();

        return redirect()->route('admin_login')->with('success', 'Password reset successfully. Please login.');
    }

}
