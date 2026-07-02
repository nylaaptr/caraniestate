<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fontsource-roboto@5.1.0/index.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #7AB2D3;
            --primary-blue-rgb: 122, 178, 211;
            --dark-blue: #1E3A5F;
            --light-blue: #e6f2f8;
            --sidebar-width-collapsed: 80px;
            --sidebar-width-expanded: 250px;
            --success-green: #2ecc71;
            --warning-orange: #f39c12;
            --danger-red: #e74c3c;
            --purple: #9b59b6;
            --teal: #1abc9c;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
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
            width: 40px; height: 40px; background: white;
            border-radius: 12px; display: flex; align-items: center;
            justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            flex-shrink: 0;
        }
        .logo i { font-size: 20px; color: var(--dark-blue); }
        .company-name {
            font-weight: 700; font-size: 0.85rem; line-height: 1.2;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3); opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar:hover .company-name { opacity: 1; }

        .nav-menu { padding: 25px 0; flex-grow: 1; overflow-y: auto; }
        .nav-menu a { text-decoration: none; color: inherit; display: block; }
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
        
        .nav-item:hover { background: rgba(255,255,255,0.08); border-left-color: var(--primary-blue); }
        .nav-item.active { background: rgba(255,255,255,0.1); border-left-color: var(--primary-blue); }
        .nav-item i { font-size: 18px; width: 24px; text-align: center; flex-shrink: 0; }
        .nav-item span {
            font-weight: 500; font-size: 0.95rem; opacity: 0;
            transition: opacity 0.3s ease; display: inline-block;
        }
        .sidebar:hover .nav-item span { opacity: 1; }

        .logout-btn {
            padding: 15px 20px; cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center; gap: 15px;
            border-top: 1px solid rgba(255,255,255,0.1); margin-top: auto;
            white-space: nowrap; overflow: hidden; color: #fff;
            background: none; border: none; width: 100%; text-align: left;
        }
        .logout-btn:hover { background: rgba(255,255,255,0.08); }
        .logout-btn i { font-size: 18px; width: 24px; text-align: center; flex-shrink: 0; }
        .logout-btn span { opacity: 0; transition: opacity 0.3s ease; }
        .sidebar:hover .logout-btn span { opacity: 1; }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width-collapsed);
            overflow-y: auto;
            padding: 25px 30px;
            background: #f0f2f5;
            transition: margin-left 0.3s ease;
            height: 100vh;
        }
        .sidebar:hover + .main-content { margin-left: var(--sidebar-width-expanded); }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }
        .page-title-section h1 {
            font-size: 1.8rem; font-weight: 700; color: var(--dark-blue);
            margin-bottom: 5px; display: flex; align-items: center; gap: 12px;
        }
        .page-title-section h1 i { color: var(--primary-blue); }
        .page-title-section p { color: #64748b; font-size: 0.95rem; }

        .header-actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 18px; border-radius: 10px; font-size: 0.9rem;
            font-weight: 500; cursor: pointer; transition: all 0.3s ease;
            border: none; text-decoration: none; font-family: inherit;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--dark-blue), #2563eb);
            color: white; box-shadow: 0 3px 10px rgba(30, 58, 95, 0.25);
        }
        .btn-primary:hover { box-shadow: 0 5px 15px rgba(30, 58, 95, 0.35); transform: translateY(-1px); }
        .btn-outline {
            background: white; color: var(--dark-blue); border: 2px solid #e2e8f0;
        }
        .btn-outline:hover { border-color: var(--primary-blue); color: var(--primary-blue); }
        .btn-danger { background: linear-gradient(135deg, #c0392b, #e74c3c); color: white; }
        .btn-danger:hover { transform: translateY(-1px); }

        /* Stats Cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }
        .stat-card {
            background: white; border-radius: 12px; padding: 18px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            display: flex; align-items: center; gap: 15px;
            transition: all 0.3s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; flex-shrink: 0;
        }
        .stat-icon.login { background: rgba(122,178,211,0.15); color: var(--primary-blue); }
        .stat-icon.transaction { background: rgba(46,204,113,0.15); color: var(--success-green); }
        .stat-icon.account { background: rgba(155,89,182,0.15); color: var(--purple); }
        .stat-icon.alert { background: rgba(231,76,60,0.15); color: var(--danger-red); }
        .stat-info h4 { font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .stat-value { font-size: 1.5rem; font-weight: 700; color: var(--dark-blue); }

        /* Filter Bar */
        .filter-bar {
            background: white; border-radius: 14px; padding: 20px;
            margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;
        }
        .filter-group { flex: 1; min-width: 150px; }
        .filter-label {
            display: block; font-size: 0.8rem; font-weight: 600;
            color: #64748b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .filter-input, .filter-select {
            width: 100%; padding: 10px 12px; border: 2px solid #e2e8f0;
            border-radius: 8px; font-size: 0.9rem; font-family: inherit;
            color: #334155; background: white; transition: all 0.3s;
        }
        .filter-input:focus, .filter-select:focus {
            outline: none; border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15);
        }

        /* Activity Layout */
        .activity-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            align-items: start;
        }
        @media (max-width: 1024px) {
            .activity-layout { grid-template-columns: 1fr; }
        }

        /* Live Indicator */
        .live-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; background: rgba(231,76,60,0.1);
            border-radius: 20px; font-size: 0.8rem; color: #e74c3c; font-weight: 600;
        }
        .live-dot {
            width: 8px; height: 8px; background: #e74c3c;
            border-radius: 50%; animation: blink 1.5s infinite;
        }
        @keyframes blink { 0%,100% { opacity:1; } 50% { opacity:0.3; } }

        /* Activity Feed */
        .feed-card {
            background: white; border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .feed-header {
            padding: 18px 22px; border-bottom: 1px solid #f1f5f9;
            display: flex; justify-content: space-between; align-items: center;
        }
        .feed-title {
            font-size: 1.1rem; font-weight: 600; color: var(--dark-blue);
            display: flex; align-items: center; gap: 10px;
        }

        .feed-body { padding: 0; max-height: calc(100vh - 280px); overflow-y: auto; }
        .feed-body::-webkit-scrollbar { width: 6px; }
        .feed-body::-webkit-scrollbar-track { background: #f1f5f9; }
        .feed-body::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }

        /* Timeline */
        .date-group {
            padding: 10px 22px;
            background: #f8fafc;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.8rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        .activity-item {
            display: flex;
            gap: 15px;
            padding: 16px 22px;
            border-bottom: 1px solid #f8fafc;
            transition: background 0.2s;
            cursor: pointer;
            position: relative;
        }
        .activity-item:hover { background: #f8fafc; }
        .activity-item:last-child { border-bottom: none; }

        .activity-icon-wrap {
            position: relative;
            flex-shrink: 0;
        }
        .activity-icon {
            width: 42px; height: 42px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
        }
        .activity-icon.login { background: rgba(122,178,211,0.15); color: var(--primary-blue); }
        .activity-icon.logout { background: rgba(148,163,184,0.2); color: #64748b; }
        .activity-icon.booking { background: rgba(243,156,18,0.15); color: var(--warning-orange); }
        .activity-icon.payment { background: rgba(46,204,113,0.15); color: var(--success-green); }
        .activity-icon.register { background: rgba(155,89,182,0.15); color: var(--purple); }
        .activity-icon.update { background: rgba(26,188,156,0.15); color: var(--teal); }
        .activity-icon.delete { background: rgba(231,76,60,0.15); color: var(--danger-red); }
        .activity-icon.document { background: rgba(52,152,219,0.15); color: #3498db; }
        .activity-icon.alert-act { background: rgba(231,76,60,0.15); color: var(--danger-red); }

        .activity-content { flex: 1; min-width: 0; }
        .activity-user {
            font-weight: 600; color: var(--dark-blue);
            font-size: 0.95rem; margin-bottom: 3px;
            display: flex; align-items: center; gap: 8px;
        }
        .activity-user .role-badge {
            font-size: 0.65rem; padding: 2px 8px;
            border-radius: 10px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .role-badge.user { background: rgba(122,178,211,0.15); color: var(--primary-blue); }
        .role-badge.admin { background: rgba(231,76,60,0.12); color: #e74c3c; }

        .activity-desc {
            font-size: 0.85rem; color: #64748b; line-height: 1.5;
        }
        .activity-desc strong { color: #334155; }
        .activity-meta {
            display: flex; align-items: center; gap: 15px;
            margin-top: 8px; font-size: 0.78rem; color: #94a3b8;
        }
        .activity-meta span { display: flex; align-items: center; gap: 5px; }
        .activity-meta i { font-size: 0.7rem; }

        .activity-time {
            flex-shrink: 0;
            text-align: right;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .time-value {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--dark-blue);
            font-variant-numeric: tabular-nums;
        }
        .time-ago {
            font-size: 0.72rem;
            color: #94a3b8;
            background: #f1f5f9;
            padding: 3px 8px;
            border-radius: 10px;
        }

        /* Sidebar Widget */
        .widget-card {
            background: white; border-radius: 14px;
            padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            margin-bottom: 20px;
        }
        .widget-title {
            font-size: 1rem; font-weight: 600; color: var(--dark-blue);
            margin-bottom: 15px; display: flex; align-items: center; gap: 8px;
        }
        .widget-title i { color: var(--primary-blue); }

        /* User Activity List */
        .user-activity-item {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 0; border-bottom: 1px solid #f1f5f9;
        }
        .user-activity-item:last-child { border-bottom: none; }
        .user-avatar {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: white; font-size: 0.9rem;
            flex-shrink: 0;
        }
        .user-info { flex: 1; }
        .user-name { font-weight: 600; font-size: 0.9rem; color: var(--dark-blue); }
        .user-last-action { font-size: 0.78rem; color: #94a3b8; }
        .user-last-time { font-size: 0.75rem; color: #64748b; font-weight: 500; text-align: right; }

        /* Activity Type Legend */
        .legend-list { display: flex; flex-direction: column; gap: 10px; }
        .legend-item {
            display: flex; align-items: center; gap: 10px;
            font-size: 0.85rem; color: #475569;
        }
        .legend-icon {
            width: 30px; height: 30px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem;
        }
        .legend-count {
            margin-left: auto;
            font-weight: 600;
            color: var(--dark-blue);
            background: #f1f5f9;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.78rem;
        }

        /* Toast */
        .toast-container { position: fixed; top: 20px; right: 20px; z-index: 2000; display: flex; flex-direction: column; gap: 10px; }
        .toast {
            display: flex; align-items: center; gap: 12px; padding: 14px 18px;
            background: white; border-radius: 10px; box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            min-width: 280px; animation: slideInRight 0.3s ease;
            border-left: 4px solid var(--success-green);
        }
        .toast.error { border-left-color: var(--danger-red); }
        .toast.warning { border-left-color: var(--warning-orange); }
        @keyframes slideInRight { from { transform: translateX(100%); opacity:0; } to { transform: translateX(0); opacity:1; } }
        .toast-icon { font-size: 1.1rem; }
        .toast-message { flex: 1; font-size: 0.85rem; color: #334155; font-weight: 500; }
        .toast-close { background: none; border: none; color: #94a3b8; cursor: pointer; }

        /* Modal */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);
            z-index: 1000; display: none; align-items: center; justify-content: center; padding: 20px;
        }
        .modal-overlay.show { display: flex; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        .modal-content {
            background: white; border-radius: 16px; max-width: 550px; width: 100%;
            max-height: 90vh; overflow-y: auto; animation: slideUp 0.3s ease;
        }
        @keyframes slideUp { from { transform: translateY(20px); opacity:0; } to { transform: translateY(0); opacity:1; } }
        .modal-header { padding: 22px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
        .modal-title { font-size: 1.2rem; font-weight: 600; color: var(--dark-blue); }
        .modal-close { width: 32px; height: 32px; border-radius: 8px; border: none; background: #f1f5f9; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b; transition: all 0.3s; }
        .modal-close:hover { background: #fee2e2; color: #ef4444; }
        .modal-body { padding: 22px; }
        .modal-footer { padding: 18px 22px; border-top: 1px solid #f1f5f9; display: flex; gap: 10px; justify-content: flex-end; }

        .detail-row { display: flex; padding: 8px 0; border-bottom: 1px solid #f8fafc; }
        .detail-label { width: 140px; font-size: 0.85rem; color: #94a3b8; font-weight: 500; }
        .detail-value { flex: 1; font-size: 0.9rem; color: #1e293b; font-weight: 500; }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content { padding: 15px; }
            .page-title-section h1 { font-size: 1.4rem; }
            .filter-bar { flex-direction: column; }
            .filter-group { width: 100%; }
            .activity-time { display: none; }
            .stats-row { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 480px) {
            .stats-row { grid-template-columns: 1fr; }
        }

        /* Empty state */
        .empty-state {
            text-align: center; padding: 60px 20px;
        }
        .empty-state i { font-size: 3rem; color: #cbd5e1; margin-bottom: 15px; }
        .empty-state h3 { color: #64748b; font-weight: 600; margin-bottom: 5px; }
        .empty-state p { color: #94a3b8; font-size: 0.85rem; }
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
    <div class="page-header">
        <div class="page-title-section">
            <h1><i class="fas fa-clock-rotate-left"></i> Log Aktivitas Pengguna</h1>
            <p>Pantau seluruh aktivitas yang dilakukan oleh pengguna secara real-time</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-outline" onclick="refreshActivity()"><i class="fas fa-sync-alt"></i> Refresh</button>
            <button class="btn btn-danger" onclick="confirmClearLogs()"><i class="fas fa-trash"></i> Bersihkan Log</button>
        </div>
    </div>

    <!-- Stats -->
    <!-- <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon login"><i class="fas fa-sign-in-alt"></i></div>
            <div class="stat-info">
                <h4>Login Hari Ini</h4>
                <div class="stat-value" id="loginCount">24</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon transaction"><i class="fas fa-exchange-alt"></i></div>
            <div class="stat-info">
                <h4>Transaksi</h4>
                <div class="stat-value" id="transCount">18</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon account"><i class="fas fa-user-plus"></i></div>
            <div class="stat-info">
                <h4>Pendaftaran Baru</h4>
                <div class="stat-value" id="regCount">5</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon alert"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-info">
                <h4>Aktivitas Mencurigakan</h4>
                <div class="stat-value" id="alertCount">2</div>
            </div>
        </div>
    </div> -->

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="filter-group">
            <label class="filter-label">Tanggal</label>
            <input type="date" class="filter-input" id="filterDate">
        </div>
        <div class="filter-group">
            <label class="filter-label">Tipe Aktivitas</label>
            <select class="filter-select" id="filterType">
                <option value="all">Semua Aktivitas</option>
                <option value="login">Login</option>
                <option value="logout">Logout</option>
                <option value="register">Pendaftaran</option>
                <option value="booking">Booking</option>
                <option value="payment">Pembayaran</option>
                <option value="document">Upload Dokumen</option>
                <option value="update">Update Profil</option>
                <option value="delete">Penghapusan</option>
                <option value="alert">Peringatan</option>
            </select>
        </div>
        
        <div class="filter-group">
            <label class="filter-label">Cari Pengguna</label>
            <input type="text" class="filter-input" placeholder="Nama atau email..." id="filterSearch">
        </div>
        <button class="btn btn-primary" onclick="applyFilters()" style="align-self:flex-end">
            <i class="fas fa-filter"></i> Terapkan
        </button>
    </div>

    <!-- Activity Layout -->
    <div class="activity-layout">
        <!-- Feed -->
        <div class="feed-card">
            <div class="feed-header">
                <div class="feed-title">
                    <i class="fas fa-stream"></i> Timeline Aktivitas
                </div>
                <span style="font-size:0.85rem;color:#64748b"><strong id="totalFiltered">156</strong> aktivitas ditemukan</span>
            </div>
            <div class="feed-body" id="feedBody">
                <!-- Activities will be populated by JS -->
            </div>
            <div id="paginationWrapper"></div>
        </div>

        

        <!-- Sidebar Widgets -->
        <div>
            <!-- Top Active Users -->
            <div class="widget-card">
                <div class="widget-title"><i class="fas fa-users"></i> Pengguna Aktif</div>
                <div id="topUsers"></div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal-overlay" id="detailModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title">Detail Aktivitas</div>
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" id="modalBody"></div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeModal()">Tutup</button>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<script>
const activityData = @json($recentActivities);

/**
 * =========================================
 * AUTO ICON BERDASARKAN TIPE AKTIVITAS
 * =========================================
 */
function getActivityIcon(type) {

    switch ((type || '').toLowerCase()) {

        case 'login':
            return 'fa-sign-in-alt';

        case 'logout':
            return 'fa-sign-out-alt';

        case 'register':
            return 'fa-user-plus';

        case 'booking':
            return 'fa-calendar-check';

        case 'payment':
            return 'fa-credit-card';

        case 'document':
            return 'fa-file-upload';

        case 'chatbot':
            return 'fa-robot';

        case 'update':
            return 'fa-user-edit';

        case 'delete':
            return 'fa-trash';

        case 'alert':
            return 'fa-triangle-exclamation';

        default:
            return 'fa-bell';
    }
}

/**
 * =========================================
 * AUTO DETECT TYPE
 * =========================================
 */
function inferType(text) {

    text = (text || '').toLowerCase();

    if (text.includes('login')) return 'login';

    if (text.includes('logout')) return 'logout';

    if (
        text.includes('daftar') ||
        text.includes('register')
    ) return 'register';

    if (
        text.includes('booking') ||
        text.includes('pesan')
    ) return 'booking';

    if (
        text.includes('bayar') ||
        text.includes('payment')
    ) return 'payment';

    if (
        text.includes('upload') ||
        text.includes('dokumen')
    ) return 'document';

    if (
        text.includes('chatbot') ||
        text.includes('chat') ||
        text.includes('ai')
    ) return 'chatbot';

    if (
        text.includes('update') ||
        text.includes('ubah')
    ) return 'update';

    if (
        text.includes('hapus') ||
        text.includes('delete')
    ) return 'delete';

    return 'alert';
}

/**
 * =========================================
 * FORMAT DATE ONLY
 * =========================================
 */
function formatDateOnly(time) {

    if (!time) return null;

    const dt = new Date(time);

    if (isNaN(dt.getTime())) return null;

    const year = dt.getFullYear();
    const month = String(dt.getMonth() + 1).padStart(2, '0');
    const day = String(dt.getDate()).padStart(2, '0');

    return `${year}-${month}-${day}`;
}

/**
 * =========================================
 * FORMAT DATETIME
 * =========================================
 */
function formatTime(time) {

    if (!time) return '-';

    const dt = new Date(time);

    if (isNaN(dt.getTime())) {

        console.log('INVALID DATE:', time);

        return '-';
    }

    const now = new Date();
    const diffMs = now - dt;
    const diffSec = Math.floor(diffMs / 1000);
    const diffMin = Math.floor(diffSec / 60);
    const diffHour = Math.floor(diffMin / 60);
    const diffDay = Math.floor(diffHour / 24);

    // Baru saja
    if (diffSec < 60) {
        return 'Baru saja';
    }

    // Menit
    if (diffMin < 60) {
        return `${diffMin} menit yang lalu`;
    }

    // Jam
    if (diffHour < 24) {
        return `${diffHour} jam yang lalu`;
    }

    // Kemarin
    if (diffDay === 1) {
        return 'Kemarin';
    }

    // Hari
    if (diffDay < 7) {
        return `${diffDay} hari yang lalu`;
    }

    // Fallback
    return dt.toLocaleString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

/**
 * =========================================
 * NORMALIZE DATA
 * =========================================
 */
function normalize(data) {

    return (data || []).map(item => {

        const text =
            item.text ??
            item.aktivitas ??
            item.desc ??
            item.message ??
            '';

        const activityType =
            item.type ??
            item.tipe ??
            inferType(text);

        const createdAt =
            item.created_at ??
            item.time ??
            null;

        return {

            id: item.id ?? null,

            icon:
                item.icon ??
                getActivityIcon(activityType),

            user:
                item.user ??
                item.name ??
                'System',

            role:
                item.role ??
                'user',

            email:
                item.email ??
                '-',

            text: text,

            type:
                (activityType || 'alert')
                .toLowerCase(),

            time: createdAt,

            date: formatDateOnly(createdAt)
        };
    });
}

/**
 * =========================================
 * STATE
 * =========================================
 */
let cleanedData = normalize(activityData);

let filteredData = [...cleanedData];

/**
 * =========================================
 * RENDER ACTIVITIES
 * =========================================
 */
function renderActivities(data) {

    const feedBody =
        document.getElementById('feedBody');

    feedBody.innerHTML = '';

    document.getElementById('totalFiltered')
        .textContent = data.length;

    if (!data.length) {

        feedBody.innerHTML = `
            <div style="
                padding:30px;
                text-align:center;
                color:#94a3b8;
            ">
                Tidak ada aktivitas ditemukan
            </div>
        `;

        return;
    }

    data.forEach(item => {

        const div = document.createElement('div');

        div.className = 'activity-item';

        div.innerHTML = `

            <div style="
                display:flex;
                gap:14px;
                width:100%;
                align-items:flex-start;
            ">

                <!-- ICON -->
                <div style="
                    width:42px;
                    height:42px;
                    border-radius:12px;
                    background:#eef2ff;
                    color:#4f46e5;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    flex-shrink:0;
                ">
                    <i class="fas ${item.icon}"></i>
                </div>

                <!-- CONTENT -->
                <div style="flex:1">

                    <div style="
                        display:flex;
                        justify-content:space-between;
                        gap:10px;
                        align-items:flex-start;
                    ">

                        <div>

                            <div style="
                                font-weight:600;
                                color:#0f172a;
                            ">
                                ${item.user}
                            </div>

                            <div style="
                                font-size:13px;
                                color:#64748b;
                                margin-top:3px;
                            ">
                                ${item.email}
                            </div>

                        </div>

                        <div style="
                            display:flex;
                            flex-direction:column;
                            align-items:flex-end;
                            gap:4px;
                        ">

                            <span style="
                                font-size:12px;
                                color:#94a3b8;
                                white-space:nowrap;
                            ">
                                ${formatTime(item.time)}
                            </span>

                            <span style="
                                font-size:11px;
                                color:#cbd5e1;
                            ">
                                ${(() => {
                                    if (!item.time) return '-';
                                    const dt = new Date(item.time);
                                    if (isNaN(dt.getTime())) return '-';
                                    return dt.toLocaleTimeString('id-ID', {
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    });
                                })()}
                            </span>

                        </div>

                    </div>

                    <div style="
                        margin-top:10px;
                        color:#334155;
                        line-height:1.5;
                    ">
                        ${item.text}
                    </div>

                    <div style="margin-top:12px">

                        <span style="
                            display:inline-block;
                            padding:5px 12px;
                            border-radius:30px;
                            background:#eef2ff;
                            color:#4338ca;
                            font-size:11px;
                            font-weight:600;
                            text-transform:capitalize;
                        ">
                            ${item.type}
                        </span>

                    </div>

                </div>

            </div>
        `;

        feedBody.appendChild(div);
    });
}

/**
 * =========================================
 * APPLY FILTERS
 * =========================================
 */
function applyFilters() {

    const selectedDate =
        document.getElementById('filterDate')
        .value;

    const selectedType =
        document.getElementById('filterType')
        .value
        .toLowerCase();

    const search =
        document.getElementById('filterSearch')
        .value
        .toLowerCase();

    filteredData = cleanedData.filter(item => {

        /**
         * FILTER TYPE
         */
        const matchType =
            selectedType === 'all' ||
            item.type === selectedType;

        /**
         * FILTER DATE
         */
        const matchDate =
            !selectedDate ||
            item.date === selectedDate;

        /**
         * FILTER SEARCH
         */
        const matchSearch =

            !search ||

            (item.user || '')
            .toLowerCase()
            .includes(search) ||

            (item.email || '')
            .toLowerCase()
            .includes(search) ||

            (item.text || '')
            .toLowerCase()
            .includes(search);

        return (
            matchType &&
            matchDate &&
            matchSearch
        );
    });

    renderActivities(filteredData);
}

// RELOAD HALAMAN
function refreshActivity() {

    location.reload();
}

// BERSIHKAN LOG
function confirmClearLogs() {

    const confirmDelete = confirm(
        'Yakin ingin menghapus semua log aktivitas?'
    );

    if (!confirmDelete) return;

    fetch("{{ route('admin.clear_logs') }}", {

        method: 'DELETE',

        headers: {
            'X-CSRF-TOKEN':
                '{{ csrf_token() }}',

            'Accept':
                'application/json'
        }

    })
    .then(response => response.json())

    .then(data => {

        if (data.success) {

            alert(data.message);

            location.reload();

        } else {

            alert('Gagal menghapus log.');
        }
    })

    .catch(error => {

        console.error(error);

        alert('Terjadi kesalahan.');
    });
}

/**
 * =========================================
 * TOP ACTIVE USERS
 * =========================================
 */
function renderTopUsers() {

    const container =
        document.getElementById('topUsers');

    if (!container) return;

    const counts = {};

    cleanedData.forEach(item => {

        if (!counts[item.user]) {

            counts[item.user] = {
                total: 0,
                email: item.email
            };
        }

        counts[item.user].total++;
    });

    const sortedUsers =
        Object.entries(counts)
        .sort((a, b) => b[1].total - a[1].total)
        .slice(0, 5);

    container.innerHTML = '';

    sortedUsers.forEach(([name, data]) => {

        container.innerHTML += `

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                padding:12px 0;
                border-bottom:1px solid #f1f5f9;
            ">

                <div>

                    <div style="
                        font-weight:600;
                        color:#0f172a;
                    ">
                        ${name}
                    </div>

                    <div style="
                        font-size:12px;
                        color:#64748b;
                        margin-top:2px;
                    ">
                        ${data.email}
                    </div>

                </div>

                <div style="
                    background:#eef2ff;
                    color:#4338ca;
                    padding:4px 10px;
                    border-radius:20px;
                    font-size:12px;
                    font-weight:600;
                ">
                    ${data.total}
                </div>

            </div>
        `;
    });
}

/**
 * =========================================
 * MODAL
 * =========================================
 */
function closeModal() {

    document
        .getElementById('detailModal')
        .classList
        .remove('active');
}

/**
 * =========================================
 * INIT
 * =========================================
 */
document.addEventListener('DOMContentLoaded', function () {

    renderActivities(filteredData);

    renderTopUsers();

    /**
     * AUTO FILTER
     */
    document
        .getElementById('filterDate')
        .addEventListener('change', applyFilters);

    document
        .getElementById('filterType')
        .addEventListener('change', applyFilters);

    document
        .getElementById('filterSearch')
        .addEventListener('keyup', applyFilters);
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

