<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required | email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('Error', 'Invalid Credentials');
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
        echo "Forget password submitted";
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

}               
