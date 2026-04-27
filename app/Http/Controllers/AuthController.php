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
    // AuthController.php

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

        $user = User::where('email_user', $request->email)->first();

        // AuthController.php - method login()

        if ($user && Hash::check($request->password, $user->password_user)) {
            
            Auth::login($user);
            $request->session()->regenerate();

            // 🔥 AMBIL PARAMETER 'redirect' (pakai input() lebih reliable)
            $redirectUrl = $request->input('redirect');

            if ($redirectUrl && str_starts_with($redirectUrl, '/')) {
                return redirect($redirectUrl);
            }

            // Fallback jika redirect tidak valid / tidak ada
            if ($user->role_user === 'admin') {
                return redirect()->route('admin.welcome');
            }

            return redirect()->route('halaman-katalog');
        }

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

    // REGISTER
    public function register(Request $request)
    {
        // 🔥 1. VALIDASI INPUT
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email_user' => 'required|email|unique:users,email_user',
            'no_hp' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:100',
            'password_user' => 'required|min:8|confirmed',
        ], [
            // Custom error messages (opsional tapi disarankan)
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'email_user.required' => 'Email wajib diisi',
            'email_user.email' => 'Format email tidak valid',
            'email_user.unique' => 'Email sudah terdaftar',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'password_user.required' => 'Password wajib diisi',
            'password_user.min' => 'Password minimal 8 karakter',
            'password_user.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // 🔥 2. SIMPAN USER KE DATABASE
        $user = User::create([
            'nama_user' => $validated['nama_lengkap'],
            'email_user' => $validated['email_user'],
            'no_hp' => $validated['no_hp'],
            'pekerjaan' => $validated['pekerjaan'] ?? null,
            'password_user' => Hash::make($validated['password_user']),
            'role_user' => 'user', // default role
        ]);

        // 🔥 3. REDIRECT KE WELCOME DENGAN PESAN SUKSES
        return redirect()->route('welcome')
            ->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}