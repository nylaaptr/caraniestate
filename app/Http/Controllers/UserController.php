<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        return view('data_user', compact('users')); // sesuaikan dengan blade kamu
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
}