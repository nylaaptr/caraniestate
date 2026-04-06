<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Rumah - PropertiHarmoni</title>
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
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-home"></i>
            </div>
            <div class="company-name">PT. Properti Harmoni</div>
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
            <div>
                <h1 class="page-title">Edit Data Rumah</h1>
                <div class="breadcrumb">
                    <a href="dashboard.html" class="breadcrumb-link">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="data-rumah.html" class="breadcrumb-link">Data Rumah</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Edit Data Rumah</span>
                </div>
            </div>
            
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin Utama</div>
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
            
            <form id="editPropertyForm">
                <!-- Property Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-home"></i> Informasi Dasar Properti
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="namaProperti" class="form-label">Nama Properti</label>
                            <input type="text" class="form-control" id="namaProperti" value="Kelapa Gading Regency" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="jenisProperti" class="form-label">Jenis Properti</label>
                            <select class="form-control" id="jenisProperti" required>
                                <option value="">Pilih Jenis Properti</option>
                                <option value="rumah" selected>Rumah</option>
                                <option value="ruko">Ruko</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="kategoriProperti" class="form-label">Kategori Properti</label>
                            <select class="form-control" id="kategoriProperti" required>
                                <option value="">Pilih Kategori</option>
                                <option value="subsidi" selected>Subsidi</option>
                                <option value="komersial">Komersial</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="tipeProperti" class="form-label">Tipe Properti</label>
                            <select class="form-control" id="tipeProperti" required>
                                <option value="">Pilih Tipe</option>
                                <option value="30/60">30/60</option>
                                <option value="36/72" selected>36/72</option>
                                <option value="45/84">45/84</option>
                                <option value="60/135">60/135</option>
                                <option value="ruko">Ruko</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label for="blokRumah" class="form-label">Blok Rumah</label>
                            <input type="text" class="form-control" id="blokRumah" placeholder="Contoh: Blok A, Cluster Bunga" value="Blok C">
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
                            <input type="number" class="form-control" id="hargaProperti" value="450000000" min="0" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="luasBangunan" class="form-label">Luas Bangunan (m²)</label>
                            <input type="number" class="form-control" id="luasBangunan" value="36" min="0" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="luasTanah" class="form-label">Luas Tanah (m²)</label>
                            <input type="number" class="form-control" id="luasTanah" value="72" min="0" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="stokUnit" class="form-label">Stok Unit</label>
                            <input type="number" class="form-control" id="stokUnit" value="8" min="0" required>
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
                        <select class="form-control" id="statusUnit" required>
                            <option value="">Pilih Status</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="dipesan" selected>Dipesan</option>
                            <option value="terjual">Terjual</option>
                        </select>
                    </div>
                </div>
                
                <!-- Image Upload Section -->
                <div class="image-upload-section">
                    <h3 class="section-title">
                        <i class="fas fa-image"></i> Gambar Properti
                    </h3>
                    <p class="form-subtitle">Upload gambar terbaru untuk properti ini (opsional)</p>
                    
                    <div class="upload-area" id="imageUpload">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <p class="upload-text">Klik atau drag file gambar ke sini</p>
                        <p class="upload-hint">Format: JPG, PNG | Max: 5MB | Maksimal 5 file</p>
                        <input type="file" class="file-input" id="propertyImage" accept=".jpg,.jpeg,.png" multiple>
                        <div class="file-name" id="imageName">kelapa-gading-36-72.jpg</div>
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
        document.addEventListener('DOMContentLoaded', function() {
            
            // Image upload handling
            const uploadArea = document.getElementById('imageUpload');
            const fileInput = document.getElementById('propertyImage');
            const fileName = document.getElementById('imageName');

            uploadArea.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    if (this.files.length > 1) {
                        fileName.textContent = `${this.files.length} file dipilih`;
                    } else {
                        fileName.textContent = this.files[0].name;
                    }

                    const rootStyles = getComputedStyle(document.documentElement);
                    const primaryColor = rootStyles.getPropertyValue('--primary-blue');

                    fileName.style.color = primaryColor;
                }
            });
            
            // Form submission
            document.getElementById('editPropertyForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form values
                const namaProperti = document.getElementById('namaProperti').value.trim();
                const jenisProperti = document.getElementById('jenisProperti').value;
                const kategoriProperti = document.getElementById('kategoriProperti').value;
                const tipeProperti = document.getElementById('tipeProperti').value;
                const blokRumah = document.getElementById('blokRumah').value.trim();
                const hargaProperti = document.getElementById('hargaProperti').value.trim();
                const luasBangunan = document.getElementById('luasBangunan').value.trim();
                const luasTanah = document.getElementById('luasTanah').value.trim();
                const stokUnit = document.getElementById('stokUnit').value.trim();
                const statusUnit = document.getElementById('statusUnit').value;
                
                // Simple validation
                if (!namaProperti) {
                    alert('Nama properti harus diisi');
                    document.getElementById('namaProperti').focus();
                    return;
                }
                
                if (!jenisProperti) {
                    alert('Jenis properti harus dipilih');
                    document.getElementById('jenisProperti').focus();
                    return;
                }
                
                if (!kategoriProperti) {
                    alert('Kategori properti harus dipilih');
                    document.getElementById('kategoriProperti').focus();
                    return;
                }
                
                if (!tipeProperti) {
                    alert('Tipe properti harus dipilih');
                    document.getElementById('tipeProperti').focus();
                    return;
                }
                
                if (!hargaProperti || isNaN(hargaProperti) || parseInt(hargaProperti) <= 0) {
                    alert('Harga properti harus diisi dan berupa angka positif');
                    document.getElementById('hargaProperti').focus();
                    return;
                }
                
                if (!luasBangunan || isNaN(luasBangunan) || parseInt(luasBangunan) <= 0) {
                    alert('Luas bangunan harus diisi dan berupa angka positif');
                    document.getElementById('luasBangunan').focus();
                    return;
                }
                
                if (!luasTanah || isNaN(luasTanah) || parseInt(luasTanah) <= 0) {
                    alert('Luas tanah harus diisi dan berupa angka positif');
                    document.getElementById('luasTanah').focus();
                    return;
                }
                
                if (!stokUnit || isNaN(stokUnit) || parseInt(stokUnit) < 0) {
                    alert('Stok unit harus diisi dan berupa angka non-negatif');
                    document.getElementById('stokUnit').focus();
                    return;
                }
                
                if (!statusUnit) {
                    alert('Status unit harus dipilih');
                    document.getElementById('statusUnit').focus();
                    return;
                }
                
                // Success message
                alert('Data properti berhasil diperbarui!\n\nBlok Rumah: ' + (blokRumah || 'Tidak diisi'));
                
                // In a real Laravel application, you would submit the form data to the server here
                // window.location.href = 'data-rumah.html';
            });
            
            // Cancel button
            document.getElementById('cancelBtn').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin membatalkan perubahan? Semua perubahan yang belum disimpan akan hilang.')) {
                    // Redirect to data rumah page
                    window.location.href = 'data-rumah.html';
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

