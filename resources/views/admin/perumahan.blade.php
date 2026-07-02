<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Perumahan - Carani Estate</title>
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
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.9),0 6px 14px rgba(0,0,0,0.08);
        border: 1px solid #d0d0d0;
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

    /* Data Tables */
    .data-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .table-header {
        padding: 20px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a365d;
    }

    .table-actions {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-primary {
        background: var(--primary-blue);
        color: white;
    }

    .btn-primary:hover {
        background: #6aa5c6;
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #4a5568;
    }

    .btn-secondary:hover {
        background: #cbd5e0;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    th, td {
        padding: 6px 10px;
        font-size: 0.9rem;
        line-height: 1.2;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
        word-wrap: break-word;
        vertical-align: middle;
    }

    th {
        padding: 8px 10px;
        background: #f8fafc;
        text-align: center;
        font-weight: 600;
        color: #1a365d;
        font-size: 0.95rem;
        position: sticky;
        top: 0;
        z-index: 10;
        vertical-align: middle;
    }

    tr {
        height: 38px;
    }

    tr:hover {
        background: #f1f5f9;
    }

    th:nth-child(1), td:nth-child(1) {
        width: 40px;
        text-align: center; /* ← Rata tengah horizontal */
        vertical-align: middle;
        white-space: nowrap;      /* ← PENTING! Mencegah angka pecah jadi 2 baris */
        word-wrap: normal;
    }
    
    th:nth-child(5){
        text-align: center !important;
    }

    /* Jumlah Blok */
    th:nth-child(4),
    td:nth-child(4){
        width: 110px;
        text-align: center;
    }

    /* Action */
    th:nth-child(5),
    td:nth-child(5){
        width: 140px;
        text-align: center;
        
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .status-tersedia {
        background: #d1fae5;
        color: #059669;
    }

    .status-dipesan {
        background: #fef3c7;
        color: #f59e0b;
    }

    .status-terjual {
        background: #e0f2fe;
        color: #2563eb;
    }

    .category-badge {
        padding: 4px 10px;
        border-radius: 16px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-block;
    }

    .category-subsidi {
        background: #ffedd5;
        color: #ea580c;
    }

    .category-komersial {
        background: #dbeafe;
        color: #2563eb;
    }

    .property-badge {
        padding: 4px 10px;
        border-radius: 16px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-block;
    }

    .property-rumah {
        background: #d1fae5;
        color: #059669;
    }

    .property-ruko {
        background: #fbcfe8;
        color: #be185d;
    }

    .project-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .project-kelapa {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .project-green {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }

    .price {
        font-weight: 700;
        color: var(--dark-blue);
    }

    .area {
        font-size: 0.9rem;
        color: #4a5568;
    }

    .stock {
        font-weight: 600;
        color: #1a365d;
    }

    .action-btn {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;        /* ← Flex untuk icon + text */
        align-items: center;
        justify-content: center;
        width: 100%;                 /* ← Lebar penuh dalam container */
        min-width: 35px; 
    }

    .action-group{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    .action-group form{
        margin: 0;
    }

    .action-btn{
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
        padding: 0;
        font-size: 13px;
    }

    .btn-edit{
        background: #3b82f6;
        color: white;
    }

    .btn-edit:hover{
        background: #2563eb;
    }

    .btn-delete{
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover{
        background: #dc2626;
    }

    .btn-view{
        background: #6b7280;
        color: white;
    }

    .btn-view:hover{
        background: #4b5563;
    }

    /* tombol kelola blok */
    .btn-kelola{
        background: #10b981;
        color: white;
        padding: 0 12px;
        height: 38px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    .btn-kelola:hover{
        background: #059669;
    }

    .block-badge{
        padding: 3px 8px;
        font-size: 0.75rem;
        border-radius: 8px;
        background: #ede9fe;
        color: #5b21b6;
    }

        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .table-actions {
                flex-direction: column;
                gap: 8px;
            }
            
            .search-bar {
                width: 250px;
            }
        }
        
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
            
            th, td {
                padding: 12px 10px;
                font-size: 0.85rem;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-width-collapsed) !important;
            }
            
            .sidebar-header {
                padding: 15px;
            }
            
            .main-content {
                margin-left: var(--sidebar-width-collapsed) !important;
            }
            
            .data-table-container {
                margin-bottom: 20px;
            }
            
            .table-header {
                padding: 15px;
            }
            
            .table-title {
                font-size: 1rem;
            }
            
            .btn-action {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
            
            .action-btn {
                padding: 4px 8px;
                font-size: 0.75rem;
            }

            th:nth-child(7),
            td:nth-child(7),
            th:nth-child(8),
            td:nth-child(8) {
                display: none; /* sembunyi luas */
            }

            th:nth-child(9),
            td:nth-child(9) {
                display: none; /* sembunyi stok */
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
                font-size: 1.1rem;
            }
            
            .table-header {
                padding: 12px 10px;
            }
            
            .table-title {
                font-size: 0.95rem;
            }
            
            th, td {
                padding: 10px 8px;
                font-size: 0.8rem;
            }
            
            th:nth-child(6), td:nth-child(6),
            th:nth-child(7), td:nth-child(7),
            th:nth-child(8), td:nth-child(8) {
                display: none;
            }
            
            .action-btn {
                padding: 3px 6px;
                font-size: 0.7rem;
            }
            
            .status-badge, .category-badge, .property-badge, .project-badge {
                padding: 3px 8px;
                font-size: 0.75rem;
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

            <a href="{{ route('admin.data_user') }}"
                class="nav-item {{ request()->routeIs('admin.data_user') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>Data User</span>
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
                <span>Verifikasi Dokumen</span>
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
            <h1 class="page-title">Data Perumahan</h1>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>

        @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

        <form method="GET" action="{{ route('admin.perumahan') }}" id="searchForm">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="search" 
                    placeholder="Cari perumahan..." 
                    value="{{ request('search') }}"
                    oninput="document.getElementById('searchForm').submit()">
            </div>
        </form>
        
        <!-- Data Rumah Table -->
        <div class="data-table-container">
            <div class="table-header">
                <div class="table-title">Daftar Perumahan Tersedia</div>
                <div class="table-actions">
                    <a href="{{ route('admin.tambah-perumahan') }}" class="btn-action btn-primary">
                        <i class="fas fa-plus"></i> Tambah Perumahan
                    </a>
                </div>
                
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perumahan</th>
                            <th>Lokasi Perumahan</th>
                            <th>Jumlah Blok</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($perumahan as $p)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $p->nama_perumahan }}
                            </td>

                            <td>
                                {{ $p->lokasi_perumahan }}
                            </td>

                            <td>
                                <span class="block-badge">
                                    {{ $p->blok->count() }} Blok
                                </span>
                            </td>

                            <td>
                                <div class="action-group">

                                    <a href="{{ route('admin.edit-perumahan', $p->id_perumahan) }}"
                                    class="action-btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form method="POST"
                                        action="{{ route('admin.hapus-perumahan', $p->id_perumahan) }}"
                                        style="display:inline;"
                                        onsubmit="return confirm('Yakin hapus perumahan ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.kelola-blok', $p->id_perumahan) }}"
                                    class="action-btn btn-view"
                                    title="Kelola Blok">
                                        <i class="fas fa-layer-group"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="4"
                                style="text-align:center;padding:30px;color:#64748b;">
                                Belum ada data perumahan
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>

                <div style="display:flex;justify-content:center;margin-top:20px;">
                    @if(method_exists($perumahan, 'links'))
                        {{ $perumahan->appends(request()->query())->links() }}
                    @endif
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Add active state to nav items
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Action button functionality
            document.querySelectorAll('.action-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const action = this.querySelector('i').className;
                    const row = this.closest('tr');
                    const propertyName = row.querySelector('td:nth-child(2)').textContent;
                    const propertyType = row.querySelector('td:nth-child(5)').textContent;
                    
                    if (action.includes('fa-edit')) {
                        alert(`Mengedit data perumahan: ${propertyName} - Tipe ${propertyType}`);
                    } else if (action.includes('fa-eye')) {
                        alert(`Menampilkan detail perumahan: ${propertyName} - Tipe ${propertyType}`);
                    }
                });
            });
            
            // Add property button
            document.querySelector('.btn-primary').addEventListener('click', function() {
                alert('Formulir tambah perumahan akan ditampilkan...');
            });
            
            // Search functionality
            const searchInput = document.querySelector('.search-bar input');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            
            // Statistics update
            const stats = {
                total: 10,
                available: document.querySelectorAll('.status-tersedia').length,
                booked: document.querySelectorAll('.status-dipesan').length,
                sold: document.querySelectorAll('.status-terjual').length
            };
            
            console.log('Statistik Properti:', stats);
        });
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

