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
use App\Mail\VerificationMail;

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

        // Generate verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // Default role as member
            'verification_code' => $verificationCode
        ]);

        // Generate OTP
        $otp = sprintf("%06d", mt_rand(1, 999999));

        // Store OTP
        OtpCode::create([
            'user_id' => $user->id,
            'code' => $verificationCode,  // Changed from $otp
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        // Send verification email with the code
        Mail::to($user->email)->send(new VerificationMail($verificationCode));

        return redirect()->route('otp.verify')
            ->with('success', 'Please check your email for verification code');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function verify(Request $request)
    {
        try {
            $request->validate([
                'otp' => 'required|string|min:6|max:6'
            ]);

            // Get the latest unverified user with this OTP code
            $otpCode = OtpCode::where('code', $request->otp)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if ($otpCode) {
                $user = User::find($otpCode->user_id);
                if ($user) {
                    $user->email_verified_at = now();
                    $user->save();

                    // Delete used OTP
                    $otpCode->delete();

                    // Log the user in
                    Auth::login($user);

                    return redirect()->intended('/dashboard')
                        ->with('success', 'Email verified successfully');
                }
            }

            return back()->with('error', 'Verification failed. Please try again.');
        } catch (\Exception $e) {
            return back()->with('error', 'Verification failed. Please try again.' . $e->getMessage());
        }
    }

    public function resendVerification(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);
    
    $user = User::where('email', $request->email)->first();
    
    if (!$user) {
        return back()->with('error', 'User not found.');
    }
    
    // Delete any existing OTP
    OtpCode::where('user_id', $user->id)->delete();
    
    // Generate new OTP
    $otp = sprintf("%06d", mt_rand(1, 999999));
    
    // Store new OTP
    OtpCode::create([
        'user_id' => $user->id,
        'code' => $otp,
        'expires_at' => Carbon::now()->addMinutes(10),
    ]);

    // Send new verification email
    Mail::to($user->email)->send(new VerificationMail($otp));

    return back()->with('success', 'New verification code has been sent to your email.');
}
}