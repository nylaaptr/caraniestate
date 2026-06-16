<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Carani Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #7AB2D3;
            --primary-blue-rgb: 122, 178, 211;
            --dark-blue: #1E3A5F;
            --light-blue: #e6f2f8;
            --sidebar-width: 260px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
        }
        
        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--dark-blue) 0%, #1E3A5F 100%);
            color: white;
            padding: 15px 30px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .logo-icon i {
            font-size: 24px;
            color: var(--dark-blue);
        }
        
        .logo-text {
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }
        
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }
        
        .nav-item {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-item:hover {
            color: var(--primary-blue);
        }
        
        .nav-item.active {
            color: var(--primary-blue);
            font-weight: 600;
        }
        
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-blue);
            transition: width 0.3s ease;
        }
        
        .nav-item:hover::after {
            width: 100%;
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .notification-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }
        
        .notification-icon:hover {
            background: rgba(255,255,255,0.2);
        }
        
        .profile-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .profile-icon:hover {
            background: rgba(255,255,255,0.2);
        }

        .menu-toggle{
            display: none;
            font-size: 22px;
            cursor: pointer;
            padding: 8px 10px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .menu-toggle:hover{
            background: rgba(255,255,255,0.15);
        }

        /* PROFILE DROPDOWN */
        .profile-dropdown {
            position: relative;
            cursor: pointer;
        }

        .profile-icon {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            min-width: 180px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 999;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            color: #333;
            text-decoration: none;
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #f5f5f5;
        }

        .dropdown-menu hr {
            margin: 4px 0;
            border: none;
            border-top: 1px solid #eee;
        }

        /* Tampilkan dropdown */
        .dropdown-menu.show {
            display: block;
        }
        
        /* Main Content */
        .main-content {
            margin: 100px auto 30px;
            max-width: 600px;
            padding: 0 20px;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 25px;
            margin-top: 40px;
        }
        
        /* Notification List */
        .notification-list {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .notification-item {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            border-radius: 14px;
            padding: 18px 22px;
            margin-bottom: 16px;

            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.4);

            display: flex;
            align-items: center;
            gap: 16px;

            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .notification-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.12);
        }

        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .notification-item:hover {
            background: #f8fafc;
        }
        
        .notification-icon-container {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            flex-shrink: 0;
        }
        
        .notification-icon-container.mail {
            background: #f1f5f9;
            color: #64748b;
        }
        
        .notification-icon-container.warning {
            background: #fef3c7;
            color: #f59e0b;
        }
        
        .notification-icon-container.info {
            background: #dbeafe;
            color: #2563eb;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1a365d;
            margin-bottom: 6px;
        }
        
        .notification-description {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.5;
        }
        
        .notification-arrow {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            flex-shrink: 0;
        }
        
        .notification-arrow i {
            font-size: 12px;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }
        
        .empty-icon {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 20px;
        }
        
        .empty-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 10px;
        }
        
        .empty-description {
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Profilll */
            .profile-avatar,
            .profile-avatar-default {
                width: 35px;
                height: 35px;
                border-radius: 50%;
                object-fit: cover;
            }

            .profile-avatar-default {
                background: #7AB2D3;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
            }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .header{
                padding: 15px;
            }

            .header-container{
                display: flex;
                flex-direction: row;      /* ← jadi satu baris */
                align-items: center;
                justify-content: space-between; /* ← kiri & kanan */
                width: 100%;
            }

            /* tombol toggle muncul di mobile */
            .menu-toggle{
                display: block;
                color: white;
                order: 2;
            }

            /* nav jadi dropdown */
            .nav-menu{
                display: none;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: linear-gradient(135deg, var(--dark-blue) 0%, #1E3A5F 100%);
                flex-direction: column;
                padding: 15px 0;
                gap: 0;
                box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            }

            .nav-menu.show{
                display: flex;
            }

            .nav-item{
                padding: 12px 20px;
                width: 100%;
            }

            .nav-item::after{
                display: none;
            }
            
            .logo-text {
                font-size: 1rem;
            }
            
            .user-actions {
                margin-left: auto;   /* ← dorong ke kanan */
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .main-content {
                margin: 80px auto 30px;
                padding: 0 15px;
            }
            
            .page-title {
                font-size: 1.3rem;
            }
            
            .notification-item {
                padding: 16px;
            }
            
            .notification-icon-container {
                width: 36px;
                height: 36px;
            }
            
            .notification-arrow {
                width: 18px;
                height: 18px;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 15px;
            }
            
            .logo-text {
                display: none;
            }
            
            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
            
            .main-content {
                padding: 0 10px;
            }
            
            .page-title {
                font-size: 1.2rem;
            }
            
            .notification-item {
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    {{ Auth::check() ? 'LOGIN BERHASIL' : 'BELUM LOGIN' }}
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="logo-text">Carani Estate</div>
            </div>

            <div class="menu-toggle" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>
            <nav class="nav-menu" id="navMenu">
                <a href="{{ route('welcome') }}"
                class="nav-item {{ request()->routeIs('welcome') ? 'active' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('tentang-kami') }}"
                class="nav-item {{ request()->routeIs('tentang-kami') ? 'active' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('halaman-katalog') }}"
                class="nav-item {{ request()->routeIs('halaman-katalog') ? 'active' : '' }}">
                    Katalog
                </a>
                <a href="{{ route('halaman-chatbot') }}"
                class="nav-item {{ request()->routeIs('halaman-chatbot') ? 'active' : '' }}">
                    ChatBot
                </a>
                @auth
                <a href="{{ route('riwayat-pemesanan') }}" class="nav-item {{ request()->routeIs('riwayat-pemesanan') ? 'active' : '' }}">
                    Riwayat Pemesanan
                </a>
                @endauth
                <a href="{{ route('halaman-kontak') }}"
                class="nav-item {{ request()->routeIs('kontak') ? 'active' : '' }}">
                    Kontak
                </a>
            </nav>
            
            <div class="user-actions">

                {{-- Notifikasi hanya kalau login --}}
                @auth
                <a href="{{ route('halaman-notifikasi') }}" class="notification-icon" style="position:relative;">
                    <i class="fas fa-bell"></i>

                    @php
                        $jumlahBelumBaca = \App\Models\Notifikasi::where('id_user', Auth::id())
                            ->where('status_baca', 0)->count();
                    @endphp

                    @if($jumlahBelumBaca > 0)
                        <span style="position:absolute; top:-5px; right:-5px; 
                                    background:#ef4444; color:white; border-radius:50%; 
                                    width:18px; height:18px; font-size:0.65rem; 
                                    display:flex; align-items:center; justify-content:center;
                                    font-weight:700;">
                            {{ $jumlahBelumBaca > 9 ? '9+' : $jumlahBelumBaca }}
                        </span>
                    @endif
                </a>
                @endauth

                {{-- Guest --}}
                @guest
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="nav-item login-link">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @else
                    {{-- HANYA ICON PROFILE --}}
                    <a href="{{ route('halaman-profil') }}" class="profile-icon">
                        @php
                            $user = Auth::user();
                        @endphp

                        {{-- Prioritas 1: Foto upload user --}}
                        @if($user->profile_photo)

                            <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
                                class="profile-avatar"
                                alt="Profile Photo">

                        {{-- Prioritas 2: Foto Google --}}
                        @elseif($user->google_avatar)

                            <img src="{{ $user->google_avatar }}"
                                class="profile-avatar"
                                referrerpolicy="no-referrer"
                                alt="Google Photo"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}'">

                        {{-- Prioritas 3: Inisial --}}
                        @else

                            <div class="profile-avatar-default">
                                {{ strtoupper(substr($user->nama_user, 0, 1)) }}
                            </div>

                        @endif

                    </a>
                @endguest
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page-title">Notifikasi</h1>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <div>
                <input type="checkbox" id="selectAll">
                <label for="selectAll">Pilih Semua</label>
            </div>

            <button id="deleteSelected"
                style="background:#dc2626; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
                <i class="fas fa-trash"></i> Hapus Terpilih
            </button>

        </div>
        
        <div class="notification-list">
            @forelse($notifikasi ?? [] as $n)
            {{-- ✅ Mapping tipe notifikasi ke icon & style yang sudah ada --}}
            @php

switch($n->tipe) {
    case 'pemesanan':
    case 'transaksi':
        $icon = 'fa-shopping-cart';
        $iconClass = 'mail';
        break;

    case 'dokumen':
    case 'verifikasi':
        $icon = 'fa-file-check';
        $iconClass = 'info';
        break;

    case 'peringatan':
    case 'tagihan':
        $icon = 'fa-exclamation-triangle';
        $iconClass = 'warning';
        break;

    case 'pelunasan':
        $icon = 'fa-money-bill-wave';
        $iconClass = 'warning';
        break;

    default:
        $icon = 'fa-bell';
        $iconClass = 'mail';
}

/* =========================
   RESET SEMUA VAR
========================= */
$transaksi = null;
$pemesanan = null;
$dokumen = null;

/* =========================
   RESOLVE DATA SESUAI TIPE
========================= */
if ($n->tipe == 'pelunasan') {

    $transaksi = \App\Models\Transaksi::find($n->referensi_id);

}

elseif ($n->tipe == 'monitoring') {

    $pemesanan = \App\Models\Pemesanan::find($n->referensi_id);

    if ($pemesanan) {
        $transaksi = $pemesanan->transaksi;
    }

}

elseif ($n->tipe == 'verifikasi') {

    $dokumen = \App\Models\Dokumen::find($n->referensi_id);

}

$link = '#';

/* =====================================================
   AMBIL DATA DASAR
===================================================== */
$transaksi = null;
$pemesanan = null;
$dokumen = null;

if ($n->tipe == 'pelunasan') {

    $transaksi = \App\Models\Transaksi::find($n->referensi_id);

} elseif ($n->tipe == 'verfikasi') {

    $dokumen = \App\Models\Dokumen::find($n->referensi_id);

} else {

    $pemesanan = \App\Models\Pemesanan::find($n->referensi_id);
}

/* =====================================================
   LOGIC PELUNASAN → INVOICE
===================================================== */
if ($n->tipe == 'pelunasan' && $transaksi) {

    $link = route('invoice', $transaksi->id_transaksi);

/* =====================================================
   LOGIC DOKUMEN
===================================================== */
} elseif ($n->tipe == 'dokumen' && $dokumen) {

    $pemesanan = \App\Models\Pemesanan::find($dokumen->id_pemesanan);

    if ($dokumen->status_verifikasi == 'ditolak') {

        $link = route('form-pemesanan', $dokumen->id_pemesanan);

    } else {

        $link = route('detail-pemesanan', $dokumen->id_pemesanan);
    }

/* =====================================================
   MONITORING / TAHAP LAIN → DETAIL PEMESANAN
===================================================== */
} elseif ($pemesanan) {
    $link = route('detail-pemesanan', $pemesanan->id_pemesanan);
} elseif ($n->tipe == 'transaksi') {
    $link = route('pemesanan.terima-kasih', $n->referensi_id);
}

@endphp
            
            <a href="{{ $link }}" style="text-decoration:none; color:inherit; display:block;">
                <div class="notification-item {{ $n->status_baca == 0 ? 'unread' : '' }}">
                    <input type="checkbox" class="notif-checkbox" value="{{ $n->id_notifikasi }}" 
                        onclick="event.stopPropagation();">

                    <div class="notification-icon-container {{ $iconClass }}">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <div class="notification-content">
                        <h3 class="notification-title">{{ $n->judul }}</h3>
                        <p class="notification-description">{{ $n->pesan }}</p>
                        <small class="text-muted" style="font-size:0.8rem;">
                            {{ \Carbon\Carbon::parse($n->created_at)->diffForHumans() }}
                        </small>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px;">

                        {{-- 🗑 HAPUS NOTIF --}}
                        <form id="bulkDeleteForm" method="POST" action="{{ route('notifikasi.hapus.massal') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="ids" id="selectedIds">
                        </form>

                        {{-- ➡️ PANAH --}}
                        <div class="notification-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>

                    </div>
                </div>
            </a>
            @empty
            {{-- ✅ Empty state: class tetap sama --}}
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-bell-slash"></i>
                </div>
                <h3 class="empty-title">Belum Ada Notifikasi</h3>
                <p class="empty-description">Kamu akan menerima notifikasi saat ada update pemesanan atau verifikasi dokumen.</p>
            </div>
            @endforelse
        </div>

        {{-- ✅ Pagination (jika pakai) - class Bootstrap tetap utuh --}}
        @if(isset($notifikasi) && method_exists($notifikasi, 'links'))
        <div class="mt-4">
            {{ $notifikasi->links() }}
        </div>
        @endif
    </div>

    <script>
        
        // Add hover effect for desktop
        if (window.innerWidth > 768) {
            const header = document.querySelector('.header');
            const mainContent = document.querySelector('.main-content');
            
            header.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 6px 20px rgba(0,0,0,0.15)';
            });
            
            header.addEventListener('mouseleave', function() {
                this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
            });
        }

        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }

        // Tutup dropdown kalau klik di luar
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.profile-dropdown')) {
                document.getElementById('dropdownMenu').classList.remove('show');
            }
        });

        // Add interactivity to search button
        document.querySelector('.search-btn').addEventListener('click', function() {
            alert('Mencari riwayat pemesanan dengan kriteria yang dipilih...');
        });
        
        // Add interactivity to action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.querySelector('i').className;
                const bookingId = this.closest('tr').querySelector('td:first-child').textContent;
                
                if (action.includes('fa-eye')) {
                    alert(`Menampilkan detail pemesanan: ${bookingId}`);
                } else if (action.includes('fa-times')) {
                    if (confirm(`Apakah Anda yakin ingin membatalkan pemesanan ${bookingId}?`)) {
                        alert(`Pemesanan ${bookingId} berhasil dibatalkan.`);
                        // In a real application, you would update the status in the database
                    }
                }
            });
        });
        
        // Add hover effect to table rows
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.background = '#f8fafc';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.background = '';
            });
        });

        // Tambahkan di akhir script
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function(e) {
                // Jangan jalankan jika klik di elemen yang tidak ingin trigger
                if(e.target.closest('a')) {
                    const notifId = this.dataset.id;
                    
                    // Mark as read via AJAX (tanpa reload)
                    if(notifId) {
                        fetch(`/notifikasi/${notifId}/read`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({})
                        }).catch(err => console.log('Gagal update status baca:', err));
                    }
                }
            });
        });
        
        // Pagination functionality
        document.querySelectorAll('.page-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.page-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                alert(`Menampilkan halaman ${this.textContent}`);
            });
        });

        // TOGGLE NAV
        function toggleMenu(){
            document.getElementById('navMenu').classList.toggle('show');
        }
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function() {

    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.notif-checkbox');
    const deleteBtn = document.getElementById('deleteSelected');
    const selectedIdsInput = document.getElementById('selectedIds');

    // SELECT ALL
    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    // DELETE SELECTED
    deleteBtn.addEventListener('click', function() {
        let selected = [];

        checkboxes.forEach(cb => {
            if (cb.checked) {
                selected.push(cb.value);
            }
        });

        if (selected.length === 0) {
            alert('Pilih notifikasi dulu!');
            return;
        }

        if (!confirm('Hapus notifikasi terpilih?')) return;

        selectedIdsInput.value = selected.join(',');
        document.getElementById('bulkDeleteForm').submit();
    });

});
</script>
</body>
</html>

