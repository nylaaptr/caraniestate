<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;        // 🔥 TAMBAH
use Illuminate\Support\Facades\Storage;    // 🔥 TAMBAH

class UserController extends Controller
{
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

    public function create()
    {
        return view('tambah_datauser');
    }

    public function destroy($id)
    {
        User::where('id_user', $id)->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }

    // 🔥🔥🔥 TAMBAHAN UNTUK UPLOAD PP
    public function uploadPP(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // 🔥 WAJIB pakai ini
        $user = Auth::user();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $namaFile);

            $user->profile_photo = $namaFile;
        }

        $user->save();

        return back()->with('success', 'Berhasil upload PP');
    }
}