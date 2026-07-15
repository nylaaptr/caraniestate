<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Rumah - Carani Estate</title>
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
        
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #64748b;
        }
        
        .breadcrumb i {
            font-size: 12px;
        }
        
        .breadcrumb-link {
            color: var(--primary-blue);
            text-decoration: none;
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
        
        /* Add Property Form Styles */
        .add-property-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 10px;
        }
        
        .form-subtitle {
            color: #64748b;
            font-size: 1rem;
        }
        
        .form-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: var(--primary-blue);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1a365d;
            font-size: 0.95rem;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(var(--primary-blue-rgb), 0.2);
            outline: none;
        }
        
        .form-control::placeholder {
            color: #a0aec0;
        }
        
        /* Select styling */
        select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.48 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
            padding-right: 40px;
        }
        
        /* Image upload section */
        .image-upload-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #e2e8f0;
        }
        
        .upload-area {
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
        }
        
        .upload-area:hover {
            border-color: var(--primary-blue);
            background: #f0f9ff;
        }
        
        .upload-icon {
            font-size: 3rem;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }
        
        .upload-text {
            font-size: 1rem;
            color: #4a5568;
            margin-bottom: 10px;
        }
        
        .upload-hint {
            font-size: 0.85rem;
            color: #94a3b8;
        }
        
        .file-input {
            display: none;
        }
        
        .file-name {
            margin-top: 10px;
            font-size: 0.9rem;
            color: var(--primary-blue);
            font-weight: 500;
        }

        /* PREVIEW GAMBAR */
        .preview-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 15px;
        }

        .preview-item {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .preview-item button {
            position: absolute;
            top: 5px;
            right: 5px;

            width: 24px;
            height: 24px;

            border-radius: 50%;
            border: none;

            background: transparent;
            color: white;

            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-img {
            width: 100%;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            transition: 0.2s;
        }

        .preview-img:hover {
            transform: scale(1.05);
            border-color: #4a90b7;
        }


        .btn-delete-preview{
            position:absolute;
            top:8px;
            right:8px;
            width:30px;
            height:30px;
            border:none;
            border-radius:50%;
            background:#dc3545;
            color:#fff;
            cursor:pointer;
        }

        .btn-delete-preview:hover{
            background:#bb2d3b;
        }

        .img-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            justify-content: center;
            align-items: center;
        }

        .img-modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }
        
        /* Action buttons */
        .form-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #f1f5f9;
        }
        
        .btn-action {
            padding: 12px 35px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-save {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #4a90b7 100%);
            color: white;
        }
        
        .btn-save:hover {
            background: linear-gradient(135deg, #6aa5c6 0%, #3d85aa 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(var(--primary-blue-rgb), 0.3);
        }
        
        .btn-cancel {
            background: #e2e8f0;
            color: #4a5568;
            text-decoration: none;
        }
        
        .btn-cancel:hover {
            background: #cbd5e0;
            transform: translateY(-2px);
        }
        
        /* Required indicator */
        .required {
            color: #ef4444;
            margin-left: 4px;
        }
        
        /* Responsive Design */
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
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .add-property-container {
                padding: 20px;
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
            
            .form-title {
                font-size: 1.5rem;
            }
            
            .btn-action {
                padding: 10px 25px;
                font-size: 0.95rem;
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
                font-size: 1.2rem;
            }
            
            .form-title {
                font-size: 1.4rem;
            }
            
            .section-title {
                font-size: 1.1rem;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
            
            .form-row {
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
        <!-- Header -->
        <div class="header">
            <div>
                <h1 class="page-title">Tambah Data Rumah</h1>
                <div class="breadcrumb">
                    <a href="dashboard.html" class="breadcrumb-link">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="{{ route('admin.data_rumah') }}" class="breadcrumb-link">Data Rumah</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Tambah Data Rumah</span>
                </div>
            </div>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
            
            <!-- Add Property Form -->
            <div class="add-property-container">
                <div class="form-header">
                    <h2 class="form-title">Form Tambah Properti</h2>
                    <p class="form-subtitle">
                        Isi data properti baru dengan lengkap dan valid
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.simpan-rumah') }}" enctype="multipart/form-data">

                    @csrf

                    <!-- Property Information -->
                    <div class="form-section">

                        <h3 class="section-title">
                            <i class="fas fa-home"></i>
                            Informasi Dasar Properti
                        </h3>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Perumahan</label>
                                <select name="id_perumahan" id="perumahanSelect" class="form-control" required>
                                    <option value="">Pilih Perumahan</option>
                                    @foreach($perumahan as $p)
                                        <option value="{{ $p->id_perumahan }}">
                                            {{ $p->nama_perumahan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    Nama Properti
                                </label>

                                <input type="text"
                                    name="nama_properti"
                                    class="form-control"
                                    placeholder="Contoh: Ruko Kelapa Gading"
                                    required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Jenis Properti
                                </label>

                                <select name="jenis_properti"
                                        class="form-control"
                                        placeholder="Contoh: Ruko"
                                        required>

                                    <option value="">Pilih</option>
                                    <option value="rumah">Rumah</option>
                                    <option value="ruko">Ruko</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Kategori Properti
                                </label>

                                <select name="kategori_properti"
                                        class="form-control"
                                        placeholder="Contoh: Komersial"
                                        required>

                                    <option value="">Pilih</option>
                                    <option value="subsidi">Subsidi</option>
                                    <option value="komersial">Komersial</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">
                                    Tipe Properti
                                </label>
                                <select name="tipe_properti"
                                        class="form-control"
                                        required>
                                    <option value="">Pilih</option>
                                    <option value="30/60">30/60</option>
                                    <option value="36/72">36/72</option>
                                    <option value="45/84">45/84</option>
                                    <option value="60/135">60/135</option>
                                    <option value="ruko">Ruko</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Blok</label>
                                <select name="id_blok" id="blokSelect" class="form-control" required>
                                    <option value="">Pilih Blok</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <label>Stok Unit</label>
                                <input type="number" name="stok_unit" class="form-control" placeholder="Contoh: 1,2,3" required>
                            </div>
                    </div>

                    <!-- Harga -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-tag"></i>
                            Detail Harga & Ukuran
                        </h3>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Harga Properti</label>
                                <input type="number"
                                    name="harga_properti"
                                    class="form-control"
                                    placeholder="Contoh: 700000000"
                                    required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Booking Fee</label>
                                <input type="number" class="form-control"placeholder="Contoh: 100000000" name="bookingFee">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Luas Bangunan</label>
                                <input type="number"
                                    name="luas_bangunan"
                                    class="form-control"
                                    placeholder="Contoh: 36"
                                    required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Luas Tanah</label>
                                <input type="number"
                                    name="luas_tanah"
                                    class="form-control"
                                    placeholder="Contoh: 72"
                                    required>
                            </div>
                        </div>
                    </div>


                    <!-- Status -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-boxes"></i>
                            Status Unit
                        </h3>
                        <div class="form-group">
                            <select name="status_unit"
                                    class="form-control"
                                    required>
                                <option value="">Pilih</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="dipesan">Dipesan</option>
                                <option value="terjual">Terjual</option>
                            </select>
                        </div>
                    </div>


                    <!-- Upload -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-image"></i>
                            Gambar Properti
                        </h3>
                        <div id="previewContainer" class="preview-grid"></div>
                        <input type="file"
                        id="gambar"
                        name="gambar[]"
                        class="form-control"
                        accept="image/*"
                        multiple>
                    </div>

                    <!-- <button type="button" onclick="cekFile()">
                        Cek File
                    </button> -->

                    <!-- Tombol -->
                    <div class="form-actions">
                        <a href="{{ route('admin.data_rumah') }}"
                        class="btn-action btn-cancel">
                            Batal
                        </a>

                        <button type="submit"
                                class="btn-action btn-save">
                            Tambah Properti
                        </button>
                    </div>
                </form>
            </div>
    </div>

    <script>
function cekFile() {
    console.log(
        document.getElementById('gambar').files
    );
}
</script>

    <!-- JS GAMBAR -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let fileBuffer = [];
            const fileInput = document.querySelector('input[name="gambar[]"]');
            const container = document.getElementById('previewContainer');

            if (!fileInput || !container) return;
            fileInput.addEventListener('change', function (event) {
                const files = Array.from(event.target.files);
                fileBuffer = fileBuffer.concat(files);
                renderPreview();
                // fileInput.value = '';
            });

            function renderPreview() {
                container.innerHTML = '';

                // Update isi input file
                const dataTransfer = new DataTransfer();

                fileBuffer.forEach(file => {
                    dataTransfer.items.add(file);
                });

                fileInput.files = dataTransfer.files;
                fileBuffer.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e){

                        const wrapper = document.createElement('div');
                        wrapper.classList.add('preview-item');

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('preview-img');
                        img.onclick = () => openModal(e.target.result);

                        const delBtn = document.createElement('button');
                        delBtn.type = 'button';
                        delBtn.classList.add('btn-delete-preview');
                        delBtn.innerHTML = '<i class="fas fa-trash"></i>';

                        delBtn.onclick = () => {
                            fileBuffer.splice(index,1);
                            renderPreview();
                        };

                        wrapper.appendChild(img);
                        wrapper.appendChild(delBtn);

                        container.appendChild(wrapper);

                    };

                    reader.readAsDataURL(file);
                });
            }

            window.openModal = function (src) {
                const modal = document.getElementById('imgModal');
                const img = document.getElementById('imgModalSrc');

                if (!modal || !img) return;

                modal.style.display = 'flex';
                img.src = src;
            };

            window.closeModal = function () {
                const modal = document.getElementById('imgModal');
                if (modal) modal.style.display = 'none';
            };

        });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const perumahan = document.getElementById('perumahanSelect');
                const blok = document.getElementById('blokSelect');

                if (!perumahan || !blok) return;

                perumahan.addEventListener('change', function () {

                    let id = this.value;

                    if (!id) {
                        blok.innerHTML = '<option value="">Pilih Blok</option>';
                        return;
                    }

                    fetch('/admin/get-blok/' + id)
                        .then(res => res.json())
                        .then(data => {

                            blok.innerHTML = '<option value="">Pilih Blok</option>';

                            data.forEach(b => {
                                blok.innerHTML += `
                                    <option value="${b.id_blok}">
                                        ${b.nama_blok}
                                    </option>
                                `;
                            });

                        })
                        .catch(err => {
                            console.log('error blok:', err);
                        });

                });

            });
            </script>

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
            
            // Cancel button
            document.getElementById('cancelBtn').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin membatalkan penambahan properti? Semua data yang telah diisi akan hilang.')) {
                    // Redirect to data rumah page
                    window.location.href = 'data-rumah.html';
                }
            });
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

<div id="imgModal" class="img-modal" onclick="closeModal()">
    <img id="imgModalSrc">
</div>
</body>
</html>

