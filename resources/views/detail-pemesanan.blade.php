<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan - PropertiHarmoni</title>
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
        
        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 30px;
        }

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
        
        .detail-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .detail-header {
            background: #f8fafc;
            padding: 25px 30px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .status-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #f59e0b;
        }
        
        .status-approved {
            background: #d1fae5;
            color: #059669;
        }
        
        .status-rejected {
            background: #fecaca;
            color: #dc2626;
        }
        
        .status-paid {
            background: #dbeafe;
            color: #2563eb;
        }
        
        .detail-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-blue);
        }
        
        /* Property Section */
        .property-section {
            padding: 30px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-blue);
        }
        
        .property-card {
            display: flex;
            gap: 25px;
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        
        .property-image {
            width: 180px;
            height: 180px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .property-info {
            flex: 1;
        }
        
        .property-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 10px;
        }
        
        .property-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            margin-bottom: 15px;
        }
        
        .property-location i {
            color: var(--primary-blue);
        }
        
        .property-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 15px;
        }
        
        .property-specs {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .spec-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            color: #4a5568;
        }
        
        .spec-item i {
            color: var(--primary-blue);
        }
        
        /* Customer Info Section */
        .customer-section {
            padding: 30px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
        }
        
        .info-label {
            font-size: 0.95rem;
            color: #64748b;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-blue);
        }
        
        /* Payment Section */
        .payment-section {
            padding: 30px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .payment-details {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
        }
        
        .payment-title {
            font-weight: 700;
            color: #059669;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .payment-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #d1fae5;
        }
        
        .payment-item:last-child {
            border-bottom: none;
        }
        
        .payment-label {
            color: #64748b;
        }
        
        .payment-value {
            font-weight: 600;
            color: var(--dark-blue);
        }
        
        .total-payment {
            font-size: 1.4rem;
            font-weight: 800;
            color: #059669;
            text-align: right;
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid #d1fae5;
        }
        
        /* Document Section */
        .document-section {
            padding: 30px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .document-item {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }
        
        .document-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 28px;
        }
        
        .document-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 8px;
        }
        
        .document-status {
            font-size: 0.85rem;
            padding: 4px 10px;
            border-radius: 20px;
            display: inline-block;
        }
        
        .status-complete {
            background: #d1fae5;
            color: #059669;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #f59e0b;
        }
        
        /* Upload Section */
        .upload-section {
            padding: 30px;
        }
        
        .upload-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 20px;
        }
        
        .upload-area {
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .upload-area:hover {
            border-color: var(--primary-blue);
            background: #f0f9ff;
        }
        
        .upload-icon {
            font-size: 3.5rem;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }
        
        .upload-text {
            font-size: 1.1rem;
            color: #4a5568;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .upload-hint {
            font-size: 0.9rem;
            color: #94a3b8;
        }
        
        .file-input {
            display: none;
        }
        
        .file-name {
            margin-top: 15px;
            font-size: 0.95rem;
            color: var(--primary-blue);
            font-weight: 600;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            padding: 25px 30px;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
        }
        
        .btn {
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-primary {
            background: var(--primary-blue);
            color: white;
        }
        
        .btn-primary:hover {
            background: #6aa5c6;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(var(--primary-blue-rgb), 0.3);
        }
        
        .btn-secondary {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-secondary:hover {
            background: #cbd5e0;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }
        
        /* Timeline */
        .timeline {
            position: relative;
            padding: 20px 0;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--primary-blue);
        }
        
        .timeline-item {
            position: relative;
            padding-left: 50px;
            margin-bottom: 25px;
        }
        
        .timeline-item:last-child {
            margin-bottom: 0;
        }
        
        .timeline-dot {
            position: absolute;
            left: 12px;
            top: 8px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--primary-blue);
            border: 3px solid white;
        }
        
        .timeline-dot.complete {
            background: #10b981;
        }
        
        .timeline-dot.pending {
            background: #f59e0b;
        }
        
        .timeline-date {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 5px;
        }
        
        .timeline-text {
            font-weight: 600;
            color: var(--dark-blue);
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
            
            .nav-menu {
                display: none;
                margin-bottom: 20px;
            }
            
            .user-actions {
                margin-left: auto;   /* ← dorong ke kanan */
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .property-card {
                flex-direction: column;
                text-align: center;
            }
            
            .property-image {
                margin: 0 auto;
            }
            
            .info-grid,
            .payment-grid,
            .document-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .timeline::before {
                left: 15px;
            }
            
            .timeline-item {
                padding-left: 45px;
            }
            
            .timeline-dot {
                left: 7px;
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
                padding: 15px;
            }
            
            .detail-title {
                font-size: 1.3rem;
            }
            
            .property-name {
                font-size: 1.2rem;
            }
            
            .property-image {
                width: 150px;
                height: 150px;
            }
        }
    </style>
</head>
<body>
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
                    <a href="{{ route('login') }}" class="nav-item login-link">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @else
                    {{-- HANYA ICON PROFILE --}}
                    <a href="{{ route('halaman-profil') }}" class="profile-icon">
                        <img src="{{ Auth::user()->profile_photo 
                            ? asset('storage/profile_photos/' . Auth::user()->profile_photo) 
                            : asset('default-avatar.png') }}" 
                            alt="Profile" class="profile-img">
                    </a>
                @endguest
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="detail-container">
            <!-- Detail Header -->
            <div class="detail-header">
                <h2 class="detail-title">
                    Detail Pemesanan #{{ str_pad($transaksi->id_transaksi, 3, '0', STR_PAD_LEFT) }}
                </h2>
                @php
                    $statusClass = match($transaksi->status_transaksi) {
                        'menunggu_pembayaran'  => 'status-pending',
                        'menunggu_verifikasi'  => 'status-pending',
                        'berhasil'             => 'status-approved',
                        'ditolak'              => 'status-rejected',
                        default                => 'status-pending'
                    };
                    $statusLabel = match($transaksi->status_transaksi) {
                        'menunggu_pembayaran'  => 'Menunggu Pembayaran',
                        'menunggu_verifikasi'  => 'Menunggu Verifikasi',
                        'berhasil'             => 'Berhasil',
                        'ditolak'              => 'Ditolak',
                        default                => $transaksi->status_transaksi
                    };
                @endphp
                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
            </div>

            <!-- Detail Properti -->
            <div class="property-section">
                <h3 class="section-title">Detail Properti</h3>
                <div class="property-card">
                    <div class="property-image">
                        <img src="{{ asset('img/tipe36.jpg') }}" alt="{{ $transaksi->properti->nama_properti ?? '-' }}">
                    </div>
                    <div class="property-info">
                        <h4 class="property-name">{{ $transaksi->properti->nama_properti ?? '-' }}</h4>
                        <div class="property-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Bondowoso</span>
                        </div>
                        <div class="property-price">
                            Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                        </div>
                        <div class="property-specs">
                            <div class="spec-item">
                                <i class="fas fa-ruler-combined"></i>
                                <span>{{ $transaksi->properti->tipe_properti ?? '-' }} m²</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-tag"></i>
                                <span>{{ $transaksi->properti->kategori_properti ?? '-' }}</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-home"></i>
                                <span>{{ $transaksi->properti->jenis_properti ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Pemesan -->
            <div class="customer-section">
                <h3 class="section-title">Informasi Pemesan</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value">{{ $transaksi->user->nama_user ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Nomor HP</div>
                        <div class="info-value">{{ $transaksi->user->no_hp ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $transaksi->user->email_user ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tanggal Transaksi</div>
                        <div class="info-value">
                            {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Pembayaran -->
            <div class="payment-section">
                <h3 class="section-title">Detail Pembayaran</h3>

                {{-- Jenis Transaksi --}}
                <div class="payment-details">
                    <div class="payment-title">Metode Pembayaran</div>
                    <div class="payment-grid">
                        <div class="payment-item">
                            <span class="payment-label">Jenis Pembayaran</span>
                            <span class="payment-value">{{ ucfirst($transaksi->jenis_transaksi) }}</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Total Harga</span>
                            <span class="payment-value">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Jika KPR --}}
                @if($transaksi->jenis_transaksi == 'kredit' && $transaksi->kpr)
                <div class="payment-details" style="background:#f0f9ff; border-left-color:var(--primary-blue);">
                    <div class="payment-title" style="color:var(--dark-blue);">Detail KPR</div>
                    <div class="payment-grid">
                        <div class="payment-item">
                            <span class="payment-label">Nama Bank</span>
                            <span class="payment-value">{{ $transaksi->kpr->nama_bank }}</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Nomor Kontrak</span>
                            <span class="payment-value">{{ $transaksi->kpr->nomor_kontrak ?? '-' }}</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Uang Muka</span>
                            <span class="payment-value">
                                Rp {{ number_format($transaksi->kpr->uang_muka, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Jumlah Pinjaman</span>
                            <span class="payment-value">
                                Rp {{ number_format($transaksi->kpr->jumlah_pinjaman, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Suku Bunga</span>
                            <span class="payment-value">{{ $transaksi->kpr->suku_bunga }}% / tahun</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Tenor</span>
                            <span class="payment-value">{{ $transaksi->kpr->tenor }} bulan</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Angsuran/Bulan</span>
                            <span class="payment-value">
                                Rp {{ number_format($transaksi->kpr->angsuran_perbulan, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Status KPR</span>
                            <span class="payment-value">{{ ucfirst($transaksi->kpr->status_kpr) }}</span>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Riwayat Pembayaran --}}
                @if($transaksi->pembayaran->count() > 0)
                <div class="payment-details" style="background:#fafafa; border-left-color:#64748b;">
                    <div class="payment-title" style="color:#1a365d;">Riwayat Pembayaran</div>
                    <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
                        <thead>
                            <tr style="background:#f1f5f9;">
                                <th style="padding:10px; text-align:left;">Ke-</th>
                                <th style="padding:10px; text-align:left;">Tanggal</th>
                                <th style="padding:10px; text-align:left;">Jumlah</th>
                                <th style="padding:10px; text-align:left;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->pembayaran as $bayar)
                            @php
                                if ($bayar->status_bayar == 'disetujui') {
                                    $bayarWarna = 'color:#059669';
                                } elseif ($bayar->status_bayar == 'ditolak') {
                                    $bayarWarna = 'color:#dc2626';
                                } else {
                                    $bayarWarna = 'color:#f59e0b';
                                }
                            @endphp
                            <tr style="border-bottom:1px solid #e2e8f0;">
                                <td style="padding:10px;">{{ $bayar->ke_pembayaran }}</td>
                                <td style="padding:10px;">
                                    {{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d M Y') }}
                                </td>
                                <td style="padding:10px;">
                                    Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}
                                </td>
                                <td style="padding:10px; font-weight:600; {{ $bayarWarna }}">
                                    {{ ucfirst($bayar->status_bayar) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('riwayat-pemesanan') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                @if($transaksi->status_transaksi == 'menunggu_pembayaran')
                <button class="btn btn-danger" onclick="batalkanPemesanan()">
                    <i class="fas fa-times"></i> Batalkan Pemesanan
                </button>
                @endif
            </div>

        </div> {{-- penutup .detail-container --}}
    </div> {{-- penutup .main-content --}}

    <script>
        function batalkanPemesanan() {
            if (confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?')) {
                alert('Pemesanan dibatalkan.');
                window.location.href = '{{ route("riwayat-pemesanan") }}';
            }
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
</body>
</html>

