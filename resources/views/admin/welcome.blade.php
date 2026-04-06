<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PropertiHarmoni</title>
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
            <h1 class="page-title">Dashboard Admin</h1>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin Utama</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
        
        <!-- Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="stat-title">Total Pengguna</div>
                <div class="stat-value">2,458</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +12% dari bulan lalu
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-title">Properti Aktif</div>
                <div class="stat-value">1,892</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +8% dari bulan lalu
                </div>
            </div>
            
            
            
            <div class="stat-card">
                <div class="stat-title">Verifikasi Pending</div>
                <div class="stat-value">23</div>
                <div class="stat-change">
                    <i class="fas fa-clock"></i>
                    Perlu segera diproses
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="recent-activity">
            <div class="activity-header">
                <h2 class="activity-title">Aktivitas Terbaru</h2>
                <a href="#" class="view-all">Lihat Semua</a>
            </div>
            
            <ul class="activity-list">
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Pengguna baru mendaftar: Nayla Putri Wijaya</div>
                        <div class="activity-time">10 menit yang lalu</div>
                    </div>
                </li>
                
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Properti baru ditambahkan: Kelapa Gading Regency</div>
                        <div class="activity-time">2 jam yang lalu</div>
                    </div>
                </li>
                
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-file-upload"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Dokumen verifikasi dikirim oleh Alfin Rahman</div>
                        <div class="activity-time">5 jam yang lalu</div>
                    </div>
                </li>
                
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Transaksi baru: Rizky Saputra membeli Green City</div>
                        <div class="activity-time">Kemarin</div>
                    </div>
                </li>
                
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Pesan ChatBot baru dari Siti Nurhaliza</div>
                        <div class="activity-time">Kemarin</div>
                    </div>
                </li>
            </ul>
        </div>
        
        <!-- Quick Actions -->
        <div class="quick-actions">
            <div class="actions-header">
                <h2 class="actions-title">Aksi Cepat</h2>
            </div>
            
            <div class="actions-grid">
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="action-title">Tambah User</div>
                </div>
                
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="action-title">Tambah Properti</div>
                </div>
                
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="action-title">Verifikasi Dokumen</div>
                </div>
                
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="action-title">Lihat Laporan</div>
                </div>
            </div>
        </div>
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

