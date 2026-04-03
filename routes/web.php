<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| 🌐 PUBLIC ROUTES (Bisa diakses Guest & User)
|--------------------------------------------------------------------------
*/

// Home & Company Profile
Route::get('/', function () {
    $unggulan = \App\Models\Properti::with('blok')
                ->where('status_unit', '!=', 'terjual')
                ->limit(3)
                ->get();
    return view('welcome', compact('unggulan'));
})->name('welcome');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');

Route::get('/halaman-kontak', function () {
    return view('halaman-kontak');
})->name('halaman-kontak');

Route::get('/halaman-chatbot', function () {
        return view('halaman-chatbot');
    })->name('halaman-chatbot');

// Katalog Properti (PUBLIC - Bisa dilihat tanpa login)
Route::get('/halaman-katalog', function () {
    $query = \App\Models\Properti::with('blok')
                ->where('status_unit', '!=', 'terjual');

    // Filter logic
    if (request('perumahan')) {
        $query->where('id_perumahan', request('perumahan'));
    }
    if (request('jenis')) {
        $query->where('jenis_properti', request('jenis'));
    }
    if (request('kategori')) {
        $query->where('kategori_properti', request('kategori'));
    }
    if (request('tipe')) {
        $query->where('tipe_properti', request('tipe'));
    }
    if (request('harga')) {
        $harga = request('harga');
        if ($harga == '0-200') {
            $query->whereBetween('harga_properti', [0, 200000000]);
        } elseif ($harga == '200-300') {
            $query->whereBetween('harga_properti', [200000000, 300000000]);
        } elseif ($harga == '300-500') {
            $query->whereBetween('harga_properti', [300000000, 500000000]);
        } elseif ($harga == '500+') {
            $query->where('harga_properti', '>', 500000000);
        }
    }

    $properti = $query->paginate(9);
    return view('halaman-katalog', compact('properti'));
})->name('halaman-katalog');

// Detail Properti (PUBLIC - Bisa dilihat tanpa login)
Route::get('/detail-katalog/{id}', function ($id) {
    $properti = \App\Models\Properti::with('blok')->findOrFail($id);
    return view('detail-katalog', compact('properti'));
})->name('detail-katalog');

// Notifikasi (Opsional: bisa public atau protected)
Route::get('/halaman-notifikasi', function () {
    return view('halaman-notifikasi');
})->name('halaman-notifikasi');


/*
|--------------------------------------------------------------------------
| 🔐 AUTH ROUTES (Login, Logout, Password)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/gantipass', [AuthController::class, 'formGantiPassword'])->name('ganti-password');
Route::post('/gantipass', [AuthController::class, 'updatePassword'])->name('ganti-password.proses');


/*
|--------------------------------------------------------------------------
| 🔒 PROTECTED ROUTES (Hanya User Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // --- FORM PEMESANAN ---
    // Halaman form booking (Hanya bisa diakses jika sudah login)
    Route::get('/form-pemesanan/{id}', function ($id) {
        $properti = \App\Models\Properti::with('blok')->findOrFail($id);
        return view('form-pemesanan', compact('properti'));
    })->name('form-pemesanan');

    // Proses submit pemesanan
    Route::post('/pemesanan/proses', function (\Illuminate\Http\Request $request) {
        // TODO: Validasi & simpan ke tabel Transaksi
        // \App\Models\Transaksi::create([...]);
        
        return redirect()->route('riwayat-pemesanan')->with('success', 'Pemesanan berhasil diajukan!');
    })->name('pemesanan.proses');


    // --- RIWAYAT & DETAIL PEMESANAN ---
    Route::get('/riwayat-pemesanan', function () {
        $transaksi = \App\Models\Transaksi::with('properti')
            ->where('id_user', Auth::id())
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);
        return view('riwayat-pemesanan', compact('transaksi'));
    })->name('riwayat-pemesanan');

    Route::get('/detail-pemesanan/{id}', function ($id) {
        $transaksi = \App\Models\Transaksi::with(['properti', 'user', 'pembayaran', 'kpr'])
            ->where('id_transaksi', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();
        return view('detail-pemesanan', compact('transaksi'));
    })->name('detail-pemesanan');


    // --- CHATBOT & PROFIL ---
    // 💡 Chatbot saya letakkan di sini agar bisa akses data user

    Route::get('/halaman-profil', function () {
        return view('halaman-profil');
    })->name('halaman-profil');

});


/*
|--------------------------------------------------------------------------
| 👨‍💻 ADMIN ROUTES (Hanya Admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('admin.welcome');
    })->name('admin.dashboard');

    // ========================
    // DATA RUMAH
    // ========================
    Route::get('/data_rumah', function () {
        $search = request('search');
        
        if ($search) {
            $properti = \App\Models\Properti::with(['blok', 'perumahan'])
                        ->where('nama_properti', 'like', "%$search%")
                        ->orWhere('tipe_properti', 'like', "%$search%")
                        ->orWhere('jenis_properti', 'like', "%$search%")
                        ->orWhere('status_unit', 'like', "%$search%")
                        ->orWhereHas('perumahan', function($q) use ($search) {
                            $q->where('nama_perumahan', 'like', "%$search%");
                        })
                        ->orWhereHas('blok', function($q) use ($search) {
                            $q->where('nama_blok', 'like', "%$search%");
                        })
                        ->get();
            $isPaginated = false;
        } else {
            $properti = \App\Models\Properti::with(['blok', 'perumahan'])
                        ->paginate(10);
            $isPaginated = true;
        }
        
        return view('admin.data_rumah', compact('properti', 'isPaginated'));
    })->name('admin.data_rumah');

    Route::delete('/hapus_rumah/{id}', function ($id) {
        \App\Models\Properti::where('id_properti', $id)->delete();
        return redirect()->route('admin.data_rumah')->with('success', 'Properti berhasil dihapus.');
    })->name('admin.hapus_rumah');

    Route::get('/edit_rumah/{id}', function ($id) {
        $properti = \App\Models\Properti::with(['blok', 'perumahan'])
                    ->where('id_properti', $id)->firstOrFail();
        return view('admin.edit_rumah', compact('properti'));
    })->name('admin.edit_rumah');

    Route::get('/tambah-rumah', function () {
        return view('admin.tambah-rumah');
    })->name('admin.tambah-rumah');

    // ========================
    // DATA USER
    // ========================
    Route::get('/data_user', function () {
        $search = request('search');
        
        if ($search) {
            $users = \App\Models\User::where('nama_user', 'like', "%$search%")
                        ->orWhere('email_user', 'like', "%$search%")
                        ->orWhere('no_hp', 'like', "%$search%")
                        ->get();
            $isPaginated = false;
        } else {
            $users = \App\Models\User::paginate(10);
            $isPaginated = true;
        }
        
        return view('admin.data_user', compact('users', 'isPaginated'));
    })->name('admin.data_user');

    Route::get('/tambah-datauser', function () {
        return view('admin.tambah-datauser');
    })->name('admin.tambah-datauser');

    Route::post('/tambah-datauser', function () {
        \App\Models\User::create([
            'nama_user'    => request('nama_user'),
            'email_user'   => request('email_user'),
            'no_hp'        => request('no_hp'),
            'password_user' => bcrypt(request('password_user')),
            'role_user'    => request('role_user'),
        ]);

        return redirect()->route('admin.data_user')
            ->with('success', 'User berhasil ditambahkan.');
    })->name('admin.tambah-datauser.simpan');

    Route::get('/edit_user/{id}', function ($id) {
        $user = \App\Models\User::where('id_user', $id)->firstOrFail();
        return view('admin.edit_user', compact('user'));
    })->name('admin.edit_user');

    Route::post('/edit_user/{id}', function ($id) {
        $user = \App\Models\User::where('id_user', $id)->firstOrFail();
        $user->nama_user  = request('nama_user');
        $user->email_user = request('email_user');
        $user->no_hp      = request('no_hp');
        $user->role_user  = request('role_user');

        if (request('password_user')) {
            $user->password_user = bcrypt(request('password_user'));
        }

        $user->save();

        return redirect()->route('admin.data_user')->with('success', 'User berhasil diupdate.');
    })->name('admin.edit_user.update');

    // ========================
    // VERIFIKASI
    // ========================
    Route::get('/halaman_verifikasi', function () {
        $status = request('status');

        $query = \App\Models\Dokumen::with('user');

        if ($status && $status != 'semua') {
            $query->where('status_verifikasi', $status);
        }

        $dokumen = $query->orderBy('uploaded_at', 'desc')->get();

        return view('admin.halaman_verifikasi', compact('dokumen'));
    })->name('admin.halaman_verifikasi');

    Route::post('/verifikasi/{id}/approve', function ($id) {
        $dokumen = \App\Models\Dokumen::findOrFail($id);
        $dokumen->status_verifikasi = 'diterima';
        $dokumen->verified_at = now();
        $dokumen->save();

        \App\Models\Notifikasi::create([
            'id_user' => $dokumen->id_user,
            'judul' => 'Dokumen Disetujui',
            'pesan' => 'Dokumen ' . $dokumen->jenis_dokumen . ' kamu telah diterima.',
            'tipe' => 'dokumen',
            'status_baca' => 0,
            'status_kirim' => 'terkirim',
            'channel' => 'in_app',
            'referensi_id' => $dokumen->id_dokumen,
            'referensi_tipe' => 'dokumen',
        ]);

        return back()->with('success', 'Dokumen disetujui');
    })->name('admin.verifikasi.approve');

    Route::post('/verifikasi/{id}/tolak', function ($id) {
        $dokumen = \App\Models\Dokumen::findOrFail($id);
        $dokumen->status_verifikasi = 'ditolak';
        $dokumen->catatan_verifikasi = request('catatan');
        $dokumen->verified_at = now();
        $dokumen->save();

        return back()->with('success', 'Dokumen ditolak');
    })->name('admin.verifikasi.tolak');

});