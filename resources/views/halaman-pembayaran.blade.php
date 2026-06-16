<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Carani Estate</title>
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
        
        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 30px;
        }
        
        .payment-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        /* Payment Header */
        .payment-header {
            background: #f8fafc;
            padding: 30px;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
        }
        
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            background: #fef3c7;
            color: #f59e0b;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
        
        .payment-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 10px;
        }
        
        .payment-subtitle {
            color: #64748b;
            font-size: 1.1rem;
        }
        
        /* Property Preview */
        .property-preview {
            display: flex;
            gap: 25px;
            padding: 25px 30px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .property-image {
            width: 150px;
            height: 150px;
            border-radius: 12px;
            overflow: hidden;
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
        
        /* Payment Details Section */
        .payment-details-section {
            padding: 30px;
        }
        
        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-blue);
        }
        
        .payment-info {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
        }
        
        .payment-title-info {
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
            font-size: 1.3rem;
            font-weight: 800;
            color: #059669;
            text-align: right;
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid #d1fae5;
        }
        
        /* Payment Method Section */
        .payment-method-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }
        
        .payment-method-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .payment-method-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .payment-method-card:hover {
            border-color: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .payment-method-card.selected {
            border-color: var(--primary-blue);
            background: #f0f9ff;
            box-shadow: 0 4px 15px rgba(var(--primary-blue-rgb), 0.2);
        }
        
        .payment-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: var(--primary-blue);
        }
        
        .payment-name {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }
        
        .payment-desc {
            font-size: 0.85rem;
            color: #64748b;
        }
        
        /* Bank Account Section */
        .bank-account-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }
        
        .bank-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }
        
        .bank-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        
        .bank-logo {
            font-size: 3rem;
            margin-bottom: 10px;
            color: var(--primary-blue);
        }
        
        .bank-name {
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 8px;
            font-size: 1.1rem;
        }
        
        .bank-number {
            font-family: 'Courier New', monospace;
            font-size: 1.2rem;
            font-weight: 700;
            color: #059669;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }
        
        .bank-owner {
            font-size: 0.9rem;
            color: #64748b;
        }
        
        /* Upload Section */
        .upload-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }
        
        .upload-title {
            font-size: 1.1rem;
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
            font-size: 3rem;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }
        
        .upload-text {
            font-size: 1rem;
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
        
        /* Payment Instructions */
        .instructions-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }
        
        .instructions-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 15px;
        }
        
        .instructions-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .instruction-item {
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            gap: 12px;
        }
        
        .instruction-item:last-child {
            border-bottom: none;
        }
        
        .instruction-number {
            width: 28px;
            height: 28px;
            background: var(--primary-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }
        
        .instruction-text {
            color: #4a5568;
            line-height: 1.6;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
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
            .property-preview {
                flex-direction: column;
                text-align: center;
            }
            
            .property-image {
                margin: 0 auto;
            }
            
            .payment-grid,
            .bank-grid,
            .payment-method-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
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
            
            .payment-title {
                font-size: 1.5rem;
            }
            
            .property-name {
                font-size: 1.2rem;
            }
            
            .property-image {
                width: 120px;
                height: 120px;
            }
            
            .bank-card {
                padding: 15px;
            }
            
            .bank-number {
                font-size: 1rem;
            }
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
    <div class="main-content">
        <div class="payment-container">
            <!-- Payment Header -->
            <div class="payment-header">
                <div class="status-badge">
                    <i class="fas fa-clock me-2"></i> Menunggu Pembayaran
                </div>
                <h2 class="payment-title">Halaman Pembayaran</h2>
                <p class="payment-subtitle">Apartemen Begawan Malang - ID: MLG-2025-005</p>
            </div>
            
            <!-- Property Preview -->
            <div class="property-preview">
                <div class="property-image">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Apartemen Begawan Malang">
                </div>
                <div class="property-info">
                    <h3 class="property-name">Apartemen Begawan Malang</h3>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Kota Malang, Kecamatan Klojen, Jawa Timur</span>
                    </div>
                </div>
            </div>
            
            <!-- Payment Details Section -->
            <div class="payment-details-section">
                <h3 class="section-title">Detail Pembayaran</h3>
                
                <div class="payment-info">
                    <div class="payment-title-info">Rincian Biaya</div>
                    <div class="payment-grid">
                        <div class="payment-item">
                            <span class="payment-label">Harga Properti</span>
                            <span class="payment-value">Rp 3.500.000.000</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Uang Muka</span>
                            <span class="payment-value">Rp 700.000.000</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Biaya Administrasi</span>
                            <span class="payment-value">Rp 5.000.000</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Biaya Notaris</span>
                            <span class="payment-value">Rp 15.000.000</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">PPN (10%)</span>
                            <span class="payment-value">Rp 350.000.000</span>
                        </div>
                        <div class="payment-item">
                            <span class="payment-label">Biaya AJB</span>
                            <span class="payment-value">Rp 10.000.000</span>
                        </div>
                    </div>
                    <div class="total-payment">Total: Rp 4.580.000.000</div>
                </div>
                
                <!-- Payment Method Section -->
                <div class="payment-method-section">
                    <h3 class="section-title">Metode Pembayaran</h3>
                    <p class="form-label">Pilih metode pembayaran yang sesuai</p>
                    <div class="payment-method-grid">
                        <div class="payment-method-card selected" data-method="transfer">
                            <div class="payment-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="payment-name">Transfer Bank</div>
                            <div class="payment-desc">ATM/Internet/Mobile Banking</div>
                        </div>
                        
                        <div class="payment-method-card" data-method="virtual">
                            <div class="payment-icon">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <div class="payment-name">Virtual Account</div>
                            <div class="payment-desc">Bayar via ATM/MBanking</div>
                        </div>
                        
                        <div class="payment-method-card" data-method="ewallet">
                            <div class="payment-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="payment-name">E-Wallet</div>
                            <div class="payment-desc">OVO, Gopay, Dana</div>
                        </div>
                        
                        <div class="payment-method-card" data-method="minimarket">
                            <div class="payment-icon">
                                <i class="fas fa-store"></i>
                            </div>
                            <div class="payment-name">Minimarket</div>
                            <div class="payment-desc">Alfamart, Indomaret</div>
                        </div>
                    </div>
                    <input type="hidden" id="selectedPaymentMethod" value="transfer">
                </div>
                
                <!-- Bank Account Section -->
                <div class="bank-account-section">
                    <h3 class="section-title">Rekening Pembayaran</h3>
                    <div class="bank-grid">
                        <div class="bank-card">
                            <div class="bank-logo">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <div class="bank-name">Bank BCA</div>
                            <div class="bank-number">0123 456 789</div>
                            <div class="bank-owner">PT. Properti Harmoni</div>
                        </div>
                        
                        <div class="bank-card">
                            <div class="bank-logo">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <div class="bank-name">Bank Mandiri</div>
                            <div class="bank-number">137 00 1234567</div>
                            <div class="bank-owner">PT. Properti Harmoni</div>
                        </div>
                        
                        <div class="bank-card">
                            <div class="bank-logo">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <div class="bank-name">Bank BNI</div>
                            <div class="bank-number">0123 456 789</div>
                            <div class="bank-owner">PT. Properti Harmoni</div>
                        </div>
                        
                        <div class="bank-card">
                            <div class="bank-logo">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <div class="bank-name">Bank BRI</div>
                            <div class="bank-number">0123 01 001234 50 6</div>
                            <div class="bank-owner">PT. Properti Harmoni</div>
                        </div>
                    </div>
                </div>
                
                <!-- Upload Section -->
                <div class="upload-section">
                    <h3 class="upload-title">Upload Bukti Pembayaran</h3>
                    
                    <div class="upload-area" id="uploadArea">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <p class="upload-text">Klik atau drag file bukti pembayaran</p>
                        <p class="upload-hint">Format: JPG, PNG, PDF | Max: 5MB</p>
                        <input type="file" class="file-input" id="paymentProof" accept=".jpg,.jpeg,.png,.pdf">
                        <div class="file-name" id="fileName"></div>
                    </div>
                </div>
                
                <!-- Payment Instructions -->
                <div class="instructions-section">
                    <h3 class="instructions-title">Petunjuk Pembayaran</h3>
                    <ul class="instructions-list">
                        <li class="instruction-item">
                            <div class="instruction-number">1</div>
                            <div class="instruction-text">Transfer sesuai dengan jumlah total pembayaran ke salah satu rekening di atas</div>
                        </li>
                        <li class="instruction-item">
                            <div class="instruction-number">2</div>
                            <div class="instruction-text">Gunakan nomor pemesanan (MLG-2025-005) sebagai berita transfer</div>
                        </li>
                        <li class="instruction-item">
                            <div class="instruction-number">3</div>
                            <div class="instruction-text">Upload bukti pembayaran (struk transfer/screenshot) pada form di atas</div>
                        </li>
                        <li class="instruction-item">
                            <div class="instruction-number">4</div>
                            <div class="instruction-text">Klik tombol "Konfirmasi Pembayaran" setelah upload berhasil</div>
                        </li>
                        <li class="instruction-item">
                            <div class="instruction-number">5</div>
                            <div class="instruction-text">Tunggu konfirmasi dari tim kami (maksimal 1x24 jam)</div>
                        </li>
                    </ul>
                </div>
                
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn btn-secondary" id="cancelBtn">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button class="btn btn-primary" id="confirmBtn">
                        <i class="fas fa-check-circle"></i> Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method selection
            const paymentCards = document.querySelectorAll('.payment-method-card');
            const selectedPaymentMethod = document.getElementById('selectedPaymentMethod');
            
            paymentCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove selected class from all cards
                    paymentCards.forEach(c => c.classList.remove('selected'));
                    
                    // Add selected class to clicked card
                    this.classList.add('selected');
                    
                    // Update hidden input value
                    selectedPaymentMethod.value = this.dataset.method;
                });
            });
            
            // File upload handling
            const uploadArea = document.getElementById('uploadArea');
            const fileInput = document.getElementById('paymentProof');
            const fileName = document.getElementById('fileName');
            
            uploadArea.addEventListener('click', () => {
                fileInput.click();
            });
            
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileName.textContent = `✓ ${this.files[0].name}`;
                    fileName.style.color = var(--primary-blue);
                }
            });
            
            // Cancel button
            document.getElementById('cancelBtn').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin membatalkan pembayaran?')) {
                    alert('Pembayaran dibatalkan.');
                    // In real application: window.location.href = '/riwayat-pemesanan';
                }
            });
            
            // Confirm button
            document.getElementById('confirmBtn').addEventListener('click', function() {
                if (!document.getElementById('fileName').textContent) {
                    alert('Silakan upload bukti pembayaran terlebih dahulu.');
                    return;
                }
                
                alert('Konfirmasi pembayaran berhasil dikirim! Tim kami akan segera memverifikasi pembayaran Anda.');
                // In real application: submit form to /pembayaran/konfirmasi
                // window.location.href = '/riwayat-pemesanan';
            });
            
            // Add subtle animation on page load
            const paymentContainer = document.querySelector('.payment-container');
            paymentContainer.style.opacity = '0';
            paymentContainer.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                paymentContainer.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                paymentContainer.style.opacity = '1';
                paymentContainer.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>

