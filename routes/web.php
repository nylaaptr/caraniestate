<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\PerumahanController;
use App\Http\Controllers\BlokController;
use App\Helpers\StatusHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\NotifikasiEmail;
use App\Models\LeadEmail;

/*
|--------------------------------------------------------------------------
| 🌐 PUBLIC ROUTES (Bisa diakses Guest & User)
|--------------------------------------------------------------------------
*/

// Home & Company Profile
Route::get('/', function () {
    $unggulan = \App\Models\Properti::with('blok','gambar')
                ->where('status_unit', '!=', 'terjual')
                ->inRandomOrder()
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

// IKLAN
// TRACK VISITOR WEBSITE
Route::post('/track-visitor', function () {

    \App\Http\Controllers\VisitorController::track('website');

    return response()->json([
        'success' => true
    ]);

})->name('track-visitor');


// TRACK VISITOR POPUP
// Route::post('/track-visitor-popup', function () {

//     \App\Http\Controllers\VisitorController::track('popup_email');

//     return response()->json([
//         'success' => true
//     ]);

// })->name('track-visitor-popup');


// Katalog Properti (PUBLIC - Bisa dilihat tanpa login)
Route::get('/halaman-katalog', function () {
    $query = \App\Models\Properti::with('blok','gambar')
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

    $properti = $query->inRandomOrder()->paginate(9);
    return view('halaman-katalog', compact('properti'));
})->name('halaman-katalog');

// Detail Properti (PUBLIC - Bisa dilihat tanpa login)
Route::get('/detail-katalog/{id}', function ($id) {
    $properti = \App\Models\Properti::with('blok','gambar')->findOrFail($id);
    return view('detail-katalog', compact('properti'));
})->name('detail-katalog');



// -- NOTIFIKASI --
// Notifikasi (Opsional: bisa public atau protected)
Route::get('/halaman-notifikasi', function () {
    // tandai semua notif user sebagai sudah dibaca
    \App\Models\Notifikasi::where('id_user', Auth::id())
        ->where('status_baca', 0)
        ->update([
            'status_baca' => 1
        ]);

    // ambil data notif
    $notifikasi = \App\Models\Notifikasi::where('id_user', Auth::id())
        ->latest()
        ->get()
        ->unique('referensi_id');
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
| 🤖 CHATBOT
|--------------------------------------------------------------------------
*/

// halaman chatbot
Route::get(
    '/halaman-chatbot',
    [ChatbotController::class, 'index']
)->name('halaman-chatbot');

// kirim pesan chatbot
Route::post(
    '/chatbot/kirim',
    [ChatbotController::class, 'kirim']
)->name('chatbot.kirim');

// hapus riwayat chat
Route::delete(
    '/chatbot/hapus-riwayat',
    [ChatbotController::class, 'hapusRiwayat']
)->middleware('auth');

// =========================
// AMBIL PESAN TERBARU CHATBOT
// =========================
Route::get('/chatbot/pesan-terbaru', function(Request $request) {

    return response()->json([
        'session_id' => $request->session_id,
        'messages' => \App\Models\ChatbotMessage::where(
            'id_sessions',
            $request->session_id
        )->get()
    ]);

});


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

// kirim chatbot
Route::post('/chatbot/kirim', [ChatbotController::class, 'kirim'])->name('chatbot.kirim');


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
        $transaksi = \App\Models\Transaksi::with('properti','pemesanan')
            ->where('id_user', Auth::id())
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);
        return view('riwayat-pemesanan', compact('transaksi'));
    })->name('riwayat-pemesanan');

    Route::get('/detail-pemesanan/{id}', [MonitoringController::class, 'pelanggan'])
    ->name('detail-pemesanan');



    // ✅ Detail Properti (Hanya bisa diakses jika login)
    Route::get('/detail-katalog/{id}', function ($id) {
        $properti = \App\Models\Properti::with('blok','gambar')->findOrFail($id);
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

    Route::get('/halaman-profil', function () {
        return view('halaman-profil');
    })->name('halaman-profil');

    // 🔥 TAMBAHAN INI
    Route::post('/upload-pp', [UserController::class, 'uploadPP'])->name('upload.pp');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');

});

// PEMBAYARAN LUNAS
Route::get(
    '/invoice/{id}',
    [TransaksiController::class, 'invoice']
)->name('invoice');

Route::get('/invoice/{id}/pdf', [TransaksiController::class, 'downloadPdf'])
    ->name('invoice.pdf');

// Route::post(
//     '/pembayaran-lunas/store',
//     [TransaksiController::class, 'storePembayaranLunas']
// )->name('pembayaran.lunas.store');


// YANG LAMA INI 
Route::get(
    '/pembayaran-lunas/berhasil/{id}',
    function ($id) {

        $transaksi = \App\Models\Transaksi::with('properti')
            ->findOrFail($id);

        return view(
            'terimakasih-pembayaran',
            compact('transaksi')
        );
    }
)->name('pembayaran.lunas.berhasil');

Route::post('/upload-bukti', [DokumenController::class, 'uploadBuktiPembayaran'])
    ->name('user.upload.bukti');

// EMAILLL
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])
    ->name('google.welcome');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])
    ->name('google.callback');

// GMAIL
Route::post('/save-email-visitor', function () {

    $email = request('email');

    // Simpan ke database
    LeadEmail::firstOrCreate(
        [
            'email' => $email
        ],
        [
            'sumber' => 'popup'
        ]
    );

    // Kirim email ke admin
    Mail::to('aylaanputri05@gmail.com')->send(
        new NotifikasiEmail([
            'judul' => 'Lead Baru Masuk',
            'pesan' => 'Ada calon customer baru: ' . $email
        ])
    );

    return back()->with(
        'success',
        'Terima kasih, data berhasil dikirim.'
    );

})->name('save-email-visitor');



/*
|--------------------------------------------------------------------------
| 👨‍💻 ADMIN ROUTES (Hanya Admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth'])->group(function () {

    // ========================
    // DASHBOARD
    // =======================
    Route::get('/', function () {

        // ========================
        // CARD DASHBOARD
        // ========================

        $totalVisitor = \App\Models\VisitorLog::count();

        $totalLeads = \App\Models\LeadEmail::count();

        $totalTransaksi = \App\Models\Transaksi::where(
            'status_transaksi',
            'berhasil'
        )->count();

        $totalUser = \App\Models\User::count();


        // ========================
        // AKTIVITAS TERBARU
        // ========================

        $recentActivities = \App\Models\LogAktivitas::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {

                return [
                    'icon' => $item->icon,
                    'text' => ($item->user->nama_user ?? '-') . ' - ' . $item->aktivitas,
                    'created_at' => $item->created_at
                        ? $item->created_at->toISOString()
                        : null,
                    'time' => $item->created_at
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | CHART PENJUALAN BULANAN
        |--------------------------------------------------------------------------
        */

        $labelBulanan = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        $dataTransaksi = [];
        $dataPendapatan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {

            // Total transaksi per bulan
            $totalTransaksiBulanan = \App\Models\Transaksi::whereMonth(
                'tanggal_transaksi',
                $bulan
            )
            ->whereYear(
                'tanggal_transaksi',
                now()->year
            )
            ->count();

            // Total pendapatan per bulan
            $totalPendapatanBulanan = \App\Models\Transaksi::whereMonth(
                'tanggal_transaksi',
                $bulan
            )
            ->whereYear(
                'tanggal_transaksi',
                now()->year
            )
            ->where('status_transaksi', 'berhasil')
            ->sum('total_harga');

            $dataTransaksi[] = $totalTransaksiBulanan;

            $dataPendapatan[] = $totalPendapatanBulanan;
        }

        /*
        |--------------------------------------------------------------------------
        | CHART PENJUALAN TAHUNAN
        |--------------------------------------------------------------------------
        */

        $labelTahunan = [];

        $dataTahunanTransaksi = [];

        $dataTahunanPendapatan = [];

        $tahunSekarang = now()->year;

        for ($tahun = $tahunSekarang - 4; $tahun <= $tahunSekarang; $tahun++) {

            $labelTahunan[] = $tahun;

            // Total transaksi tahunan
            $totalTransaksiTahunan = \App\Models\Transaksi::whereYear(
                'tanggal_transaksi',
                $tahun
            )->count();

            // Total pendapatan tahunan
            $totalPendapatanTahunan = \App\Models\Transaksi::whereYear(
                'tanggal_transaksi',
                $tahun
            )
            ->where('status_transaksi', 'berhasil')
            ->sum('total_harga');

            $dataTahunanTransaksi[] = $totalTransaksiTahunan;

            $dataTahunanPendapatan[] = $totalPendapatanTahunan;
        }


        /*
        |--------------------------------------------------------------------------
        | CHART STATUS TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $chartStatus = [

            'berhasil' => \App\Models\Transaksi::where(
                'status_transaksi',
                'berhasil'
            )->count(),

            'menunggu_pembayaran' => \App\Models\Transaksi::where(
                'status_transaksi',
                'menunggu_pembayaran'
            )->count(),

            'menunggu_verifikasi' => \App\Models\Transaksi::where(
                'status_transaksi',
                'menunggu_verifikasi'
            )->count(),

            'perlu_upload_ulang' => \App\Models\Transaksi::where(
                'status_transaksi',
                'perlu_upload_ulang'
            )->count(),

            'ditolak' => \App\Models\Transaksi::where(
                'status_transaksi',
                'ditolak'
            )->count(),
        ];


        return view('admin.welcome', compact(
            'totalVisitor',
            'totalLeads',
            'totalTransaksi',
            'totalUser',
            'recentActivities',

            'labelBulanan',
            'dataTransaksi',
            'dataPendapatan',

            'labelTahunan',
            'dataTahunanTransaksi',
            'dataTahunanPendapatan',
            'chartStatus'
        ));

    })->name('admin.welcome');

// AKTIVITI SEMUA
Route::get('/aktivitas', function () {

    $recentActivities = \App\Models\LogAktivitas::with('user')
        ->latest()
        ->get()
        ->map(function ($item) {

            return [
                'id' => $item->id,
                'type' => $item->tipe,
                'icon' => $item->icon,
                'user' => $item->user->nama_user ?? '-',
                'role' => $item->user->role_user ?? 'user',
                'email' => $item->user->email_user ?? '-',
                'desc' => $item->aktivitas,
                'created_at' => $item->created_at
                ? $item->created_at->toISOString()
                : null,
                    ];

        });

    return view('admin.aktivitas', compact('recentActivities'));

})->name('admin.aktivitas');


    // ========================
    // CLEAR LOG
    // ========================
// HAPUS LOG AKTIVITAS PENGGUNA
Route::delete('/clear-logs', function () {

    \App\Models\LogAktivitas::truncate();

    return response()->json([
        'success' => true,
        'message' => 'Semua log aktivitas berhasil dihapus.'
    ]);

})->name('admin.clear_logs');


    // ========================
// PESAN PELANGGAN
// ========================
Route::get('/pesan-pelanggan', function () {

    $allChats = \App\Models\ChatbotMessage::orderBy(
        'created_at',
        'desc'
    )->get();

    $totalActiveChats = $allChats
        ->pluck('id_sessions')
        ->unique()
        ->count();

    $newChatsToday = $allChats
        ->filter(function($chat){

            return \Carbon\Carbon::parse(
                $chat->created_at
            )->isToday();

        })
        ->pluck('id_sessions')
        ->unique()
        ->count();


    // ========================
    // AMBIL SESSION + USER + MESSAGE
    // ========================
    $sessions = \App\Models\ChatSession::with([

        'user',

        'messages' => function($q){

            $q->orderBy(
                'created_at',
                'asc'
            );

        }

    ])->get();


    // ========================
    // SORT SESSION BERDASARKAN CHAT TERBARU
    // ========================
    $sessions = $sessions->sortByDesc(function($session){

        return optional(
            $session->messages->last()
        )->created_at;

    });


    // ========================
    // DATA UNTUK LIST CHAT KIRI
    // ========================
    $chatSessions = $sessions->map(function($session){

        $lastMessage = $session->messages->last();

        $user = $session->user;

        return [

            'session_id' => $session->id_sessions,

            'avatar' => $user?->foto_profil
                ? asset(
                    'storage/' .
                    $user->foto_profil
                )
                : strtoupper(
                    substr(
                        $user?->nama_user ?? 'U',
                        0,
                        1
                    )
                ),

            'nama' => $user?->nama_user
                ?? 'Pengguna',

            // preview chat terakhir
            'preview' => $lastMessage?->message
                ?? 'Belum ada pesan',

            // waktu chat terakhir
            'time' => $lastMessage?->created_at
                ?? $session->created_at,

            // status
            'status' => $session->status_chat

        ];

    });


    // ========================
    // CHAT YANG DIPILIH
    // ========================
    $selectedSessionId = request()->get(
        'chat_session'
    );

    $selectedChat = $sessions
        ->where(
            'id_sessions',
            $selectedSessionId
        )
        ->first();


    // default ambil chat paling atas
    if (!$selectedChat) {

        $selectedChat = $sessions->first();

    }


    // ========================
    // DATA PROPERTI UNTUK MODAL
    // ========================
    $allProperties = \App\Models\Properti::with([
    'blok',
    'gambar',
    'perumahan'
    ])
    ->where('status_unit', 'tersedia')
    ->select(
        'id_properti',
        'id_perumahan',   // 🔥 TAMBAH INI
        'id_blok',
        'nama_properti',
        'jenis_properti',
        'kategori_properti',
        'tipe_properti',
        'harga_properti',
        'luas_bangunan',
        'luas_tanah',
        'stok_unit'
    )
    ->get();


    return view(
        'admin.pesan_pelanggan',
        compact(
            'chatSessions',
            'totalActiveChats',
            'newChatsToday',
            'selectedChat',
            'allProperties'
        )
    );

})->name('admin.pesan_pelanggan');


// ========================
// KIRIM CHAT ADMIN
// ========================
Route::post('/kirim-chat', function(\Illuminate\Http\Request $request){

    $properti = [];

    // ========================
    // AMBIL DATA PROPERTI
    // ========================
    if (
        $request->properti_ids &&
        count($request->properti_ids) > 0
    ) {

    // ENTAR UABH
        $properti = \App\Models\Properti::with([
            'blok',
            'perumahan',
            'gambar'
        ])
        ->whereIn(
            'id_properti',
            $request->properti_ids
        )
        ->select(
            'id_properti',
            'id_perumahan',   // 🔥 TAMBAH INI
            'id_blok',
            'nama_properti',
            'jenis_properti',
            'kategori_properti',
            'tipe_properti',
            'harga_properti',
            'luas_bangunan',
            'luas_tanah',
            'stok_unit'
        )
        ->get();
    }


    // ========================
    // SIMPAN CHAT
    // ========================
    $chat = \App\Models\ChatbotMessage::create([

        'id_sessions' => $request->session_id,
        'sender' => 'admin',
        'message' => $request->message
            ?: 'Berikut rekomendasi properti untuk Anda 😊',
        'properti_data' => json_encode($properti),

        'created_at' => now(),


    ]);


    // ========================
    // RESPONSE
    // ========================
    return response()->json([
        'success' => true,
        'message' => $chat->message,
        'time' => now()->format('H:i'),
        'properti' => $properti
    ]);

})->name('admin.kirim_chat');


    // ========================
    // DATA RUMAH
    // ========================
    Route::get('/data_rumah', function () {

        $search = request('search');

        if ($search) {

            $properti = \App\Models\Properti::with([
                    'blok',
                    'perumahan'
                ])
                ->where('nama_properti', 'like', "%{$search}%")
                ->orWhere('tipe_properti', 'like', "%{$search}%")
                ->orWhere('jenis_properti', 'like', "%{$search}%")
                ->orWhere('status_unit', 'like', "%{$search}%")
                ->orWhereHas('perumahan', function ($q) use ($search) {
                    $q->where(
                        'nama_perumahan',
                        'like',
                        "%{$search}%"
                    );
                })
                ->orWhereHas('blok', function ($q) use ($search) {
                    $q->where(
                        'nama_blok',
                        'like',
                        "%{$search}%"
                    );
                })
                ->get();

            $isPaginated = false;

        } else {

            $properti = \App\Models\Properti::with([
                    'blok',
                    'perumahan',
                    'gambar'
                ])
                ->withCount('gambar')
                ->paginate(10);

            $isPaginated = true;
        }

        return view(
            'admin.data_rumah',
            compact('properti', 'isPaginated')
        );

    })->name('admin.data_rumah');


    Route::delete('/hapus_rumah/{id}', function ($id) {

        \App\Models\Properti::where(
            'id_properti',
            $id
        )->delete();

        return redirect()
            ->route('admin.data_rumah')
            ->with(
                'success',
                'Properti berhasil dihapus.'
            );

    })->name('admin.hapus_rumah');


    Route::get('/edit_rumah/{id}', function ($id) {

        $properti = \App\Models\Properti::with([
                'blok',
                'perumahan'
            ])
            ->where(
                'id_properti',
                $id
            )
            ->firstOrFail();

        return view(
            'admin.edit-datarumah',
            compact('properti')
        );

    })->name('admin.edit_rumah');

    Route::put('/edit_rumah/{id}', function (\Illuminate\Http\Request $request, $id) {
        
        $properti = \App\Models\Properti::findOrFail($id);

        // ======================
        // HAPUS GAMBAR YANG DICENTANG HAPUS
        // ======================
        if ($request->filled('gambar_hapus')) {

            $gambarHapus = \App\Models\GambarProperti::whereIn(
                'id_gambar',
                $request->gambar_hapus
            )->get();

            foreach ($gambarHapus as $gambar) {

                Storage::disk('public')->delete(
                    'images/' . $gambar->path_gambar
                );

                $gambar->delete();
            }
        }

        // ======================
        // UPDATE DATA PROPERTI
        // ======================
        $properti->update([
            'nama_properti'     => $request->nama_properti,
            'jenis_properti'    => $request->jenis_properti,
            'kategori_properti' => $request->kategori_properti,
            'tipe_properti'     => $request->tipe_properti,
            'harga_properti'    => $request->harga_properti,
            'luas_bangunan'     => $request->luas_bangunan,
            'luas_tanah'        => $request->luas_tanah,
            'stok_unit'         => $request->stok_unit,
            'status_unit'       => $request->status_unit,
        ]);

        // ======================
        // TAMBAH GAMBAR BARU
        // ======================
   
        if ($request->hasFile('gambar')) {

            foreach ($request->file('gambar') as $file) {

                $namaFile =
                    time().'_'.
                    uniqid().'.'.
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'images',
                    $namaFile,
                    'public'
                );

                \App\Models\GambarProperti::create([
                    'id_properti' => $properti->id_properti,
                    'path_gambar' => $namaFile
                ]);
            }
        }

        return redirect()
            ->route('admin.data_rumah')
            ->with(
                'success',
                'Data berhasil diupdate'
            );

    })->name('admin.update_rumah');


    
    // ========================
// TAMBAH DATA RUMAH
// ========================

// BLOK 
Route::get('/get-blok/{id_perumahan}', [BlokController::class, 'getByPerumahan']);

// FORM TAMBAH RUMAH
Route::get('/tambah-rumah', function () {
    $blok = \App\Models\Blok::with('perumahan')->get();
    $perumahan = \App\Models\Perumahan::all();

    return view('admin.tambah-rumah', compact('blok', 'perumahan'));

})->name('admin.tambah-rumah');


// SIMPAN DATA RUMAH
Route::post('/tambah-rumah', function (
    \Illuminate\Http\Request $request
) {
    $request->validate([
        'nama_properti'      => 'required',
        'jenis_properti'     => 'required',
        'kategori_properti'  => 'required',
        'tipe_properti'      => 'required',
        'id_blok'            => 'required|exists:blok,id_blok',
        'harga_properti'     => 'required|numeric',
        'luas_bangunan'      => 'required|numeric',
        'luas_tanah'         => 'required|numeric',
        'stok_unit'          => 'required|numeric',
        'status_unit'        => 'required',
        'gambar_properti.*'  => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
    ]);

    $blok = \App\Models\Blok::findOrFail(
        $request->id_blok
    );

    // ========================
    // SIMPAN PROPERTI
    // ========================
    $bookingFee = (int) str_replace(['.', ',', 'Rp', ' '], '', 1000000);
    $properti = \App\Models\Properti::create([

        'id_perumahan'      => $blok->id_perumahan,
        'id_blok'           => $blok->id_blok,

        'nama_properti'     => $request->nama_properti,
        'jenis_properti'    => $request->jenis_properti,
        'kategori_properti' => $request->kategori_properti,
        'tipe_properti'     => $request->tipe_properti,

        'harga_properti'    => $request->harga_properti,

        'bookingFee'        => $bookingFee,

        'luas_bangunan'     => $request->luas_bangunan,
        'luas_tanah'        => $request->luas_tanah,

        'stok_unit'         => max(0, (int) $request->stok_unit),
        'status_unit'       => $request->status_unit,
    ]);

    // ========================
    // SIMPAN GAMBAR
    // ========================
    if ($request->hasFile('gambar')) {

        foreach (
            $request->file('gambar')
            as $file
        ) {

            $namaFile =
                time() . '_' .
                uniqid() . '_' .
                $file->getClientOriginalName();

            $file->storeAs(
                'images',
                $namaFile,
                'public'
            );

            \App\Models\GambarProperti::create([
                'id_properti' => $properti->id_properti,
                'path_gambar' => $namaFile
            ]);
        }
    }

    return redirect()
        ->route('admin.data_rumah')
        ->with(
            'success',
            'Properti berhasil ditambahkan.'
        );

})->name('admin.simpan-rumah');

// PERUMAHAN
Route::get('/admin/perumahan', [PerumahanController::class, 'index'])
    ->name('admin.perumahan');

    Route::get('/tambah-perumahan', function () {
    return view('admin.tambah_perumahan');
})->name('admin.tambah-perumahan');

Route::put('/perumahan/{id}', [PerumahanController::class, 'update'])
    ->name('admin.update-perumahan');

Route::get('/perumahan/{id}/edit', [PerumahanController::class, 'edit'])
    ->name('admin.edit-perumahan');

    Route::delete('/perumahan/{id}', [PerumahanController::class, 'destroy'])
    ->name('admin.hapus-perumahan');

    Route::post('/simpan-perumahan', [PerumahanController::class, 'store'])
    ->name('admin.simpan-perumahan');

    // KELOLA BLOK
    Route::get('/perumahan/{id}/blok', [BlokController::class, 'index'])
    ->name('admin.kelola-blok');

Route::post('/perumahan/{id}/blok', [BlokController::class, 'store'])
    ->name('admin.tambah-blok');

Route::put('/blok/{id}', [BlokController::class, 'update'])
    ->name('admin.update-blok');

Route::delete('/blok/{id}', [BlokController::class, 'destroy'])
    ->name('admin.hapus-blok');


    // ========================
    // DATA USER
    // ========================
    Route::get('/data_user', function () {

        $search = request('search');

        if ($search) {

            $users = \App\Models\User::where(
                    'nama_user',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'email_user',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'no_hp',
                    'like',
                    "%{$search}%"
                )
                ->get();

            $isPaginated = false;

        } else {

            $users = \App\Models\User::paginate(10);

            $isPaginated = true;
        }

        return view(
            'admin.data_user',
            compact('users', 'isPaginated')
        );

    })->name('admin.data_user');


    Route::get('/tambah-datauser', function () {
        return view('admin.tambah-datauser');
    })->name('admin.tambah-datauser');


    Route::post('/tambah-datauser', function () {

        \App\Models\User::create([
            'nama_user' => request('nama_user'),
            'email_user' => request('email_user'),
            'no_hp' => request('no_hp'),
            'password_user' => bcrypt(
                request('password_user')
            ),
            'role_user' => request('role_user'),
        ]);

        return redirect()
            ->route('admin.data_user')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );

    })->name('admin.tambah-datauser.simpan');


    Route::get('/edit_user/{id}', function ($id) {

        $user = \App\Models\User::where(
            'id_user',
            $id
        )->firstOrFail();

        return view(
            'admin.edit_user',
            compact('user')
        );

    })->name('admin.edit_user');


    Route::post('/edit_user/{id}', function ($id) {

        $user = \App\Models\User::where(
            'id_user',
            $id
        )->firstOrFail();

        $user->nama_user = request('nama_user');
        $user->email_user = request('email_user');
        $user->no_hp = request('no_hp');
        $user->role_user = request('role_user');

        if (request('password_user')) {
            $user->password_user = bcrypt(
                request('password_user')
            );
        }

        $user->save();

        return redirect()
            ->route('admin.data_user')
            ->with(
                'success',
                'User berhasil diupdate.'
            );

    })->name('admin.edit_user.update');


    Route::delete('/hapus_user/{id}', function ($id) {

        \App\Models\User::where(
            'id_user',
            $id
        )->delete();

        return redirect()
            ->route('admin.data_user')
            ->with(
                'success',
                'User berhasil dihapus.'
            );

    })->name('admin.hapus_user');

    // UPLOAD BUKTI PELUNASAN
    Route::post('/bukti/{id}/approve', [DokumenController::class, 'approveBukti'])
    ->name('admin.bukti.approve');

Route::post('/bukti/{id}/reject', [DokumenController::class, 'rejectBukti'])
    ->name('admin.bukti.reject');

    // ========================
    // VERIFIKASI
    // ========================
    
    // ✅ HALAMAN LIST VERIFIKASI (Query by Transaksi, bukan User)
    Route::get('/halaman_verifikasi', function () {

        $status = request('status');
        $search = request('search');

        // ✅ Query utama: ambil dari tabel Transaksi
        $query = \App\Models\Transaksi::with([
            'user',
            'dokumen'
        ]);

        // Filter search (cari di data user yang terkait transaksi)
        if ($search) {
            $query->whereHas('user', function($q) use ($search) {
                $q->where('nama_user', 'like', "%{$search}%")
                  ->orWhere('email_user', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Filter status (berdasarkan status dokumen)
        if ($status == 'pending') {
            $query->whereHas('dokumen', function($q) {
                $q->where('status_verifikasi', 'pending');
            });
        } elseif ($status == 'diterima') {
            $query->whereHas('dokumen', function($q) {
                $q->where('status_verifikasi', 'diterima');
            });
        } elseif ($status == 'ditolak') {
            $query->whereHas('dokumen', function($q) {
                $q->where('status_verifikasi', 'ditolak');
            });
        }

        // ✅ Pagination: setiap transaksi = 1 baris
        $verifications = $query
            ->orderBy('id_transaksi', 'desc')  // ✅ Urutkan dari pengajuan terbaru
            ->paginate(5)
            ->withQueryString();

        // ✅ Kirim sebagai 'user' agar kompatibel dengan view lama
        $transaksiLunas = \App\Models\Transaksi::with([
            'user',
            'properti'
        ])
        ->whereNotNull('bukti_transaksi')
        ->orderBy('id_transaksi', 'desc')
        ->paginate(5, ['*'], 'lunas_page');

        return view('admin.halaman_verifikasi', [
            'user' => $verifications,
            'transaksi' => $verifications,
            'transaksiLunas' => $transaksiLunas
        ]);

    })->name('admin.halaman_verifikasi');


    // ✅ APPROVE DOKUMEN
    Route::post('/verifikasi/{id}/approve', function ($id) {

    // ambil dokumen
    $dokumen = \App\Models\Dokumen::findOrFail($id);

    // update status
    $dokumen->update([
        'status_verifikasi' => 'diterima',
        'verified_at' => now()
    ]);

    // ambil transaksi dari id_transaksi
    $transaksi = \App\Models\Transaksi::with('dokumen')
        ->findOrFail($dokumen->id_transaksi);

    // cek apakah semua dokumen sudah diterima
    $masihPending = $transaksi->dokumen()
        ->where('status_verifikasi', '!=', 'diterima')
        ->exists();

    return back()->with(
        'success',
        'Dokumen berhasil disetujui'
    );

})->name('admin.verifikasi.approve');


    // ✅ TOLAK DOKUMEN
    Route::post('/verifikasi/{id}/tolak', function ($id) {

    $dokumen = \App\Models\Dokumen::findOrFail($id);

    $catatan = request('catatan') ?: 'Dokumen ditolak oleh admin';

    // update dokumen
    $dokumen->update([
        'status_verifikasi' => 'ditolak',
        'catatan_verifikasi' => $catatan,
        'verified_at' => now()
    ]);

    // ambil transaksi user
    $transaksi = \App\Models\Transaksi::find($dokumen->id_transaksi);

    if($transaksi){

        // reset transaksi agar user isi ulang
        $transaksi->update([
            'status_transaksi' => 'perlu_upload_ulang'
        ]);

        // buat notifikasi sistem
        \App\Models\Notifikasi::create([
            'id_user' => $transaksi->id_user,
            'judul' => 'Dokumen Ditolak',
            'pesan' => 'Dokumen Anda ditolak admin. Silakan upload ulang dokumen dan isi ulang form pemesanan.',
            'tipe' => 'verifikasi',
            'referensi_id' => $transaksi->id_transaksi,
            'referensi_tipe' => 'transaksi',
            'status_baca' => 0
        ]);

        // kirim email
        $user = \App\Models\User::find($transaksi->id_user);

        if($user && $user->email){
            Mail::raw(
                "Dokumen Anda ditolak.\n\nCatatan Admin: ".$catatan."\n\nSilakan login kembali dan isi ulang form pemesanan.",
                function($message) use ($user){
                    $message->to($user->email)
                            ->subject('Dokumen Pemesanan Ditolak');
                }
            );
        }
    }

    return back()->with('success', 'Dokumen berhasil ditolak');

})->name('admin.verifikasi.tolak');


    // ✅ DETAIL VERIFIKASI PER TRANSAKSI (Fix: kirim $transaksi ke view)
    Route::get('/verifikasi/{id_transaksi}', function ($id_transaksi) {

        // ✅ Ambil transaksi + relasi user & dokumen
        $transaksi = \App\Models\Transaksi::with(['user', 'dokumen'])
            ->findOrFail($id_transaksi);

        // ✅ Kirim 3 variabel ke view
        return view('admin.verifikasi_dokumen', [
            'user' => $transaksi->user,
            'dokumen' => $transaksi->dokumen,
            'transaksi' => $transaksi  // ✅ INI YANG DIBUTUHKAN VIEW
        ]);

    })->name('admin.verifikasi_dokumen');


    // ✅ SELESAI VERIFIKASI
    Route::post('/verifikasi/{id_transaksi}/selesai', function ($id_transaksi) {

        // Optional: update status transaksi jika perlu
        // $transaksi = \App\Models\Transaksi::findOrFail($id_transaksi);
        // $transaksi->status_transaksi = 'diverifikasi';
        // $transaksi->save();

        return redirect()
            ->route('admin.halaman_verifikasi')
            ->with('success', 'Verifikasi selesai');

    })->name('admin.verifikasi.selesai');

    // verifikasi admin
    

    // ========================
    // LAPORAN PENJUALAN
    // ========================

Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])
    ->name('admin.laporan_penjualan');
    Route::get(
    '/admin/laporan-penjualan/export',
    [LaporanPenjualanController::class, 'export']
)->name('laporan.penjualan.export');

    // ========================
    // MONITORING PEMESANAN
    // ========================
Route::get('/monitoring-pemesanan',
    [MonitoringController::class, 'index'])
    ->name('admin.monitoring-pemesanan');

    Route::get('/admin/detail-monitoring/{id}', [App\Http\Controllers\MonitoringController::class, 'show'])
    ->name('monitoring.show');

    // UPDATE MONITORING
    Route::put('/admin/monitoring/{id}', 
    [MonitoringController::class, 'update']
)->name('monitoring.update');

// UPLOAD DOKUMEN ADMIN (MONITORING)
Route::post('/admin/upload-dokumen/{id_pemesanan}', function (
    Illuminate\Http\Request $request,
    $id_pemesanan
) {

    $request->validate([
        'dokumen_admin' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
    ]);

    $pemesanan = \App\Models\Pemesanan::findOrFail($id_pemesanan);

    $file = $request->file('dokumen_admin');

    $namaFile = time() . '_admin_' . $file->getClientOriginalName();

    $path = $file->storeAs('dokumen/admin', $namaFile, 'public');

    /* =========================
       1. DOKUMEN ADMIN
    ========================= */
    \App\Models\Dokumen::create([
        'id_user' => $pemesanan->id_user,
        'id_pemesanan' => $pemesanan->id_pemesanan,
        'id_transaksi' => $pemesanan->id_transaksi,
        'jenis_dokumen' => 'dokumen_admin',
        'nama_file' => $namaFile,
        'path_file' => $path,
        'tipe_file' => $file->getClientMimeType(),
        'ukuran_file' => $file->getSize(),
        'status_verifikasi' => 'diterima',
        'catatan_verifikasi' => '',
        'sumber_dokumen' => 'admin',
    ]);

    /* =========================
       LOG AKTIVITAS
    ========================= */
    \App\Models\LogAktivitas::create([
        'id_user' => auth()->id(),
        'aktivitas' => 'Admin mengupload dokumen "' . $namaFile . '"',
        'icon' => 'fa-upload',
        'tipe' => 'dokumen',
        'ref_id' => $pemesanan->id_pemesanan
    ]);

    /* =========================
       NOTIFIKASI
    ========================= */
    \App\Models\Notifikasi::create([
        'id_user' => $pemesanan->id_user,
        'judul' => 'Dokumen Baru Dari Admin',
        'pesan' => 'Admin mengupload dokumen baru untuk pemesanan Anda.',
        'tipe' => 'dokumen',
        'status_baca' => 0,
        'status_kirim' => 'terkirim',
        'channel' => 'in_app',

        // 🔥 INI YANG BENAR
        'referensi_id' => $pemesanan->id_pemesanan,
        'referensi_tipe' => 'pemesanan',
    ]);

    return back()->with('success', 'Dokumen berhasil diupload');

})->name('admin.upload.dokumen');

// HAPUS DOKUMEN ADMIN
Route::delete('/admin/hapus-dokumen/{id}', function ($id) {

    $dokumen = \App\Models\Dokumen::findOrFail($id);

    // hapus file dari storage
    if (\Storage::disk('public')->exists($dokumen->path_file)) {

        \Storage::disk('public')->delete($dokumen->path_file);
    }

    // hapus data db
    $dokumen->delete();

    return back()->with(
        'success',
        'Dokumen berhasil dihapus'
    );

})->name('admin.hapus.dokumen');
});

// ========================
// VERIFIKASI PEMBAYARAN LUNAS
// ========================
Route::post('/admin/kirim-notif-pelunasan/{id_transaksi}', function ($id_transaksi) {

    $transaksi = \App\Models\Transaksi::findOrFail($id_transaksi);

    // update transaksi
    StatusHelper::sync(
    $transaksi,
    'menunggu_pelunasan',
    'Pelunasan Pembayaran'
);

    // update pemesanan juga
    $transaksi->update([
    'progres' => 'pelunasan',
    'tahap_saat_ini' => 'Pelunasan Pembayaran',
    'status' => 'Proses'
]);

if ($transaksi->pemesanan) {

    $transaksi->pemesanan->update([
        'progres' => 'pelunasan',
        'tahap_saat_ini' => 'Pelunasan Pembayaran',
        'status' => 'Proses'
    ]);

}

    // notif pelanggan
    \App\Models\Notifikasi::create([
        'id_user' => $transaksi->id_user,
        'judul' => 'Pelunasan Pembayaran',
        'pesan' =>
            'Silakan lakukan pelunasan pembayaran dan upload bukti transfer.',
        'tipe' => 'pelunasan',
        'status_baca' => 0,
        'status_kirim' => 'terkirim',
        'channel' => 'in_app',
        'referensi_id' => $transaksi->id_transaksi,
        'referensi_tipe' => 'transaksi'
    ]);

    return back()->with(
        'success',
        'Notifikasi pelunasan berhasil dikirim'
    );

})->name('admin.kirim.notif.pelunasan');

Route::post('/admin/pembayaran_lunas/{id_transaksi}', function ($id_transaksi) {

    $transaksi = \App\Models\Transaksi::findOrFail($id_transaksi);

    // update status pembayaran
    StatusHelper::sync(
    $transaksi,
    'selesai',
    'Selesai'
);

    // notif ke pelanggan
    \App\Models\Notifikasi::create([
        'id_user' => $transaksi->id_user,
        'judul' => 'Pembayaran Diverifikasi',
        'pesan' =>
            'Pembayaran lunas Anda berhasil diverifikasi admin.',
        'tipe' => 'transaksi',

        'status_baca' => 0,

        'status_kirim' => 'terkirim',

        'channel' => 'in_app',

        'referensi_id' => $transaksi->id_transaksi,

        'referensi_tipe' => 'transaksi'
    ]);

    // log aktivitas
    \App\Models\LogAktivitas::create([

        'id_user' => auth()->id(),

        'aktivitas' =>
            'Admin memverifikasi pembayaran lunas transaksi #' .
            $transaksi->id_transaksi,

        'icon' => 'fa-check-circle',

        'tipe' => 'verifikasi',

        'ref_id' => $transaksi->id_transaksi
    ]);

    return back()->with(
        'success',
        'Pembayaran berhasil diverifikasi'
    );

})->name('admin.verifikasi.pembayaran');




    // ========================
    // TEST EMAIL
    // ========================
    Route::get('/test-email', function () {

    // Ganti email perus
        Mail::to('naylawardhani96@gmail.com')->send(
            new NotifikasiEmail([
                'judul' => 'Tes Notifikasi',
                'pesan' => 'Ini email dari sistem 🚀'
            ])
        );
        return 'Email terkirim!';
    });
