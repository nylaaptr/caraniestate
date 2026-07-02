<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Pemesanan - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* =========================================
           PROVIDED SIDEBAR & MAIN STYLES
           ========================================= */
        :root {
            --primary-blue: #7AB2D3;
            --primary-blue-rgb: 122, 178, 211;
            --dark-blue: #1E3A5F;
            --light-blue: #e6f2f8;
            --sidebar-width-collapsed: 80px;
            --sidebar-width-expanded: 250px;
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

        .sidebar {
            width: var(--sidebar-width-collapsed);
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
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            flex-shrink: 0;
        }

        .logo i {
            font-size: 20px;
            color: var(--dark-blue);
        }

        .company-name {
            font-weight: 700;
            font-size: 0.85rem;
            line-height: 1.2;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

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
            padding: 15px 20px;
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
            flex-shrink: 0;
        }

        .nav-item span {
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            display: inline-block;
        }

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
            color: #ffffff;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
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
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar:hover .logout-btn span {
            opacity: 1;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width-collapsed);
            margin-right: 20px;
            overflow-y: auto;
            padding: 20px;
            background: #f8fafc;
            transition: margin-left 0.3s ease;
        }

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

        /* =========================================
           CUSTOM PAGE COMPONENTS STYLES
           ========================================= */
        .breadcrumb {
            display: flex;
            gap: 8px;
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 15px;
            align-items: center;
        }
        .breadcrumb a { color: var(--dark-blue); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb i { color: #cbd5e1; font-size: 0.8rem; }

        .refresh-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        .refresh-btn {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .refresh-btn:hover { background: var(--dark-blue); transform: translateY(-2px); }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            margin-bottom: 25px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: flex-end;
            border: 1px solid #e2e8f0;
        }
        .filter-form{
            width: 100%;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .custom-search{
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0 12px;
        }

        .custom-search i{
            color: #94a3b8;
        }

        .custom-search input{
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            padding: 10px 0;
            font-size: 0.95rem;
        }

        .filter-action{
            display: flex;
            align-items: flex-end;
        }

        .filter-btn{
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover{
            background: var(--dark-blue);
            transform: translateY(-2px);
        }
        .filter-group { flex: 1; min-width: 200px; }
        .filter-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }
        .filter-input, .filter-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
            background: #f8fafc;
            transition: all 0.2s ease;
        }
        .filter-input:focus, .filter-select:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15);
        }

        /* Table Card */
        .table-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .table-card-header {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 700;
            color: var(--dark-blue);
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-wrapper {
            overflow-x: auto;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }
        th {
            background: #f8fafc;
            padding: 15px 20px;
            text-align: left;
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }
        td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.95rem;
            color: #334155;
            transition: background 0.2s;
        }
        tr:hover td { background: #f8fafc; }
        tr:last-child td { border-bottom: none; }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .customer-avatar {
            width: 40px;
            height: 40px;
            background: #e2e8f0;
            color: #475569;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }
        .badge-proses { background: #fff3cd; color: #d97706; border: 1px solid #fde68a; }
        .badge-selesai { background: #d1fae5; color: #059669; border: 1px solid #a7f3d0; }
        .badge-ditolak { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }

        .method-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            background: #e0f2fe;
            color: #0369a1;
        }

        .detail-btn {
            padding: 8px 16px;
            background: var(--dark-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }
        .detail-btn:hover {
            background: #0f172a;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(30, 58, 95, 0.2);
        }

        .pagination{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:8px;
            padding:20px;
            list-style:none;
        }

        .page-item{
            list-style:none;
        }

        .page-link{
            display:block;
            padding:8px 14px;
            border-radius:8px;
            border:1px solid #dbeafe;
            text-decoration:none;
            color:#1e3a5f;
            background:white;
            transition:0.3s;
        }

        .page-link:hover{
            background:#eff6ff;
        }

        .page-item.active .page-link{
            background:#1e3a5f;
            color:white;
            border-color:#1e3a5f;
        }

        .page-item.disabled .page-link{
            opacity:0.5;
            cursor:not-allowed;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .main-content { margin-left: 80px; }
            .filter-section { flex-direction: column; align-items: stretch; }
            .filter-group { min-width: 100%; }
            .search-bar { width: 200px; }
        }
        @media (max-width: 768px) {
            .sidebar { width: 60px; }
            .main-content { margin-left: 60px; padding: 15px; }
            .header { flex-direction: column; gap: 15px; align-items: flex-start; }
            .user-profile { display: none; }
            .search-bar { width: 100%; box-sizing: border-box; }
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
        <!-- Header Page -->
        <div class="header">
            <h1 class="page-title">Monitoring Pemesanan</h1>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>

        <!-- Filter & Search Section -->
        <div class="filter-section">
            <form method="GET" class="filter-form">
                {{-- Search --}}
                <div class="filter-group">
                    <label>Cari Pesanan</label>
                    <div class="search-bar custom-search">
                        <i class="fas fa-search"></i>
                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari pelanggan / properti...">
                    </div>
                </div>

                {{-- Status --}}
                <div class="filter-group">
                    <label>Status Pemesanan</label>
                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="Proses"
                            {{ request('status') == 'Proses' ? 'selected' : '' }}>
                            Proses
                        </option>

                        <option value="Selesai"
                            {{ request('status') == 'Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                        <option value="Ditolak"
                            {{ request('status') == 'Ditolak' ? 'selected' : '' }}>
                            Ditolak
                        </option>
                    </select>
                </div>

                {{-- Metode --}}
                <div class="filter-group">
                    <label>Metode Pembayaran</label>
                    <select name="metode" class="filter-select">
                        <option value="">Semua Metode</option>
                        <option value="kredit"
                            {{ request('metode') == 'kredit' ? 'selected' : '' }}>
                            KPR
                        </option>

                        <option value="lunas"
                            {{ request('metode') == 'lunas' ? 'selected' : '' }}>
                            Lunas
                        </option>
                    </select>
                </div>

                {{-- Sorting --}}
                <div class="filter-group">
                    <label>Urutkan</label>
                    <select name="sort" class="filter-select">
                        <option value="latest"
                            {{ request('sort') == 'latest' ? 'selected' : '' }}>
                            Terbaru
                        </option>

                        <option value="oldest"
                            {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                            Terlama
                        </option>

                        <option value="name_asc"
                            {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                            Nama A-Z
                        </option>

                        <option value="name_desc"
                            {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                            Nama Z-A
                        </option>
                    </select>
                </div>
                {{-- Button --}}
                <div class="filter-action">
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <div class="refresh-container">
            <button class="refresh-btn">
                <i class="fas fa-sync-alt"></i> Refresh Data
            </button>
        </div>


        <!-- Table Monitoring -->
        <div class="table-card">
            <div class="table-card-header">
                <span>Daftar Seluruh Pemesanan Pelanggan</span>
                <span style="font-size:0.85rem; color:#64748b; font-weight:500;">
                    Menampilkan {{ $pemesanan->count() }} dari {{ $pemesanan->total() }} data
                </span>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Properti</th>
                            <th>Metode Pembayaran</th>
                            <th>Tahap Saat Ini</th>
                            <th>Status</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesanan as $item)
                        <tr>
                            <td>{{ ($pemesanan->currentPage() - 1) * $pemesanan->perPage() + $loop->iteration }}</td>

                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($item->user->nama_user, 0, 1)) }}
                                    </div>

                                    <div>
                                        <strong>{{ $item->user->nama_user }}</strong><br>

                                        <span style="font-size:0.8rem; color:#94a3b8;">
                                            {{ $item->user->kode_customer }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                {{ $item->properti->nama_properti }}
                                - {{ $item->properti->tipe_properti }}
                            </td>

                            <td>
                                <span class="method-badge">
                                    {{ $item->metode_pembayaran }}
                                </span>
                            </td>

                            <td>{{ $item->tahap_saat_ini }}</td>

                            <td>
                                <span class="status-badge">
                                    {{ $item->status }}
                                </span>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->format('d M Y') }}
                            </td>

                            <td>
                                <a href="{{ route('monitoring.show', $item->id_pemesanan) }}"
                                class="detail-btn">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">
                {{ $pemesanan->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</body>
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
</html>

