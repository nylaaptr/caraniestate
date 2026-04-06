<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data User - PropertiHarmoni</title>
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
        
        /* Add User Form Styles */
        .add-user-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 30px;
            max-width: 700px;
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
        
        /* Password container */
        .password-container {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            font-size: 16px;
        }
        
        .toggle-password:hover {
            color: var(--primary-blue);
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
            
            .add-user-container {
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
            <div>
                <h1 class="page-title">Tambah Data User</h1>
                <div class="breadcrumb">
                    <a href="dashboard.html" class="breadcrumb-link">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="data-user.html" class="breadcrumb-link">Data User</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Tambah Data User</span>
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
        
        <!-- Add User Form -->
        <div class="add-user-container">
            <div class="form-header">
                <h2 class="form-title">Form Tambah User</h2>
                <p class="form-subtitle">Isi data user baru dengan lengkap dan valid</p>
            </div>
            
            <form method="POST" action="{{ route('admin.tambah-datauser.simpan') }}">
                @csrf
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-user-plus"></i> Data User
                    </h3>

                    @if($errors->any())
                        <div style="background:#fecaca; color:#dc2626; padding:12px; border-radius:8px; margin-bottom:15px;">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" class="form-control" 
                                name="nama_user"
                                value="{{ old('nama_user') }}"
                                placeholder="Masukkan nama lengkap" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email <span class="required">*</span></label>
                            <input type="email" class="form-control" 
                                name="email_user"
                                value="{{ old('email_user') }}"
                                placeholder="Masukkan email" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nomor HP <span class="required">*</span></label>
                            <input type="tel" class="form-control" 
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                placeholder="Contoh: 081234567890" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Password <span class="required">*</span></label>
                            <div class="password-container">
                                <input type="password" class="form-control" 
                                    id="password" name="password_user"
                                    placeholder="Buat password yang kuat" required>
                                <button type="button" class="toggle-password" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Role <span class="required">*</span></label>
                        <select class="form-control" name="role_user" required>
                            <option value="">Pilih Role User</option>
                            <option value="admin" {{ old('role_user') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="customer" {{ old('role_user') == 'customer' ? 'selected' : '' }}>Pengguna</option>
                        </select>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <a href="{{ route('data_user') }}" class="btn-action btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-action btn-save">
                        <i class="fas fa-save"></i> Tambah User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar on small screens
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            
            // Add hover effect for desktop
            if (window.innerWidth > 992) {
                sidebar.addEventListener('mouseenter', function() {
                    this.style.width = '300px';
                    mainContent.style.marginLeft = '300px';
                });
                
                sidebar.addEventListener('mouseleave', function() {
                    this.style.width = 'var(--sidebar-width)';
                    mainContent.style.marginLeft = 'var(--sidebar-width)';
                });
            }
            
            // Add active state to nav items
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Password toggle functionality
            document.getElementById('togglePassword').addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
            
            // Form submission
            document.getElementById('addUserForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form values
                const fullName = document.getElementById('fullName').value.trim();
                const email = document.getElementById('email').value.trim();
                const phone = document.getElementById('phone').value.trim();
                const password = document.getElementById('password').value.trim();
                const role = document.getElementById('role').value;
                
                // Simple validation
                if (!fullName || !email || !phone || !password || !role) {
                    alert('Mohon lengkapi semua field yang wajib diisi.');
                    return;
                }
                
                // Email format validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert('Format email tidak valid');
                    document.getElementById('email').focus();
                    return;
                }
                
                // Phone format validation
                if (!/^\d{10,13}$/.test(phone.replace(/\D/g, ''))) {
                    alert('Nomor HP harus 10-13 digit angka');
                    document.getElementById('phone').focus();
                    return;
                }
                
                // Password strength validation
                if (password.length < 8) {
                    alert('Password minimal harus 8 karakter');
                    document.getElementById('password').focus();
                    return;
                }
                
                // Success message
                alert(`User ${fullName} berhasil ditambahkan sebagai ${role === 'admin' ? 'Admin' : 'Pengguna'}!`);
                
                // Reset form
                this.reset();
                
                // In a real Laravel application, you would submit the form data to the server here
                // window.location.href = 'data-user.html';
            });
            
            // Cancel button
            document.getElementById('cancelBtn').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin membatalkan penambahan user? Semua data yang telah diisi akan hilang.')) {
                    // Redirect to data user page
                    window.location.href = 'data-user.html';
                }
            });
        });
    </script>
</body>
</html>

