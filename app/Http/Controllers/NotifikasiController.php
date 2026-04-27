<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Notifikasi extends Controller
{
    public function index()
    {
        $notifikasi = \App\Models\Notifikasi::where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20); // atau ->get() kalau tidak pakai pagination
        
        return view('halaman-notifikasi', compact('notifikasi'));
    }
}
