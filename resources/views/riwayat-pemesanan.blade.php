<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan - PropertiHarmoni</title>
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
            font-family: "Roboto", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
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
        
        .page-header {
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 10px;
        }
        
        .page-subtitle {
            color: #64748b;
            font-size: 1.1rem;
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
        
        /* Search and Filter */
        .search-filter {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .filter-row {
            display: flex;
            gap: 20px;
            align-items: end;
            flex-wrap: wrap;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-label {
            font-weight: 600;
            color: #1a365d;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .filter-input, .filter-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .filter-input:focus, .filter-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(var(--primary-blue-rgb), 0.2);
            outline: none;
        }
        
        .filter-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.48 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
            padding-right: 40px;
        }
        
        .search-btn {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 120px;
        }
        
        .search-btn:hover {
            background: #6aa5c6;
        }
        
        /* Booking History */
        .booking-history {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .history-header {
            padding: 20px 30px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .history-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark-blue);
        }
        
        .history-stats {
            display: flex;
            gap: 20px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-blue);
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .history-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .history-table th {
            background: #f8fafc;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--dark-blue);
            font-size: 0.95rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .history-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        
        .history-table tr:hover {
            background: #f8fafc;
        }
        
        .property-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .property-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            background: #f1f5f9;
        }
        
        .property-details h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }
        
        .property-details p {
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
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
        
        .status-completed {
            background: #dbeafe;
            color: #2563eb;
        }
        
        .price {
            font-weight: 700;
            color: var(--dark-blue);
            font-size: 1.1rem;
        }
        
        .action-btn {
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 5px;
        }
        
        .btn-view {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-view:hover {
            background: #cbd5e0;
        }
        
        .btn-cancel {
            background: #fecaca;
            color: #dc2626;
        }
        
        .btn-cancel:hover {
            background: #fca5a5;
        }
        
        /* Pagination */
        .pagination-container {
            padding: 20px 30px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: center;
        }
        
        .pagination {
            display: flex;
            gap: 5px;
        }
        
        .page-item {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .page-item:hover {
            background: #f8fafc;
            border-color: var(--primary-blue);
        }
        
        .page-item.active {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-icon {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 20px;
        }
        
        .empty-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 10px;
        }
        
        .empty-message {
            color: #64748b;
            margin-bottom: 20px;
        }
        
        .btn-primary {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: #6aa5c6;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .filter-row {
                flex-direction: column;
                gap: 15px;
            }
            
            .search-btn {
                align-self: flex-start;
            }
            
            .history-stats {
                display: none;
            }
        }
        
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

            .main-content {
                padding: 20px 15px;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .history-table th,
            .history-table td {
                padding: 12px 15px;
                font-size: 0.9rem;
            }
            
            .property-image {
                width: 50px;
                height: 50px;
            }
            
            .property-details h4 {
                font-size: 0.9rem;
            }
            
            .action-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px;
            }
            
            .logo-text {
                display: none;
            }
            
            .logo-icon {
                width: 40px;
                height: 40px;
            }
            
            .nav-menu {
                display: none;
            }
            
            .main-content {
                padding: 15px;
            }
            
            .page-title {
                font-size: 1.3rem;
            }
            
            .filter-group {
                min-width: 100%;
            }
            
            .history-table {
                display: block;
                overflow-x: auto;
            }
            
            .history-table th,
            .history-table td {
                white-space: nowrap;
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
                <a href="{{ route('riwayat-pemesanan') }}"
                class="nav-item {{ request()->routeIs('riwayat-pemesanan') ? 'active' : '' }}">
                    Riwayat Pemesanan
                </a>
                <a href="{{ route('halaman-kontak') }}"
                class="nav-item {{ request()->routeIs('halaman-kontak') ? 'active' : '' }}">
                    Kontak
                </a>
            </nav>
            
            <div class="user-actions">
                {{-- Notifikasi hanya muncul kalau sudah login --}}
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

                {{-- Conditional: Guest vs Authenticated --}}
                @guest
                    <a href="{{ route('login') }}" class="nav-item login-link">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @else
                    <div class="profile-dropdown">
                        <div class="profile-icon" onclick="toggleDropdown()">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="{{ route('halaman-profil') }}">
                                <i class="fas fa-user-circle"></i> Lihat Profil
                            </a>
                            <hr>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Riwayat Pemesanan</h1>
            <p class="page-subtitle">Kelola dan pantau semua pemesanan properti Anda</p>
        </div>
        
        <!-- Search and Filter -->
        <div class="search-filter">
            <div class="filter-row">
                <div class="filter-group">
                    <label class="filter-label">Cari Properti</label>
                    <input type="text" class="filter-input" placeholder="Nama properti, lokasi, atau ID pemesanan">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Status Pemesanan</label>
                    <select class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="pending">Menunggu Verifikasi</option>
                        <option value="approved">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                        <option value="completed">Selesai</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Rentang Tanggal</label>
                    <input type="date" class="filter-input">
                </div>
                
                <button class="search-btn">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </div>
        
        <!-- Booking History -->
        <div class="booking-history">
            <div class="history-header">
                <h2 class="history-title">Daftar Pemesanan</h2>
                <div class="history-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $transaksi->total() }}</div>
                        <div class="stat-label">Total</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">
                            {{ $transaksi->where('status_transaksi', 'menunggu_pembayaran')->count() }}
                        </div>
                        <div class="stat-label">Aktif</div>
                    </div>
                </div>
            </div>
            
            <table class="history-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Properti</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $t)
                    @php
                        $statusClass = match($t->status_transaksi) {
                            'menunggu_pembayaran'  => 'status-pending',
                            'menunggu_verifikasi'  => 'status-pending',
                            'berhasil'             => 'status-approved',
                            'ditolak'              => 'status-rejected',
                            default                => 'status-pending'
                        };
                        $statusLabel = match($t->status_transaksi) {
                            'menunggu_pembayaran'  => 'Menunggu Pembayaran',
                            'menunggu_verifikasi'  => 'Menunggu Verifikasi',
                            'berhasil'             => 'Berhasil',
                            'ditolak'              => 'Ditolak',
                            default                => $t->status_transaksi
                        };
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="property-info">
                                <img src="img/tipe36.jpg" class="property-image">
                                <div class="property-details">
                                    <h4>{{ $t->properti->nama_properti ?? '-' }}</h4>
                                    <p>Tipe {{ $t->properti->tipe_properti ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}</td>
                        <td class="price">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('detail-pemesanan', $t->id_transaksi) }}" 
                            class="action-btn btn-view">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            @if($t->status_transaksi == 'menunggu_pembayaran')
                            <button class="action-btn btn-cancel">
                                <i class="fas fa-times"></i> Batalkan
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:40px; color:#64748b;">
                            Belum ada riwayat pemesanan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="pagination-container">
                {{ $transaksi->links() }}
            </div>
        </div>
    </div>

    <script>
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

