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
            return redirect()->route('admin_dashboard');
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
        if (! $admin) {
            return redirect()->route('admin_login', 'Invalid token or email');
        }
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

    public function admin_profile()
    {
        return view('admin.profile');
    }

    public function admin_profile_submit(Request $request)
    {
        // Get current admin
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name'  => 'required',      
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        // Handle Photo Upload
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120', // 5MB max
            ]);

            $image      = $request->file('photo');
            $final_name = 'admin_' . time() . '.' . $image->Extension();

            // Delete old photo if exists
            if ($admin->photo != '' && file_exists(public_path('uploads/' . $admin->photo))) {
                unlink(public_path('uploads/' . $admin->photo));
            }

            $image->move(public_path('uploads'), $final_name);
            $admin->photo = $final_name;
        }

        // Handle Password C
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);
            $admin->password = Hash::make($request->password); 
        }

        // Update other fields
        $admin->name  = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
