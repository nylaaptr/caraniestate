<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan - Carani Estate</title>
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
        
        .booking-form-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        /* Property Preview Section */
        .property-preview {
            background: #f8fafc;
            padding: 30px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            gap: 30px;
            align-items: center;
        }
        
        .property-image {
            width: 200px;
            height: 200px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
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
            font-size: 1.8rem;
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
            margin-bottom: 20px;
        }
        
        .property-type {
            display: inline-block;
            padding: 5px 12px;
            background: var(--primary-blue);
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        /* Form Section */
        .form-section {
            padding: 30px;
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-blue);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d3748;
            font-size: 0.95rem;
        }
        
        .form-control {
            width: 100%;
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(var(--primary-blue-rgb), 0.2);
            outline: none;
        }
        
        .form-control::placeholder {
            color: #a0aec0;
        }
        
        /* Select styling */
        select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.48 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
            padding-right: 40px;
        }
        
        /* Employment Type Selection */
        .employment-type {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .radio-group {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .radio-input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-blue);
        }
        
        .radio-label {
            font-weight: 500;
            color: #1a365d;
            font-size: 0.95rem;
        }
        
        /* Document Upload Section */
        .document-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }
        
        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .upload-item {
            margin-bottom: 15px;
        }
        
        .upload-label {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .required {
            color: #ef4444;
            font-size: 0.9rem;
        }
        
        .upload-area {
            border: 2px dashed #cbd5e0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }
        
        .upload-area:hover {
            border-color: var(--primary-blue);
            background: #f0f9ff;
        }
        
        .upload-icon {
            font-size: 2rem;
            color: var(--primary-blue);
            margin-bottom: 10px;
        }
        
        .upload-text {
            font-size: 0.9rem;
            color: #4a5568;
            margin-bottom: 5px;
        }
        
        .upload-hint {
            font-size: 0.8rem;
            color: #94a3b8;
        }
        
        .file-input {
            display: none;
        }
        
        .file-name {
            margin-top: 8px;
            font-size: 0.85rem;
            color: var(--primary-blue);
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        /* Payment Info */
        .payment-info {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        
        .payment-title {
            font-weight: 700;
            color: #059669;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .payment-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        
        .payment-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #d1fae5;
        }
        
        .payment-item:last-child {
            border-bottom: none;
            font-weight: 700;
            color: var(--dark-blue);
        }
        
        .payment-label {
            color: #64748b;
        }

        .payment-detail-box{
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:16px;
    padding:22px;
    margin-top:10px;
    margin-bottom:20px;
}

.payment-detail-title{
    font-size:1rem;
    font-weight:700;
    color:#1e293b;
    margin-bottom:18px;
    display:flex;
    align-items:center;
    gap:10px;
}

.payment-detail-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 0;
    border-bottom:1px dashed #e2e8f0;
    gap:15px;
}

.payment-detail-row:last-child{
    border-bottom:none;
    padding-bottom:0;
}

.payment-detail-label{
    color:#64748b;
    font-size:0.92rem;
}

.payment-detail-value{
    font-weight:700;
    color:#0f172a;
    text-align:right;
}

.rekening-highlight{
    font-size:1.05rem;
    letter-spacing:0.5px;
}

.nominal-highlight{
    color:#059669;
    font-size:1.1rem;
}

.copy-btn{
    background:var(--primary-blue);
    color:white;
    border:none;
    padding:6px 12px;
    border-radius:8px;
    font-size:0.75rem;
    font-weight:600;
    cursor:pointer;
    margin-left:10px;
    transition:0.3s ease;
}

.copy-btn:hover{
    background:var(--dark-blue);
    transform:translateY(-1px);
}

.copy-btn.copied{
    background:#10b981;
}

@media(max-width:768px){

    .payment-detail-row{
        flex-direction:column;
        align-items:flex-start;
    }

    .payment-detail-value{
        text-align:left;
    }
}
        
        /* Action Buttons */
        .form-actions {
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
            
            .form-row,
            .document-grid,
            .payment-details {
                grid-template-columns: 1fr;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }

            /* tombol toggle muncul di mobile */
            .menu-toggle{
                display: block;
                color: white;
                order: 2;
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
            
            .property-name {
                font-size: 1.5rem;
            }
            
            .form-section {
                padding: 20px;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 10px;
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
        <div class="booking-form-container">
            <form action="{{ route('pemesanan.proses') }}" method="POST" enctype="multipart/form-data" id="bookingForm">
            @csrf
            <input type="hidden" name="id_properti" value="{{ $properti->id_properti }}">
            <!-- Property Preview -->
            <!-- Property Preview - DINAMIS -->
            <div class="property-preview">
                <div class="property-image">
                    <img
                        src="{{ $properti->gambar->first()
                            ? asset('storage/images/' . $properti->gambar->first()->path_gambar)
                            : asset('images/placeholder-properti.png')
                        }}"
                        alt="{{ $properti->nama_properti }}"
                        onerror="this.src='{{ asset('images/placeholder-properti.png') }}'">
                </div>
                <div class="property-info">
                    <h2 class="property-name">{{ $properti->nama_properti }}</h2>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $properti->perumahan->lokasi_perumahan ?? 'Lokasi tidak tersedia' }}</span>
                    </div>
                    <div class="property-price">Rp {{ number_format($properti->harga_properti, 0, ',', '.') }}</div>
                    <span class="property-type">
                        {{ $properti->tipe_properti }} - {{ ucfirst($properti->kategori_properti) }}
                    </span>
                </div>
            </div>
            
            <!-- Form Section -->
            <div class="form-section">
                <h3 class="section-title">Informasi Pribadi</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="fullName" class="form-label">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" class="form-control" id="fullName" name="nama_lengkap" 
                            value="{{ old('nama_lengkap', Auth::user()->nama_user ?? '') }}" 
                            placeholder="Masukkan nama lengkap Anda" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone" class="form-label">Nomor HP <span class="required">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="no_hp" 
                            value="{{ old('no_hp', Auth::user()->no_hp ?? '') }}" 
                            placeholder="Contoh: 081234567890" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" 
                            value="{{ old('email', Auth::user()->email_user ?? '') }}" 
                            placeholder="Masukkan email Anda" required readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="address" class="form-label">Alamat Lengkap <span class="required">*</span></label>
                        <textarea class="form-control" id="address" name="alamat" rows="2" 
                                placeholder="Masukkan alamat lengkap Anda" required>{{ old('alamat', Auth::user()->alamat_user ?? '') }}</textarea>
                    </div>
                </div>
            </div>
                
                <!-- Property Details -->
                <div class="form-section">
                    <h3 class="section-title">Detail Properti</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="propertyType" class="form-label">Tipe Properti <span class="required">*</span></label>
                            <div class="form-control" style="background-color: #ffffff; font-weight: 500;">
                                {{ $properti->tipe_properti ?? 'Tidak tersedia' }} 
                                @if($properti->tipe_properti == '30/60')
                                    <span class="text-muted">(Subsidi)</span>
                                @else
                                    <span class="text-muted">(Komersil)</span>
                                @endif
                            </div>

                            {{-- ✅ Tetap kirim value saat form submit --}}
                            <input type="hidden" name="tipe_dipilih" value="{{ $properti->tipe_properti ?? '' }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="downPayment" class="form-label">
                                Uang Muka <span class="required">*</span>
                            </label>

                            @php
                                $bookingFee = $properti->bookingFee ?? 0;
                            @endphp

                            <input 
                                type="text" 
                                class="form-control" 
                                id="downPayment" 
                                name="uang_muka"
                                value="Rp {{ number_format($bookingFee, 0, ',', '.') }}"
                                readonly
                            >

                            <!-- nilai asli untuk backend -->
                            <input 
                                type="hidden" 
                                name="uang_muka_value" 
                                value="{{ $bookingFee }}"
                            >
                        </div>
                    </div>
                </div>
                
                <!-- Payment Method Section -->
                <div class="form-section">
                    <h3 class="section-title">Metode Pembayaran</h3>
                    <div class="form-group">
                        <label for="paymentMethod" class="form-label">Pilih Metode Pembayaran <span class="required">*</span></label>
                        <select class="form-control" id="paymentMethod" name="jenis_transaksi" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="kredit">KPR (Kredit Pemilikan Rumah)</option>
                            <option value="lunas">Lunas</option>
                        </select>
                    </div>
                </div>

                
                
                <!-- Employment Type -->
                <div class="form-section">
                    <h3 class="section-title">Jenis Pekerjaan</h3>
                    <div class="employment-type">
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" name="employmentType" id="employment-pns" value="pns" class="radio-input" checked>
                                <label for="employment-pns" class="radio-label">Pegawai Swasta/PNS</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" name="employmentType" id="employment-wiraswasta" value="wiraswasta" class="radio-input">
                                <label for="employment-wiraswasta" class="radio-label">Wirausaha/Non PNS</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Document Uploads - PNS -->
                <div class="form-section" id="pns-documents">
                    <h3 class="section-title">Dokumen Persyaratan (Pegawai Swasta/PNS)</h3>
                    <div class="document-section">
                        <div class="document-grid">
                            <div class="upload-item">
                                <label class="upload-label">Fotokopi KTP (Suami & Istri) <span class="required">*</span></label>
                                <div class="upload-area" id="ktpUpload">
                                    <i class="fas fa-id-card upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="ktpFile" name="ktp[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="ktpFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Fotokopi Kartu Keluarga <span class="required">*</span></label>
                                <div class="upload-area" id="kkUpload">
                                    <i class="fas fa-users upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="kkFile" name="kk[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="kkFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Fotokopi Surat Nikah <span class="required">*</span></label>
                                <div class="upload-area" id="marriageUpload">
                                    <i class="fas fa-ring upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="marriageFile" name="surat_nikah[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="marriageFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Fotokopi NPWP Pemohon <span class="required">*</span></label>
                                <div class="upload-area" id="npwpUpload">
                                    <i class="fas fa-file-alt upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="npwpFile" name="npwp[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="npwpFileName"></div>
                                </div>
                            </div>
                            
                            <!-- FOTO 3X4 PNS -->
                            <div class="upload-item">
                                <label class="upload-label">Foto Berwarna 3x4 (Suami & Istri) <span class="required">*</span></label>
                                <div class="upload-area" id="photoUpload">
                                    <i class="fas fa-camera upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG | Max 2MB</p>
                                    <input type="file" class="file-input" id="photoFile" name="foto_3x4[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="photoFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Surat Keterangan Kerja <span class="required">*</span></label>
                                <div class="upload-area" id="workCertUpload">
                                    <i class="fas fa-briefcase upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="workCertFile" name="surat_kerja[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="workCertFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Slip Gaji 3 Bulan Terakhir <span class="required">*</span></label>
                                <div class="upload-area" id="salaryUpload">
                                    <i class="fas fa-file-invoice-dollar upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="salaryFile" name="slip_gaji[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="salaryFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Rekening Koran 3 Bulan Terakhir <span class="required">*</span></label>
                                <div class="upload-area" id="bankUpload">
                                    <i class="fas fa-file-invoice upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="bankFile" name="rekening_koran[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="bankFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Foto Selfie Ukuran 4R <span class="required">*</span></label>
                                <div class="upload-area" id="selfieUpload">
                                    <i class="fas fa-user upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG | Max 3MB</p>
                                    <input type="file" class="file-input" id="selfieFile" name="selfie[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="selfieFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Foto Lokasi Tempat Kerja <span class="required">*</span></label>
                                <div class="upload-area" id="workplaceUpload">
                                    <i class="fas fa-building upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG | Max 3MB</p>
                                    <input type="file" class="file-input" id="workplaceFile" name="foto_tempat_kerja[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="workplaceFileName"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Document Uploads - Wiraswasta (hidden by default) -->
                <div class="form-section" id="wiraswasta-documents" style="display: none;">
                    <h3 class="section-title">Dokumen Persyaratan (Wirausaha/Non PNS)</h3>
                    <div class="document-section">
                        <div class="document-grid">
                            <div class="upload-item">
                                <label class="upload-label">Fotokopi KTP (Suami & Istri) <span class="required">*</span></label>
                                <div class="upload-area" id="ktpUploadW">
                                    <i class="fas fa-id-card upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="ktpFileW" name="ktp[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="ktpFileNameW"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Fotokopi Kartu Keluarga <span class="required">*</span></label>
                                <div class="upload-area" id="kkUploadW">
                                    <i class="fas fa-users upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="kkFileW" name="kk[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="kkFileNameW"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Fotokopi Surat Nikah <span class="required">*</span></label>
                                <div class="upload-area" id="marriageUploadW">
                                    <i class="fas fa-ring upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="marriageFileW" name="surat_nikah[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="marriageFileNameW"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Fotokopi NPWP Pemohon <span class="required">*</span></label>
                                <div class="upload-area" id="npwpUploadW">
                                    <i class="fas fa-file-alt upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="npwpFileW" name="npwp[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="npwpFileNameW"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">SPT Pajak <span class="required">*</span></label>
                                <div class="upload-area" id="sptUpload">
                                    <i class="fas fa-file-invoice upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="sptFile" name="spt_pajak[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="sptFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Foto Berwarna 3x4 (Suami & Istri) <span class="required">*</span></label>
                                <div class="upload-area" id="photoUploadW">
                                    <i class="fas fa-camera upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG | Max 2MB</p>
                                    <input type="file" class="file-input" id="photoFileW" name="foto_3x4[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="photoFileNameW"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Surat Keterangan Usaha/SIUP <span class="required">*</span></label>
                                <div class="upload-area" id="businessCertUpload">
                                    <i class="fas fa-file-contract upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="businessCertFile" name="surat_ket_usaha[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="businessCertFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Surat Keterangan Penghasilan Usaha <span class="required">*</span></label>
                                <div class="upload-area" id="incomeCertUpload">
                                    <i class="fas fa-file-signature upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="incomeCertFile" name="surat_penghasilan_usaha[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="incomeCertFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Pembukuan Usaha 6 Bulan Terakhir <span class="required">*</span></label>
                                <div class="upload-area" id="businessRecordUpload">
                                    <i class="fas fa-book upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="businessRecordFile" name="pembukuan_usaha[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="businessRecordFileName"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Rekening Koran 3 Bulan Terakhir <span class="required">*</span></label>
                                <div class="upload-area" id="bankUploadW">
                                    <i class="fas fa-file-invoice upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>
                                    <input type="file" class="file-input" id="bankFileW" name="rekening_koran[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="bankFileNameW"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Foto Selfie Ukuran 4R <span class="required">*</span></label>
                                <div class="upload-area" id="selfieUploadW">
                                    <i class="fas fa-user upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG | Max 3MB</p>
                                    <input type="file" class="file-input" id="selfieFileW" name="selfie[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="selfieFileNameW"></div>
                                </div>
                            </div>
                            
                            <div class="upload-item">
                                <label class="upload-label">Foto Lokasi Tempat Usaha <span class="required">*</span></label>
                                <div class="upload-area" id="businessPlaceUpload">
                                    <i class="fas fa-store upload-icon"></i>
                                    <p class="upload-text">Klik atau drag file</p>
                                    <p class="upload-hint">JPG/PNG | Max 3MB</p>
                                    <input type="file" class="file-input" id="businessPlaceFile" name="foto_tempat_usaha[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    <div class="file-name" id="businessPlaceFileName"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Information -->
                <div class="form-section">
                    <h3 class="section-title">Informasi Pembayaran</h3>

                    @php
                        $harga = $properti->harga_properti ?? 0;

                        // ambil booking fee dari database
                        $bookingFee = (int) ($properti->bookingFee ?? 0);

                        // total pembayaran = booking fee saja
                        $totalPembayaran = $harga + $bookingFee;
                    @endphp

                    <div class="payment-info">
                        <div class="payment-title">Rincian Biaya</div>

                        <div class="payment-details">

                            <div class="payment-item">
                                <span class="payment-label">Harga Properti</span>
                                <span class="payment-value">
                                    Rp {{ number_format($harga, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="payment-item">
                                <span class="payment-label">Booking Fee</span>
                                <span class="payment-value">
                                    Rp {{ number_format($bookingFee, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="payment-item">
                                <span class="payment-label">Total Pembayaran</span>
                                <span class="payment-value">
                                    Rp {{ number_format($totalPembayaran, 0, ',', '.') }}
                                </span>
                            </div>

                        </div>

                        <p style="margin-top: 15px; font-size: 0.9rem; color: #64748b;">
                            <strong>Catatan:</strong> Booking fee mengikuti unit properti yang dipilih.
                        </p>
                    </div>
                </div>

                <!-- Informasi Rekening -->
                <div class="payment-detail-box">
                    <div class="payment-detail-title">
                        <i class="fas fa-university"></i>
                        Informasi Transfer Booking Fee
                    </div>

                    <div class="payment-detail-row">
                        <span class="payment-detail-label">Bank</span>
                        <span class="payment-detail-value">
                            Bank Mandiri
                        </span>
                    </div>

                    <div class="payment-detail-row">
                        <span class="payment-detail-label">Nomor Rekening</span>

                        <span class="payment-detail-value rekening-highlight">
                            1430033363555

                            <button type="button"
                                class="copy-btn"
                                onclick="copyRekening('1234567890')">

                                Salin
                            </button>
                        </span>
                    </div>

                    <div class="payment-detail-row">
                        <span class="payment-detail-label">Atas Nama</span>

                        <span class="payment-detail-value">
                            PT Carani Bhanu Balakosa
                        </span>
                    </div>

                    <div class="payment-detail-row">
                        <span class="payment-detail-label">
                            Total Transfer
                        </span>

                        <span class="payment-detail-value nominal-highlight">
                            Rp {{ number_format($bookingFee,0,',','.') }}
                        </span>
                    </div>

                </div>

                <!-- Upload Bukti Booking Fee (KHUSUS LUNAS) -->
                <div class="form-section" id="booking-proof-section" style="display: none;">
                    <h3 class="section-title">Upload Bukti Booking Fee</h3>

                    <div class="upload-item">
                        <label class="upload-label">
                            Bukti Pembayaran Booking Fee <span class="required">*</span>
                        </label>

                        <div class="upload-area" id="buktiBookingUpload">
                            <i class="fas fa-receipt upload-icon"></i>
                            <p class="upload-text">Klik atau drag file</p>
                            <p class="upload-hint">JPG/PNG/PDF | Max 5MB</p>

                            <input 
                                type="file" 
                                class="file-input" 
                                name="bukti_booking" 
                                id="buktiBooking"
                                accept=".jpg,.jpeg,.png,.pdf"
                            >

                            <!-- TAMBAHAN -->
                            <div class="file-name" id="buktiBookingName"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" id="cancelBtn">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pemesanan
                        </button>
                    </div>

                </form>{{-- tutup form --}}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method dropdown change handler
            // ========== MODAL PREVIEW ==========
            function openPreview(file) {
                const url = URL.createObjectURL(file);
                // buka di tab baru
                window.open(url, '_blank');

            }

            // ========== FILE UPLOAD HANDLER (GANTI YANG LAMA) ==========
            function setupFileUpload(uploadAreaId, fileInputId, fileNameId) {
                const uploadArea = document.getElementById(uploadAreaId);
                const fileInput = document.getElementById(fileInputId);
                const fileName = document.getElementById(fileNameId);

                if (!uploadArea || !fileInput || !fileName) return;

                uploadArea.addEventListener('click', function(e) {
                    // Jangan trigger klik file input kalau yg diklik tombol preview
                    if (e.target.closest('button[data-preview]')) return;
                    fileInput.click();
                });

                fileInput.addEventListener('change', function() {
                    const files = Array.from(this.files);
                    if (!files.length) return;

                    fileName.innerHTML = '';

                    files.forEach(file => {
                        const row = document.createElement('div');
                        row.style.cssText = 'display:flex; align-items:center; gap:6px; margin-top:5px;';

                        const nameSpan = document.createElement('span');
                        nameSpan.textContent = file.name;
                        nameSpan.style.cssText = 'font-size:0.82rem; color:#7AB2D3; font-weight:500; flex:1; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;';

                        const btnLihat = document.createElement('button');
                        btnLihat.type = 'button';
                        btnLihat.setAttribute('data-preview', '1');

                        btnLihat.innerHTML = '<i class="fas fa-eye"></i>';

                        btnLihat.style.cssText = `
                            width:30px;
                            height:30px;
                            border:none;
                            border-radius:8px;
                            cursor:pointer;
                            background:#e8f0fe;
                            color:#1E3A5F;
                            transition:0.2s;
                            flex-shrink:0;
                        `;

                        btnLihat.onmouseenter = () => {
                            btnLihat.style.background = '#7AB2D3';
                            btnLihat.style.color = '#fff';
                        };

                        btnLihat.onmouseleave = () => {
                            btnLihat.style.background = '#e8f0fe';
                            btnLihat.style.color = '#1E3A5F';
                        };
                        btnLihat.addEventListener('click', (e) => {
                            e.stopPropagation(); // supaya tidak trigger uploadArea click
                            openPreview(file);
                        });

                        row.appendChild(nameSpan);
                        row.appendChild(btnLihat);
                        fileName.appendChild(row);
                    });
                });
            }

            // ========== SETUP PNS ==========
            setupFileUpload('ktpUpload', 'ktpFile', 'ktpFileName');
            setupFileUpload('kkUpload', 'kkFile', 'kkFileName');
            setupFileUpload('marriageUpload', 'marriageFile', 'marriageFileName');
            setupFileUpload('npwpUpload', 'npwpFile', 'npwpFileName');
            setupFileUpload('photoUpload', 'photoFile', 'photoFileName');
            setupFileUpload('workCertUpload', 'workCertFile', 'workCertFileName');
            setupFileUpload('salaryUpload', 'salaryFile', 'salaryFileName');
            setupFileUpload('bankUpload', 'bankFile', 'bankFileName');
            setupFileUpload('selfieUpload', 'selfieFile', 'selfieFileName');
            setupFileUpload('workplaceUpload', 'workplaceFile', 'workplaceFileName');

            // ========== SETUP WIRASWASTA ==========
            setupFileUpload('ktpUploadW', 'ktpFileW', 'ktpFileNameW');
            setupFileUpload('kkUploadW', 'kkFileW', 'kkFileNameW');
            setupFileUpload('marriageUploadW', 'marriageFileW', 'marriageFileNameW');
            setupFileUpload('npwpUploadW', 'npwpFileW', 'npwpFileNameW');
            setupFileUpload('sptUpload', 'sptFile', 'sptFileName');
            setupFileUpload('photoUploadW', 'photoFileW', 'photoFileNameW');
            setupFileUpload('businessCertUpload', 'businessCertFile', 'businessCertFileName');
            setupFileUpload('incomeCertUpload', 'incomeCertFile', 'incomeCertFileName');
            setupFileUpload('businessRecordUpload', 'businessRecordFile', 'businessRecordFileName');
            setupFileUpload('bankUploadW', 'bankFileW', 'bankFileNameW');
            setupFileUpload('selfieUploadW', 'selfieFileW', 'selfieFileNameW');
            setupFileUpload('businessPlaceUpload', 'businessPlaceFile', 'businessPlaceFileName');

            setupFileUpload('buktiBookingUpload', 'buktiBooking', 'buktiBookingName');

            // ========== SISA SCRIPT LAMA (payment, employment toggle, submit, cancel) ==========
            const paymentMethodSelect = document.getElementById('paymentMethod');
            const downPaymentInput = document.getElementById('downPayment');
            const paymentDetails = document.querySelector('.payment-details');

            paymentMethodSelect.addEventListener('change', function() {
                // ... (isi sama persis dengan script lama)
            });

            const pnsRadio = document.getElementById('employment-pns');
            const wiraswastaRadio = document.getElementById('employment-wiraswasta');
            const pnsDocuments = document.getElementById('pns-documents');
            const wiraswastaDocuments = document.getElementById('wiraswasta-documents');

            pnsRadio.addEventListener('change', function() {
                if (this.checked) { pnsDocuments.style.display='block'; wiraswastaDocuments.style.display='none'; }
            });
            wiraswastaRadio.addEventListener('change', function() {
                if (this.checked) { pnsDocuments.style.display='none'; wiraswastaDocuments.style.display='block'; }
            });
            
            // Cancel button
            document.getElementById('cancelBtn').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin membatalkan pemesanan? Semua data yang telah diisi akan hilang.')) {
                    window.location.href = '{{ route("halaman-katalog") }}';
                }
            });
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function(){

    const paymentMethod = document.getElementById('paymentMethod');

    // section uang muka
    const downPaymentSection = document
        .getElementById('downPayment')
        .closest('.form-group');

    // upload booking
    const bookingProofSection = document.getElementById('booking-proof-section');


    function updatePaymentUI(){

        const metode = paymentMethod.value;

        // uang muka SELALU tampil
        downPaymentSection.style.display = 'block';

        // upload booking tampil untuk KPR maupun Lunas
        if(metode === 'kredit' || metode === 'lunas'){
            bookingProofSection.style.display = 'block';
        }else{
            bookingProofSection.style.display = 'none';
        }
    }

    paymentMethod.addEventListener('change', updatePaymentUI);

    // jalankan saat halaman load
    updatePaymentUI();

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const paymentMethod = document.getElementById('paymentMethod');
    const bookingSection = document.getElementById('booking-proof-section');
    const buktiBooking = document.getElementById('buktiBooking');
    const buktiBookingName = document.getElementById('buktiBookingName');

    // tampil/sembunyikan upload booking fee
    paymentMethod.addEventListener('change', function () {

        const selected = this.value;

        // booking fee muncul untuk KPR maupun Lunas
        if (selected === 'kredit' || selected === 'lunas') {
            bookingSection.style.display = 'block';
        } else {
            bookingSection.style.display = 'none';
            buktiBooking.value = '';
            buktiBookingName.innerHTML = '';
        }
    });

    

});
</script>

<script>
function copyRekening(noRek){

    navigator.clipboard.writeText(noRek);

    alert('Nomor rekening berhasil disalin');
}
</script>
</body>
</html>

