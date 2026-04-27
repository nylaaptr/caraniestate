<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Lunas - Carani Estate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@fontsource/roboto@5.0.12/index.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #7AB2D3;
            --primary-blue-rgb: 122, 178, 211;
            --dark-blue: #1E3A5F;
            --light-blue: #e6f2f8;
            --sidebar-width: 260px;
            --success-green: #22c55e;
            --success-bg: #f0fdf4;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "Roboto", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
            color: #1e293b;
            line-height: 1.6;
        }
        
        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--dark-blue) 0%, #1E3A5F 100%);
            color: white;
            padding: 15px 30px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1280px;
            margin: 0 auto;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .logo-icon i {
            font-size: 20px;
            color: var(--dark-blue);
        }
        
        .logo-text {
            font-weight: 700;
            font-size: 1.15rem;
            letter-spacing: 0.5px;
        }
        
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 28px;
        }
        
        .nav-item {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
            padding: 4px 0;
        }
        
        .nav-item:hover {
            color: var(--primary-blue);
        }
        
        .nav-item.active {
            color: var(--primary-blue);
            font-weight: 600;
        }
        
        .nav-item.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary-blue);
            border-radius: 1px;
        }
        
        .nav-item:not(.active)::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-blue);
            transition: width 0.3s ease;
        }
        
        .nav-item:hover::after {
            width: 100%;
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .notification-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }
        
        .notification-icon:hover {
            background: rgba(255,255,255,0.2);
        }
        
        .notification-icon span {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
        
        .profile-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255,255,255,0.2);
        }
        
        .profile-icon:hover {
            border-color: var(--primary-blue);
        }
        
        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .menu-toggle {
            display: none;
            font-size: 22px;
            cursor: pointer;
            padding: 8px 10px;
            border-radius: 6px;
            transition: 0.3s;
        }
        
        .menu-toggle:hover {
            background: rgba(255,255,255,0.15);
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 12px 20px;
            }

            .header-container {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                width: 100%;
            }

            .menu-toggle {
                display: block;
                color: white;
                order: 2;
            }

            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: var(--dark-blue);
                flex-direction: column;
                padding: 10px 0;
                gap: 0;
                box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            }

            .nav-menu.show {
                display: flex;
            }

            .nav-item {
                padding: 12px 20px;
                width: 100%;
            }

            .nav-item::after {
                display: none;
            }
            
            .logo-text {
                font-size: 1rem;
            }
            
            .user-actions {
                margin-left: auto;
                display: flex;
                align-items: center;
                gap: 10px;
            }
        }

        /* Main Content */
        main {
            padding-top: 80px;
            min-height: 100vh;
            background: linear-gradient(to bottom, var(--light-blue) 0%, #f8fafc 100%);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2rem;
            color: var(--dark-blue);
            margin-bottom: 8px;
        }

        .page-header p {
            color: #64748b;
            font-size: 0.95rem;
        }

        /* Success Banner */
        .success-banner {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
            border-left: 4px solid var(--success-green);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        .success-banner-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .success-icon-large {
            width: 50px;
            height: 50px;
            background: var(--success-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            animation: pulse-success 2s infinite;
        }

        @keyframes pulse-success {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .success-text h2 {
            color: #166534;
            font-size: 1.1rem;
            margin-bottom: 4px;
        }

        .success-text p {
            color: #15803d;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header i {
            font-size: 1.2rem;
        }

        .card-header h3 {
            font-size: 1rem;
            font-weight: 600;
        }

        .card-body {
            padding: 24px;
        }

        /* Grid Layout */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 992px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        /* Detail Items */
        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #64748b;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-label i {
            color: var(--primary-blue);
            width: 16px;
        }

        .detail-value {
            color: #1e293b;
            font-weight: 500;
            font-size: 0.9rem;
            text-align: right;
        }

        .detail-value.amount {
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .status-badge {
            display: inline-block;
            background: #f0fdf4;
            color: #166534;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-badge.pending {
            background: #fefce8;
            color: #a16207;
        }

        /* Upload Area */
        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            background: #f8fafc;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .upload-area:hover, .upload-area.dragover {
            border-color: var(--primary-blue);
            background: var(--light-blue);
        }

        .upload-area input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            width: 60px;
            height: 60px;
            background: var(--light-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary-blue);
            font-size: 24px;
        }

        .upload-text h4 {
            color: var(--dark-blue);
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .upload-text p {
            color: #64748b;
            font-size: 0.85rem;
        }

        .upload-text small {
            color: #94a3b8;
            display: block;
            margin-top: 5px;
        }

        .preview-image {
            max-width: 100%;
            max-height: 200px;
            margin-top: 15px;
            border-radius: 8px;
            display: none;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(122, 178, 211, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(122, 178, 211, 0.5);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            background: #cbd5e1;
            box-shadow: none;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        /* Steps */
        .steps {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            gap: 0;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            padding: 0 20px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #64748b;
            transition: all 0.3s ease;
            margin-bottom: 8px;
        }

        .step.active .step-circle {
            background: var(--success-green);
            border-color: var(--success-green);
            color: white;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.2);
        }

        .step.completed .step-circle {
            background: var(--success-green);
            border-color: var(--success-green);
            color: white;
        }

        .step.completed .step-circle i {
            font-size: 18px;
        }

        .step-label {
            font-size: 0.8rem;
            color: #64748b;
            text-align: center;
            max-width: 100px;
        }

        .step.active .step-label {
            color: var(--success-green);
            font-weight: 600;
        }

        .step-line {
            width: 50px;
            height: 2px;
            background: #cbd5e1;
        }

        .step.completed .step-line {
            background: var(--success-green);
        }

        /* Footer */
        .footer {
            background: var(--dark-blue);
            color: white;
            padding: 30px 20px;
            text-align: center;
            margin-top: 40px;
        }

        .footer p {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loading-overlay.show {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Alert */
        .alert {
            background: #fef3c7;
            border: 1px solid #fbbf24;
            color: #92400e;
            padding: 12px 16px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 16px;
            font-size: 0.9rem;
        }

        .alert i {
            color: #f59e0b;
        }

        .alert.success {
            background: #f0fdf4;
            border-color: #86efac;
            color: #166534;
        }

        .alert.success i {
            color: #22c55e;
        }

        /* House Image */
        .house-preview {
            width: 100%;
            height: 160px;
            background: linear-gradient(135deg, var(--light-blue) 0%, #e2e8f0 100%);
            border-radius: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .house-preview i {
            font-size: 3rem;
            color: var(--primary-blue);
        }

        .house-preview .badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--success-green);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="logo-text">Carani Estate</div>
            </div>

            <div class="menu-toggle" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>
            
            <nav class="nav-menu" id="navMenu">
                <a href="#" class="nav-item">Beranda</a>
                <a href="#" class="nav-item">Tentang Kami</a>
                <a href="#" class="nav-item">Katalog</a>
                <a href="#" class="nav-item">ChatBot</a>
                <a href="#" class="nav-item">Riwayat Pemesanan</a>
                <a href="#" class="nav-item">Kontak</a>
            </nav>
            
            <div class="user-actions">
                <a href="#" class="notification-icon" style="position:relative;">
                    <i class="fas fa-bell"></i>
                    <span>3</span>
                </a>
                <a href="#" class="profile-icon">
                    <img src="https://via.placeholder.com/36/7AB2D3/FFFFFF?text=NP" alt="Profile" class="profile-img">
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <!-- Steps -->
            <div class="steps">
                <div class="step completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div>
                    <span class="step-label">Pemesanan</span>
                </div>
                <div class="step-line completed"></div>
                <div class="step completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div>
                    <span class="step-label">Verifikasi</span>
                </div>
                <div class="step-line completed"></div>
                <div class="step active">
                    <div class="step-circle">3</div>
                    <span class="step-label">Pembayaran</span>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-circle">4</div>
                    <span class="step-label">Serah Terima</span>
                </div>
            </div>

            <!-- Success Banner -->
            <div class="success-banner">
                <div class="success-banner-content">
                    <div class="success-icon-large">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="success-text">
                        <h2>Dokumen Anda Terverifikasi!</h2>
                        <p>Selamat, dokumen pemesanan Anda telah diverifikasi oleh admin. Silakan lakukan pembayaran untuk melanjutkan proses transaksi dan mendapatkan notifikasi serah terima.</p>
                    </div>
                </div>
            </div>

            <div class="grid-2">
                <!-- Detail Pemesanan -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-file-invoice"></i>
                        <h3>Detail Pemesanan</h3>
                    </div>
                    <div class="card-body">
                        <div class="house-preview">
                            <i class="fas fa-home"></i>
                            <span class="badge"><i class="fas fa-check-circle" style="margin-right:5px;"></i>Terverifikasi</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-home"></i> Tipe Rumah</span>
                            <span class="detail-value">Tipe 36 - Griya Harmoni</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-ruler-combined"></i> Luas Tanah / Bangunan</span>
                            <span class="detail-value">72m² / 36m²</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-map-marker-alt"></i> Lokasi</span>
                            <span class="detail-value">Bondowoso, Jawa Timur</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-calendar-alt"></i> Tanggal Pesan</span>
                            <span class="detail-value">15 Januari 2025</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-id-badge"></i> No. Pemesanan</span>
                            <span class="detail-value">#PMS-2025-00142</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-tag"></i> Status Dokumen</span>
                            <span class="status-badge">Terverifikasi</span>
                        </div>
                    </div>
                </div>

                <!-- Detail Pembayaran -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-credit-card"></i>
                        <h3>Rincian Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-money-bill-wave"></i> Harga Rumah</span>
                            <span class="detail-value amount">Rp 150.000.000</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-hand-holding-usd"></i> Metode Bayar</span>
                            <span class="detail-value">Kredit / Cicilan</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-percent"></i> Uang Muka (DP 20%)</span>
                            <span class="detail-value">Rp 30.000.000</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-percentage"></i> Sisa / Total Pinjaman</span>
                            <span class="detail-value">Rp 120.000.000</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-calendar-check"></i> Tenor</span>
                            <span class="detail-value">10 Tahun (120 Bulan)</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-redo"></i> Bunga per Tahun</span>
                            <span class="detail-value">8.5% Fixed</span>
                        </div>
                        <div class="detail-item" style="border-top: 2px solid var(--light-blue); margin-top: 10px; padding-top: 16px;">
                            <span class="detail-label" style="font-weight: 700; color: var(--dark-blue);">
                                <i class="fas fa-coins"></i> Cicilan/Bulan
                            </span>
                            <span class="detail-value amount" style="font-size: 1.2rem; color: var(--primary-blue);">
                                Rp 1.493.000
                            </span>
                        </div>
                        <div class="alert" style="margin-top: 20px;">
                            <i class="fas fa-info-circle"></i>
                            <span>Silakan transfer DP ke rekening <strong>BCA 123-456-7890</strong> a.n <strong>PT. Carani Bhanu Balakosa</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Bukti Pembayaran -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h3>Upload Bukti Pembayaran</h3>
                </div>
                <div class="card-body">
                    <div class="upload-area" id="uploadArea">
                        <input type="file" id="fileInput" accept="image/*,.pdf" onchange="previewFile(this)">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="upload-text">
                            <h4>Seret & Lepas File di Sini</h4>
                            <p>atau <strong style="color: var(--primary-blue); cursor: pointer;">Pilih File</strong></p>
                            <small>Format: JPG, PNG, PDF (Maks. 5MB)</small>
                        </div>
                        <img id="previewImage" class="preview-image" alt="Preview">
                        <div id="fileInfo" style="margin-top: 10px; font-size: 0.85rem; color: #64748b; display: none;">
                            <i class="fas fa-file-check" style="color: var(--success-green);"></i> 
                            <span id="fileName">file.jpg</span> (<span id="fileSize">240 KB</span>)
                        </div>
                    </div>

                    <div class="alert success" id="successAlert" style="display: none; margin-top: 16px;">
                        <i class="fas fa-check-circle"></i>
                        <span>Bukti pembayaran berhasil diupload. Silakan klik tombol "Kirim Bukti Pembayaran" untuk melanjutkan.</span>
                    </div>

                    <div class="actions">
                        <button class="btn btn-primary" id="submitBtn" disabled onclick="submitPayment()">
                            <i class="fas fa-paper-plane"></i> Kirim Bukti Pembayaran
                        </button>
                        <button class="btn btn-secondary" onclick="window.history.back()">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Carani Estate</h3>
                    <p>Platform terpercaya untuk membeli, menjual, dan menyewa properti sejak 2015.</p>
                    <div class="footer-social">
                        <div class="social-icon"><i class="fab fa-facebook-f"></i></div>
                        <div class="social-icon"><i class="fab fa-twitter"></i></div>
                        <div class="social-icon"><i class="fab fa-instagram"></i></div>
                        <div class="social-icon"><i class="fab fa-linkedin-in"></i></div>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Tautan Cepat</h3>
                    <ul class="footer-links">
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Katalog Properti</a></li>
                        <li><a href="#">ChatBot</a></li>
                        <li><a href="#">Riwayat Pemesanan</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Layanan</h3>
                    <ul class="footer-links">
                        <li><a href="#">Pembelian Properti</a></li>
                        <li><a href="#">Penjualan Properti</a></li>
                        <li><a href="#">Sewa Properti</a></li>
                        <li><a href="#">Konsultasi Properti</a></li>
                        <li><a href="#">Finansial & KPR</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Kontak Kami</h3>
                    <div class="footer-contact">
                        <p><i class="fas fa-map-marker-alt"></i> Jl. Raya Pakisan, Bunduh, Bataan, Kec. Tenggarang, Kabupaten Bondowoso, Jawa Timur 68271</p>
                        <p><i class="fas fa-phone"></i> 0812-3456-7890</p>
                        <p><i class="fas fa-envelope"></i> caranibhanubalakosa@gmail.com</p>
                        <p><i class="fas fa-clock"></i> Senin - Sabtu: 08:00 - 17:00</p>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                &copy; 2025 CaraniEstate. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <script>
        // Toggle mobile menu
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('show');
        }

        // File upload preview
        function previewFile(input) {
            const file = input.files[0];
            const uploadArea = document.getElementById('uploadArea');
            const previewImg = document.getElementById('previewImage');
            const fileInfo = document.getElementById('fileInfo');
            const submitBtn = document.getElementById('submitBtn');

            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    input.value = '';
                    return;
                }

                // Display file info
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileSize').textContent = (file.size / 1024).toFixed(0) + ' KB';
                fileInfo.style.display = 'block';

                // Image preview
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewImg.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImg.style.display = 'none';
                }

                uploadArea.style.borderColor = '#7AB2D3';
                uploadArea.style.background = '#e6f2f8';
                submitBtn.disabled = false;
                document.getElementById('successAlert').style.display = 'flex';
            }
        }

        // Drag & Drop
        const uploadArea = document.getElementById('uploadArea');

        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function() {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('fileInput').files = files;
                previewFile(document.getElementById('fileInput'));
            }
        });

        // Submit payment
        function submitPayment() {
            const btn = document.getElementById('submitBtn');
            const overlay = document.getElementById('loadingOverlay');
            
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
            overlay.classList.add('show');

            setTimeout(() => {
                overlay.classList.remove('show');
                alert('✅ Bukti pembayaran berhasil dikirim!\n\nAdmin akan segera memverifikasi pembayaran Anda. Anda akan menerima notifikasi setelah verifikasi selesai.');
                
                btn.innerHTML = '<i class="fas fa-check"></i> Terkirim';
                btn.style.background = '#22c55e';
                
                // Reset after delay
                setTimeout(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Bukti Pembayaran';
                    btn.style.background = '';
                }, 3000);
            }, 2000);
        }
    </script>
</body>
</html>

