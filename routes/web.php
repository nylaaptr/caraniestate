<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Http;

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

Route::post('/save-email-visitor', [VisitorController::class, 'store'])
    ->name('save-email-visitor');

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

// -- NOTIFIKASI --
// Notifikasi (Opsional: bisa public atau protected)
Route::get('/halaman-notifikasi', function () {
    $notifikasi = \App\Models\Notifikasi::where('id_user', Auth::id())
        ->latest()
        ->get()
        ->unique('referensi_id'); // 🔥 biar tidak numpuk

    return view('halaman-notifikasi', compact('notifikasi'));
})->name('halaman-notifikasi')->middleware('auth');

// Mark notifikasi sebagai sudah dibaca
Route::post('/notifikasi/{id}/read', function ($id) {
    $notif = \App\Models\Notifikasi::where('id_user', Auth::id())
        ->findOrFail($id);
    $notif->update(['status_baca' => 1]);
    return response()->json(['success' => true]);
})->name('notifikasi.read')->middleware('auth');

Route::delete('/notifikasi-massal', function () {

    $ids = explode(',', request('ids'));

    \App\Models\Notifikasi::whereIn('id_notifikasi', $ids)
        ->where('id_user', auth()->id())
        ->delete();

    return back()->with('success', 'Notifikasi berhasil dihapus');
})->name('notifikasi.hapus.massal')->middleware('auth');


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

// Route untuk halaman register
Route::get('/register', function () {
    return view('register'); // Pastikan file register.blade.php ada
})->name('register');

// Route untuk memproses register
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');


/*
|--------------------------------------------------------------------------
| 🔒 PROTECTED ROUTES (Hanya User Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // --- FORM PEMESANAN ---
    // Halaman form booking (Hanya bisa diakses jika sudah login)
    Route::get('/form-pemesanan/{id}', function ($id) {
        $properti = \App\Models\Properti::where('id_properti', $id)->firstOrFail();
        return view('form-pemesanan', compact('properti'));
    })->name('form-pemesanan');

    // Proses submit pemesanan
    Route::post('/pemesanan/proses', [App\Http\Controllers\PemesananController::class, 'proses'])
        ->name('pemesanan.proses');


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

    // ✅ Detail Properti (Hanya bisa diakses jika login)
    Route::get('/detail-katalog/{id}', function ($id) {
        $properti = \App\Models\Properti::with('blok')->findOrFail($id);
        return view('detail-katalog', compact('properti'));
    })->name('detail-katalog');

    // --- HALAMAN TERIMS PEMESANAN ---
    // Halaman terima kasih setelah pemesanan
    Route::get('/pemesanan/terima-kasih/{id}', function ($id) {
        $transaksi = \App\Models\Transaksi::with('properti')
            ->where('id_transaksi', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();
        return view('terima-kasih', compact('transaksi'));
    })->name('pemesanan.terima-kasih');


    // --- CHATBOT & PROFIL ---
    // 💡 Chatbot saya letakkan di sini agar bisa akses data user

    // CHATBOT
    Route::post('/chat/send', [ChatBotController::class, 'sendMessage'])->name('chat.send');

    Route::get('/halaman-profil', function () {
        return view('halaman-profil');
    })->name('halaman-profil');

    // 🔥 TAMBAHAN INI
    Route::post('/upload-pp', [UserController::class, 'uploadPP'])->name('upload.pp');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');

});



/*
|--------------------------------------------------------------------------
| 👨‍💻 ADMIN ROUTES (Hanya Admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('admin.welcome');
    })->name('admin.welcome');

    Route::get('/halaman_chatbot', function () {
    return view('admin.halaman_chatbot');
})->name('admin.halaman_chatbot');

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

    Route::delete('/hapus_user/{id}', function ($id) {
    \App\Models\User::where('id_user', $id)->delete();

    return redirect()->route('admin.data_user')
        ->with('success', 'User berhasil dihapus.');
    })->name('admin.hapus_user');


    // ========================
    // VERIFIKASI
    // ========================
    Route::get('/halaman_verifikasi', function () {
        $status = request('status');

        $queryTransaksi = \App\Models\Transaksi::with(['user', 'properti']);
        $queryDokumen = \App\Models\Dokumen::with('user');

        if ($status == 'pending') {
            $queryTransaksi->where('status_transaksi', 'menunggu_verifikasi');
            $queryDokumen->where('status_verifikasi', 'pending');
        } elseif ($status == 'diterima') {
            $queryTransaksi->where('status_transaksi', 'menunggu_pembayaran');
            $queryDokumen->where('status_verifikasi', 'diterima');
        } elseif ($status == 'ditolak') {
            $queryTransaksi->where('status_transaksi', 'ditolak');
            $queryDokumen->where('status_verifikasi', 'ditolak');
        }

        $transaksi = $queryTransaksi->orderBy('tanggal_transaksi', 'desc')->get();
        $user = \App\Models\User::with('dokumen')->get();

        return view('admin.halaman_verifikasi', compact('transaksi', 'user'));
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

    // MELIHAT DOKUMEN
    Route::get('/verifikasi/{id}', function ($id) {
    $user = \App\Models\User::with('dokumen')->findOrFail($id);

    return view('admin.verifikasi_dokumen', compact('user'));
    })->name('admin.verifikasi_dokumen');

    Route::post('/verifikasi/{id}/selesai', function ($id) {
    $user = \App\Models\User::with('dokumen')->findOrFail($id);

    // contoh: cek apakah semua dokumen sudah diterima
    $allApproved = $user->dokumen->every(function ($d) {
        return $d->status_verifikasi === 'diterima';
    });

    // kirim notifikasi ke user
    \App\Models\Notifikasi::create([
        'id_user' => $user->id_user,
        'judul' => 'Verifikasi Selesai',
        'pesan' => $allApproved 
            ? 'Semua dokumen kamu telah diverifikasi.'
            : 'Verifikasi selesai, tapi masih ada dokumen yang perlu diperbaiki.',
        'tipe' => 'dokumen',
        'status_baca' => 0,
        'status_kirim' => 'terkirim',
        'channel' => 'in_app',
        'referensi_id' => $user->id_user,
        'referensi_tipe' => 'user',
    ]);

    return redirect()->route('admin.halaman_verifikasi')
        ->with('success', 'Verifikasi selesai');
    })->name('admin.verifikasi.selesai');

});

// TEST
Route::get('/test-gemini', function () {
    $apiKey = env('GOOGLE_GEMINI_API_KEY');
    $model = env('GOOGLE_GEMINI_MODEL', 'gemini-2.0-flash');
    $url = "https://generativelanguage.googleapis.com/v1/models/{$model}:generateContent?key={$apiKey}";
    
    $response = Http::post($url, [
        'contents' => [[
            'parts' => [['text' => 'Halo, apakah API key Gemini saya berfungsi?']]
        ]]
    ]);
    
    if ($response->successful()) {
        $text = $response->json('candidates.0.content.parts.0.text') ?? 'No response';
        return '✅ API Key Gemini Berhasil! Response: ' . $text;
    }
    
    return '❌ Error ' . $response->status() . ': ' . $response->body();
});