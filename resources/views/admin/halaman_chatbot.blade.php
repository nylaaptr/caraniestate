<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot Admin - Carani Estate</title>
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
        
        /* Chat Container */
        .chat-container {
            display: flex;
            height: calc(100vh - 160px);
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        /* Chat List Sidebar */
        .chat-list {
            width: 320px;
            border-right: 1px solid #e2e8f0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        
        .chat-list-header {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }
        
        .chat-list-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a365d;
            margin-bottom: 15px;
        }
        
        .chat-stats {
            display: flex;
            gap: 15px;
        }
        
        .stat-item {
            text-align: center;
            flex: 1;
        }
        
        .stat-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-blue);
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .chat-filters {
            padding: 15px 20px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            display: flex;              /* kunci utama */
            align-items: center;        /* sejajar secara vertikal */
            justify-content: flex-start;/* kiri ke kanan */
            gap: 8px;
        }
        
        .filter-btn {
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 0.85rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-btn.active {
            background: var(--primary-blue);
            color: white;
        }
        
        .filter-btn:not(.active) {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .chat-items {
            flex-grow: 1;
            overflow-y: auto;
        }
        
        .chat-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .chat-item:hover {
            background: #f8fafc;
        }
        
        .chat-item.active {
            background: #e0f2fe;
            border-left: 4px solid var(--primary-blue);
        }
        
        .chat-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .chat-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .chat-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 16px;
        }
        
        .chat-user-details {
            flex: 1;
        }
        
        .chat-user-name {
            font-weight: 600;
            color: #1a365d;
            font-size: 0.95rem;
        }
        
        .chat-user-id {
            font-size: 0.75rem;
            color: #64748b;
        }
        
        .chat-time {
            font-size: 0.75rem;
            color: #64748b;
        }
        
        .chat-preview {
            font-size: 0.85rem;
            color: #4a5568;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 5px;
        }
        
        .chat-tags {
            display: flex;
            gap: 5px;
        }
        
        .chat-tag {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 500;
        }
        
        .tag-new {
            background: #fef3c7;
            color: #f59e0b;
        }
        
        .tag-pending {
            background: #e0f2fe;
            color: #0369a1;
        }
        
        .tag-resolved {
            background: #d1fae5;
            color: #059669;
        }
        
        /* Chat Content */
        .chat-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .chat-header {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .chat-user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 20px;
        }
        
        .chat-user-info-large {
            flex: 1;
        }
        
        .chat-user-name-large {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a365d;
            margin-bottom: 3px;
        }
        
        .chat-user-details-large {
            display: flex;
            gap: 15px;
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .chat-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-online {
            background: #d1fae5;
            color: #059669;
        }
        
        .status-offline {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .chat-actions {
            display: flex;
            gap: 10px;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-resolve {
            background: #d1fae5;
            color: #059669;
        }
        
        .btn-resolve:hover {
            background: #86efac;
        }
        
        .btn-delete {
            background: #fecaca;
            color: #dc2626;
        }
        
        .btn-delete:hover {
            background: #fca5a5;
        }
        
        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .message {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 12px;
            position: relative;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .message-user {
            align-self: flex-start;
            background: #f1f5f9;
            color: #1a365d;
            border-bottom-left-radius: 4px;
        }
        
        .message-admin {
            align-self: flex-end;
            background: var(--primary-blue);
            color: white;
            border-bottom-right-radius: 4px;
        }
        
        .message-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 0.8rem;
        }
        
        .message-sender {
            font-weight: 600;
        }
        
        .message-time {
            opacity: 0.8;
        }
        
        .message-content {
            line-height: 1.5;
        }
        
        .message-actions {
            position: absolute;
            top: 5px;
            right: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .message:hover .message-actions {
            opacity: 1;
        }
        
        .message-action-btn {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
            background: rgba(0,0,0,0.1);
            color: white;
        }
        
        .chat-input {
            padding: 20px;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
            display: flex;
            gap: 10px;
        }
        
        .message-input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            resize: none;
            min-height: 60px;
            max-height: 120px;
        }
        
        .message-input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(var(--primary-blue-rgb), 0.2);
            outline: none;
        }
        
        .send-btn {
            background: var(--primary-blue);
            color: white;
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .send-btn:hover {
            background: #6aa5c6;
            transform: scale(1.05);
        }
        
        .send-btn:disabled {
            background: #cbd5e0;
            cursor: not-allowed;
            transform: none;
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .chat-list {
                width: 280px;
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
            
            .chat-container {
                height: calc(100vh - 140px);
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
            
            .chat-container {
                flex-direction: column;
                height: calc(100vh - 120px);
            }
            
            .chat-list {
                width: 100%;
                max-height: 300px;
            }
            
            .chat-content {
                height: calc(100% - 300px);
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
            
            .chat-list-header, .chat-filters {
                padding: 12px 15px;
                flex-wrap: wrap;
            }
            
            .chat-item {
                padding: 12px 15px;
            }
            
            .chat-user-name {
                font-size: 0.9rem;
            }
            
            .chat-preview {
                font-size: 0.8rem;
            }
            
            .chat-header {
                padding: 15px;
            }
            
            .chat-user-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
            
            .chat-user-name-large {
                font-size: 1rem;
            }
            
            .chat-messages {
                padding: 15px;
            }
            
            .message {
                max-width: 80%;
            }
            
            .chat-input {
                padding: 15px;
            }
            
            .message-input {
                min-height: 50px;
            }
            
            .send-btn {
                width: 50px;
                height: 50px;
                font-size: 18px;
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
            <h1 class="page-title">ChatBot Admin</h1>
            
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari riwayat chat...">
            </div>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin Utama</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
        
        <!-- Chat Container -->
        <div class="chat-container">
            <!-- Chat List -->
            <div class="chat-list">
                <div class="chat-list-header">
                    <h2 class="chat-list-title">Riwayat Chat Pengguna</h2>
                    <div class="chat-stats">
                        <div class="stat-item">
                            <div class="stat-value">24</div>
                            <div class="stat-label">Aktif</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">8</div>
                            <div class="stat-label">Baru</div>
                        </div>
                    </div>
                </div>
                
                <div class="chat-filters">
                    <button class="filter-btn active">Semua</button>
                    <button class="filter-btn">Pending</button>
                    <button class="filter-btn">Ditanggapi</button>
                </div>
                
                <div class="chat-items">
                    <div class="chat-item active">
                        <div class="chat-item-header">
                            <div class="chat-user-info">
                                <div class="chat-avatar">N</div>
                                <div class="chat-user-details">
                                    <div class="chat-user-name">Nayla Putri</div>
                                    <div class="chat-user-id">ID: USER-001</div>
                                </div>
                            </div>
                            <div class="chat-time">10:24 AM</div>
                        </div>
                        <div class="chat-preview">Halo, saya tertarik dengan rumah di cluster...</div>
                        <div class="chat-tags">
                            <span class="chat-tag tag-new">Baru</span>
                            <span class="chat-tag tag-pending">Pertanyaan</span>
                        </div>
                    </div>
                    
                    <div class="chat-item">
                        <div class="chat-item-header">
                            <div class="chat-user-info">
                                <div class="chat-avatar">A</div>
                                <div class="chat-user-details">
                                    <div class="chat-user-name">Alfin Rahman</div>
                                    <div class="chat-user-id">ID: USER-002</div>
                                </div>
                            </div>
                            <div class="chat-time">09:15 AM</div>
                        </div>
                        <div class="chat-preview">Saya ingin tahu tentang skema pembayaran...</div>
                        <div class="chat-tags">
                            <span class="chat-tag tag-pending">Pending</span>
                        </div>
                    </div>
                    
                    <div class="chat-item">
                        <div class="chat-item-header">
                            <div class="chat-user-info">
                                <div class="chat-avatar">R</div>
                                <div class="chat-user-details">
                                    <div class="chat-user-name">Rizky Saputra</div>
                                    <div class="chat-user-id">ID: USER-003</div>
                                </div>
                            </div>
                            <div class="chat-time">Kemarin</div>
                        </div>
                        <div class="chat-preview">Terima kasih atas bantuannya, saya akan...</div>
                        <div class="chat-tags">
                            <span class="chat-tag tag-resolved">Selesai</span>
                        </div>
                    </div>
                    
                    <div class="chat-item">
                        <div class="chat-item-header">
                            <div class="chat-user-info">
                                <div class="chat-avatar">S</div>
                                <div class="chat-user-details">
                                    <div class="chat-user-name">Siti Nurhaliza</div>
                                    <div class="chat-user-id">ID: USER-004</div>
                                </div>
                            </div>
                            <div class="chat-time">02/06</div>
                        </div>
                        <div class="chat-preview">Apakah ada promo khusus untuk pembelian...</div>
                        <div class="chat-tags">
                            <span class="chat-tag tag-pending">Pending</span>
                        </div>
                    </div>
                    
                    <div class="chat-item">
                        <div class="chat-item-header">
                            <div class="chat-user-info">
                                <div class="chat-avatar">D</div>
                                <div class="chat-user-details">
                                    <div class="chat-user-name">Dewi Lestari</div>
                                    <div class="chat-user-id">ID: USER-005</div>
                                </div>
                            </div>
                            <div class="chat-time">01/06</div>
                        </div>
                        <div class="chat-preview">Saya sudah upload dokumen, mohon verifikasi...</div>
                        <div class="chat-tags">
                            <span class="chat-tag tag-resolved">Selesai</span>
                        </div>
                    </div>
                    
                    <div class="chat-item">
                        <div class="chat-item-header">
                            <div class="chat-user-info">
                                <div class="chat-avatar">K</div>
                                <div class="chat-user-details">
                                    <div class="chat-user-name">Kevin Hartono</div>
                                    <div class="chat-user-id">ID: USER-006</div>
                                </div>
                            </div>
                            <div class="chat-time">30/05</div>
                        </div>
                        <div class="chat-preview">Bisa bantu saya untuk menghitung simulasi...</div>
                        <div class="chat-tags">
                            <span class="chat-tag tag-pending">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chat Content -->
            <div class="chat-content">
                <div class="chat-header">
                    <div class="chat-user-avatar">N</div>
                    <div class="chat-user-info-large">
                        <div class="chat-user-name-large">Nayla Putri Wijaya</div>
                        <div class="chat-user-details-large">
                            <span>PNS - Marketing</span>
                            <span>|</span>
                            <span>Rp 8.500.000/bulan</span>
                            <span class="chat-status status-online">Online</span>
                        </div>
                    </div>
                    <div class="chat-actions">
                        <div class="action-btn btn-resolve" title="Tandai sebagai selesai">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="action-btn btn-delete" title="Hapus riwayat">
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>
                </div>
                
                <div class="chat-messages">
                    <div class="message message-user">
                        <div class="message-header">
                            <span class="message-sender">Nayla</span>
                            <span class="message-time">10:20 AM</span>
                        </div>
                        <div class="message-content">
                            Halo! Saya tertarik dengan rumah di cluster Harmony Garden. Apakah masih tersedia unit tipe 36/72?
                        </div>
                    </div>
                    
                    <div class="message message-admin">
                        <div class="message-header">
                            <span class="message-sender">Admin - Bambang</span>
                            <span class="message-time">10:22 AM</span>
                        </div>
                        <div class="message-content">
                            Halo Mbak Nayla! Terima kasih atas pertanyaannya. Untuk cluster Harmony Garden, tipe 36/72 masih tersedia dengan harga mulai dari Rp 450 juta. Ada 3 unit yang tersisa. Apakah Anda ingin saya tampilkan detail lengkapnya?
                        </div>
                        <div class="message-actions">
                            <div class="message-action-btn">
                                <i class="fas fa-edit"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="message message-user">
                        <div class="message-header">
                            <span class="message-sender">Nayla</span>
                            <span class="message-time">10:24 AM</span>
                        </div>
                        <div class="message-content">
                            Ya, saya ingin tahu detail lengkapnya, terutama tentang lokasi, fasilitas, dan skema pembayaran yang tersedia.
                        </div>
                    </div>
                    
                    <div class="message message-admin">
                        <div class="message-header">
                            <span class="message-sender">Admin - Bambang</span>
                            <span class="message-time">10:26 AM</span>
                        </div>
                        <div class="message-content">
                            Tentu Mbak Nayla! Untuk cluster Harmony Garden:<br>
                        - Lokasi: Blok A, dekat taman utama dan gerbang utama<br>
                        - Fasilitas: Kolam renang, gym, taman bermain anak, keamanan 24 jam<br>
                        - Skema pembayaran: Cash keras, KPR (DP 10%), atau cicilan tanpa bunga 12 bulan<br><br>
                        
                        Apakah Mbak berminat untuk jadwalkan survey lokasi?
                        </div>
                    </div>
                    
                    <div class="message message-user">
                        <div class="message-header">
                            <span class="message-sender">Nayla</span>
                            <span class="message-time">10:28 AM</span>
                        </div>
                        <div class="message-content">
                            Terima kasih Mas Bambang! Saya tertarik dengan skema KPR. Apakah bisa dijelaskan lebih detail tentang simulasi cicilan per bulannya?
                        </div>
                    </div>
                    
                    <div class="message message-admin">
                        <div class="message-header">
                            <span class="message-sender">Admin - Bambang</span>
                            <span class="message-time">10:30 AM</span>
                        </div>
                        <div class="message-content">
                            Tentu Mbak Nayla! Untuk unit tipe 36/72 dengan harga Rp 450 juta:<br>
                        - DP 10% = Rp 45 juta<br>
                        - Cicilan bank selama 15 tahun<br>
                        - Estimasi cicilan per bulan: Rp 3.8 - 4.2 juta (tergantung suku bunga bank)<br><br>
                        
                        Kami juga bisa bantu proses pengajuan KPR ke 5 bank partner kami dengan suku bunga kompetitif. Apakah Mbak berminat untuk jadwalkan survey lokasi?
                        </div>
                    </div>
                    
                    <div class="message message-user">
                        <div class="message-header">
                            <span class="message-sender">Nayla</span>
                            <span class="message-time">10:32 AM</span>
                        </div>
                        <div class="message-content">
                            Ya, saya sangat berminat! Kapan bisa dijadwalkan survey lokasi? Apakah bisa hari Sabtu besok?
                        </div>
                    </div>
                    
                    <div class="message message-admin">
                        <div class="message-header">
                            <span class="message-sender">Admin - Bambang</span>
                            <span class="message-time">10:33 AM</span>
                        </div>
                        <div class="message-content">
                            Pasti bisa Mbak Nayla! Saya akan bookingkan jadwal survey untuk hari Sabtu besok, pukul 10.00 WIB. Saya akan kirim konfirmasi via WhatsApp 1 hari sebelum jadwal. Mohon pastikan nomor WhatsApp yang terdaftar aktif ya.
                        </div>
                    </div>
                    
                    <div class="message message-user">
                        <div class="message-header">
                            <span class="message-sender">Nayla</span>
                            <span class="message-time">10:35 AM</span>
                        </div>
                        <div class="message-content">
                            Baik, terima kasih banyak Mas Bambang! Saya tunggu konfirmasinya. Nomor WhatsApp saya sudah aktif.
                        </div>
                    </div>
                    
                    <div class="message message-admin">
                        <div class="message-header">
                            <span class="message-sender">Admin - Bambang</span>
                            <span class="message-time">10:36 AM</span>
                        </div>
                        <div class="message-content">
                            Sama-sama Mbak Nayla! Senang bisa membantu. Jika ada pertanyaan lain, jangan ragu untuk menghubungi saya. Selamat siang! 😊
                        </div>
                    </div>
                </div>
                
                <div class="chat-input">
                    <textarea class="message-input" placeholder="Ketik pesan Anda..."></textarea>
                    <button class="send-btn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chat item selection
            const chatItems = document.querySelectorAll('.chat-item');
            chatItems.forEach(item => {
                item.addEventListener('click', function() {
                    chatItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Filter buttons
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Send message functionality
            const messageInput = document.querySelector('.message-input');
            const sendBtn = document.querySelector('.send-btn');
            
            sendBtn.addEventListener('click', function() {
                const message = messageInput.value.trim();
                if (message) {
                    // Create new message element
                    const newMessage = document.createElement('div');
                    newMessage.className = 'message message-admin';
                    newMessage.innerHTML = `
                        <div class="message-header">
                            <span class="message-sender">Admin - Bambang</span>
                            <span class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                        </div>
                        <div class="message-content">
                            ${message}
                        </div>
                        <div class="message-actions">
                            <div class="message-action-btn">
                                <i class="fas fa-edit"></i>
                            </div>
                        </div>
                    `;
                    
                    // Add to chat messages
                    document.querySelector('.chat-messages').appendChild(newMessage);
                    
                    // Clear input and focus
                    messageInput.value = '';
                    messageInput.focus();
                    
                    // Scroll to bottom
                    const chatMessages = document.querySelector('.chat-messages');
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                    
                    // Simulate user response after 2 seconds
                    setTimeout(() => {
                        const userResponse = document.createElement('div');
                        userResponse.className = 'message message-user';
                        userResponse.innerHTML = `
                            <div class="message-header">
                                <span class="message-sender">Nayla</span>
                                <span class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                            </div>
                            <div class="message-content">
                                Terima kasih atas tanggapannya. Saya akan pertimbangkan informasi ini.
                            </div>
                        `;
                        
                        document.querySelector('.chat-messages').appendChild(userResponse);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 2000);
                }
            });
            
            // Enter key to send message (Shift+Enter for new line)
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendBtn.click();
                }
            });
            
            // Action buttons
            document.querySelector('.btn-resolve').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menandai chat ini sebagai selesai?')) {
                    // Update the chat status
                    const chatTags = document.querySelector('.chat-tags');
                    chatTags.innerHTML = '<span class="chat-tag tag-resolved">Selesai</span>';
                    
                    // Show success message
                    alert('Chat berhasil ditandai sebagai selesai.');
                }
            });
            
            document.querySelector('.btn-delete').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus riwayat chat ini? Tindakan ini tidak dapat dibatalkan.')) {
                    // Here you would typically make an API call to delete the chat
                    alert('Riwayat chat berhasil dihapus.');
                    // In a real app, you'd redirect to the next chat or refresh the list
                }
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