<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Carani Estate</title>
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
        
        /* Dashboard Stats */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-title {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 10px;
        }
        
        .stat-value {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }
        
        .stat-change {
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .stat-change.positive {
            color: #10b981;
        }
        
        .stat-change.negative {
            color: #ef4444;
        }
        
        .stat-change i {
            font-size: 14px;
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        @media (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .chart-subtitle {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 2px;
        }

        .chart-tabs {
            display: flex;
            gap: 5px;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 3px;
        }

        .chart-tab {
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            background: none;
            color: #64748b;
            transition: all 0.3s;
        }

        .chart-tab.active {
            background: white;
            color: var(--dark-blue);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .chart-container-sm {
            position: relative;
            height: 280px;
        }
        
        /* Recent Activity */
        .recent-activity {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 25px;
            margin-bottom: 25px;
        }
        
        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .activity-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark-blue);
        }
        
        .view-all {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .activity-list {
            list-style: none;
        }
        
        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            gap: 15px;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 36px;
            height: 36px;
            background: #dbeafe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            flex-shrink: 0;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-text {
            font-size: 0.95rem;
            color: #1a365d;
            margin-bottom: 5px;
        }
        
        .activity-time {
            font-size: 0.85rem;
            color: #64748b;
        }
        
        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 25px;
        }
        
        .actions-header {
            margin-bottom: 20px;
        }
        
        .actions-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark-blue);
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .action-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .action-card:hover {
            background: #e0f2fe;
            transform: translateY(-3px);
        }
        
        .action-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 24px;
        }
        
        .action-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1a365d;
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .dashboard-stats {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            
            .stat-value {
                font-size: 1.5rem;
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
            
            .user-profile {
                width: 100%;
                justify-content: space-between;
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
            
            .dashboard-stats {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
            
            .stat-title {
                font-size: 0.85rem;
            }
            
            .stat-value {
                font-size: 1.3rem;
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
            
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
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
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title">Dashboard Admin</h1>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
        
        <!-- Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="stat-title">Visitor</div>
                <div class="stat-value">{{ number_format($totalVisitor) }}</div>
                <div class="stat-change">
                    Pengunjung website
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-title">Leads</div>
                <div class="stat-value">{{ number_format($totalLeads) }}</div>
                <div class="stat-change positive">
                    User tertarik / kontak admin
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-title">User</div>
                <div class="stat-value">{{ number_format($totalUser) }}</div>
                <div class="stat-change positive">
                    Akun terdaftar
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-title">Transaksi</div>
                <div class="stat-value">{{ number_format($totalTransaksi) }}</div>
                <div class="stat-change positive">
                    Pembelian berhasil
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <div class="chart-title">
                            Statistik Penjualan Properti
                        </div>

                        <div class="chart-subtitle">
                            Monitoring transaksi & pendapatan properti
                        </div>
                    </div>

                    <div class="chart-tabs">
                        <button class="chart-tab active" id="btnBulanan">
                            Bulanan
                        </button>

                        <button class="chart-tab" id="btnTahunan">
                            Tahunan
                        </button>
                    </div>
                </div>

                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <div class="chart-title">
                            Status Pemesanan Properti
                        </div>

                        <div class="chart-subtitle">
                            Persentase status transaksi
                        </div>
                    </div>
                </div>

                <div class="chart-container-sm">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="recent-activity">
            <div class="activity-header">
                <h2 class="activity-title">
                    Aktivitas Terbaru
                </h2>
                <a href="{{ route('admin.aktivitas') }}" class="view-all">
                    Lihat Semua
                </a>
            </div>

            <ul class="activity-list">
                @forelse($recentActivities as $activity)
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas {{ $activity['icon'] }}"></i>
                    </div>

                    <div class="activity-content">
                        <div class="activity-text">
                            {{ $activity['text'] }}
                        </div>
                        <div class="activity-time">
                            {{ \Carbon\Carbon::parse($activity['time'])->diffForHumans() }}
                        </div>
                    </div>
                </li>
            @empty
                <li>Belum ada aktivitas</li>
            @endforelse
            </ul>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Quick action cards
            document.querySelectorAll('.action-card').forEach(card => {
                card.addEventListener('click', function() {
                    const action = this.querySelector('.action-title').textContent;
                    alert(`Mengarahkan ke: ${action}`);
                    
                    // In a real Laravel application, you would redirect to the appropriate page
                    // switch(action) {
                    //     case 'Tambah User':
                    //         window.location.href = '/admin/users/create';
                    //         break;
                    //     case 'Tambah Properti':
                    //         window.location.href = '/admin/properties/create';
                    //         break;
                    //     case 'Verifikasi Dokumen':
                    //         window.location.href = '/admin/verification';
                    //         break;
                    //     case 'Lihat Laporan':
                    //         window.location.href = '/admin/reports';
                    //         break;
                    // }
                });
            });
            
            // Search functionality
            const searchInput = document.querySelector('.search-bar input');
            searchInput.addEventListener('input', function() {
                console.log('Searching for:', this.value);
                // In a real application, you would implement live search here
            });
        });

        
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | SALES CHART
    |--------------------------------------------------------------------------
    */

    const salesCtx = document.getElementById('salesChart');

if (salesCtx) {

    let salesChart;

    // DATA BULANAN
    const bulananData = {

        labels: @json($labelBulanan),

        transaksi: @json($dataTransaksi),

        pendapatan: @json($dataPendapatan)
    };

    // DATA TAHUNAN
    const tahunanData = {

        labels: @json($labelTahunan),

        transaksi: @json($dataTahunanTransaksi),

        pendapatan: @json($dataTahunanPendapatan)
    };

    // FUNCTION RENDER CHART
    function renderChart(data) {

        if (salesChart) {
            salesChart.destroy();
        }

        salesChart = new Chart(salesCtx, {

            type: 'bar',

            data: {

                labels: data.labels,

                datasets: [

                    {
                        label: 'Total Transaksi',

                        data: data.transaksi,

                        backgroundColor: '#3B82F6',

                        borderRadius: 8,

                        yAxisID: 'y'
                    },

                    {
                        label: 'Pendapatan',

                        data: data.pendapatan,

                        type: 'line',

                        borderColor: '#10B981',

                        backgroundColor: '#10B981',

                        tension: 0.4,

                        yAxisID: 'y1'
                    }
                ]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    mode: 'index',
                    intersect: false
                },

                plugins: {

                    legend: {
                        position: 'top'
                    }
                },

                scales: {

                    y: {
                        beginAtZero: true
                    },

                    y1: {

                        beginAtZero: true,

                        position: 'right',

                        grid: {
                            drawOnChartArea: false
                        },

                        ticks: {

                            callback: function(value) {

                                return 'Rp ' +
                                    new Intl.NumberFormat('id-ID')
                                    .format(value);
                            }
                        }
                    }
                }
            }
        });
    }

    // DEFAULT CHART
    renderChart(bulananData);

    // BUTTON BULANAN
    document.getElementById('btnBulanan')
        .addEventListener('click', function() {

            renderChart(bulananData);

            this.classList.add('active');

            document.getElementById('btnTahunan')
                .classList.remove('active');
        });

    // BUTTON TAHUNAN
    document.getElementById('btnTahunan')
        .addEventListener('click', function() {

            renderChart(tahunanData);

            this.classList.add('active');

            document.getElementById('btnBulanan')
                .classList.remove('active');
        });
}


    /*
    |--------------------------------------------------------------------------
    | STATUS CHART
    |--------------------------------------------------------------------------
    */

    const statusCtx = document.getElementById('statusChart');

    if (statusCtx) {

        new Chart(statusCtx, {

            type: 'doughnut',

            data: {

                labels: [
                    'Berhasil',
                    'Menunggu Pembayaran',
                    'Menunggu Verifikasi',
                    'Upload Ulang',
                    'Ditolak'
                ],

                datasets: [{

                    data: [

                        {{ $chartStatus['berhasil'] }},
                        {{ $chartStatus['menunggu_pembayaran'] }},
                        {{ $chartStatus['menunggu_verifikasi'] }},
                        {{ $chartStatus['perlu_upload_ulang'] }},
                        {{ $chartStatus['ditolak'] }}

                    ],

                    backgroundColor: [

                        '#10B981',
                        '#F59E0B',
                        '#3B82F6',
                        '#8B5CF6',
                        '#EF4444'

                    ],

                    borderWidth: 0
                }]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

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

