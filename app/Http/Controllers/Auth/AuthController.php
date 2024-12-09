<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OtpCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check user role for redirection
            if (Auth::user()->role_id == 1) {
                return redirect()->intended('admin/dashboard');
            }
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // Default role as member
        ]);

        // Generate OTP
        $otp = sprintf("%06d", mt_rand(1, 999999));
        
        // Store OTP
        OtpCode::create([
            'user_id' => $user->id,
            'code' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        // Send OTP Email
        Mail::send('emails.verification', ['otp' => $otp], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification OTP');
        });

        // Auth::login($user);

        return redirect()->route('otp.verify')->with('success', 'Verification email sent. Please check your inbox.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}