<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Carani Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #7AB2D3;
            --primary-blue-rgb: 122, 178, 211;
            --dark-blue: #1E3A5F;
            --light-blue: #e6f2f8;
            --sidebar-width: 260px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
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
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .logo-icon i {
            font-size: 24px;
            color: var(--dark-blue);
        }
        
        .logo-text {
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }
        
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }
        
        .nav-item {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-item:hover {
            color: var(--primary-blue);
        }
        
        .nav-item.active {
            color: var(--primary-blue);
            font-weight: 600;
        }
        
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -5px;
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
            gap: 20px;
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
        
        .profile-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .profile-icon:hover {
            background: rgba(255,255,255,0.2);
        }

        .menu-toggle{
            display: none;
            font-size: 22px;
            cursor: pointer;
            padding: 8px 10px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .menu-toggle:hover{
            background: rgba(255,255,255,0.15);
        }
        
        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .profile-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 40px;
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            font-weight: 700;
            color: white;
            border: 4px solid #f8fafc;
            box-shadow: 0 8px 20px rgba(122, 178, 211, 0.3);
        }
        
        .profile-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 10px;
        }
        
        .profile-email {
            color: #64748b;
            font-size: 1.1rem;
        }

        /* PP */
        .avatar-wrapper {
            position: relative;
            width: 80px;
            height: 80px;
            margin: auto;
        }

        .profile-avatar,
        .profile-avatar-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        .profile-avatar {
            background: #7AB2D3;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-avatar-img {
            object-fit: cover;
        }

        /* tombol + */
        .edit-avatar {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #1E3A5F;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .form-input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-input:focus {
            outline: none;
            border-color: #7AB2D3;
        }

        .btn-save {
            background: #22c55e;
            color: white;
        }

        .btn-save:hover {
            background: #16a34a;
        }
        
        /* Personal Information Section */
        .personal-info {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-blue);
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 0.95rem;
            color: #64748b;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .info-value {
            font-size: 1.1rem;
            color: var(--dark-blue);
            font-weight: 600;
            padding: 12px 16px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }
        
        /* Security Section */
        .security-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e2e8f0;
        }
        
        .security-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .security-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
        }
        
        .security-btn {
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-change-password {
            background: var(--primary-blue);
            color: white;
        }
        
        .btn-change-password:hover {
            background: #6aa5c6;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(var(--primary-blue-rgb), 0.3);
        }
        
        .btn-logout {
            background: #ef4444;
            color: white;
        }
        
        .btn-logout:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        /* Modal Ganti Password */
        .password-modal {
            border-radius: 16px;
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .password-modal .modal-header {
            background: linear-gradient(135deg, var(--dark-blue), #1e3a5f);
            color: white;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .password-modal .modal-title {
            font-weight: 700;
        }

        .password-modal .form-control {
            border-radius: 10px;
            padding: 12px 14px;
            border: 1px solid #e2e8f0;
        }

        .password-modal .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(var(--primary-blue-rgb), 0.25);
        }

        .btn-save-password {
            width: 100%;
            margin-top: 15px;
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-save-password:hover {
            background: #6aa5c6;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(var(--primary-blue-rgb), 0.3);
        }

        
        /* Responsive Design */
        @media (max-width: 768px) {
            .header{
                padding: 15px;
            }

            .header-container{
                display: flex;
                flex-direction: row;      /* ← jadi satu baris */
                align-items: center;
                justify-content: space-between; /* ← kiri & kanan */
                width: 100%;
            }

            /* tombol toggle muncul di mobile */
            .menu-toggle{
                display: block;
                color: white;
                order: 2;
            }

            /* nav jadi dropdown */
            .nav-menu{
                display: none;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: linear-gradient(135deg, var(--dark-blue) 0%, #1E3A5F 100%);
                flex-direction: column;
                padding: 15px 0;
                gap: 0;
                box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            }

            .nav-menu.show{
                display: flex;
            }

            .nav-item{
                padding: 12px 20px;
                width: 100%;
            }

            .nav-item::after{
                display: none;
            }
            
            .logo-text {
                font-size: 1rem;
            }
            
            .nav-menu {
                display: none;
                margin-bottom: 20px;
            }
            
            .user-actions {
                margin-left: auto;   /* ← dorong ke kanan */
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .profile-container {
                padding: 30px 20px;
            }
            
            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 28px;
            }
            
            .profile-name {
                font-size: 1.5rem;
            }
            
            .profile-email {
                font-size: 1rem;
            }
            
            .info-grid {
                gap: 20px;
            }
            
            .security-actions {
                flex-direction: column;
                gap: 15px;
            }
            
            .security-btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 15px;
            }
            
            .logo-text {
                display: none;
            }
            
            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
            
            .main-content {
                padding: 15px;
            }
            
            .profile-container {
                padding: 25px 15px;
            }
            
            .profile-avatar {
                width: 70px;
                height: 70px;
                font-size: 24px;
            }
            
            .profile-name {
                font-size: 1.3rem;
            }
            
            .section-title {
                font-size: 1.2rem;
            }
            
            .info-label {
                font-size: 0.9rem;
            }
            
            .info-value {
                font-size: 1rem;
                padding: 10px 14px;
            }
            
            .security-title {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
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
                <a href="{{ route('welcome') }}"
                class="nav-item {{ request()->routeIs('welcome') ? 'active' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('tentang-kami') }}"
                class="nav-item {{ request()->routeIs('tentang-kami') ? 'active' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('halaman-katalog') }}"
                class="nav-item {{ request()->routeIs('halaman-katalog') ? 'active' : '' }}">
                    Katalog
                </a>
                <a href="{{ route('halaman-chatbot') }}"
                class="nav-item {{ request()->routeIs('halaman-chatbot') ? 'active' : '' }}">
                    ChatBot
                </a>
                @auth
                <a href="{{ route('riwayat-pemesanan') }}" class="nav-item {{ request()->routeIs('riwayat-pemesanan') ? 'active' : '' }}">
                    Riwayat Pemesanan
                </a>
                @endauth
                <a href="{{ route('halaman-kontak') }}"
                class="nav-item {{ request()->routeIs('kontak') ? 'active' : '' }}">
                    Kontak
                </a>
            </nav>
            
            <div class="user-actions">

                {{-- Notifikasi hanya kalau login --}}
                @auth
                <a href="{{ route('halaman-notifikasi') }}" class="notification-icon" style="position:relative;">
                    <i class="fas fa-bell"></i>

                    @php
                        $jumlahBelumBaca = \App\Models\Notifikasi::where('id_user', Auth::id())
                            ->where('status_baca', 0)->count();
                    @endphp

                    @if($jumlahBelumBaca > 0)
                        <span style="position:absolute; top:-5px; right:-5px; 
                                    background:#ef4444; color:white; border-radius:50%; 
                                    width:18px; height:18px; font-size:0.65rem; 
                                    display:flex; align-items:center; justify-content:center;
                                    font-weight:700;">
                            {{ $jumlahBelumBaca > 9 ? '9+' : $jumlahBelumBaca }}
                        </span>
                    @endif
                </a>
                @endauth

                {{-- Guest --}}
                @guest
                    <a href="{{ route('login') }}" class="nav-item login-link">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @else
                    {{-- HANYA ICON PROFILE --}}
                    <a href="{{ route('halaman-profil') }}" class="profile-icon">
                        <img src="{{ Auth::user()->profile_photo 
                            ? asset('storage/profile_photos/' . Auth::user()->profile_photo) 
                            : asset('default-avatar.png') }}" 
                            alt="Profile" class="profile-img">
                    </a>
                @endguest
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="profile-container">

            @php
                $user = Auth::user();
                $inisial = strtoupper(substr($user->name, 0, 1));
            @endphp

            <!-- Profile Header -->
            <div class="profile-header">
                @php
                    $user = Auth::user();
                    $inisial = strtoupper(substr($user->name, 0, 1));
                @endphp

                <div class="avatar-wrapper">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" 
                            class="profile-avatar-img">
                    @else
                        <div class="profile-avatar">{{ $inisial }}</div>
                    @endif

                    <!-- tombol upload -->
                    <label for="upload-photo" class="edit-avatar">
                        <i class="fas fa-plus"></i>
                    </label>

                    <form action="{{ route('upload.pp') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="upload-photo" name="photo" hidden onchange="this.form.submit()">
                    </form>
                </div>

                <h2 class="profile-name">{{ $user->name }}</h2>
                <p class="profile-email">{{ $user->email }}</p>
            </div>
            
            <!-- Personal Information -->
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="personal-info">
                    <h3 class="section-title">Informasi Pribadi</h3>

                    <div class="info-grid">

                        <div class="info-item">
                            <span class="info-label">Nama Lengkap</span>
                            <input type="text" name="nama_user" 
                                value="{{ $user->nama_user }}" class="form-input">
                        </div>

                        <div class="info-item">
                            <span class="info-label">Nomor HP</span>
                            <input type="text" name="no_hp" 
                                value="{{ $user->no_hp }}" class="form-input">
                        </div>

                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <input type="email" name="email_user" 
                                value="{{ $user->email_user }}" class="form-input">
                        </div>

                        <div class="info-item full">
                            <span class="info-label">Alamat</span>
                            <textarea name="alamat" class="form-input">{{ $user->alamat }}</textarea>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Pekerjaan</span>
                            <input type="text" name="pekerjaan" 
                                value="{{ $user->pekerjaan }}" class="form-input">
                        </div>

                    </div>
                </div>

                <!-- Security Settings -->
                <div class="security-section">
                    <h4 class="security-title">Pengaturan Keamanan</h4>

                    <div class="security-actions">
                        <button type="button" class="security-btn btn-change-password">
                            <i class="fas fa-lock"></i> Ganti Password
                        </button>

                        <button type="submit" class="security-btn btn-save">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>

                        <button type="button" class="security-btn btn-logout"
                                onclick="document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </div>
                </div>
            </form>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </div>
    

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const changePasswordBtn = document.querySelector(".btn-change-password");
        const modalElement = document.getElementById("changePasswordModal");
        const modal = new bootstrap.Modal(modalElement);

        changePasswordBtn.addEventListener("click", function () {
            modal.show();
        });

        const form = modalElement.querySelector("form");

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const oldPass = form.querySelectorAll("input")[0].value;
            const newPass = form.querySelectorAll("input")[1].value;
            const confirmPass = form.querySelectorAll("input")[2].value;

            if (!oldPass || !newPass || !confirmPass) {
                alert("Semua field wajib diisi!");
                return;
            }

            if (newPass.length < 8) {
                alert("Password baru minimal 8 karakter!");
                return;
            }

            if (newPass !== confirmPass) {
                alert("Konfirmasi password tidak cocok!");
                return;
            }

            alert("Password berhasil diperbarui ✅");

            form.reset();
            modal.hide();
        });
    });
</script>

    <script>
        // Logout button
        document.querySelector('.btn-logout').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                alert('Logout berhasil!');
                // In a real Laravel application, you would submit a logout form
                // document.getElementById('logout-form').submit();
            }
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }

        // Tutup dropdown kalau klik di luar
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.profile-dropdown')) {
                document.getElementById('dropdownMenu').classList.remove('show');
            }
        });

        // Add interactivity to search button
        document.querySelector('.search-btn').addEventListener('click', function() {
            alert('Mencari riwayat pemesanan dengan kriteria yang dipilih...');
        });
        
        // Add interactivity to action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.querySelector('i').className;
                const bookingId = this.closest('tr').querySelector('td:first-child').textContent;
                
                if (action.includes('fa-eye')) {
                    alert(`Menampilkan detail pemesanan: ${bookingId}`);
                } else if (action.includes('fa-times')) {
                    if (confirm(`Apakah Anda yakin ingin membatalkan pemesanan ${bookingId}?`)) {
                        alert(`Pemesanan ${bookingId} berhasil dibatalkan.`);
                        // In a real application, you would update the status in the database
                    }
                }
            });
        });
        
        // Add hover effect to table rows
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.background = '#f8fafc';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.background = '';
            });
        });
        
        // Pagination functionality
        document.querySelectorAll('.page-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.page-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                alert(`Menampilkan halaman ${this.textContent}`);
            });
        });
    </script>


    <!-- Modal Ganti Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content password-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-lock"></i> Ganti Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" class="form-control" placeholder="Masukkan password lama">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" class="form-control" placeholder="Masukkan password baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" placeholder="Ulangi password baru">
                    </div>

                    <button type="submit" class="btn-save-password">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // TOGGLE NAV
        function toggleMenu(){
            document.getElementById('navMenu').classList.toggle('show');
        }
</script>
</body>
</html>