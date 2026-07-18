<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\LogAktivitas;

class AuthController extends Controller
{
    // =========================
    // HALAMAN LOGIN
    // =========================
    public function index()
    {
        return view('login');
    }

    // =========================
    // LOGIN MANUAL
    // =========================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email_user', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password_user)) {

            Auth::login($user);
            $request->session()->regenerate();

            // LOG AKTIVITAS LOGIN
            LogAktivitas::create([
                'id_user' => $user->id_user,
                'aktivitas' => 'Login ke sistem',
                'icon' => 'fa-right-to-bracket',
                'tipe' => 'login'
            ]);

            if ($user->role_user === 'admin') {
                return redirect()->route('admin.welcome');
            }

            return redirect()->route('welcome');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->withInput($request->except('password'));
    }

    // =========================
    // GOOGLE LOGIN
    // =========================
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email_user', $googleUser->email)->first();
            if (!$user) {

                $user = User::create([
                    'nama_user' => $googleUser->name,
                    'email_user' => $googleUser->email,
                    'no_hp' => '-',
                    'password_user' => bcrypt('google-login'),
                    'role_user' => 'customer',
                    'google_id' => $googleUser->id,
                    'google_avatar' => $googleUser->avatar,
                ]);

            } else {

                $user->update([
                    'google_id' => $googleUser->id,
                    'google_avatar' => $googleUser->avatar,
                ]);
            }

            Auth::login($user);
            request()->session()->regenerate();

            // LOG AKTIVITAS GOOGLE LOGIN
            LogAktivitas::create([
                'id_user' => $user->id_user,
                'aktivitas' => 'Login menggunakan Google',
                'icon' => 'fa-google',
                'tipe' => 'login'
            ]);

            return redirect()->route('welcome');

        } catch (\Exception $e) {
    dd($e->getMessage());
}
    }

    // =========================
    // FORM GANTI PASSWORD
    // =========================
    public function formGantiPassword(Request $request)
    {
        $email = $request->query('email');

        return view('gantipass', compact('email'));
    }

    // =========================
    // UPDATE PASSWORD
    // =========================
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user,email_user',
            'password_baru' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email_user', $request->email)->first();

        if ($user) {

            $user->update([
                'password_user' => Hash::make($request->password_baru)
            ]);
        }

        return redirect()->route('login')->with('success', 'Password berhasil diubah.');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        $user = Auth::user();

        // LOG SEBELUM LOGOUT
        if ($user) {
            LogAktivitas::create([
                'id_user' => $user->id_user,
                'aktivitas' => 'Logout dari sistem',
                'icon' => 'fa-right-from-bracket',
                'tipe' => 'logout'
            ]);
        }

        $role = $user->role_user ?? null;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($role === 'admin') {
            return redirect()->route('login');
        }

        return redirect()->route('welcome');
    }

    // =========================
    // REGISTER
    // =========================
    public function register(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'email_user' => 'required|email|unique:user,email_user',
            'no_hp' => 'required',
            'password_user' => 'required|min:8|confirmed',
        ]);

        $role = ($request->email_user === 'admin@gmail.com') ? 'admin' : 'customer';

        $user = User::create([
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
            'no_hp' => $request->no_hp,
            'password_user' => bcrypt($request->password_user),
            'role_user' => $role,
        ]);

        // LOG REGISTER
        LogAktivitas::create([
            'id_user' => $user->id_user,
            'aktivitas' => 'Mendaftar akun baru',
            'icon' => 'fa-user-plus',
            'tipe' => 'register'
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil.');
    }
}