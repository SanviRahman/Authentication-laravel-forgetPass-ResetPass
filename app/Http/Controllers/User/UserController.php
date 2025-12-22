<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function registration()
    {
        return view('user.registration');
    }

    public function registration_submit(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        // Token generate
        $token = hash('sha256', time());

        // User create with token
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'token'    => $token,
            'status'   => 0,
        ]);

        // Verification link
        $verification_link = route('registration_verify', [
            'token' => $token,
            'email' => $request->email,
        ]);

        $subject = 'Registration Verification';
        $message = 'Click on the following link to verify your email';
        $message .= '<a href="' . $verification_link . '">Verify Email</a>';
        $message .= '<br><br>Or copy this link: <br>' . $verification_link;

        // Mail send
        Mail::to($request->email)->send(new Websitemail($subject, $message, $verification_link));

        return redirect()->back()
            ->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    public function registration_verify($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if (! $user) {
            return redirect()->route('login')->with('error', 'Invalid token or email');
        }
        $user->token  = '';
        $user->status = 1;
        $user->save();

        return redirect()->route('login')->with('success', 'Email verification successful. You can login now.');
    }

    public function login()
    {
        return view('user.login');
    }
}
