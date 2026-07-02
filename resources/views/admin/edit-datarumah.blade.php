<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Rumah - Carani Estate</title>
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
        
        /* Edit Form Styles */
        .edit-form-container {
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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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

        /* IMAGE PREVIEW */
        .old-image-item{
            position:relative;
        }

        .old-image-preview{
            width:120px;
            height:90px;
            object-fit:cover;
            border-radius:8px;
            border:1px solid #ddd;
        }

        .delete-old-image{
            position:absolute;
            top:-8px;
            right:-8px;

            width:24px;
            height:24px;

            border:none;
            border-radius:50%;

            background:transparent;
            color:white;

            cursor:pointer;
            font-weight:bold;
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
        }
        
        .btn-cancel:hover {
            background: #cbd5e0;
            transform: translateY(-2px);
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
            
            .edit-form-container {
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
                <h1 class="page-title">Edit Data Rumah</h1>
                <div class="breadcrumb">
                    <a href="dashboard.html" class="breadcrumb-link">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="{{ route('admin.data_rumah') }}" class="breadcrumb-link">Data Rumah</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Edit Data Rumah</span>
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
        
        <!-- Edit Form -->
        <div class="edit-form-container">
            <div class="form-header">
                <h2 class="form-title">Edit Data Properti</h2>
                <p class="form-subtitle">Perbarui informasi properti dengan data yang valid</p>
            </div>
            
            <form id="editPropertyForm" method="POST" action="{{ route('admin.update_rumah', $properti->id_properti) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Property Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-home"></i> Informasi Dasar Properti
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="namaProperti" class="form-label">Nama Properti</label>
                            <input type="text" class="form-control" id="namaProperti"  name="nama_properti"
                                value="{{ $properti->nama_properti }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Perumahan</label>
                            <input type="text" class="form-control" name="nama_perumahan"
                                value="{{ $properti->perumahan->nama_perumahan ?? '-' }}"
                                readonly>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="kategoriProperti" class="form-label">Kategori Properti</label>
                            <select class="form-control" name="kategori_properti" id="kategoriProperti" required>
                                <option value="">Pilih Kategori</option>
                                <option value="subsidi" {{ $properti->kategori_properti == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                <option value="komersial" {{ $properti->kategori_properti == 'komersial' ? 'selected' : '' }}>Komersial</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jenisProperti" class="form-label">Jenis Properti</label>
                            <select class="form-control" name="jenis_properti" id="jenisProperti" required>
                                <option value="">Pilih Jenis Properti</option>
                                <option value="rumah" {{ $properti->jenis_properti == 'rumah' ? 'selected' : '' }}>Rumah</option>
                                <option value="ruko" {{ $properti->jenis_properti == 'ruko' ? 'selected' : '' }}>Ruko</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="tipeProperti" class="form-label">Tipe Properti</label>
                            <select class="form-control" name="tipe_properti" id="tipeProperti" required>
                                <option value="">Pilih Tipe</option>
                                <option value="30/60" {{ $properti->tipe_properti == '30/60' ? 'selected' : '' }}>30/60</option>
                                <option value="36/72" {{ $properti->tipe_properti == '36/72' ? 'selected' : '' }}>36/72</option>
                                <option value="45/84" {{ $properti->tipe_properti == '45/84' ? 'selected' : '' }}>45/84</option>
                                <option value="60/135" {{ $properti->tipe_properti == '60/135' ? 'selected' : '' }}>60/135</option>
                                <option value="Ruko" {{ $properti->tipe_properti == 'Ruko' ? 'selected' : '' }}>Ruko</option>
                            </select>
                        </div>

                        <div class="form-group" style="grid-column: 2 / -1;">
                            <label for="blokRumah" class="form-label">Blok Rumah</label>
                            <input type="text" class="form-control" name="nama_blok" id="blokRumah"
                                value="{{ $properti->blok->nama_blok ?? '' }}">
                        </div>
                    </div>
                </div>
                
                <!-- Price & Size Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-tag"></i> Detail Harga & Ukuran
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="hargaProperti" class="form-label">Harga Properti (Rp)</label>
                            <input type="number" class="form-control" name="harga_properti" id="hargaProperti"
                                value="{{ $properti->harga_properti }}" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="luasBangunan" class="form-label">Luas Bangunan (m²)</label>
                            <input type="number" class="form-control" name="luas_bangunan" id="luasBangunan"
                                value="{{ $properti->luas_bangunan }}" min="0" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="luasTanah" class="form-label">Luas Tanah (m²)</label>
                            <input type="number" class="form-control" name="luas_tanah" id="luasTanah"
                                value="{{ $properti->luas_tanah }}" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="stokUnit" class="form-label">Stok Unit</label>
                            <input type="number" class="form-control" name="stok_unit" id="stokUnit"
                                value="{{ $properti->stok_unit }}" min="0" required>
                        </div>
                    </div>
                </div>
                
                <!-- Status Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-boxes"></i> Status Unit
                    </h3>
                    
                    <div class="form-group">
                        <label for="statusUnit" class="form-label">Status Unit</label>
                        <select class="form-control" name="status_unit" id="statusUnit" required>
                            <option value="">Pilih Status</option>
                            <option value="tersedia" {{ $properti->status_unit == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="dipesan" {{ $properti->status_unit == 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                            <option value="terjual" {{ $properti->status_unit == 'terjual' ? 'selected' : '' }}>Terjual</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group" style="grid-column:1/-1;">
                    <label class="form-label">Gambar Saat Ini</label>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;">

                        @foreach($properti->gambar as $img)
                            <div class="old-image-item"
                                style="position:relative;">

                                <img src="{{ asset('storage/images/'.$img->path_gambar) }}"
                                    onclick="lihatGambar(this.src)"
                                    class="old-image-preview"
                                    style="
                                        width:120px;
                                        height:90px;
                                        object-fit:cover;
                                        border-radius:6px;
                                        border:1px solid #ddd;
                                        cursor:pointer;
                                    ">

                                <button type="button"
                                        onclick="hapusGambar(this)"
                                        style="
                                            position:absolute;
                                            top:-8px;
                                            right:-8px;
                                            width:24px;
                                            height:24px;
                                            border:none;
                                            border-radius:50%;
                                            background:transparent;
                                            color:black;
                                            cursor:pointer;
                                        ">
                                    ×
                                </button>

                                <input type="hidden"
                                    class="gambar-lama"
                                    name="gambar_lama[]"
                                    value="{{ $img->id_gambar }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="image-upload-section">
                    <h3 class="section-title">
                        <i class="fas fa-image"></i>
                        Tambah Gambar Baru
                    </h3>

                    <button type="button"
                        onclick="hapusGambar(this)"
                            style="
                                position:absolute;
                                top:-8px;
                                right:-8px;
                                width:24px;
                                height:24px;
                                border:none;
                                border-radius:50%;
                                background:transparent;
                                color:black;
                                cursor:pointer;
                            ">
                        ×
                    </button>
                    <input
                        type="file"
                        name="gambar[]"
                        id="propertyImage"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple>

                    <div id="previewContainer"
                        style="display:flex;gap:10px;flex-wrap:wrap;margin-top:15px;">
                    </div>
                </div>

                
                <!-- Action Buttons -->
                <div class="form-actions">
                    <button type="button" class="btn-action btn-cancel" id="cancelBtn">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn-action btn-save">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function hapusGambar(button)
        {
            if(confirm('Hapus gambar ini?'))
            {
                const item = button.closest('.old-image-item');

                // hidden input gambar lama
                const input = item.querySelector('.gambar-lama');

                // tandai untuk dihapus
                input.name = 'gambar_hapus[]';

                // sembunyikan dari tampilan
                item.style.display = 'none';
            }
        }
        </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // =========================
            // PREVIEW GAMBAR BARU
            // =========================
            const fileInput = document.getElementById('propertyImage');
            const previewContainer = document.getElementById('previewContainer');

            let selectedFiles = [];

            fileInput.addEventListener('change', function () {

                // simpan file baru
                selectedFiles = [...selectedFiles, ...Array.from(this.files)];

                renderPreview();

            });

            function renderPreview()
            {
                previewContainer.innerHTML = '';

                selectedFiles.forEach((file, index) => {

                    const reader = new FileReader();

                    reader.onload = function(e)
                    {
                        const wrapper = document.createElement('div');

                        wrapper.style.position = 'relative';
                        wrapper.style.display = 'inline-block';

                        // gambar preview
                        const img = document.createElement('img');

                        img.src = e.target.result;

                        img.style.width = '120px';
                        img.style.height = '90px';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '6px';
                        img.style.border = '1px solid #ddd';
                        img.style.cursor = 'pointer';

                        img.onclick = function () {
                            lihatGambar(this.src);
                        };

                        wrapper.appendChild(img);

                        // tombol silang
                        const btn = document.createElement('button');

                        btn.type = 'button';
                        btn.innerHTML = '&times;';

                        btn.style.position = 'absolute';
                        btn.style.top = '-8px';
                        btn.style.right = '-8px';
                        btn.style.width = '24px';
                        btn.style.height = '24px';
                        btn.style.border = 'none';
                        btn.style.borderRadius = '50%';
                        btn.style.background = 'white';
                        btn.style.cursor = 'pointer';
                        btn.style.fontSize = '16px';
                        btn.style.boxShadow = '0 0 3px rgba(0,0,0,.3)';

                        btn.onclick = function () {

                            // hapus file dari array
                            selectedFiles.splice(index, 1);

                            // rebuild file input
                            const dt = new DataTransfer();

                            selectedFiles.forEach(file => {
                                dt.items.add(file);
                            });

                            fileInput.files = dt.files;

                            renderPreview();
                        };

                        wrapper.appendChild(btn);

                        previewContainer.appendChild(wrapper);
                    };

                    reader.readAsDataURL(file);
                });

                // sinkronkan file input
                const dt = new DataTransfer();

                selectedFiles.forEach(file => {
                    dt.items.add(file);
                });

                fileInput.files = dt.files;
            }

            // =========================
            // VALIDASI FORM
            // =========================
            const form = document.getElementById('editPropertyForm');

            if (form) {

                form.addEventListener('submit', function (e) {

                    const namaProperti =
                        document.getElementById('namaProperti').value.trim();

                    const hargaProperti =
                        document.getElementById('hargaProperti').value.trim();

                    const luasBangunan =
                        document.getElementById('luasBangunan').value.trim();

                    const luasTanah =
                        document.getElementById('luasTanah').value.trim();

                    const stokUnit =
                        document.getElementById('stokUnit').value.trim();

                    if (!namaProperti) {
                        e.preventDefault();
                        alert('Nama properti harus diisi');
                        return;
                    }

                    if (!hargaProperti || parseInt(hargaProperti) <= 0) {
                        e.preventDefault();
                        alert('Harga properti tidak valid');
                        return;
                    }

                    if (!luasBangunan || parseInt(luasBangunan) <= 0) {
                        e.preventDefault();
                        alert('Luas bangunan tidak valid');
                        return;
                    }

                    if (!luasTanah || parseInt(luasTanah) <= 0) {
                        e.preventDefault();
                        alert('Luas tanah tidak valid');
                        return;
                    }

                    if (!stokUnit || parseInt(stokUnit) < 0) {
                        e.preventDefault();
                        alert('Stok unit tidak valid');
                        return;
                    }

                });

            }

            // =========================
            // CANCEL BUTTON
            // =========================
            const cancelBtn = document.getElementById('cancelBtn');

            if (cancelBtn) {

                cancelBtn.addEventListener('click', function () {

                    if (confirm('Batalkan perubahan?')) {
                        window.location.href = "{{ route('admin.data_rumah') }}";
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

<!-- JS MODAL -->
 <script>
function lihatGambar(src)
{
    const modal = document.getElementById('imageModal');
    const image = document.getElementById('modalImage');

    image.src = src;
    modal.style.display = 'flex';
}

function tutupGambar()
{
    document.getElementById('imageModal').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function(){

    const modal = document.getElementById('imageModal');

    if(modal)
    {
        modal.addEventListener('click', function(e){

            if(e.target === modal)
            {
                tutupGambar();
            }

        });
    }

});
</script>


<!-- GAMBAR LAMA MODAL -->
    <div id="imageModal"
        style="
            display:none;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,.8);
            z-index:9999;
            justify-content:center;
            align-items:center;
        ">

        <span onclick="tutupGambar()"
            style="
                position:absolute;
                top:20px;
                right:30px;
                color:white;
                font-size:40px;
                cursor:pointer;
            ">
            &times;
        </span>

        <img id="modalImage"
            style="
                max-width:90%;
                max-height:90%;
                border-radius:10px;
            ">
    </div>
</body>
</html>

