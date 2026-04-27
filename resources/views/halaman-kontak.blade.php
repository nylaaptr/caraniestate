<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Carani Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            font-family: "Roboto", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
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
        }
        
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        
        /* Contact Form Section */
        .contact-form-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 30px;
        }
        
        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 25px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d3748;
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
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .required {
            color: #ef4444;
            margin-left: 4px;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #4a90b7 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
            margin-top: 10px;
        }
        
        .submit-btn:hover {
            background: linear-gradient(135deg, #6aa5c6 0%, #3d85aa 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(var(--primary-blue-rgb), 0.3);
        }
        
        /* Map & Info Section */
        .map-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .map-container {
            height: 350px;
            width: 100%;
            background: #e0e7ff;
            position: relative;
            overflow: hidden;
        }
        
        .map-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #e0e7ff 0%, #bfdbfe 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--dark-blue);
            text-align: center;
            padding: 20px;
        }
        
        .map-placeholder i {
            font-size: 4rem;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }
        
        .map-placeholder h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .map-placeholder p {
            font-size: 1.1rem;
            max-width: 80%;
        }
        
        .info-section {
            padding: 30px;
        }
        
        .info-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-blue);
        }
        
        .contact-info {
            list-style: none;
            padding: 0;
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
            font-size: 18px;
        }
        
        .info-text h4 {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }
        
        .info-text p, .info-text a {
            color: #4a5568;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .info-text a:hover {
            color: var(--primary-blue);
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-blue);
            font-size: 18px;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-3px);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .contact-container {
                grid-template-columns: 1fr;
            }
            
            .map-container {
                height: 300px;
            }
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
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
            
            .logo-text {
                font-size: 1rem;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .contact-form-section,
            .map-section {
                padding: 20px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .map-container {
                height: 250px;
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
            
            .section-title {
                font-size: 1.4rem;
            }
            
            .info-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .social-links {
                flex-wrap: wrap;
            }
            
            .map-placeholder h3 {
                font-size: 1.3rem;
            }
            
            .map-placeholder p {
                font-size: 1rem;
                max-width: 100%;
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
        <div class="contact-container">
            <!-- Contact Form Section -->
            <div class="contact-form-section">
                <h2 class="section-title">Kirim Pesan kepada Kami</h2>
                <p style="text-align: center; color: #64748b; margin-bottom: 25px;">
                    Isi formulir di bawah ini untuk menghubungi tim kami. Kami akan merespon pesan Anda dalam 1x24 jam.
                </p>
                
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Masukkan nama lengkap Anda" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Contoh: 081234567890">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject" class="form-label">Subjek <span class="required">*</span></label>
                        <select class="form-control" id="subject" required>
                            <option value="">Pilih subjek pesan</option>
                            <option value="info-properti">Informasi Properti</option>
                            <option value="keluhan">Keluhan/Kritik</option>
                            <option value="kerjasama">Kerjasama Bisnis</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message" class="form-label">Pesan <span class="required">*</span></label>
                        <textarea class="form-control" id="message" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                    </button>
                </form>
            </div>
            
            <!-- Map & Info Section -->
            <div class="map-section">
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.712122164841!2d113.84226827500642!3d-7.925107192098588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6dcb18dbda8b5%3A0x2d7ea0b123774aa6!2sPt.Carani%20Bhanu%20Balakosa!5e0!3m2!1sid!2sid!4v1776705530292!5m2!1sid!2sid"
                        width="100%" 
                        height="500" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
                
                <div class="info-section">
                    <h3 class="info-title">Informasi Kontak</h3>
                    <ul class="contact-info">
                        <li class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-text">
                                <h4>Alamat Kantor</h4>
                                <p>Jl. Raya Pakisan, Bunduh, Bataan, Kec. Tenggarang, Kabupaten Bondowoso, Jawa Timur 68271</p>
                            </div>
                        </li>
                        
                        <li class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-text">
                                <h4>Telepon</h4>
                                <p><a href="tel:+6281234567890">0812-3456-7890</a> (WhatsApp)</p>
                            </div>
                        </li>
                        
                        <li class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-text">
                                <h4>Email</h4>
                                <p><a href="mailto:info@propertiharmoni.com">caranibhanubalakosa@gmail.com</a></p>
                            </div>
                        </li>
                        
                        <li class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-text">
                                <h4>Jam Operasional</h4>
                                <p>Senin - Jumat: 08:00 - 17:00 WIB</p>
                                <p>Sabtu: 08:00 - 14:00 WIB</p>
                                <p>Minggu: Libur</p>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="social-link" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission
            document.getElementById('contactForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form values
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const subject = document.getElementById('subject').value;
                const message = document.getElementById('message').value.trim();
                
                // Simple validation
                if (!name || !email || !subject || !message) {
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
                
                // Success message
                alert(`Terima kasih ${name}!\nPesan Anda dengan subjek "${subject}" telah terkirim. Tim kami akan segera menghubungi Anda.`);
                
                // Reset form
                this.reset();
            });
            
            // Add subtle animation on page load
            const contactContainer = document.querySelector('.contact-container');
            contactContainer.style.opacity = '0';
            contactContainer.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                contactContainer.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                contactContainer.style.opacity = '1';
                contactContainer.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>

