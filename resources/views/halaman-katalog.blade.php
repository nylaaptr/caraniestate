<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Properti - Carani Estate</title>
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
            padding-top: 20px;
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

        .main-content{
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
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

        
        /* Search Filter Section */
        /* Search Filter Section */
        .search-filter {
            background: white;
            border-radius: 16px;
            padding: 25px 30px;
            margin: 80px 30px 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: flex-end;
            justify-content: space-between;
        }
        
        .filter-group {
            display: flex;
            align-items: column;
            flex-direction: column;
            gap: 6px;
        }
        
        .filter-label {
            font-weight: 600;
            color: #1a365d;
            font-size: 0.85rem;
        }
        
        .filter-input {
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            min-width: 200px;
            transition: all 0.3s ease;
        }
        
        .filter-input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(var(--primary-blue-rgb), 0.2);
            outline: none;
        }
        
        .filter-select {
            padding: 8px 12px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.9rem;
            min-width: 150px;
            height: 40px;
            background: white;
            transition: all 0.3s ease;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.48 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
            padding-right: 40px;
        }
        
        .filter-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(var(--primary-blue-rgb), 0.2);
            outline: none;
        }
        
        .bedroom-buttons {
            display: flex;
            gap: 10px;
        }
        
        .bedroom-btn {
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }
        
        .bedroom-btn:hover {
            border-color: var(--primary-blue);
            background: #f8fafc;
        }
        
        .bedroom-btn.active {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }
        
        .search-btn {
            background: #2e4b83;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .search-btn:hover {
            background: #4d72bd;
            transform: translateY(-2px);
        }
        
        .search-btn i {
            font-size: 18px;
        }
        
        /* Properties Section */
        .properties-section {
            padding: 30px 30px 60px;
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 30px;
            text-align: center;
        }
        
        .properties-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        
        .property-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            position: relative;
        }
        
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        
        .property-image {
            height: 200px;
            background: #f8fafc;
            position: relative;
            overflow: hidden;
        }
        
        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .property-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
        }
        
        .badge-new {
            background: #10b981;
        }
        
        .badge-sale {
            background: #ef4444;
        }
        
        .property-info {
            padding: 20px;
        }
        
        .property-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 10px;
        }
        
        .property-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a365d;
            margin-bottom: 10px;
            line-height: 1.4;
        }
        
        .property-location {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .property-location i {
            color: #64748b;
        }
        
        .property-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #4a5568;
        }
        
        .property-detail {
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }
        
        .property-detail i {
            color: var(--primary-blue);
        }
        
        .property-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            text-decoration: none;
        }
        
        .action-btn {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
        }
        
        .btn-view {
            background: #e2e8f0;
            color: #4a5568;
            text-decoration: none;
        }
        
        .btn-view:hover {
            background: #cbd5e0;
        }
        
        .btn-contact {
            background: var(--primary-blue);
            color: white;
        }
        
        .btn-contact:hover {
            background: #6aa5c6;
        }
        
        /* Pagination */
        /* ✅ FIX PAGINATION - Override semua style yang konflik */
        .pagination {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 6px !important;
            list-style: none !important;
            padding: 20px 0 0 0 !important;
            margin: 0 !important;
            flex-wrap: wrap !important;
        }

        .pagination .page-item {
            display: inline-block !important;
            margin: 0 2px !important;
        }

        .pagination .page-link {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 42px !important;
            height: 42px !important;
            padding: 0 14px !important;
            color: #1E3A5F !important;
            background: white !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 10px !important;
            font-size: 0.95rem !important;
            font-weight: 500 !important;
            text-decoration: none !important;
            transition: all 0.3s ease !important;
            line-height: 1 !important;
        }

        .pagination .page-link:hover {
            background: #7AB2D3 !important;
            color: white !important;
            border-color: #7AB2D3 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(122, 178, 211, 0.3) !important;
        }

        .pagination .page-item.active .page-link {
            background: #1E3A5F !important;
            color: white !important;
            border-color: #1E3A5F !important;
            font-weight: 600 !important;
            cursor: default !important;
        }

        .pagination .page-item.disabled .page-link {
            color: #adb5bd !important;
            background: #f8f9fa !important;
            border-color: #dee2e6 !important;
            pointer-events: none !important;
            cursor: not-allowed !important;
        }

        /* ✅ FIX: Pastikan SVG/icon arrow tidak terlalu besar */
        .pagination .page-link svg {
            width: 16px !important;
            height: 16px !important;
            fill: currentColor !important;
        }

        .pagination .page-link i,
        .pagination .page-link span {
            font-size: 0.95rem !important;
            line-height: 1 !important;
        }

        /* ✅ Prevent konflik dengan Font Awesome global */
        .pagination .page-link .fa,
        .pagination .page-link .fas,
        .pagination .page-link .far {
            font-size: 0.9rem !important;
            width: auto !important;
            height: auto !important;
        }

        /* ✅ Responsive untuk mobile */
        @media (max-width: 576px) {
            .pagination .page-link {
                min-width: 36px !important;
                height: 36px !important;
                padding: 0 10px !important;
                font-size: 0.85rem !important;
            }
            
            .pagination .page-link svg {
                width: 14px !important;
                height: 14px !important;
            }
        }

        /* Footer */
        .footer {
            background: var(--dark-blue);
            color: white;
            padding: 50px 30px 20px;
            margin-top: 80px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }
        
        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            position: relative;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary-blue);
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #cbd5e0;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary-blue);
        }
        
        .footer-contact p {
            margin: 10px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .footer-contact i {
            color: var(--primary-blue);
        }
        
        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            background: var(--primary-blue);
            transform: translateY(-2px);
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 40px;
            font-size: 0.9rem;
            color: #cbd5e0;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .header {
                padding: 15px 20px;
            }
            
            .nav-menu {
                gap: 20px;
            }
            
            .nav-item {
                font-size: 0.9rem;
            }
            
            .search-filter {
                padding: 20px;
                margin: 80px 20px 20px;
                flex-direction: column;
                gap: 15px;
            }
            
            .filter-group {
                width: 100%;
                flex-wrap: wrap;
            }
            
            .filter-input, .filter-select {
                min-width: 100%;
            }
            
            .bedroom-buttons {
                width: 100%;
                justify-content: center;
            }
            
            .search-btn {
                width: 100%;
                justify-content: center;
            }
            
            .properties-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 15px;
            }
            
            .logo-text {
                display: none;
            }
            
            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            /* tombol toggle muncul di mobile */
            .menu-toggle{
                display: block;
                color: white;
                order: 2;
            }
            
            .nav-menu {
                display: none;
            }
            
            .user-actions {
                gap: 15px;
            }
            
            .search-filter {
                margin: 80px 15px 20px;
                padding: 20px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .properties-grid {
                grid-template-columns: 1fr;
            }
            
            .property-card {
                margin-bottom: 20px;
            }
            
            .property-image {
                height: 150px;
            }
            
            .property-price {
                font-size: 1.2rem;
            }
            
            .property-title {
                font-size: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 15px;
            }
            
            .search-filter {
                margin: 80px 15px 20px;
                padding: 15px;
            }
            
            .filter-label {
                font-size: 0.85rem;
            }
            
            .filter-input, .filter-select {
                font-size: 0.9rem;
                padding: 10px 12px;
            }
            
            .bedroom-btn {
                padding: 8px 12px;
                font-size: 0.9rem;
            }
            
            .search-btn {
                padding: 12px 20px;
                font-size: 0.9rem;
            }
            
            .section-title {
                font-size: 1.3rem;
            }
            
            .property-price {
                font-size: 1.1rem;
            }
            
            .property-title {
                font-size: 0.95rem;
            }
            
            .property-details {
                font-size: 0.85rem;
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
    "
    <!-- Search Filter Section -->
    <form method="GET" action="{{ route('halaman-katalog') }}">
        <section class="search-filter">

            <div class="filter-group">
                <label class="filter-label">Perumahan</label>
                <select name="perumahan" class="filter-select">
                    <option value="">Semua Perumahan</option>
                    <option value="1" {{ request('perumahan') == '1' ? 'selected' : '' }}>Green City</option>
                    <option value="2" {{ request('perumahan') == '2' ? 'selected' : '' }}>Kelapa Gading Regency</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Jenis Properti</label>
                <select name="jenis" class="filter-select">
                    <option value="">Semua</option>
                    <option value="rumah" {{ request('jenis') == 'rumah' ? 'selected' : '' }}>Rumah</option>
                    <option value="ruko" {{ request('jenis') == 'ruko' ? 'selected' : '' }}>Ruko</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Kategori</label>
                <select name="kategori" class="filter-select">
                    <option value="">Semua</option>
                    <option value="subsidi" {{ request('kategori') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                    <option value="komersial" {{ request('kategori') == 'komersial' ? 'selected' : '' }}>Komersial</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Tipe Rumah</label>
                <select name="tipe" class="filter-select">
                    <option value="">Semua Tipe</option>
                    <option value="30/60" {{ request('tipe') == '30/60' ? 'selected' : '' }}>30 / 60</option>
                    <option value="36/72" {{ request('tipe') == '36/72' ? 'selected' : '' }}>36 / 72</option>
                    <option value="45/84" {{ request('tipe') == '45/84' ? 'selected' : '' }}>45 / 84</option>
                    <option value="60/135" {{ request('tipe') == '60/135' ? 'selected' : '' }}>60 / 135</option>
                    <option value="Ruko" {{ request('tipe') == 'Ruko' ? 'selected' : '' }}>Ruko</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Kisaran Harga</label>
                <select name="harga" class="filter-select">
                    <option value="">Semua Harga</option>
                    <option value="0-200" {{ request('harga') == '0-200' ? 'selected' : '' }}>Rp 0 - 200 Juta</option>
                    <option value="200-300" {{ request('harga') == '200-300' ? 'selected' : '' }}>Rp 200 - 300 Juta</option>
                    <option value="300-500" {{ request('harga') == '300-500' ? 'selected' : '' }}>Rp 300 - 500 Juta</option>
                    <option value="500+" {{ request('harga') == '500+' ? 'selected' : '' }}>Rp 500 Juta+</option>
                </select>
            </div>

            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i> Cari Properti
            </button>

        </section>
    </form>

    
    <!-- Properties Section -->
<section class="properties-section">
    
    <div class="properties-grid">
        
        @foreach($properti as $p)
        @php
            $bgStatus = $p->status_unit == 'tersedia' ? '#309561' : ($p->status_unit == 'dipesan' ? '#fef3c7' : '#b70c0c');
            $colorStatus = $p->status_unit == 'tersedia' ? '#059669' : ($p->status_unit == 'dipesan' ? '#f59e0b' : '#b70c0c');
            $labelStatus = $p->status_unit == 'tersedia' ? 'Tersedia' : ($p->status_unit == 'dipesan' ? 'Dipesan' : 'Terjual');
        @endphp

        <div class="property-card">
            <div class="property-image">
            <img src="img/tipe36.jpg" alt="{{ $p->nama_properti }}">
            {{-- Badge tersedia pindah ke sini --}}
            <div class="property-badge" style="background:{{ $bgStatus }}; color:white;">
                {{ $labelStatus }}
            </div>
        </div>

        <div class="property-info">
            <div class="property-price">
                Rp {{ number_format($p->harga_properti, 0, ',', '.') }}
            </div>
            <div class="property-title">
                {{ $p->nama_properti }}
            </div>
            <div class="property-location">
                <i class="fas fa-map-marker-alt"></i> Bondowoso
            </div>

            {{-- Tipe, kategori, blok sejajar --}}
            <div class="property-details">
                <div class="property-detail">
                    <i class="fas fa-ruler-combined"></i> {{ $p->tipe_properti }} m²
                </div>
                <div class="property-detail">
                    <i class="fas fa-tag"></i> {{ $p->kategori_properti }}
                </div>
                <div class="property-detail">
                    <i class="fas fa-map-pin"></i> Blok {{ $p->blok->nama_blok ?? '-' }}
                </div>
            </div>

                {{-- Hapus div blok yang lama --}}

                <div class="property-actions">
                    @auth
                        {{-- ✅ Sudah login: tampilkan "Lihat Detail" --}}
                        <a href="{{ route('detail-katalog', $p->id_properti) }}" 
                        class="action-btn btn-view">
                            Lihat Detail
                        </a>
                    @else
                        {{-- 🔒 Belum login: tampilkan "Login" --}}
                        <a href="{{ route('login') }}" 
                        class="action-btn btn-view">
                            Login
                        </a>
                    @endauth
                    
                    <button class="action-btn btn-contact">Hubungi</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div style="display:flex; justify-content:center; margin-top:30px;">
        {{ $properti->appends(request()->query())->links() }}
    </div>
</section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Carani Estate</h3>
                    <p>Platform terpercaya untuk membeli, menjual, dan menyewa properti sejak 2015.</p>
                    <div class="footer-social">
                        <div class="social-icon"><i class="fab fa-facebook-f"></i></div>
                        <div class="social-icon"><i class="fab fa-twitter"></i></div>
                        <div class="social-icon"><i class="fab fa-instagram"></i></div>
                        <div class="social-icon"><i class="fab fa-linkedin-in"></i></div>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Tautan Cepat</h3>
                    <ul class="footer-links">
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Katalog Properti</a></li>
                        <li><a href="#">ChatBot</a></li>
                        <li><a href="#">Riwayat Pemesanan</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Layanan</h3>
                    <ul class="footer-links">
                        <li><a href="#">Pembelian Properti</a></li>
                        <li><a href="#">Penjualan Properti</a></li>
                        <li><a href="#">Sewa Properti</a></li>
                        <li><a href="#">Konsultasi Properti</a></li>
                        <li><a href="#">Finansial & KPR</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Kontak Kami</h3>
                    <div class="footer-contact">
                        <p><i class="fas fa-map-marker-alt"></i> Jl. Melati No. 45, Jakarta Selatan</p>
                        <p><i class="fas fa-phone"></i> 0812-3456-7890</p>
                        <p><i class="fas fa-envelope"></i> info@propertiharmoni.com</p>
                        <p><i class="fas fa-clock"></i> Senin - Sabtu: 08:00 - 17:00</p>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                &copy; 2025 PropertiHarmoni. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    <script>
        // Add interactivity to bedroom buttons
        document.querySelectorAll('.bedroom-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.bedroom-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Add interactivity to search button
        document.querySelector('.search-btn').addEventListener('click', function() {
            alert('Mencari properti dengan kriteria yang dipilih...');
            // In a real application, you would perform the search here
        });
        
        // Add hover effect to property cards
        document.querySelectorAll('.property-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 8px 20px rgba(0,0,0,0.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.05)';
            });
        });
        
        // Add click event to action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const action = this.textContent.trim();
                const propertyTitle = this.closest('.property-card').querySelector('.property-title').textContent;
                
                if (action === 'Lihat Detail') {
                    alert(`Menampilkan detail properti: ${propertyTitle}`);
                } else if (action === 'Hubungi') {
                    alert(`Menghubungi agen untuk properti: ${propertyTitle}`);
                }
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

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
    </script>

    
</body>
</html>