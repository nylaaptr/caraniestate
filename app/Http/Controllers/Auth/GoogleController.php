<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // 1. Redirect ke Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Callback dari Google
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        // cari user
        $user = User::where('email', $googleUser->email)->first();

        // kalau belum ada, buat baru
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(16)),
                'google_avatar' => $googleUser->avatar,
                'profile_photo' => null,
            ]);
        } else {
            // update avatar setiap login Google
            $user->update([
                'name' => $googleUser->name,
                'google_avatar' => $googleUser->avatar,
            ]);
        }

        // 🔥 INI PENTING: login ke session Laravel
        Auth::login($user);

        // regenerate session biar navbar update
        session()->regenerate();

        return redirect('/'); // atau route home kamu
    }
}