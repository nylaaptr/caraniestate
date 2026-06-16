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
        
        /* Document Verification Section */
        .verification-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 25px;
        }
        
        .verification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .verification-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a365d;
        }
        
        .user-info-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .user-avatar {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 24px;
        }
        
        .user-details {
            flex: 1;
        }
        
        .user-name-large {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a365d;
            margin-bottom: 5px;
        }
        
        .user-id {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 5px;
        }
        
        .user-status {
            font-size: 0.85rem;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-block;
        }
        
        .user-status.pending {
            background: #fef3c7;
            color: #f59e0b;
        }
        
        .user-status.approved {
            background: #d1fae5;
            color: #059669;
        }
        
        .user-status.rejected {
            background: #fecaca;
            color: #dc2626;
        }
        
        .document-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .document-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .document-item:hover {
            background: #f1f5f9;
            border-color: var(--primary-blue);
        }
        
        .document-item.selected {
            background: #e0f2fe;
            border-color: var(--primary-blue);
        }
        
        .doc-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }
        
        .doc-icon {
            width: 40px;
            height: 40px;
            background: #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #4a5568;
        }
        
        .doc-icon.complete {
            background: #d1fae5;
            color: #059669;
        }
        
        .doc-icon.pending {
            background: #fef3c7;
            color: #f59e0b;
        }
        
        .doc-icon.missing {
            background: #fecaca;
            color: #dc2626;
        }
        
        .doc-name {
            font-weight: 600;
            color: #1a365d;
            font-size: 0.95rem;
        }
        
        .doc-status {
            font-size: 0.8rem;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-block;
        }
        
        .doc-status.complete {
            background: #d1fae5;
            color: #059669;
        }
        
        .doc-status.pending {
            background: #fef3c7;
            color: #f59e0b;
        }
        
        .doc-status.missing {
            background: #fecaca;
            color: #dc2626;
        }
        
        .doc-actions {
            display: flex;
            gap: 10px;
            text-decoration: none;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .view-btn {
            background: #e2e8f0;
            color: #4a5568;
            text-decoration: none;
        }
        
        .view-btn:hover {
            background: #cbd5e0;
            color: #1a365d;
        }

        a {
            text-decoration: none;
        }
        
        .reject-btn {
            background: #fecaca;
            color: #dc2626;
        }
        
        .reject-btn:hover {
            background: #fca5a5;
            color: #b91c1c;
        }
        
        .approve-btn {
            background: #d1fae5;
            color: #059669;
        }
        
        .approve-btn:hover {
            background: #86efac;
            color: #047857;
        }
        
        .footer-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        
        .btn-back {
            background: #e2e8f0;
            color: #4a5568;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background: #cbd5e0;
        }
        
        .btn-complete {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-complete:hover {
            background: #6aa5c6;
        }
        
        /* Document Preview Modal */
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
        
        .preview-modal {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            transform: scale(0.9);
            transition: all 0.3s ease;
        }
        
        .modal-overlay.show .preview-modal {
            transform: scale(1);
        }
        
        .modal-header {
            padding: 24px 30px;
            background: linear-gradient(135deg, var(--dark-blue) 0%, #2c5282 100%);
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
            max-height: 60vh;
            overflow-y: auto;
        }
        
        .preview-content {
            text-align: center;
            padding: 20px;
        }
        
        .preview-image {
            max-width: 100%;
            max-height: 400px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            object-fit: contain;
            background: #f8fafc;
        }
        
        .preview-text {
            font-size: 0.95rem;
            color: #4a5568;
            line-height: 1.6;
            margin-top: 20px;
        }
        
        .verification-notes {
            margin-top: 25px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        
        .notes-title {
            font-weight: 600;
            color: #1a365d;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .notes-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            font-size: 0.95rem;
            min-height: 100px;
            resize: vertical;
        }
        
        .notes-input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(var(--primary-blue-rgb), 0.2);
            outline: none;
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .verification-container {
                padding: 25px;
            }
            
            .user-info-card {
                padding: 15px;
            }
            
            .user-name-large {
                font-size: 1.1rem;
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
            
            .page-title {
                font-size: 1.3rem;
            }
            
            .user-profile {
                width: 100%;
                justify-content: space-between;
            }
            
            .verification-header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }
            
            .document-item {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }
            
            .doc-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .doc-actions {
                width: 100%;
                justify-content: space-around;
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
            
            .verification-container {
                padding: 20px;
            }
            
            .user-info-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .user-avatar {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
            
            .user-name-large {
                font-size: 1rem;
            }
            
            .document-item {
                padding: 15px;
            }
            
            .doc-icon {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }
            
            .doc-name {
                font-size: 0.9rem;
            }
            
            .doc-status {
                font-size: 0.75rem;
            }
            
            .action-btn {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }
            
            .footer-actions {
                flex-direction: column;
                gap: 15px;
            }
            
            .btn-back, .btn-complete {
                width: 100%;
                text-align: center;
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
            
            .verification-container {
                padding: 15px;
            }
            
            .user-info-card {
                padding: 15px;
            }
            
            .user-avatar {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
            
            .user-name-large {
                font-size: 0.95rem;
            }
            
            .document-item {
                padding: 12px;
            }
            
            .doc-icon {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }
            
            .doc-name {
                font-size: 0.85rem;
            }
            
            .doc-status {
                font-size: 0.7rem;
            }
            
            .action-btn {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }
            
            .footer-actions {
                margin-top: 20px;
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
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
        
        <!-- Verification Container -->
        {{-- Header: Tampilkan info transaksi --}}
            <div class="verification-header">
                <h2 class="verification-title">
                    Verifikasi Dokumen - {{ $user->nama_user }}
                    <small>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d/m/Y H:i') }}</small>
                </h2>
            </div>

            {{-- List Dokumen --}}
            <div class="document-list">
                @forelse ($dokumen as $dok)  {{-- ✅ Loop dari $dokumen, bukan $user->dokumen --}}
                <div class="document-item">
                    <div class="doc-info">
                        <div class="doc-icon 
                            {{ $dok->status_verifikasi == 'diterima' ? 'complete' : ($dok->status_verifikasi == 'ditolak' ? 'rejected' : 'pending') }}">
                            <i class="fas fa-file"></i>
                        </div>

                        <div class="doc-name">
                            {{ ucfirst(str_replace('_', ' ', $dok->jenis_dokumen)) }}
                        </div>

                        <div class="doc-status 
                            {{ $dok->status_verifikasi == 'diterima' ? 'complete' : ($dok->status_verifikasi == 'ditolak' ? 'rejected' : 'pending') }}">
                            
                            @if($dok->status_verifikasi == 'diterima')
                                Lengkap & Valid
                            @elseif($dok->status_verifikasi == 'ditolak')
                                Tidak Valid
                            @else
                                Menunggu Verifikasi
                            @endif
                        </div>
                    </div>

                    <div class="doc-actions">

                        {{-- VIEW --}}
                        <a href="{{ asset('storage/' . $dok->path_file) }}" target="_blank">
                            <div class="action-btn view-btn">
                                <i class="fas fa-eye"></i>
                            </div>
                        </a>


                        {{-- TOLAK --}}
                        @if($dok->status_verifikasi != 'diterima')

                        <!-- TOLAK -->
                        <form method="POST"
                            action="{{ route('admin.verifikasi.tolak', $dok->id_dokumen) }}"
                            class="reject-form"
                            style="display:inline;">

                            @csrf

                            <input 
                                type="hidden"
                                name="catatan"
                                class="catatan-input">

                            <button type="button" class="action-btn reject-btn btn-tolak">
                                <i class="fas fa-times"></i>
                            </button>

                        </form>
                        @endif


                        {{-- APPROVE --}}
                        @if($dok->status_verifikasi != 'diterima')

                        <form method="POST"
                            action="{{ route('admin.verifikasi.approve', $dok->id_dokumen) }}"
                            style="display:inline;">

                            @csrf

                            <button
                                type="submit"
                                class="action-btn approve-btn"
                                onclick="return confirm('Setujui dokumen ini?')">

                                <i class="fas fa-check"></i>

                            </button>

                        </form>

                        @else

                        <div class="action-btn approve-btn">
                            <i class="fas fa-check"></i>
                        </div>

                        @endif

                    </div>
                </div>
                @empty
                <p style="text-align:center; color:#64748b;">Tidak ada dokumen untuk diverifikasi.</p>
                @endforelse
            </div>
            
            <form method="POST" action="{{ route('admin.verifikasi.selesai', $user->id_user) }}">
                @csrf

                <div class="verification-notes">
                    <h3 class="notes-title">Catatan Verifikasi</h3>
                    <textarea name="catatan" class="notes-input" 
                        placeholder="Masukkan catatan verifikasi jika diperlukan..."></textarea>
                </div>

                <div class="footer-actions">
                    <a href="{{ route('admin.halaman_verifikasi') }}">
                        <button type="button" class="btn-back">Kembali</button>
                    </a>

                    <button type="submit" class="btn-complete">Selesai</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Document Preview Modal
    <div class="modal-overlay" id="previewModal">
        <div class="preview-modal">
            <div class="modal-header">
                <h3 class="modal-title">Preview Dokumen</h3>
                <button class="close-modal" id="closePreviewModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="preview-content">
                    <img src="https://placehold.co/600x400/e2e8f0/4a5568?text=Dokumen+KTP" alt="Dokumen KTP" class="preview-image">
                    <div class="preview-text">
                        Ini adalah preview dokumen yang diupload oleh pengguna. Untuk dokumen asli, silakan download atau buka dalam mode fullscreen.
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <script>
document.addEventListener('DOMContentLoaded', function() {

    console.log("JS aktif");

    /*
    ==========================================
    DOCUMENT ITEM SELECT
    ==========================================
    */
    document.querySelectorAll('.document-item').forEach(item => {

        item.addEventListener('click', function(e) {

            if (e.target.closest('.action-btn')) return;

            document.querySelectorAll('.document-item').forEach(el => {
                el.classList.remove('selected');
            });

            this.classList.add('selected');

        });

    });



    /*
    ==========================================
    PREVIEW MODAL
    ==========================================
    */
    const previewModal = document.getElementById('previewModal');
    const closePreviewModal = document.getElementById('closePreviewModal');

    if(previewModal && closePreviewModal){

        closePreviewModal.addEventListener('click', function() {
            previewModal.classList.remove('show');
        });

        previewModal.addEventListener('click', function(e) {
            if(e.target === previewModal){
                previewModal.classList.remove('show');
            }
        });

        document.addEventListener('keydown', function(e) {
            if (
                e.key === 'Escape' &&
                previewModal.classList.contains('show')
            ) {
                previewModal.classList.remove('show');
            }
        });

    }



    /*
    ==========================================
    TOLAK DOKUMEN
    ==========================================
    */
    document.querySelectorAll('.btn-tolak').forEach(button => {

        button.addEventListener('click', function() {

            const alasan = prompt(
                "Masukkan alasan penolakan dokumen:"
            );

            // cancel
            if(alasan === null){
                return;
            }

            // kosong
            if(alasan.trim() === ''){
                alert("Catatan penolakan wajib diisi.");
                return;
            }

            const form = this.closest('.reject-form');

            if(!form){
                console.error("Form reject tidak ditemukan");
                return;
            }

            const inputCatatan = form.querySelector('.catatan-input');

            if(!inputCatatan){
                console.error("Input catatan tidak ditemukan");
                return;
            }

            inputCatatan.value = alasan;

            console.log("Catatan terkirim:", alasan);

            form.submit();

        });

    });



    /*
    ==========================================
    BUTTON SELESAI
    ==========================================
    */
    const completeBtn = document.querySelector('.btn-complete');

    if(completeBtn){

        completeBtn.addEventListener('click', function(e) {

            const pendingDocs =
                document.querySelectorAll('.doc-status.pending');

            if(pendingDocs.length > 0){

                const lanjut = confirm(
                    'Masih ada dokumen yang belum diverifikasi. Lanjutkan?'
                );

                if(!lanjut){
                    e.preventDefault();
                    return false;
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
