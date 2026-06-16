<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // =========================
    // TAMPIL DATA USER (ADMIN)
    // =========================
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $search = str_replace(' ', '', strtolower($request->search));

            $query->whereRaw("REPLACE(LOWER(nama_user), ' ', '') LIKE ?", ["%$search%"])
                  ->orWhereRaw("REPLACE(LOWER(email_user), ' ', '') LIKE ?", ["%$search%"])
                  ->orWhereRaw("REPLACE(LOWER(no_hp), ' ', '') LIKE ?", ["%$search%"]);
        }

        $users = $query->paginate(10)->withQueryString();

        return view('data_user', compact('users'));
    }

    // =========================
    // FORM TAMBAH USER
    // =========================
    public function create()
    {
        return view('tambah_datauser');
    }

    // =========================
    // HAPUS USER
    // =========================
    public function destroy($id)
    {
        User::where('id_user', $id)->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }


    // =========================
    // UPLOAD PROFIL
    // =========================
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    // =========================
    // UPLOAD FOTO PROFIL
    // =========================
    public function uploadPP(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $user = Auth::user();

    if ($request->hasFile('photo')) {

        // hapus foto lama kalau ada
        if ($user->profile_photo) {
            Storage::disk('public')->delete(
                'profile_photos/' . $user->profile_photo
            );
        }

        // upload foto baru
        $file = $request->file('photo');

        // simpan ke storage/app/public/profile_photos
        $path = $file->store('profile_photos', 'public');

        // simpan nama file ke database
        $user->profile_photo = basename($path);
        $user->save();
    }

    return back()->with('success', 'Foto profil berhasil diperbarui.');
}
}