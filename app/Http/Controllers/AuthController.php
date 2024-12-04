<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{
    // Tampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Tampilkan form lupa password
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function register(Request $request)
    {
        // Validasi input registrasi dengan aturan password yang lebih ketat
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'phone' => 'nullable|string|max:15',
            'role' => 'sometimes|in:user,admin'
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'] ?? null,
            'role' => $request->input('role', 'user'), // Default role adalah user
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect berdasarkan role
        return $user->isAdmin()
            ? redirect()->route('admin.dashboard')->with('success', 'Registrasi admin berhasil')
            : redirect()->route('user.dashboard')->with('success', 'Registrasi berhasil');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $user = Auth::user();

            // Langsung cek role dari database
            return $user->role_id === 1
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Anda telah logout');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        // Generate reset token
        $token = Str::random(60);
        $user->reset_token = $token;
        $user->save();

        // TODO: Kirim email reset password
        // Anda perlu mengimplementasikan pengiriman email dengan layanan email Laravel

        return redirect()->back()
            ->with('status', 'Instruksi reset password telah dikirim ke email Anda');
    }

    // Tambahan method untuk reset password (opsional)
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ]
        ]);

        $user = User::where('email', $request->email)
            ->where('reset_token', $request->token)
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Token reset tidak valid']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->reset_token = null; // Hapus token setelah digunakan
        $user->save();

        return redirect()->route('login')->with('status', 'Password berhasil direset');
    }
}

