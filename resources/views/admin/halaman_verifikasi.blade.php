<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dokumen - Carani Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
        --primary-blue: #7AB2D3;
        --primary-blue-rgb: 122, 178, 211;
        --dark-blue: #1E3A5F;
        --light-blue: #e6f2f8;
        --sidebar-width-collapsed: 80px;  /* Lebar saat collapse */
        --sidebar-width-expanded: 250px;  /* Lebar saat expand */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width-collapsed);  /* Default collapsed */
            background: linear-gradient(135deg, var(--dark-blue) 0%, #1E3A5F 100%);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            box-shadow: 5px 0 20px rgba(0,0,0,0.1);
            transition: width 0.3s ease;
            overflow: hidden;
        }

        /* Expand sidebar saat hover */
        .sidebar:hover {
            width: var(--sidebar-width-expanded);
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            white-space: nowrap;
            overflow: hidden;
        }

        .logo {
            width: 40px;  /* Lebih kecil saat collapse */
            height: 40px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            flex-shrink: 0;  /* Mencegah logo mengecil */
        }

        .logo i {
            font-size: 20px;  /* Lebih kecil saat collapse */
            color: var(--dark-blue);
        }

        .company-name {
            font-weight: 700;
            font-size: 0.85rem;
            line-height: 1.2;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            opacity: 0;  /* Sembunyikan text saat collapse */
            transition: opacity 0.3s ease;
        }

        /* Tampilkan company name saat hover */
        .sidebar:hover .company-name {
            opacity: 1;
        }

        .nav-menu {
            padding: 25px 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-menu a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .nav-item {
            padding: 15px 20px;  /* Padding lebih kecil */
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 4px solid transparent;
            white-space: nowrap;
            overflow: hidden;
        }

        .nav-group {
            display: flex;
            flex-direction: column;
        }

        .nav-parent {
            justify-content: space-between;
        }

        .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .nav-submenu {
            display: none;
            flex-direction: column;
            padding-left: 40px;
            transition: all 0.2s ease;
        }
        

        /* optional arrow */
        .nav-group.open .arrow {
            transform: rotate(180deg);
        }

        .nav-submenu a {
            padding: 10px 20px;
            font-size: 0.9rem;
            opacity: 0.85;
        }

        .nav-submenu a:hover {
            opacity: 1;
        }

        /* open state */
        .nav-group.open .nav-submenu {
            display: flex;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.08);
            border-left-color: var(--primary-blue);
        }

        .nav-item.active {
            background: rgba(255,255,255,0.1);
            border-left-color: var(--primary-blue);
        }

        .nav-item i {
            font-size: 18px;
            width: 24px;
            text-align: center;
            flex-shrink: 0;  /* Mencegah icon mengecil */
        }

        .nav-item span {
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 0;  /* Sembunyikan text nav saat collapse */
            transition: opacity 0.3s ease;
            display: inline-block;
        }

        /* Tampilkan text nav saat hover */
        .sidebar:hover .nav-item span {
            opacity: 1;
        }

        .logout-btn {
            padding: 15px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: auto;
            white-space: nowrap;
            overflow: hidden;
            color: #ffff;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.08);
        }

        .logout-btn i {
            font-size: 18px;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
        }

        .logout-btn span {
            opacity: 0;  /* Sembunyikan text logout saat collapse */
            transition: opacity 0.3s ease;
        }

        /* Tampilkan text logout saat hover */
        .sidebar:hover .logout-btn span {
            opacity: 1;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width-collapsed);  /* Sesuaikan dengan collapsed width */
            margin-right: 20px;
            overflow-y: auto;
            padding: 20px;
            background: #f8fafc;
            transition: margin-left 0.3s ease;
        }

        /* Expand main content saat sidebar hover */
        .sidebar:hover + .main-content {
            margin-left: var(--sidebar-width-expanded);
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a365d;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 8px 15px;
            width: 300px;
        }
        
        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            padding: 5px;
            width: 100%;
            font-size: 0.95rem;
        }
        
        .search-bar i {
            color: #64748b;
            margin-right: 10px;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 18px;
        }
        
        .user-info {
            text-align: right;
        }
        
        .user-name {
            font-weight: 600;
            color: #1a365d;
        }
        
        .user-role {
            font-size: 0.85rem;
            color: #64748b;
        }
        
        /* Verification Container */
        .verification-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .verification-header {
            padding: 20px 30px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .verification-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-blue);
        }
        
        .filter-controls {
            display: flex;
            gap: 10px;
            text-decoration: none;
        }
        
        .filter-btn {
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.85rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .filter-btn.active {
            background: var(--primary-blue);
            color: white;
        }
        
        .filter-btn:not(.active) {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        /* Table Styles */
        .verification-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .verification-table th {
            background: #f8fafc;
            font-weight: 600;
            color: var(--dark-blue);
            font-size: 0.95rem;
            padding: 15px 20px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .verification-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.95rem;
        }
        
        .verification-table tr:hover {
            background: #f8fafc;
        }
        
        .role-badge {
            padding: 4px 10px;
            border-radius: 16px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .role-admin {
            background: #dbeafe;
            color: #2563eb;
        }
        
        .role-user {
            background: #d1fae5;
            color: #059669;
        }
        
        .status-badge {
            padding: 5px 12px;
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
        
        .btn-view-docs {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn-view-docs:hover {
            background: #6aa5c6;
            transform: translateY(-1px);
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        .document-modal {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            transform: scale(0.9);
            transition: all 0.3s ease;
        }
        
        .modal-overlay.show .document-modal {
            transform: scale(1);
        }
        
        .modal-header {
            padding: 20px 30px;
            background: linear-gradient(135deg, var(--dark-blue) 0%, #1a365d 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-title {
            font-size: 1.3rem;
            font-weight: 700;
        }
        
        .close-modal {
            background: rgba(255,255,255,0.2);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .close-modal:hover {
            background: rgba(255,255,255,0.3);
        }
        
        .modal-body {
            padding: 25px 30px;
            max-height: 70vh;
            overflow-y: auto;
        }
        
        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }
        
        .document-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .document-item:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .document-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: white;
            font-size: 28px;
        }
        
        .document-name {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .document-preview {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
            background: #e2e8f0;
        }
        
        .document-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
            margin-top: 8px;
        }
        
        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }
        
        .btn-approve-all {
            background: #d1fae5;
            color: #059669;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-approve-all:hover {
            background: #86efac;
        }
        
        .btn-reject-all {
            background: #fecaca;
            color: #dc2626;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-reject-all:hover {
            background: #fca5a5;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }
            
            .sidebar-header {
                justify-content: center;
                padding: 20px;
            }
            
            .company-name {
                display: none;
            }
            
            .nav-item span {
                display: none;
            }
            
            .nav-item {
                justify-content: center;
                padding: 15px;
            }
            
            .logout-btn {
                justify-content: center;
                padding: 15px;
            }
            
            .main-content {
                margin-left: 80px;
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
            }
            
            .search-bar {
                width: 100%;
            }
            
            .page-title {
                font-size: 1.3rem;
            }
            
            .documents-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }
            
            .sidebar-header {
                padding: 15px;
            }
            
            .main-content {
                margin-left: 60px;
            }
            
            .verification-table {
                font-size: 0.85rem;
            }
            
            .verification-table th,
            .verification-table td {
                padding: 10px 15px;
            }
            
            .documents-grid {
                grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            }
        }
        
        @media (max-width: 480px) {
            .sidebar {
                width: 50px;
            }
            
            .main-content {
                margin-left: 50px;
            }
            
            .page-title {
                font-size: 1.2rem;
            }
            
            .verification-title {
                font-size: 1.1rem;
            }
            
            .filter-controls {
                flex-wrap: wrap;
            }
            
            .filter-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
            }
            
            .verification-table {
                display: block;
                overflow-x: auto;
            }
            
            .modal-title {
                font-size: 1.1rem;
            }
            
            .modal-body {
                padding: 20px;
            }
            
            .documents-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
            
            .document-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }
            
            .document-name {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar"  id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-home"></i>
            </div>
            <div class="company-name">PT. Carani Bhanu Balakosa</div>
        </div>
        
        <div class="nav-menu" id="navMenu">
            <a href="{{ route('admin.welcome') }}"
                class="nav-item {{ request()->routeIs('admin.welcome') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <div class="nav-group" id="propertiMenu">
                <div class="nav-item nav-parent" onclick="toggleMenu('propertiMenu')">
                    <i class="fas fa-house"></i>
                    <span>Properti</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>

                <div class="nav-submenu">
                    <a href="{{ route('admin.data_rumah') }}" class="nav-subitem">
                        <span>Data Rumah</span>
                    </a>

                    <a href="{{ route('admin.perumahan') }}" class="nav-subitem">
                        <span>Perumahan</span>
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.halaman_verifikasi') }}"
                class="nav-item {{ request()->routeIs('admin.halaman_verifikasi') ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i>
                <span>Verifikasi Data</span>
            </a>

            <a href="{{ route('admin.monitoring-pemesanan') }}"
                class="nav-item {{ request()->routeIs('admin.monitoring-pemesanan') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Monitoring</span>
            </a>

            <a href="{{ route('admin.laporan_penjualan') }}"
                class="nav-item {{ request()->routeIs('admin.laporan_penjualan') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan Penjualan</span>
            </a>

            <a href="{{ route('admin.pesan_pelanggan') }}"
                class="nav-item {{ request()->routeIs('admin.pesan_pelanggan') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Pesan Pelanggan</span>
            </a>
        
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn" style="width:100%; background:none; border:none; cursor:pointer; text-align:left;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

<!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title">Verifikasi Dokumen Pengguna</h1>
            
            <form method="GET" action="{{ route('admin.halaman_verifikasi') }}">
                <div class="search-bar">
                    <i class="fas fa-search"></i>

                    {{-- supaya filter status tidak hilang --}}
                    <input 
                        type="hidden" 
                        name="status" 
                        value="{{ request('status') }}">

                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama / email / no hp..."
                        onchange="this.form.submit()">
                </div>
            </form>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
        
        <!-- Verification Container -->
        <div class="verification-container">
            <div class="verification-header">
                <h2 class="verification-title">Daftar Dokumen Menunggu Verifikasi</h2>
                
                {{-- Filter --}}
                <div class="filter-controls">
                    <a href="{{ route('admin.halaman_verifikasi', [
                        'search' => request('search')
                    ]) }}"
                    class="filter-btn {{ !request('status') ? 'active' : '' }}">
                        Semua
                    </a>

                    <a href="{{ route('admin.halaman_verifikasi', [
                        'status' => 'pending',
                        'search' => request('search')
                    ]) }}"
                    class="filter-btn {{ request('status') == 'pending' ? 'active' : '' }}">
                        Menunggu
                    </a>

                    <a href="{{ route('admin.halaman_verifikasi', [
                        'status' => 'diterima',
                        'search' => request('search')
                    ]) }}"
                    class="filter-btn {{ request('status') == 'diterima' ? 'active' : '' }}">
                        Disetujui
                    </a>

                    <a href="{{ route('admin.halaman_verifikasi', [
                        'status' => 'ditolak',
                        'search' => request('search')
                    ]) }}"
                    class="filter-btn {{ request('status') == 'ditolak' ? 'active' : '' }}">
                        Ditolak
                    </a>

                </div>
            </div>

            @if(session('success'))
                <div style="background:#d1fae5; color:#059669; padding:12px; border-radius:8px; margin-bottom:15px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="overflow-x:auto;">
                <table class="verification-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Jumlah Dokumen</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    {{-- Ganti tbody ini --}}
                    <tbody>
                        @forelse($user as $u)  {{-- $u sekarang adalah Transaksi --}}
                        <tr>
                            <td>{{ $user->firstItem() + $loop->index }}</td>
                            
                            {{-- Akses user lewat relasi --}}
                            <td>{{ $u->user->nama_user ?? '-' }}</td>
                            <td>{{ $u->user->no_hp ?? '-' }}</td>
                            <td>{{ $u->user->email_user ?? '-' }}</td>

                            {{-- ✅ JUMLAH DOKUMEN: hitung dari relasi dokumen --}}
                            <td>
                                {{ $u->dokumen->count() }} Dokumen
                            </td>

                            <td>
                                {{ ucfirst($u->jenis_transaksi) }}
                            </td>

                            <td>
                                @php
                                    $status = $u->dokumen->pluck('status_verifikasi');
                                    if ($status->contains('pending')) {
                                        $statusLabel = 'Pending';
                                        $statusClass = 'status-pending';
                                    } elseif ($status->every(fn($s) => $s == 'diterima')) {
                                        $statusLabel = 'Disetujui';
                                        $statusClass = 'status-approved';
                                    } elseif ($status->contains('ditolak')) {
                                        $statusLabel = 'Ditolak';
                                        $statusClass = 'status-rejected';
                                    } else {
                                        $statusLabel = 'Revisi';
                                        $statusClass = 'status-pending';
                                    }
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td>
                                {{-- ✅ Gunakan id_transaksi --}}
                                <a href="{{ route('admin.verifikasi_dokumen', $u->id_transaksi) }}"
                                style="color:#2563eb; font-size:1.2rem;"
                                title="Lihat Dokumen">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align:center; padding:30px; color:#64748b;">
                                Belum ada data pengajuan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div style="margin-top:20px;">
                    {{ $user->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        {{-- Modal Tolak --}}
        <div id="tolakModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
                                    background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
            <div style="background:white; border-radius:16px; padding:30px; max-width:400px; width:90%;">
                <h3 style="color:#1E3A5F; margin-bottom:15px;">Alasan Penolakan</h3>
                <form method="POST" id="tolakForm">
                    @csrf
                    <textarea name="catatan" rows="4" 
                            style="width:100%; padding:12px; border:2px solid #e2e8f0; border-radius:8px; margin-bottom:15px;"
                            placeholder="Masukkan alasan penolakan..." required></textarea>
                    <div style="display:flex; gap:10px;">
                        <button type="button" onclick="closeTolakModal()"
                                style="flex:1; padding:12px; background:#e2e8f0; border:none; border-radius:8px; cursor:pointer;">
                            Batal
                        </button>
                        <button type="submit"
                                style="flex:1; padding:12px; background:#dc2626; color:white; border:none; border-radius:8px; cursor:pointer;">
                            Tolak Dokumen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Filter buttons
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // View documents button
            const viewButtons = document.querySelectorAll('.btn-view-docs');
            const modal = document.getElementById('documentModal');
            const closeModal = document.getElementById('closeModal');
            const modalUserName = document.getElementById('modalUserName');
            
            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userName = this.dataset.user;
                    modalUserName.textContent = userName;
                    modal.classList.add('show');
                });
            });
            
            // Close modal
            closeModal.addEventListener('click', function() {
                modal.classList.remove('show');
            });
            
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('show');
                }
            });
            
            // Approve all button
            document.querySelector('.btn-approve-all').addEventListener('click', function() {
                const userName = modalUserName.textContent;
                if (confirm(`Apakah Anda yakin ingin menyetujui semua dokumen untuk ${userName}?`)) {
                    // Update all document statuses to approved
                    const statusBadges = modal.querySelectorAll('.document-status');
                    statusBadges.forEach(badge => {
                        badge.className = 'document-status status-approved';
                        badge.textContent = 'Disetujui';
                        badge.style.background = '#d1fae5';
                        badge.style.color = '#059669';
                    });
                    
                    alert(`Semua dokumen untuk ${userName} berhasil disetujui!`);
                    modal.classList.remove('show');
                    
                    // Update table status
                    const tableRows = document.querySelectorAll('tbody tr');
                    tableRows.forEach(row => {
                        const nameCell = row.querySelector('td:nth-child(2)');
                        if (nameCell && nameCell.textContent === userName) {
                            const statusCell = row.querySelector('td:nth-child(6)');
                            statusCell.innerHTML = '<span class="status-badge status-approved">Disetujui</span>';
                        }
                    });
                }
            });
            
            // Reject all button
            document.querySelector('.btn-reject-all').addEventListener('click', function() {
                const userName = modalUserName.textContent;
                const reason = prompt(`Masukkan alasan penolakan semua dokumen untuk ${userName}:`);
                if (reason) {
                    // Update all document statuses to rejected
                    const statusBadges = modal.querySelectorAll('.document-status');
                    statusBadges.forEach(badge => {
                        badge.className = 'document-status status-rejected';
                        badge.textContent = 'Ditolak';
                        badge.style.background = '#fecaca';
                        badge.style.color = '#dc2626';
                    });
                    
                    alert(`Semua dokumen untuk ${userName} ditolak dengan alasan: ${reason}`);
                    modal.classList.remove('show');
                    
                    // Update table status
                    const tableRows = document.querySelectorAll('tbody tr');
                    tableRows.forEach(row => {
                        const nameCell = row.querySelector('td:nth-child(2)');
                        if (nameCell && nameCell.textContent === userName) {
                            const statusCell = row.querySelector('td:nth-child(6)');
                            statusCell.innerHTML = '<span class="status-badge status-rejected">Ditolak</span>';
                        }
                    });
                }
            });
        });

        document.querySelectorAll('.btn-tolak').forEach(btn => {
            btn.addEventListener('click', function() {
                showTolakModal(this.dataset.id);
            });
        });

        function showTolakModal(id) {
        document.getElementById('tolakForm').action = '/verifikasi/' + id + '/tolak';
        const modal = document.getElementById('tolakModal');
        modal.style.display = 'flex';
    }

    function closeTolakModal() {
        document.getElementById('tolakModal').style.display = 'none';
    }
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    if (!sidebar || !mainContent) {
        console.error("sidebar / mainContent tidak ditemukan");
        return;
    }

    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

    function closeAllDropdowns() {
        document.querySelectorAll('.nav-group.open').forEach(el => {
            el.classList.remove('open');
        });
    }

    // INIT STATE
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
        mainContent.classList.add('expanded');
        closeAllDropdowns();
    }

    // HOVER IN
    sidebar.addEventListener('mouseenter', function () {
        if (this.classList.contains('collapsed')) {
            this.classList.add('hovering');
        }
    });

    // HOVER OUT
    sidebar.addEventListener('mouseleave', function () {
        this.classList.remove('hovering');
        closeAllDropdowns();
    });
});


/* ===================================================
   TOGGLE DROPDOWN (INI WAJIB GLOBAL BIAR onclick WORK)
=================================================== */
window.toggleMenu = function (id) {

    const sidebar = document.getElementById('sidebar');
    const el = document.getElementById(id);

    if (!el || !sidebar) return;

    // kalau sidebar collapsed DAN tidak hover → blok
    const isBlocked =
        sidebar.classList.contains('collapsed') &&
        !sidebar.classList.contains('hovering');

    if (isBlocked) return;

    el.classList.toggle('open');
};
</script>
</body>
</html>
