<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan - Carani Estate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            font-family: "Roboto", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
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
            max-width: 1200px;
            margin: 0 auto;
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
        
        /* Main Content */
        .main-content {
            margin-top: 85px;
            padding: 30px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* =========================================
           CUSTOM UI COMPONENTS
           ========================================= */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .page-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .breadcrumb {
            font-size: 0.9rem;
            color: #64748b;
        }
        .breadcrumb a { color: var(--primary-blue); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb i { color: #cbd5e1; margin: 0 6px; font-size: 0.75rem; }
        .breadcrumb span { color: #334155; font-weight: 500; }

        .btn-back {
            padding: 8px 16px;
            background: white;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-back:hover { background: #f8fafc; border-color: var(--dark-blue); color: var(--dark-blue); }

        /* Cards */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.06); }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }
        .card-title i { color: var(--primary-blue); }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .info-item {
            background: #f8fafc;
            padding: 14px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }
        .info-label { font-size: 0.8rem; color: #64748b; margin-bottom: 5px; font-weight: 500; }
        .info-val { font-size: 1rem; font-weight: 600; color: var(--dark-blue); }
        .badge { 
            padding: 6px 12px; 
            border-radius: 20px; 
            font-size: 0.8rem; 
            font-weight: 700; 
            display: inline-flex; align-items: center; gap: 6px; }
        .badge-proses { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
        .badge-selesai { 
            background: #dcfce7; 
            color: #16a34a; 
            border: 1px solid #bbf7d0;}
        .badge-ditolak { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }

        /* Timeline Progress */
        .timeline { position: relative; padding-left: 20px; margin-top: 10px; }
        .timeline::before { content: ''; position: absolute; left: 7px; top: 0; bottom: 0; width: 2px; background: #e2e8f0; border-radius: 2px; }
        .timeline-step { position: relative; padding-left: 35px; margin-bottom: 28px; }
        .timeline-step:last-child { margin-bottom: 0; }
        .timeline-dot { position: absolute; left: -2px; top: 0; width: 18px; height: 18px; border-radius: 50%; background: #cbd5e1; border: 3px solid white; box-shadow: 0 0 0 2px #e2e8f0; z-index: 2; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; }
        .timeline-step.done .timeline-dot { background: #16a34a; border-color: #dcfce7; }
        .timeline-step.active .timeline-dot { background: var(--primary-blue); border-color: #dbeafe; box-shadow: 0 0 0 4px rgba(122, 178, 211, 0.3); }
        .step-title { font-size: 1rem; font-weight: 700; color: var(--dark-blue); margin-bottom: 4px; }
        .step-desc { font-size: 0.88rem; color: #475569; margin-bottom: 3px; line-height: 1.4; background: #f8fafc; padding: 8px 12px; border-radius: 8px; border: 1px solid #e2e8f0; }
        .step-date { font-size: 0.78rem; color: #94a3b8; margin-top: 4px; }

        /* BUTTON INVOICE */
        .btn-invoice{
            display:inline-flex;
            align-items:center;
            gap:6px;
            margin-top:8px;
            padding:6px 12px;
            background:#1E3A5F;
            color:#fff;
            text-decoration:none;
            border-radius:6px;
            font-size:13px;
            font-weight:600;
            transition:.2s;
        }

        .btn-invoice:hover{
            background:#7AB2D3;
        }

        /* Document Lists */
        .doc-list { display: flex; flex-direction: column; gap: 10px; }
        .doc-item { display: flex; align-items: center; justify-content: space-between; padding: 12px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0; transition: 0.2s; }
        .doc-item:hover { background: #f1f5f9; }
        .doc-info { flex: 1; margin-left: 15px; }
        .doc-name { font-weight: 600; color: var(--dark-blue); font-size: 0.95rem; margin-bottom: 3px; }
        .doc-meta { font-size: 0.8rem; color: #64748b; }
        .doc-status { font-size: 0.78rem; font-weight: 600; margin-top: 3px; }
        .status-valid { color: #16a34a; }
        .status-wait { color: #d97706; }
        .status-reject { color: #dc2626; }
        .doc-actions { display: flex; gap: 8px; flex-shrink: 0; }
        .doc-btn { text-decoration: none;padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; background: white; cursor: pointer; font-size: 0.8rem; color: #475569; transition: 0.2s; display: flex; align-items: center; gap: 5px; }
        .doc-btn:hover { border-color: var(--primary-blue); color: var(--primary-blue); background: #f0f9ff; }

        /* Activity List */
        .activity-list { display: flex; flex-direction: column; gap: 12px; }
        .activity-item { display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f1f5f9; }
        .activity-item:last-child { border-bottom: none; padding-bottom: 0; }
        .activity-icon { width: 32px; height: 32px; background: var(--light-blue); color: var(--dark-blue); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
        .activity-content h4 { font-size: 0.9rem; font-weight: 600; color: var(--dark-blue); margin-bottom: 3px; }
        .activity-content p { font-size: 0.82rem; color: #64748b; margin-bottom: 2px; }
        .activity-time { font-size: 0.75rem; color: #94a3b8; }

        /* Responsive */
        @media (max-width: 768px) {
            .header { padding: 12px 15px; }
            .logo-text { display: none; }
            .logo-icon { width: 40px; height: 40px; }
            .menu-toggle { display: block; }
            .nav-menu {
                display: none;
                position: absolute;
                top: 70px; left: 0; width: 100%;
                background: linear-gradient(135deg, var(--dark-blue) 0%, #1E3A5F 100%);
                flex-direction: column; padding: 15px 0;
                box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            }
            .nav-menu.show { display: flex; }
            .nav-item { padding: 12px 20px; width: 100%; }
            .nav-item::after { display: none; }
            .user-actions { margin-left: auto; gap: 10px; }
            .main-content { padding: 15px; margin-top: 70px; }
            .info-grid { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .timeline::before { left: 5px; }
            .timeline-step { padding-left: 25px; }
        }
    </style>
</head>
<body>

    <!-- Header -->
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
    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-clipboard-check" style="color:var(--primary-blue); margin-right:10px;"></i>
                    Detail Pemesanan
                </h1>

                <div class="breadcrumb" style="margin-top:8px;">
                    <a href="{{ route('riwayat-pemesanan') }}">
                        Riwayat Pemesanan
                    </a>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        #{{ $pemesanan->kode_pemesanan }}
                    </span>
                </div>
            </div>

            <a href="{{ route('riwayat-pemesanan') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- 2. Informasi Pemesanan -->
        <div class="card">
            <div class="card-title">
                <i class="fas fa-info-circle"></i>
                Informasi Pemesanan
            </div>

            <div class="info-grid">

                <!-- Nama Properti -->
                <div class="info-item">
                    <div class="info-label">
                        Nama Properti
                    </div>

                    <div class="info-val">
                        {{ $pemesanan->properti->nama_properti }}
                        -
                        {{ $pemesanan->properti->tipe }}
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="info-item">
                    <div class="info-label">
                        Metode Pembayaran
                    </div>

                    <div class="info-val">
                        {{ ucfirst($pemesanan->metode_pembayaran) }}
                    </div>
                </div>

                <!-- Tanggal Pemesanan -->
                <div class="info-item">
                    <div class="info-label">
                        Tanggal Pemesanan
                    </div>

                    <div class="info-val">
                        {{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->translatedFormat('d F Y') }}
                    </div>
                </div>

                <!-- Nomor Pemesanan -->
                <div class="info-item">
                    <div class="info-label">
                        Nomor Pemesanan
                    </div>

                    <div class="info-val">
                        {{ $pemesanan->kode_pemesanan }}
                    </div>
                </div>

                <!-- Total Harga -->
                <div class="info-item">
                    <div class="info-label">
                        Total Harga
                    </div>

                    <div class="info-val">
                        Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Status -->
                <div class="info-item">
                    <div class="info-label">
                        Status Pemesanan
                    </div>

                    @if($pemesanan->status == 'Proses')
                        <div class="status-badge badge-proses">
                            <i class="fas fa-spinner fa-spin"></i>
                            {{ $pemesanan->tahap_saat_ini }}
                        </div>

                    @elseif($pemesanan->status == 'Selesai')
                        <div class="status-badge badge-selesai">
                            <i class="fas fa-check-circle"></i>
                            {{ $pemesanan->tahap_saat_ini }}
                        </div>

                    @else
                        <div class="status-badge badge-ditolak">
                            <i class="fas fa-times-circle"></i>
                            {{ $pemesanan->tahap_saat_ini }}
                        </div>

                    @endif
                </div>
            </div>
        </div>

        <!-- 3. Progress Pemesanan -->
        <!-- 3. Progress Pemesanan -->
        @php
            /*
            |--------------------------------------------------------------------------
            | STEP BERDASARKAN METODE PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            if ($pemesanan->metode_pembayaran == 'kredit') {

                $steps = [
                [
                    'title' => 'Pemesanan Dibuat',
                    'desc'  => 'Formulir pemesanan berhasil dikirim'
                ],

                [
                    'title' => 'Upload Dokumen',
                    'desc'  => 'Pelanggan mengupload dokumen persyaratan'
                ],

                [
                    'title' => 'Verifikasi Dokumen',
                    'desc'  => 'Dokumen diverifikasi admin'
                ],

                [
                    'title' => 'KPR Disetujui Bank',
                    'desc'  => 'Pelanggan telah mendapat persetujuan dari bank'
                ],

                [
                    'title' => 'Proses Notaris',
                    'desc'  => 'Dokumen legal dan akad sedang diproses'
                ],

                [
                    'title' => 'Proses Serah Terima',
                    'desc'  => 'Dokumen rumah sedang dipersiapkan'
                ],

                [
                    'title' => 'Selesai',
                    'desc'  => 'Rumah berhasil diserahkan'
                ],

                ];

            } elseif ($pemesanan->metode_pembayaran == 'cash_bertahap') {

                $steps = [

                    [
                        'title' => 'Pemesanan Dibuat',
                        'desc'  => 'Formulir pemesanan berhasil dikirim'
                    ],

                    [
                        'title' => 'Upload Bukti Booking',
                        'desc'  => 'Bukti booking berhasil diupload'
                    ],

                    [
                        'title' => 'Verifikasi Dokumen',
                        'desc'  => 'Dokumen pelanggan sedang diverifikasi'
                    ],

                    [
                        'title' => 'Pembayaran Cicilan',
                        'desc'  => 'Pembayaran bertahap sedang berlangsung'
                    ],

                    [
                        'title' => 'Pelunasan Pembayaran',
                        'desc'  => 'Menunggu pelunasan pembayaran'
                    ],

                    [
                        'title' => 'Selesai & Serah Terima',
                        'desc'  => 'Properti siap diserahterimakan'
                    ],
                ];

            } else {

                // LUNAS

                $steps = [

                    [
                        'title' => 'Pemesanan Dibuat',
                        'desc'  => 'Formulir pemesanan berhasil dikirim'
                    ],

                    [
                    'title' => 'Upload Dokumen',
                    'desc'  => 'Pelanggan mengupload dokumen persyaratan'
                    ],

                    [
                        'title' => 'Verifikasi Dokumen',
                        'desc'  => 'Dokumen diverifikasi admin'
                    ],

                    [
                        'title' => 'Pelunasan Pembayaran',
                        'desc'  => 'Pembayaran rumah dilunasi pelanggan'
                    ],

                    [
                        'title' => 'Proses Notaris',
                        'desc'  => 'Dokumen legal dan akad sedang diproses'
                    ],

                    [
                        'title' => 'Proses Serah Terima',
                        'desc'  => 'Dokumen rumah sedang dipersiapkan'
                    ],

                    [
                        'title' => 'Selesai',
                        'desc'  => 'Rumah berhasil diserahkan'
                    ],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | STEP AKTIF
            |--------------------------------------------------------------------------
            */

            $currentStep = $pemesanan->tahap_saat_ini;

            $currentIndex = 0;

            foreach ($steps as $index => $step) {

                if ($step['title'] == $currentStep) {
                    $currentIndex = $index;
                }
            }

        @endphp


        <div class="card">
            <div class="card-title">
                <i class="fas fa-route"></i>
                Progress Pemesanan
            </div>

            <div class="timeline">

                @foreach($steps as $index => $step)

                    @php

                        $class = '';

                        // step selesai
                        if ($index < $currentIndex) {

                            $class = 'done';

                        }

                        // step aktif
                        elseif ($index == $currentIndex) {

                            if ($pemesanan->status == 'Selesai') {

                                $class = 'done';

                            }
                            elseif ($pemesanan->status == 'Ditolak') {

                                $class = 'rejected';

                            }
                            else {

                                $class = 'active';

                            }

                        }

                    @endphp

                    <div class="timeline-step {{ $class }}">

                        <!-- DOT -->
                        <div class="timeline-dot">

                            @if($index < $currentIndex)

                                <i class="fas fa-check"></i>

                            @elseif($index == $currentIndex)

                                @if($pemesanan->status == 'Selesai')

                                    <i class="fas fa-check"></i>

                                @elseif($pemesanan->status == 'Ditolak')

                                    <i class="fas fa-times"></i>

                                @else

                                    <i class="fas fa-spinner fa-spin"></i>

                                @endif

                            @endif

                        </div>

                        <!-- TITLE -->
                        <div class="step-title">
                            {{ $step['title'] }}
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="step-desc">
                            @if(
                                $index == $currentIndex &&
                                $pemesanan->catatan_admin
                            )
                                {{ $pemesanan->catatan_admin }}

                            @else
                                {{ $step['desc'] }}
                            @endif

                            {{-- Tombol Invoice --}}
                            @if($step['title'] == 'Pelunasan Pembayaran')

                                <div style="margin-top:10px;">
                                    <a href="{{ route('invoice', $pemesanan->transaksi->id_transaksi) }}"
                                    class="btn-invoice">
                                        <i class="fas fa-file-invoice"></i>
                                        Lihat Invoice
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- TANGGAL / STATUS -->
                        <div class="step-date">

                            {{-- STEP SELESAI --}}
                            @if($index < $currentIndex)

                                <i class="far fa-clock"></i>

                                {{ \Carbon\Carbon::parse($pemesanan->updated_at)->translatedFormat('d M Y, H:i') }} WIB

                            {{-- STEP AKTIF --}}
                            @elseif($index == $currentIndex)

                                {{-- STATUS SELESAI --}}
                                @if($pemesanan->status == 'Selesai')

                                    <span style="color:#16a34a; font-weight:600;">
                                        <i class="fas fa-check-circle"></i>
                                        Selesai
                                    </span>

                                    <br>

                                    {{ \Carbon\Carbon::parse($pemesanan->updated_at)->translatedFormat('d M Y, H:i') }} WIB

                                {{-- STATUS DITOLAK --}}
                                @elseif($pemesanan->status == 'Ditolak')

                                    <span style="color:#dc2626; font-weight:600;">
                                        <i class="fas fa-times-circle"></i>
                                        Ditolak
                                    </span>

                                {{-- STATUS PROSES --}}
                                @else

                                    <div style="
                                        display:flex;
                                        align-items:center;
                                        gap:8px;
                                        flex-wrap:wrap;
                                    ">

                                        <span style="color:#2563eb; font-weight:600;">
                                            <i class="fas fa-spinner fa-spin"></i>
                                            Sedang Diproses
                                        </span>

                                        @if($pemesanan->estimasi_proses)

                                            <span style="
                                                background:#eff6ff;
                                                color:#2563eb;
                                                padding:4px 10px;
                                                border-radius:999px;
                                                font-size:0.78rem;
                                                font-weight:600;
                                            ">
                                                Estimasi:
                                                {{ $pemesanan->estimasi_proses }}
                                            </span>

                                        @endif

                                    </div>

                                @endif

                            {{-- STEP BELUM --}}
                            @else

                                <span style="color:#94a3b8;">
                                    Menunggu proses
                                </span>

                            @endif

                        </div>
                    </div>

                @endforeach

            </div>
        </div>

        <!-- 4. Dokumen Saya -->
        <div class="card">
            <div class="card-title">
                <i class="fas fa-folder-open"></i>
                Dokumen Saya
            </div>

            <div class="doc-list">

                @forelse($pemesanan->dokumen as $dokumen)

                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | STATUS DOKUMEN
                        |--------------------------------------------------------------------------
                        */

                        $statusClass = 'status-wait';
                        $statusText  = 'Menunggu Verifikasi';
                        $statusIcon  = 'fa-clock';

                        if ($dokumen->status_verifikasi == 'diterima') {

                            $statusClass = 'status-valid';
                            $statusText  = 'Terverifikasi Valid';
                            $statusIcon  = 'fa-check-circle';

                        }
                        elseif ($dokumen->status_verifikasi == 'ditolak') {

                            $statusClass = 'status-reject';
                            $statusText  = 'Dokumen Ditolak';
                            $statusIcon  = 'fa-times-circle';

                        }

                    @endphp

                    <div class="doc-item">

                        <!-- INFO -->
                        <div class="doc-info">

                            <!-- NAMA FILE -->
                            <div class="doc-name">
                                @if($dokumen->jenis_dokumen == 'bukti_pembayaran')
                                    <span style="
                                        background:#fef3c7;
                                        color:#92400e;
                                        padding:2px 8px;
                                        border-radius:999px;
                                        font-size:11px;
                                        margin-right:6px;
                                    ">
                                        Bukti Pembayaran
                                    </span>
                                @endif
                                {{ $dokumen->nama_file }}
                            </div>

                            <!-- META -->
                            <div class="doc-meta">

                                Diupload:
                                {{ \Carbon\Carbon::parse($dokumen->created_at)->translatedFormat('d M Y') }}

                                @if($dokumen->sumber_dokumen == 'admin')
                                    • Dokumen dari Admin
                                @endif

                            </div>

                            <!-- STATUS -->
                            <div class="doc-status {{ $statusClass }}">

                                <i class="fas {{ $statusIcon }}"></i>

                                {{ $statusText }}

                            </div>

                            <!-- CATATAN ADMIN -->
                            @if($dokumen->catatan_verifikasi)

                                <div style="
                                    margin-top:6px;
                                    font-size:0.8rem;
                                    color:#64748b;
                                ">

                                    Catatan:
                                    {{ $dokumen->catatan_verifikasi }}

                                </div>

                            @endif

                        </div>

                        <!-- ACTION -->
                        <div class="doc-actions">

                            <!-- LIHAT -->
                            <a href="{{ asset('storage/' . $dokumen->path_file) }}"
                            target="_blank"
                            class="doc-btn">

                                <i class="fas fa-eye"></i>
                                Lihat

                            </a>

                            <!-- DOWNLOAD -->
                            <a href="{{ asset('storage/' . $dokumen->path_file) }}"
                            download
                            class="doc-btn">

                                <i class="fas fa-download"></i>
                                Unduh

                            </a>

                        </div>

                    </div>

                @empty

                    <div style="
                        padding:20px;
                        text-align:center;
                        color:#94a3b8;
                    ">

                        Belum ada dokumen

                    </div>

                @endforelse

            </div>

        </div>

        <!-- 5. Dokumen dari Admin -->
        <!-- Dokumen Dari Admin -->
        <div class="card">
            <div class="card-title">
                <i class="fas fa-building"></i>
                Dokumen dari Admin
            </div>

            <p style="color:#64748b; font-size:0.9rem; margin-bottom:15px;">
                Dokumen resmi dari perusahaan yang dapat Anda lihat dan unduh.
            </p>

            <div class="doc-list">

                @php
                    $dokumenAdmin = $pemesanan->dokumen
                        ->where('sumber_dokumen', 'admin');
                @endphp

                @forelse($dokumenAdmin as $dokumen)

                    <div class="doc-item">

                        <!-- Info -->
                        <div class="doc-info">

                            <!-- Nama File -->
                            <div class="doc-name">
                                {{ $dokumen->nama_file }}
                            </div>

                            <!-- Tanggal Upload -->
                            <div class="doc-meta">
                                Diupload Admin:
                                {{ \Carbon\Carbon::parse($dokumen->created_at)->translatedFormat('d M Y') }}
                            </div>

                        </div>

                        <!-- Action -->
                        <div class="doc-actions">
                            <!-- Lihat -->
                            <a href="{{ asset('storage/' . $dokumen->path_file) }}"
                            target="_blank"
                            class="doc-btn">

                                <i class="fas fa-eye"></i>
                                Lihat
                            </a>

                            <!-- Download -->
                            <a href="{{ asset('storage/' . $dokumen->path_file) }}"
                            download
                            class="doc-btn">

                                <i class="fas fa-download"></i>
                                Unduh
                            </a>
                        </div>
                    </div>

                @empty

                    <div class="doc-item">

                        <div class="doc-info">

                            <div class="doc-name">
                                Belum ada dokumen dari admin
                            </div>

                            <div class="doc-meta">
                                Dokumen perusahaan akan muncul di sini
                            </div>

                        </div>

                        <div class="doc-actions">
                            <button class="doc-btn"
                                    style="opacity:0.5; cursor:not-allowed;"
                                    disabled>

                                <i class="fas fa-clock"></i>
                                Menunggu
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>        
    </main>

    <script>
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('show');
        }
    </script>
</body>
</html>

