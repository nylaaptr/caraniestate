<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan form login
    public function index()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        // Cari user berdasarkan email_user (kolom kustom)
        $user = User::where('email_user', $request->email)->first();

        // Verifikasi password
        if ($user && Hash::check($request->password, $user->password_user)) {
            
            // Login user
            Auth::login($user);
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if ($user->role_user === 'admin') {
                // ✅ Lebih baik pakai route name daripada hardcoded URL
                return redirect()->route('admin.welcome'); 
                // Jika admin di project terpisah, gunakan:
                // return redirect('http://127.0.0.1:8001/admin');
            }

            // Redirect user biasa
            return redirect()->intended(route('halaman-katalog'));
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->except('password'));
    }

    // Tampilkan form ganti password
    public function formGantiPassword(Request $request)
    {
        $email = $request->query('email');
        return view('gantipass', compact('email'));
    }

    // Proses update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email'               => 'required|email|exists:users,email_user',
            'password_baru'       => 'required|min:8|confirmed',
        ], [
            'email.exists' => 'Email tidak terdaftar dalam sistem.',
            'password_baru.min' => 'Password minimal 8 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::where('email_user', $request->email)->first();

        if ($user) {
            $user->update([
                'password_user' => Hash::make($request->password_baru)
            ]);
        }

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah! Silakan login dengan password baru.');
    }

    // Logout
    public function logout(Request $request)
    {
        $role = Auth::user()->role_user; // ← cek role sebelum logout
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect berdasarkan role
        if ($role === 'admin') {
            return redirect()->route('login'); // ← admin ke login
        }
        
        return redirect()->route('welcome'); // ← pengguna ke welcome
    }
}