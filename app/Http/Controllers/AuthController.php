<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // ALGORITMA REGISTRASI
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ], [
            'password.min' => 'Password minimal 8 karakter',
            'email.unique' => 'Email sudah digunakan',
        ]);

        // Simpan user ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'user',
            'email_verified_at' => now(), // Langsung verifikasi tanpa kirim email
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // ALGORITMA LOGIN
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input tidak kosong
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kecocokan email dan password
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user() && Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            
            return redirect()->intended('/');
        }

        // Jika tidak cocok
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    // Password Reset Methods
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Generate token dan kirim email (sederhana)
        $token = Str::random(64);
        
        // Simpan token di database atau kirim email
        // Untuk sementara, langsung redirect ke reset password
        
        return redirect()->route('password.reset', ['token' => $token])
            ->with('email', $request->email);
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);

        return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login.');
    }
}