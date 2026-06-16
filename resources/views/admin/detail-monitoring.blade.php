<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Monitoring Pemesanan - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* =========================================
           PROVIDED STYLES
           ========================================= */
        :root {
            --primary-blue: #7AB2D3;
            --primary-blue-rgb: 122, 178, 211;
            --dark-blue: #1E3A5F;
            --light-blue: #e6f2f8;
            --sidebar-width-collapsed: 80px;
            --sidebar-width-expanded: 250px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

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
        .sidebar:hover { width: var(--sidebar-width-expanded); }

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
            font-size: 0.95rem; opacity: 0; transition: opacity 0.3s ease; display: inline-block; }
        .sidebar:hover .nav-item span { opacity: 1; }

        .logout-btn {
            padding: 15px 20px; cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center; gap: 15px;
            border-top: 1px solid rgba(255,255,255,0.1); margin-top: auto;
            white-space: nowrap; overflow: hidden; color: #ffffff;
            background: none; border: none; width: 100%; text-align: left;
        }
        .logout-btn:hover { background: rgba(255,255,255,0.08); }
        .logout-btn i { font-size: 18px; width: 24px; text-align: center; flex-shrink: 0; }
        .logout-btn span { opacity: 0; transition: opacity 0.3s ease; }
        .sidebar:hover .logout-btn span { opacity: 1; }

        .main-content {
            flex: 1; margin-left: var(--sidebar-width-collapsed); margin-right: 20px;
            overflow-y: auto; padding: 20px; background: #f8fafc; transition: margin-left 0.3s ease;
        }
        .sidebar:hover + .main-content { margin-left: var(--sidebar-width-expanded); }

        .header {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 20px; background: white; border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 25px;
        }
        .page-title { font-size: 1.5rem; font-weight: 700; color: #1a365d; }
        .search-bar { display: flex; align-items: center; background: #f1f5f9; border-radius: 8px; padding: 8px 15px; width: 300px; box-shadow: inset 0 1px 0 rgba(255,255,255,0.9),0 6px 14px rgba(0,0,0,0.08); border: 1px solid #d0d0d0; }
        .search-bar input { border: none; background: transparent; outline: none; padding: 5px; width: 100%; font-size: 0.95rem; }
        .search-bar i { color: #64748b; margin-right: 10px; }
        .user-profile { display: flex; align-items: center; gap: 15px; cursor: pointer; }
        .avatar { width: 40px; height: 40px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 18px; }
        .user-info { text-align: right; }
        .user-name { font-weight: 600; color: #1a365d; }
        .user-role { font-size: 0.85rem; color: #64748b; }

        /* =========================================
           CUSTOM DASHBOARD STYLES
           ========================================= */
        .breadcrumb { display: flex; gap: 8px; font-size: 0.9rem; color: #64748b; margin-bottom: 20px; align-items: center; }
        .breadcrumb a { color: var(--dark-blue); text-decoration: none; transition: 0.2s; }
        .breadcrumb a:hover { color: var(--primary-blue); text-decoration: underline; }
        .breadcrumb i { color: #cbd5e1; font-size: 0.8rem; }
        .breadcrumb span { color: #334155; font-weight: 600; }

        .back-btn { margin-left: auto; padding: 8px 14px; background: white; border: 1px solid #cbd5e1; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.2s; display: flex; align-items: center; gap: 6px; color: #475569; font-size: 0.9rem; }
        .back-btn:hover { background: #f8fafc; border-color: var(--dark-blue); color: var(--dark-blue); }

        .dashboard-grid { 
            display: grid; 
            grid-template-columns: 1.8fr 0.7fr;
            gap: 24px; 
            align-items: start;
        }

        .left-col .card{
            padding: 28px;
        }

        .right-col .card{
            padding: 18px;
        }

        @media (max-width: 1100px) { .dashboard-grid { grid-template-columns: 1fr; } }

        .card { background: white; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); padding: 24px; margin-bottom: 24px; border: 1px solid #e2e8f0; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--dark-blue); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; }
        .card-title i { color: var(--primary-blue); }

        /* Info Card */
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; }
        .info-item { background: #f8fafc; padding: 14px; border-radius: 10px; border: 1px solid #f1f5f9; }
        .info-label { font-size: 0.8rem; color: #64748b; margin-bottom: 5px; font-weight: 500; }
        .info-val { font-size: 0.95rem; font-weight: 700; color: var(--dark-blue); }
        .status-badge { 
            padding: 6px 12px; 
            border-radius: 20px; 
            font-size: 0.85rem; 
            font-weight: 700; 
            display: inline-flex; align-items: center; gap: 6px; }
        .badge-proses { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
        .badge-selesai { 
            background: #dcfce7; 
            color: #16a34a; border: 1px solid #bbf7d0; }
        .badge-ditolak { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }

        /* Progress Timeline */
        .progress-timeline { position: relative; padding-left: 25px; margin-top: 10px; }
        .progress-timeline::before { content: ''; position: absolute; left: 12px; top: 5px; bottom: 5px; width: 2px; background: #e2e8f0; border-radius: 2px; }
        .timeline-step { position: relative; margin-bottom: 25px; }
        .timeline-step:last-child { margin-bottom: 0; }
        .timeline-dot { position: absolute; left: -21px; top: 2px; width: 20px; height: 20px; border-radius: 50%; background: #e2e8f0; border: 3px solid #f8fafc; z-index: 2; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; }
        .timeline-step.done .timeline-dot { background: #16a34a; border-color: #dcfce7; }
        .timeline-step.done .timeline-dot::after { content: '✓'; font-weight: bold; }
        .timeline-step.active .timeline-dot { background: var(--primary-blue); border-color: #dbeafe; box-shadow: 0 0 0 4px rgba(122, 178, 211, 0.25); }
        .timeline-step.active .timeline-dot::after { content: '•'; font-size: 1.2rem; color: white; }
        .step-title { font-size: 1rem; font-weight: 700; color: var(--dark-blue); margin-bottom: 3px; }
        .step-desc { font-size: 0.85rem; color: #475569; margin-bottom: 2px; }
        .step-date { font-size: 0.75rem; color: #94a3b8; }

        /* Update Form */
        .update-form { 
            display: flex; 
            flex-direction: column; 
            gap: 14px; 
        }
        .form-group label { 
            display: block; 
            font-size: 0.85rem; 
            font-weight: 600; 
            color: #475569; 
            margin-bottom: 6px; 
        }
        .form-select, .form-textarea { 
            width: 100%; 
            padding: 11px 12px; 
            border: 1px solid #cbd5e1; 
            border-radius: 10px; 
            font-size: 0.9rem; 
            background: #f8fafc; 
            transition: 0.2s; 
            font-family: inherit; 
        }
        .form-select:focus, .form-textarea:focus { 
            outline: none; 
            border-color: var(--primary-blue); 
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15); 
            background: white; 
        }
        .form-textarea { 
            resize: vertical; 
            min-height: 90px; 
        }
        .btn-row { 
            display: flex; 
            gap: 10px; 
            margin-top: 5px; 
        }
        .btn { 
            padding: 11px 16px; 
            border-radius: 10px; 
            border: none; 
            font-weight: 600; 
            cursor: pointer; 
            transition: 0.2s; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            gap: 8px; 
            font-size: 0.9rem; 
        }
        .btn-primary { 
            background: var(--primary-blue); 
            color: white; 
        }
        .btn-primary:hover { 
            background: var(--dark-blue); 
            transform: translateY(-1px); 
        }
        .btn-secondary { 
            background: #f1f5f9; 
            color: #475569; 
            border: 1px solid #e2e8f0; 
        }
        .btn-secondary:hover { 
            background: #e2e8f0; 
        }
        .form-grid{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-input{
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 0.9rem;
            background: #f8fafc;
            transition: 0.2s;
        }

        .form-input:focus{
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15);
            background: white;
        }

        /* Documents List */
        .doc-list { 
            display: flex; 
            flex-direction: column; 
            gap: 8px; 
        }

        .doc-item { 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            padding: 9px 10px; 
            background: #f8fafc; 
            border-radius: 10px; 
            border: 1px solid #e2e8f0; 
            transition: 0.2s; 
        }

        .doc-item:hover { 
            background: white; 
            border-color: #cbd5e1; 
        }

        .doc-icon { 
            width: 34px; 
            height: 34px; 
            background: #fee2e2; 
            color: #dc2626; 
            border-radius: 8px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 0.9rem; 
            flex-shrink: 0; 
        }

        .doc-info { 
            flex: 1; 
            min-width: 0; 
        }

        .doc-name { 
            font-weight: 600; 
            color: var(--dark-blue); 
            font-size: 0.82rem; 
            margin-bottom: 2px; 
            white-space: nowrap; 
            overflow: hidden; 
            text-overflow: ellipsis; 
            line-height: 1.3;
        }

        .doc-meta { 
            font-size: 0.7rem; 
            color: #94a3b8; 
        }

        .doc-status { 
            font-size: 0.72rem; 
            font-weight: 600; 
            margin-top: 2px; 
        }

        .status-valid { 
            color: #16a34a; 
        }

        .status-wait { 
            color: #d97706; 
        }

        .status-reject { 
            color: #dc2626; 
        }

        .doc-actions { 
            display: flex; 
            gap: 5px; 
            flex-shrink: 0; 
        }

        .doc-btn { 
            width: 28px; 
            height: 28px; 
            border-radius: 7px; 
            border: 1px solid #e2e8f0; 
            background: white; 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            transition: 0.2s; 
            color: #64748b; 
            font-size: 0.75rem; 
            text-decoration: none;
        }

        .doc-btn:hover { 
            border-color: var(--primary-blue); 
            color: var(--primary-blue); 
            background: #f0f9ff; 
        }

        .doc-btn.danger:hover { 
            border-color: #ef4444; 
            color: #ef4444; 
            background: #fef2f2; 
        }

        /* CARD DOKUMEN */
.right-col .card{
    border-radius: 14px;
}

/* ITEM DOKUMEN */
.doc-item{
    padding: 7px 8px;
    gap: 8px;
}

/* ICON */
.doc-icon{
    width: 30px;
    height: 30px;
    font-size: 0.8rem;
}

/* NAMA FILE */
.doc-name{
    font-size: 0.74rem;
    max-width: 140px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* META */
.doc-meta{
    font-size: 0.65rem;
}

/* STATUS */
.doc-status{
    font-size: 0.65rem;
}

/* BUTTON */
.doc-btn{
    width: 24px;
    height: 24px;
    font-size: 0.68rem;
}

        /* Admin Upload Area */
        .upload-area { border: 2px dashed #cbd5e1; border-radius: 12px; padding: 20px; text-align: center; cursor: pointer; transition: 0.3s; background: #f8fafc; margin-bottom: 15px; }
        .upload-area:hover { border-color: var(--primary-blue); background: #f0f9ff; }
        .upload-icon { font-size: 1.8rem; color: var(--primary-blue); margin-bottom: 8px; }
        .upload-text { font-weight: 600; color: var(--dark-blue); margin-bottom: 4px; }
        .upload-hint { font-size: 0.8rem; color: #64748b; }

        /* Activity History */
        .activity-list { display: flex; flex-direction: column; gap: 12px; }
        .activity-item { display: flex; gap: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; }
        .activity-item:last-child { border-bottom: none; padding-bottom: 0; }
        .activity-icon { width: 34px; height: 34px; background: #dbeafe; color: #2563eb; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
        .activity-content h5 { font-size: 0.9rem; font-weight: 600; color: var(--dark-blue); margin-bottom: 3px; line-height: 1.4; }
        .activity-content p { font-size: 0.8rem; color: #64748b; margin-bottom: 2px; }
        .activity-time { font-size: 0.75rem; color: #94a3b8; margin-top: 2px; }

        @media (max-width: 768px) {
            .sidebar { width: 60px; }
            .main-content { margin-left: 60px; padding: 15px; }
            .header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .search-bar { width: 100%; box-sizing: border-box; }
            .info-grid { grid-template-columns: 1fr; }
            .back-btn { width: 100%; justify-content: center; margin-top: 10px; }
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
            <div>
                <h1 class="page-title"><i class="fas fa-clipboard-list" style="color:var(--primary-blue); margin-right:10px;"></i>Detail Monitoring</h1>
            </div>
            <div style="display:flex; align-items:center; gap:15px;">
                <div class="user-profile">
                    <div class="avatar">A</div>
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>

        <div class="breadcrumb">
            <!-- Dashboard -->
            <a href="{{ route('admin.welcome') }}">
                Dashboard
            </a>

            <i class="fas fa-chevron-right"></i>

            <!-- Monitoring -->
            <a href="{{ route('admin.monitoring-pemesanan') }}">
                Monitoring Pemesanan
            </a>

            <i class="fas fa-chevron-right"></i>

            <!-- Kode Pemesanan dari DB -->
            <span>
                {{ $pemesanan->kode_pemesanan }}
            </span>

            <!-- Tombol Kembali -->
            <button class="back-btn"
                    onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </button>
        </div>

        <div class="dashboard-grid">
            <!-- LEFT COLUMN -->
            <div class="left-col">
                <!-- 2. Informasi Pemesanan -->
                <div class="card">
                    <div class="card-title">
                        <i class="fas fa-info-circle"></i> Informasi Pemesanan
                    </div>

                    <div class="info-grid">

                        {{-- Nama Pelanggan --}}
                        <div class="info-item">
                            <div class="info-label">Nama Pelanggan</div>
                            <div class="info-val">
                                {{ $pemesanan->user->nama_user ?? '-' }}
                            </div>
                        </div>

                        {{-- Nama Properti --}}
                        <div class="info-item">
                            <div class="info-label">Nama Properti</div>
                            <div class="info-val">
                                {{ $pemesanan->properti->nama_properti ?? '-' }}
                                @if($pemesanan->properti->tipe_properti)
                                    - {{ $pemesanan->properti->tipe_properti }}
                                @endif
                            </div>
                        </div>

                        {{-- Metode Pembayaran --}}
                        <div class="info-item">
                            <div class="info-label">Metode Pembayaran</div>
                            <div class="info-val">

                                @if($pemesanan->metode_pembayaran == 'kredit')
                                    KPR
                                @elseif($pemesanan->metode_pembayaran == 'lunas')
                                    Lunas
                                @else
                                    {{ ucfirst($pemesanan->metode_pembayaran) }}
                                @endif

                            </div>
                        </div>

                        {{-- Tanggal Pemesanan --}}
                        <div class="info-item">
                            <div class="info-label">Tanggal Pemesanan</div>
                            <div class="info-val">
                                {{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->translatedFormat('d F Y') }}
                            </div>
                        </div>

                        {{-- Kode Pemesanan --}}
                        <div class="info-item">
                            <div class="info-label">Kode Pemesanan</div>
                            <div class="info-val">
                                {{ $pemesanan->kode_pemesanan ?? '-' }}
                            </div>
                        </div>

                        {{-- Status / Tahap --}}
                        <div class="info-item">
                            <div class="info-label">Status Pemesanan</div>

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
            'title' => 'Proses Bank',
            'desc'  => 'Pelanggan sedang mengurus pengajuan KPR ke bank'
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

    }

    elseif ($pemesanan->metode_pembayaran == 'Cash Bertahap') {

        $steps = [

            [
                'title' => 'Pemesanan Dibuat',
                'desc'  => 'Formulir pemesanan berhasil dikirim'
            ],

            [
                'title' => 'Upload Bukti Booking',
                'desc'  => 'Pelanggan mengupload bukti booking'
            ],

            [
                'title' => 'Verifikasi Pembayaran',
                'desc'  => 'Pembayaran booking diverifikasi admin'
            ],

            [
                'title' => 'Pembayaran Bertahap',
                'desc'  => 'Pelanggan melakukan pembayaran termin'
            ],

            [
                'title' => 'Proses Serah Terima',
                'desc'  => 'Persiapan dokumen serah terima rumah'
            ],

            [
                'title' => 'Selesai',
                'desc'  => 'Rumah berhasil diserahkan'
            ],

        ];

    }

    else {

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
    | TAHAP SAAT INI
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
                        <i class="fas fa-route"></i> Progress Pemesanan
                    </div>

                    <div class="progress-timeline">

                        @foreach($steps as $index => $step)
                            @php

                                $class = '';

                                if ($index < $currentIndex) {

                                    $class = 'done';

                                }
                                elseif ($index == $currentIndex) {

                                    if ($pemesanan->status == 'Selesai') {

                                        $class = 'done';

                                    } else {

                                        $class = 'active';

                                    }

                                }

                            @endphp

                            <div class="timeline-step {{ $class }}">

                                <div class="timeline-dot"></div>
                                <div class="step-title">
                                    {{ $step['title'] }}
                                </div>
                                <div class="step-desc">

                                    {{ $step['desc'] }}

                                    @if($index == $currentIndex && $pemesanan->catatan_admin)

                                        <div style="
                                            margin-top:8px;
                                            padding:10px;
                                            background:#f8fafc;
                                            border-left:3px solid #2563eb;
                                            border-radius:8px;
                                            color:#475569;
                                            font-size:0.85rem;
                                        ">

                                            <strong>Catatan Admin:</strong><br>

                                            {{ $pemesanan->catatan_admin }}
                                        </div>
                                    @endif
                                </div>
                                <div class="step-date">

                                    @php
                                        $isDone = $pemesanan->status == 'Selesai';
                                    @endphp

                                    {{-- STEP SUDAH SELESAI --}}
                                    @if($index < $currentIndex)

                                        <i class="far fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($pemesanan->updated_at)->translatedFormat('d M Y') }}

                                    {{-- STEP SAAT INI --}}
                                    @elseif($index == $currentIndex)

                                        @if($isDone)

                                            <i class="fas fa-check-circle"></i>
                                            Selesai pada
                                            {{ \Carbon\Carbon::parse($pemesanan->updated_at)->translatedFormat('d M Y') }}

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

                                    {{-- STEP BELUM DIMULAI --}}
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

                <!-- 4. Update Monitoring Admin -->
                <div class="card">
                    <div class="card-title">
                        <i class="fas fa-edit"></i>
                        Update Monitoring Transaksi
                    </div>

                    <div class="update-form">

                        <form action="{{ route('monitoring.update', $pemesanan->id_pemesanan) }}"
                            method="POST">

                            @csrf
                            @method('PUT')

                            <div class="form-grid">

                                <!-- Tahap -->
                                <div class="form-group">
                                    <label>Pilih Tahap Proses</label>

                                    <select class="form-select"
                                        name="tahap_saat_ini"
                                        required>

                                    @foreach($steps as $step)

                                        <option value="{{ $step['title'] }}"
                                            {{ $pemesanan->tahap_saat_ini == $step['title'] ? 'selected' : '' }}>

                                            {{ $step['title'] }}

                                        </option>

                                    @endforeach

                                </select>
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label>Ubah Status Transaksi</label>

                                    <select class="form-select"
                                            name="status"
                                            required>

                                        <option value="Proses"
                                            {{ $pemesanan->status == 'Proses' ? 'selected' : '' }}>
                                            Proses
                                        </option>

                                        <option value="Selesai"
                                            {{ $pemesanan->status == 'Selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>

                                        <option value="Ditolak"
                                            {{ $pemesanan->status == 'Ditolak' ? 'selected' : '' }}>
                                            Ditolak
                                        </option>

                                    </select>
                                </div>

                            </div>

                            <!-- Estimasi -->
                            <div class="form-group">
                                <label>Estimasi Proses</label>

                                <input type="text"
                                    class="form-input"
                                    name="estimasi_proses"
                                    value="{{ $pemesanan->estimasi_proses }}"
                                    placeholder="Contoh: 3 Hari Kerja / 1 Minggu">
                            </div>

                            <!-- Catatan -->
                            <div class="form-group">
                                <label>Catatan Admin</label>

                                <textarea class="form-textarea"
                                        name="catatan_admin"
                                        placeholder="Contoh: Dokumen notaris sedang diproses.">{{ $pemesanan->catatan_admin }}</textarea>
                            </div>

                            <!-- Button -->
                            <div class="btn-row">

                                <button type="submit"
                                        class="btn btn-primary">

                                    <i class="fas fa-save"></i>
                                    Simpan Perubahan
                                </button>

                                <button type="submit"
                                        name="kirim_notifikasi"
                                        value="1"
                                        class="btn btn-secondary">

                                    <i class="fas fa-paper-plane"></i>
                                    Kirim Notifikasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="right-col">
                
                <!-- 5. Dokumen Pelanggan -->
                <div class="card">
                    <div class="card-title">
                        <i class="fas fa-folder-open"></i>
                        Dokumen Pelanggan
                    </div>

                    <div class="doc-list">

                        @forelse($pemesanan->dokumen as $dokumen)

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | Icon berdasarkan jenis dokumen
                                |--------------------------------------------------------------------------
                                */

                                $icon = 'fa-file';

                                switch ($dokumen->jenis_dokumen) {

                                    case 'ktp':
                                        $icon = 'fa-id-card';
                                        break;

                                    case 'kk':
                                        $icon = 'fa-users';
                                        break;

                                    case 'slip_gaji':
                                        $icon = 'fa-file-invoice-dollar';
                                        break;

                                    case 'rekening_koran':
                                        $icon = 'fa-money-check-alt';
                                        break;

                                    case 'bukti_booking':
                                        $icon = 'fa-receipt';
                                        break;
                                    
                                    case 'bukti_pembayaran':
                                        $icon = 'fa-receipt';
                                        break;
                                    
                                    case 'bukti_pelunasan':
                                        $icon = 'fa-money-bill-wave';
                                        break;

                                    case 'npwp':
                                        $icon = 'fa-file-alt';
                                        break;

                                    default:
                                        $icon = 'fa-file';
                                        break;
                                }

                            @endphp


                            <div class="doc-item">

                                <!-- Icon -->
                                <div class="doc-icon">
                                    <i class="fas {{ $icon }}"></i>
                                </div>

                                <!-- Info -->
                                <div class="doc-info">

                                    <!-- Nama File -->
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

                                    <!-- Tanggal Upload -->
                                    <div class="doc-meta">
                                        Diupload:
                                        {{ \Carbon\Carbon::parse($dokumen->created_at)->translatedFormat('d M Y') }}
                                    </div>

                                    <!-- Status -->
                                    @if($dokumen->jenis_dokumen == 'bukti_pelunasan')
                                        <div class="doc-status status-valid">
                                            <i class="fas fa-check-circle"></i>
                                            Sudah Dikirim
                                        </div>
                                    @else

                                        @if($dokumen->status_verifikasi == 'diterima')
                                            <div class="doc-status status-valid">
                                                <i class="fas fa-check-circle"></i>
                                                Diterima
                                            </div>
                                        @elseif($dokumen->status_verifikasi == 'ditolak')
                                            <div class="doc-status status-reject">
                                                <i class="fas fa-times-circle"></i>
                                                Ditolak
                                            </div>
                                        @else
                                            <div class="doc-status status-wait">
                                                <i class="fas fa-clock"></i>
                                                Menunggu Verifikasi
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <!-- Action -->
                                <div class="doc-actions">

                                    <!-- Lihat -->
                                    <a href="{{ asset('storage/' . $dokumen->path_file) }}"
                                    target="_blank"
                                    class="doc-btn"
                                    title="Lihat">

                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Download -->
                                    <a href="{{ asset('storage/' . $dokumen->path_file) }}"
                                    download
                                    class="doc-btn"
                                    title="Download">

                                        <i class="fas fa-download"></i>
                                    </a>

                                    @if(
                                        $dokumen->jenis_dokumen == 'bukti_pembayaran'
                                        && $dokumen->status_verifikasi == 'pending'
                                    )

                                    <form method="POST"
                                        action="{{ route('admin.bukti.approve', $dokumen->id_dokumen) }}">

                                        @csrf
                                        <button class="doc-btn"
                                                title="Terima">

                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    <form method="POST"
                                        action="{{ route('admin.bukti.reject', $dokumen->id_dokumen) }}">

                                        @csrf

                                        <button class="doc-btn danger"
                                                title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        @empty

                            <div style="padding:20px; text-align:center; color:#94a3b8;">
                                Belum ada dokumen diupload
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- 6. Dokumen Admin / Perusahaan -->
                <div class="card">
                    <div class="card-title"><i class="fas fa-building"></i> Dokumen Perusahaan (Admin)</div>
                    <form action="{{ route('admin.upload.dokumen', $pemesanan->id_pemesanan) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="upload-area"
                        onclick="document.getElementById('adminUpload').click()">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-arrow-up"></i>
                        </div>

                        <div class="upload-text">
                            Upload Dokumen Baru
                        </div>

                        <div class="upload-hint">
                            Klik untuk menambahkan dokumen transaksi
                        </div>

                        <input type="file"
                            name="dokumen_admin"
                            id="adminUpload"
                            style="display:none;"
                            onchange="this.form.submit()">
                    </div>
                </form>
                    <div class="doc-list">
                        @foreach(
                            $pemesanan->dokumen
                            ->where('sumber_dokumen', 'admin')
                            as $dokumen
                        )

                        <div class="doc-item">
                            <div class="doc-icon"
                                style="background:#dbeafe; color:#2563eb;">
                                <i class="fas fa-building"></i>
                            </div>

                            <div class="doc-info">
                                <div class="doc-name">
                                    {{ $dokumen->nama_file }}
                                </div>

                                <div class="doc-meta">
                                    {{ \Carbon\Carbon::parse($dokumen->uploaded_at)->translatedFormat('d M Y') }}
                                    •
                                    Uploader:
                                    {{ $dokumen->uploader }}
                                </div>
                            </div>

                            <div class="doc-actions">
                                <!-- lihat -->
                                <a href="{{ asset('storage/' . $dokumen->path_file) }}"
                                    target="_blank"
                                    class="doc-btn">

                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- download -->
                                <a href="{{ asset('storage/' . $dokumen->path_file) }}"
                                    download
                                    class="doc-btn">

                                    <i class="fas fa-download"></i>
                                </a>

                                <!-- hapus -->
                                <form action="{{ route('admin.hapus.dokumen', $dokumen->id_dokumen) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="doc-btn danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
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

