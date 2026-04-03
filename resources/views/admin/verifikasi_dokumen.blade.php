<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dokumen - PropertiHarmoni</title>
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
        }
        
        .view-btn {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .view-btn:hover {
            background: #cbd5e0;
            color: #1a365d;
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
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-home"></i>
            </div>
            <div class="company-name">PT. Carani Bhanu Balakosa</div>
        </div>
        
        <div class="nav-menu" id="navMenu">
            <a href="{{ route('welcome') }}"
                class="nav-item {{ request()->routeIs('welcome') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('data_user') }}"
                class="nav-item {{ request()->routeIs('data_user') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Data User</span>
            </a>

            <a href="{{ route('data_rumah') }}"
                class="nav-item {{ request()->routeIs('data_rumah') ? 'active' : '' }}">
                <i class="fas fa-house"></i>
                <span>Data Rumah</span>
            </a>

            <a href="{{ route('halaman_verifikasi') }}"
                class="nav-item {{ request()->routeIs('halaman_verifikasi') ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i>
                <span>Verifikasi Data</span>
            </a>

            <a href="{{ route('halaman_chatbot') }}"
                class="nav-item {{ request()->routeIs('halaman_chatbot') ? 'active' : '' }}">
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
            <h1 class="page-title">Verifikasi Dokumen Pengguna</h1>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin Utama</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
        
        <!-- Verification Container -->
        <div class="verification-container">
            <div class="verification-header">
                <h2 class="verification-title">Verifikasi Dokumen - Nayla Putri Wijaya</h2>
            </div>
            
            <div class="user-info-card">
                <div class="user-avatar">N</div>
                <div class="user-details">
                    <div class="user-name-large">Nayla Putri Wijaya</div>
                    <div class="user-id">ID: USER-2025-001</div>
                    <div class="user-status pending">Status: Belum Diverifikasi</div>
                </div>
            </div>
            
            <div class="document-list">
                <div class="document-item">
                    <div class="doc-info">
                        <div class="doc-icon complete">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="doc-name">Kartu Tanda Penduduk (KTP)</div>
                        <div class="doc-status complete">Lengkap & Valid</div>
                    </div>
                    <div class="doc-actions">
                        <div class="action-btn view-btn" data-doc="ktp">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-btn reject-btn" data-doc="ktp">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="action-btn approve-btn" data-doc="ktp">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
                
                <div class="document-item">
                    <div class="doc-info">
                        <div class="doc-icon complete">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="doc-name">Kartu Keluarga (KK)</div>
                        <div class="doc-status complete">Lengkap & Valid</div>
                    </div>
                    <div class="doc-actions">
                        <div class="action-btn view-btn" data-doc="kk">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-btn reject-btn" data-doc="kk">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="action-btn approve-btn" data-doc="kk">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
                
                <div class="document-item">
                    <div class="doc-info">
                        <div class="doc-icon complete">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="doc-name">Slip Gaji 3 Bulan Terakhir</div>
                        <div class="doc-status complete">Lengkap & Valid</div>
                    </div>
                    <div class="doc-actions">
                        <div class="action-btn view-btn" data-doc="slip-gaji">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-btn reject-btn" data-doc="slip-gaji">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="action-btn approve-btn" data-doc="slip-gaji">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
                
                <div class="document-item">
                    <div class="doc-info">
                        <div class="doc-icon pending">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="doc-name">NPWP</div>
                        <div class="doc-status pending">Menunggu Upload</div>
                    </div>
                    <div class="doc-actions">
                        <div class="action-btn view-btn" data-doc="npwp">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-btn reject-btn" data-doc="npwp">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="action-btn approve-btn" data-doc="npwp">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
                
                <div class="document-item">
                    <div class="doc-info">
                        <div class="doc-icon missing">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div class="doc-name">Surat Keterangan Kerja</div>
                        <div class="doc-status missing">Belum Diupload</div>
                    </div>
                    <div class="doc-actions">
                        <div class="action-btn view-btn" data-doc="sk-kerja">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-btn reject-btn" data-doc="sk-kerja">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="action-btn approve-btn" data-doc="sk-kerja">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
                
                <div class="document-item">
                    <div class="doc-info">
                        <div class="doc-icon missing">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="doc-name">Rekening Koran 6 Bulan</div>
                        <div class="doc-status missing">Belum Diupload</div>
                    </div>
                    <div class="doc-actions">
                        <div class="action-btn view-btn" data-doc="rekening-koran">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-btn reject-btn" data-doc="rekening-koran">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="action-btn approve-btn" data-doc="rekening-koran">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="verification-notes">
                <h3 class="notes-title">Catatan Verifikasi</h3>
                <textarea class="notes-input" placeholder="Masukkan catatan verifikasi jika diperlukan..."></textarea>
            </div>
            
            <div class="footer-actions">
                <button class="btn-back">Kembali</button>
                <button class="btn-complete">Selesai</button>
            </div>
        </div>
    </div>

    <!-- Document Preview Modal -->
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Document action buttons
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const docType = this.getAttribute('data-doc');
                    document.getElementById('previewModal').classList.add('show');
                    
                    // Update modal title based on document type
                    const modalTitle = document.querySelector('.modal-title');
                    let docName = '';
                    switch(docType) {
                        case 'ktp':
                            docName = 'Kartu Tanda Penduduk (KTP)';
                            break;
                        case 'kk':
                            docName = 'Kartu Keluarga (KK)';
                            break;
                        case 'slip-gaji':
                            docName = 'Slip Gaji 3 Bulan Terakhir';
                            break;
                        case 'npwp':
                            docName = 'NPWP';
                            break;
                        case 'sk-kerja':
                            docName = 'Surat Keterangan Kerja';
                            break;
                        case 'rekening-koran':
                            docName = 'Rekening Koran 6 Bulan';
                            break;
                        default:
                            docName = 'Dokumen';
                    }
                    modalTitle.textContent = `Preview Dokumen: ${docName}`;
                });
            });
            
            // Approve button functionality
            document.querySelectorAll('.approve-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const docItem = this.closest('.document-item');
                    const docIcon = docItem.querySelector('.doc-icon');
                    const docStatus = docItem.querySelector('.doc-status');
                    
                    docIcon.className = 'doc-icon complete';
                    docStatus.className = 'doc-status complete';
                    docStatus.textContent = 'Lengkap & Valid';
                    
                    // Show success message
                    alert(`Dokumen telah diverifikasi dan disetujui.`);
                });
            });
            
            // Reject button functionality
            document.querySelectorAll('.reject-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const docItem = this.closest('.document-item');
                    const docIcon = docItem.querySelector('.doc-icon');
                    const docStatus = docItem.querySelector('.doc-status');
                    
                    docIcon.className = 'doc-icon rejected';
                    docStatus.className = 'doc-status rejected';
                    docStatus.textContent = 'Tidak Valid';
                    
                    // Show prompt for rejection reason
                    const reason = prompt('Masukkan alasan penolakan dokumen ini:');
                    if (reason) {
                        alert(`Dokumen ditolak dengan alasan: ${reason}`);
                    } else {
                        // Revert if no reason provided
                        docIcon.className = 'doc-icon pending';
                        docStatus.className = 'doc-status pending';
                        docStatus.textContent = 'Menunggu Verifikasi';
                    }
                });
            });
            
            // Document selection
            document.querySelectorAll('.document-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    // Don't select if clicking on action buttons
                    if (e.target.closest('.action-btn')) return;
                    
                    // Remove selected class from all items
                    document.querySelectorAll('.document-item').forEach(i => {
                        i.classList.remove('selected');
                    });
                    
                    // Add selected class to clicked item
                    this.classList.add('selected');
                });
            });
            
            // Preview modal functionality
            const previewModal = document.getElementById('previewModal');
            const closePreviewModal = document.getElementById('closePreviewModal');
            
            closePreviewModal.addEventListener('click', function() {
                previewModal.classList.remove('show');
            });
            
            previewModal.addEventListener('click', function(e) {
                if (e.target === previewModal) {
                    previewModal.classList.remove('show');
                }
            });
            
            // Complete button functionality
            document.querySelector('.btn-complete').addEventListener('click', function() {
                // Check if all required documents are verified
                const pendingDocs = document.querySelectorAll('.doc-status.pending');
                const missingDocs = document.querySelectorAll('.doc-status.missing');
                
                if (pendingDocs.length > 0 || missingDocs.length > 0) {
                    if (confirm('Ada dokumen yang belum diverifikasi. Apakah Anda yakin ingin menyelesaikan proses verifikasi?')) {
                        alert('Proses verifikasi selesai. Beberapa dokumen masih memerlukan verifikasi.');
                        // Here you would typically save the verification status
                        window.location.href = 'verifikasi.html'; // Redirect to verification page
                    }
                } else {
                    alert('Semua dokumen telah diverifikasi. Proses verifikasi selesai.');
                    // Here you would typically save the verification status
                    window.location.href = 'verifikasi.html'; // Redirect to verification page
                }
            });
            
            // Back button functionality
            document.querySelector('.btn-back').addEventListener('click', function() {
                window.location.href = 'dashboard.html'; // Redirect to dashboard
            });
            
            // Keyboard support for modal
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && previewModal.classList.contains('show')) {
                    previewModal.classList.remove('show');
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
