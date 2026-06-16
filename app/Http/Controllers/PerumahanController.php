<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perumahan;
use App\Models\Blok;

class PerumahanController extends Controller
{
    public function index()
{
    $perumahan = Perumahan::paginate(10);

    return view('admin.perumahan', compact('perumahan'));
}

public function edit($id)
{
    $perumahan = Perumahan::findOrFail($id);

    return view('admin.edit-perumahan', compact('perumahan'));
}

public function update(Request $request, $id)
{
    $perumahan = Perumahan::findOrFail($id);

    $perumahan->update([
        'nama_perumahan' => $request->nama_perumahan,
        'lokasi_perumahan' => $request->lokasi_perumahan,
    ]);

    return redirect()->route('admin.perumahan')
        ->with('success', 'Data berhasil diupdate');
}

public function destroy($id)
{
    Perumahan::where('id_perumahan', $id)->delete();

    return redirect()->back()->with('success', 'Data perumahan berhasil dihapus');
}

public function store(Request $request)
{
    $perumahan = new Perumahan();
    $perumahan->nama_perumahan = $request->nama_perumahan;
     $perumahan->lokasi_perumahan = $request->lokasi_perumahan;
    $perumahan->save();

    return redirect()->route('admin.perumahan')
        ->with('success', 'Data berhasil ditambahkan');
}

public function kelolaBlok($id)
{
    $perumahan = Perumahan::with('blok')
                    ->findOrFail($id);

    return view(
        'admin.kelola_blok',
        compact('perumahan')
    );
}
}
