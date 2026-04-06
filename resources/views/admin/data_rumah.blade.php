<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rumah - PropertiHarmoni</title>
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
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
        word-wrap: break-word;
        vertical-align: middle;
    }

    th {
        background: #f8fafc;
        font-weight: 600;
        color: #1a365d;
        font-size: 0.95rem;
        position: sticky;
        top: 0;
        z-index: 10;
        vertical-align: middle;
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

    th:last-child, td:last-child {
        width: 90px;
        text-align: center; /* ← Rata tengah horizontal */
        vertical-align: middle;
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
        flex-direction: column;      /* ← Ubah jadi kolom (atas-bawah) */
        align-items: stretch;        /* ← Lebar tombol mengikuti container */
        gap: 5px;                    /* ← Jarak antar tombol */
        width: fit-content; 
    }

    .btn-edit {
        background: #3b82f6;
        color: white;
    }

    .btn-edit:hover {
        background: #2563eb;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    .btn-view {
        background: #6b7280;
        color: white;
    }

    .btn-view:hover {
        background: #4b5563;
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
    <div class="sidebar">
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
                <i class="fas fa-users"></i>
                <span>Data User</span>
            </a>

            <a href="{{ route('admin.data_rumah') }}"
                class="nav-item {{ request()->routeIs('admin.data_rumah') ? 'active' : '' }}">
                <i class="fas fa-house"></i>
                <span>Data Rumah</span>
            </a>

            <a href="{{ route('admin.halaman_verifikasi') }}"
                class="nav-item {{ request()->routeIs('admin.halaman_verifikasi') ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i>
                <span>Verifikasi Data</span>
            </a>

            <a href="{{ route('admin.halaman_chatbot') }}"
                class="nav-item {{ request()->routeIs('admin.halaman_chatbot') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Chatbot</span>
            </a>
        
            <div class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title">Data Properti</h1>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin Utama</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.data_rumah') }}" id="searchForm">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="search" 
                    placeholder="Cari properti, blok, perumahan..." 
                    value="{{ request('search') }}"
                    oninput="document.getElementById('searchForm').submit()">
            </div>
        </form>
        
        <!-- Data Rumah Table -->
        <div class="data-table-container">
            <div class="table-header">
                <div class="table-title">Daftar Properti Tersedia</div>
                <div class="table-actions">
                    <a href="{{ route('admin.tambah-rumah') }}" class="btn-action btn-primary">
                        <i class="fas fa-plus"></i> Tambah Properti
                    </a>
                </div>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Properti</th>
                            <th>Blok</th>
                            <th>Jenis Properti</th>
                            <th>Kategori</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Luas Bangunan</th>
                            <th>Luas Tanah</th>
                            <th>Stok Unit</th>
                            <th>Status Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properti as $p)
                        @php
                            if ($p->status_unit == 'tersedia') {
                                $statusClass = 'status-tersedia';
                            } elseif ($p->status_unit == 'dipesan') {
                                $statusClass = 'status-dipesan';
                            } else {
                                $statusClass = 'status-terjual';
                            }

                            if ($p->perumahan && str_contains(strtolower($p->perumahan->nama_perumahan), 'kelapa')) {
                                $proyekClass = 'project-kelapa';
                            } else {
                                $proyekClass = 'project-green';
                            }
                        @endphp
                        <tr>
                            <td>
                                @if($isPaginated)
                                    {{ ($properti->currentPage() - 1) * $properti->perPage() + $loop->iteration }}
                                @else
                                    {{ $loop->iteration }}
                                @endif
                            </td>
                            <td>
                                <span class="project-badge {{ $proyekClass }}">
                                    {{ $p->perumahan->nama_perumahan ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="block-badge">
                                    {{ $p->blok->nama_blok ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="property-badge property-{{ $p->jenis_properti }}">
                                    {{ ucfirst($p->jenis_properti) }}
                                </span>
                            </td>
                            <td>
                                <span class="category-badge category-{{ $p->kategori_properti }}">
                                    {{ ucfirst($p->kategori_properti) }}
                                </span>
                            </td>
                            <td>{{ $p->tipe_properti }}</td>
                            <td>
                                <span class="price">
                                    Rp {{ number_format($p->harga_properti, 0, ',', '.') }}
                                </span>
                            </td>
                            <td><span class="area">{{ $p->luas_bangunan }} m²</span></td>
                            <td><span class="area">{{ $p->luas_tanah }} m²</span></td>
                            <td><span class="stock">{{ $p->stok_unit }} unit</span></td>
                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst($p->status_unit) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.edit_rumah', $p->id_properti) }}" 
                                    class="action-btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" 
                                        action="{{ route('admin.hapus_rumah', $p->id_properti) }}" 
                                        style="display:inline;"
                                        onsubmit="return confirm('Yakin hapus properti ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" style="text-align:center; padding:30px; color:#64748b;">
                                Belum ada data properti
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div style="display:flex; justify-content:center; margin-top:20px;">
                    @if($isPaginated)
                        {{ $properti->appends(request()->query())->links() }}
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
                        alert(`Mengedit data properti: ${propertyName} - Tipe ${propertyType}`);
                    } else if (action.includes('fa-eye')) {
                        alert(`Menampilkan detail properti: ${propertyName} - Tipe ${propertyType}`);
                    }
                });
            });
            
            // Add property button
            document.querySelector('.btn-primary').addEventListener('click', function() {
                alert('Formulir tambah properti akan ditampilkan...');
            });
            
            // Export button
            document.querySelector('.btn-secondary').addEventListener('click', function() {
                alert('Data properti sedang diproses untuk export ke Excel...');
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

        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            
            // Simpan state ke localStorage
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        // Load sidebar state saat page load
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }
            
            // Hover effect untuk sidebar (opsional - untuk expand temporary)
            sidebar.addEventListener('mouseenter', function() {
                if (this.classList.contains('collapsed')) {
                    this.style.width = 'var(--sidebar-width-expanded)';
                }
            });
            
            sidebar.addEventListener('mouseleave', function() {
                if (this.classList.contains('collapsed')) {
                    this.style.width = 'var(--sidebar-width-collapsed)';
                }
            });
        });
    </script>
</body>
</html>

