<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blok;
use App\Models\Perumahan;

class BlokController extends Controller
{
    public function index($id)
    {
        $perumahan = Perumahan::findOrFail($id);
        $blok = Blok::where('id_perumahan', $id)->get();

        return view('admin.kelola-blok', compact('perumahan', 'blok'));
    }

    public function store(Request $request, $id)
    {
        Blok::create([
            'id_perumahan' => $id,
            'nama_blok' => $request->nama_blok,
            'jumlah_unit' => $request->jumlah_unit,
        ]);

        return back()->with('success', 'Blok berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $blok = Blok::findOrFail($id);
        $blok->update([
            'nama_blok' => $request->nama_blok,
        ]);

        return back()->with('success', 'Blok berhasil diupdate');
    }

    public function destroy($id)
    {
        Blok::findOrFail($id)->delete();
        return back()->with('success', 'Blok berhasil dihapus');
    }

    // NGAMBIL DATA BLOK SESUAI DENGAN PERUMAHAN (DI HALAMAN TAMBAH RUMAH)
    public function getByPerumahan($id)
{
    return Blok::where('id_perumahan', $id)->get();
}
}