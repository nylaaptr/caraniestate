<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Properti - Carani Estate</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
            padding-top: 20px;
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

        .menu-toggle {
            display: none;
            font-size: 20px;
            cursor: pointer;
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
            text-decoration: none;
        }
        
        .profile-icon:hover {
            background: rgba(255,255,255,0.2);
        }

        .main-content{
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-dropdown {
            position: relative;
            cursor: pointer;
        }

        .profile-icon {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            min-width: 180px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 999;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            color: #333;
            text-decoration: none;
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #f5f5f5;
        }

        .dropdown-menu hr {
            margin: 4px 0;
            border: none;
            border-top: 1px solid #eee;
        }

        /* Tampilkan dropdown */
        .dropdown-menu.show {
            display: block;
        }

        .hero-header {
    position: relative;
    height: 420px;
    background: url("https://images.unsplash.com/photo-1600585154340-be6161a56a0c")
        center / cover no-repeat;
    display: flex;
    align-items: center;
    padding: 0 60px;
    margin-top: 90px; /* karena header kamu fixed */
}

        
        /* Hero Section */
        .hero {
            background: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80') no-repeat center center;
            background-size: cover;
            padding: 150px 30px 100px;
            position: relative;
            margin-top: 30px;
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(30, 58, 95, 0.85), rgba(30, 58, 95, 0.85));
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            color: white;
            text-align: center;
            margin: 0 auto;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            line-height: 1.6;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }

        /* HALAMAN TENTANG KAMI */
        /* About Section */
        .about-section {
            padding: 80px 30px;
            background: white;
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-blue);
            text-align: center;
            margin-bottom: 20px;
        }
        
        .section-subtitle {
            font-size: 1.1rem;
            color: #64748b;
            text-align: center;
            margin-bottom: 50px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .about-content {
            display: flex;
            gap: 50px;
            align-items: center;
        }
        
        .about-text {
            flex: 1;
        }
        
        .about-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 20px;
        }
        
        .about-description {
            font-size: 1rem;
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .about-features {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        
        .about-features li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .about-features i {
            color: var(--primary-blue);
            font-size: 18px;
            margin-top: 5px;
        }
        
        .about-image {
            flex: 1;
            background: #f8fafc;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Vision Mission Section */
        .vision-mission-section {
            padding: 80px 30px;
            background: #f8fafc;
        }
        
        .vision-mission-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .vision-card, .mission-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .vision-card {
            border-top: 4px solid var(--primary-blue);
        }
        
        .mission-card {
            border-top: 4px solid #10b981;
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 24px;
        }
        
        .mission-card .card-icon {
            background: #10b981;
        }
        
        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 15px;
        }
        
        .card-description {
            font-size: 0.95rem;
            color: #4a5568;
            line-height: 1.6;
        }

        /* STATISTIK */
        .stats-section {
            padding: 60px 30px;
            background: linear-gradient(135deg, var(--dark-blue) 0%, #1a365d 100%);
            color: white;
            text-align: center;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .stat-item {
            padding: 20px;
        }
        
        .stat-value {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
        }
        
        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        /* Team Section */
        .team-section {
            padding: 80px 30px;
            background: white;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .team-member {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        
        .member-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 15px;
            background: #cbd5e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: var(--dark-blue);
            font-weight: 700;
        }
        
        .member-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }
        
        .member-position {
            font-size: 0.9rem;
            color: var(--primary-blue);
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .member-social {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        
        .social-icon {
            width: 30px;
            height: 30px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            background: #6aa5c6;
            transform: translateY(-2px);
        }

        /*--------------------------------------------------------------
        # Call To Action Section - Blue & White Theme
        --------------------------------------------------------------*/
        .call-to-action {
        position: relative;
        overflow: hidden;
        /* Opsional: Background section biru tua agar kartu putih kontras */
        background-color: #ffff; 
        }

        .call-to-action::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("assets/img/hotel/showcase-3.webp");
        background-size: cover;
        background-position: center;
        opacity: 0.1;
        z-index: 0;
        }

        .call-to-action .container {
        width: auto;
        height: auto;
        position: relative;
        z-index: 1;
        }

        /* Kartu Konten: Background Putih */
        .call-to-action .cta-content {
        background: #1E3A5F; /* Putih Solid */
        border-radius: 20px;
        padding: 60px 40px;
        }

        @media (max-width: 768px) {
        .call-to-action .cta-content {
            padding: 40px 30px;
            border-radius: 15px;
        }
        }

        @media (max-width: 992px) {
        .call-to-action .text-content {
            margin-bottom: 2rem;
            text-align: center;
        }
        }

        /* Typography */
        .call-to-action .text-content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #ffff; /* Biru Tua untuk Judul */
        }

        @media (max-width: 768px) {
        .call-to-action .text-content h2 {
            font-size: 2rem;
        }
        }

        @media (max-width: 576px) {
        .call-to-action .text-content h2 {
            font-size: 1.75rem;
        }
        }

        .call-to-action .text-content .lead {
        font-size: 1.1rem;
        color: #ffff; /* Abu-abu gelap agar nyaman dibaca di background putih */
        line-height: 1.6;
        }

        @media (max-width: 768px) {
        .call-to-action .text-content .lead {
            font-size: 1rem;
        }
        }

        .call-to-action .cta-action {
        position: relative;
        }

        /* Tombol CTA: Gradient Biru */
        .call-to-action .btn-cta {
        background: linear-gradient(135deg, #ffffff, #fafafa); /* Biru Primary ke Biru Gelap */
        color: #1E3A5F; /* Teks Putih */
        font-size: 1.1rem;
        font-weight: 600;
        padding: 15px 35px;
        border-radius: 50px;
        border: 2px solid transparent; /* Border transparan untuk antisipasi layout */
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 8px 25px rgba(13, 34, 65, 0.4);
        transition: all 0.3s ease;
        }

        .call-to-action .btn-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(13, 34, 65, 0.4);
        background: linear-gradient(135deg, #ffffff, #fafafa); /* Biru lebih gelap saat hover */
        color: #1E3A5F;
        }

        .call-to-action .btn-cta:active {
        transform: translateY(0);
        }

        .call-to-action .btn-cta i {
        font-size: 1.2rem;
        }

        @media (max-width: 768px) {
        .call-to-action .btn-cta {
            font-size: 1rem;
            padding: 12px 30px;
        }
        }

        /* Badge (Opsional) - Hijau WhatsApp tetap atau bisa diubah ke Biru */
        .call-to-action .offer-badge {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 1rem;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
        animation: pulse 2s infinite;
        }

        @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
        }

        /* Feature Items */
        .call-to-action .feature-item .icon-wrapper {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.3s ease;
        }

        .call-to-action .feature-item .icon-wrapper i {
        font-size: 1.8rem;
        color: #ffffff;
        }

        .call-to-action .feature-item:hover .icon-wrapper {
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 10px 25px rgba(13, 110, 253, 0.4);
        }

        .call-to-action .feature-item h5 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #0a58ca;
        }

        .call-to-action .feature-item p {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 0;
        line-height: 1.5;
        }

        /* Footer */
        .footer {
            background: var(--dark-blue);
            color: white;
            padding: 50px 30px 20px;
            margin-top: 80px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }
        
        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            position: relative;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary-blue);
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #cbd5e0;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary-blue);
        }
        
        .footer-contact p {
            margin: 10px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .footer-contact i {
            color: var(--primary-blue);
        }
        
        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            background: var(--primary-blue);
            transform: translateY(-2px);
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 40px;
            font-size: 0.9rem;
            color: #cbd5e0;
        }

        /* Profilll */
        .profile-avatar,
        .profile-avatar-default {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-avatar-default {
            background: #7AB2D3;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        } 
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .header {
                padding: 15px 20px;
            }
            
            .nav-menu {
                gap: 20px;
            }
            
            .nav-item {
                font-size: 0.9rem;
            }
            
            .hero {
                padding: 120px 20px 80px;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .search-group {
                flex-wrap: wrap;
            }

            .search-group input,
            .search-group select,
            .search-group button {
                width: 100%;
            }

            .search-filter {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-right {
                width: 100%;
            }

            .search-btn1 {
                width: 100%;
                justify-content: center;
            }
            
            .about-content {
                flex-direction: column;
            }
            
            .about-image {
                height: 300px;
            }

            .properti-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .testimoni-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .register-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .register-branding {
                height: 280px;
                padding: 30px 20px;
            }
            
            .register-form {
                padding: 40px 30px;
            }
            
            .branding-title {
                font-size: 1.8rem;
            }
            
            .branding-subtitle {
                font-size: 1rem;
            }
            
            .logo {
                width: 80px;
                height: 80px;
            }
            
            .logo i {
                font-size: 40px;
            }
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
            
            .logo-text {
                font-size: 1rem;
            }
            
            .chat-header {
                padding: 15px 20px;
            }

            .chat-container {
                top: 70px;
                height: calc(100vh - 70px);
            }
            
            .chat-info h1 {
                font-size: 1.3rem;
            }
            
            .messages-area {
                padding: 20px;
            }
            
            .message {
                max-width: 90%;
            }
            
            .input-area {
                padding: 15px 20px;
            }
            
            .message-input {
                padding: 14px 18px;
            }
            
            .send-btn, .attachment-btn {
                width: 45px;
                height: 45px;
            }

            /* TENTANG KAMI VISI DAN MISI */
            .vision-mission-section {
                padding: 50px 15px;
            }

            .section-title {
                font-size: 1.6rem;
                text-align: center;
            }

            .section-subtitle {
                font-size: 0.9rem;
                text-align: center;
                margin-bottom: 30px;
            }

            .vision-mission-grid {
                grid-template-columns: 1fr; /* jadi 1 kolom */
                gap: 20px;
            }

            .vision-card, .mission-card {
                padding: 20px;
            }

            .card-icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
                margin-bottom: 15px;
            }

            .card-title {
                font-size: 1.1rem;
            }

            .card-description {
                font-size: 0.9rem;
                line-height: 1.5;
            }

            /* TENTANG KAMI TEAM */
            .team-section {
                padding: 50px 15px;
            }

            .team-grid {
                grid-template-columns: 1fr; /* jadi 1 kolom */
                gap: 20px;
            }

            .team-member {
                padding: 18px;
            }

            .member-photo {
                width: 90px;
                height: 90px;
                font-size: 32px;
                margin-bottom: 12px;
            }

            .member-name {
                font-size: 1rem;
            }

            .member-position {
                font-size: 0.85rem;
            }

            .member-social {
                gap: 8px;
            }

            .social-icon {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

        }
        
        @media (max-width: 768px) {
            .header {
                padding: 15px;
            }
            
            .logo-text {
                font-size: 1rem;
            }
            
            .nav-menu {
                display: none;
            }
            
            .user-actions {
                gap: 15px;
            }
            
            .hero {
                padding: 100px 20px 60px;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .about-title {
                font-size: 1.5rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
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

            /* CHATBOT */
            .chat-header {
                padding: 15px 20px;
            }

            .chat-container {
                top: 70px;
                height: calc(100vh - 70px);
            }
            
            .chat-info h1 {
                font-size: 1.3rem;
            }
            
            .messages-area {
                padding: 20px;
            }
            
            .message {
                max-width: 90%;
            }
            
            .input-area {
                padding: 15px 20px;
            }
            
            .message-input {
                padding: 14px 18px;
            }
            
            .send-btn, .attachment-btn {
                width: 45px;
                height: 45px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.4rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .search-group {
                padding: 12px;
            }

            .properti-unggulan {
                padding: 70px 20px;
            }

            .properti-grid {
                grid-template-columns: 1fr;
            }

            .properti-header h2 {
                font-size: 2rem;
            }

            .testimoni {
                padding: 70px 20px;
            }

            .testimoni-grid {
                grid-template-columns: 1fr;
            }

            .testimoni-title {
                font-size: 2rem;
            }

            .slide-btn {
                display: none;
            }

            .testimoni-card {
                min-width: 280px;
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
            
            .hero {
                padding: 80px 15px 50px;
            }
            
            .hero-title {
                font-size: 1.8rem;
            }
            
            .hero-subtitle {
                font-size: 0.9rem;
            }
            
            .btn-primary, .btn-secondary {
                padding: 12px 20px;
                font-size: 0.9rem;
            }
            
            .section-title {
                font-size: 1.3rem;
            }
            
            .about-title {
                font-size: 1.3rem;
            }
            
            .feature-title {
                font-size: 1.1rem;
            }

            .register-container {
                border-radius: 20px;
                max-width: 100%;
            }
            
            .register-branding {
                height: 240px;
                padding: 25px 15px;
            }
            
            .register-form {
                padding: 35px 25px;
            }
            
            .branding-title {
                font-size: 1.5rem;
            }
            
            .branding-subtitle {
                font-size: 0.9rem;
            }
            
            .form-title {
                font-size: 1.7rem;
            }
            
            .form-subtitle {
                font-size: 1rem;
            }
            
            .logo {
                width: 70px;
                height: 70px;
            }
            
            .logo i {
                font-size: 32px;
            }
            
            .form-logo {
                width: 60px;
                height: 60px;
            }
            
            .form-logo i {
                font-size: 28px;
            }
            
            .btn-register {
                font-size: 1rem;
                padding: 14px;
                letter-spacing: 0.3px;
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

            /* CHATBOT */
            .chat-header{
                padding: 12px 15px;
            }

            .chat-container {
                top: 65px;
                height: calc(100vh - 65px);
            }
            
            .chat-avatar {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
            
            .chat-info h1 {
                font-size: 1.2rem;
            }
            
            .messages-area {
                padding: 15px;
            }
            
            .message {
                padding: 14px 18px;
                font-size: 0.95rem;
            }
            
            .message-time {
                font-size: 0.7rem;
            }
            
            .input-area {
                padding: 12px 15px;
            }
            
            .message-input {
                padding: 12px 16px;
                font-size: 0.95rem;
            }
            
            .send-btn, .attachment-btn {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .quick-actions {
                gap: 8px;
            }
            
            .quick-btn {
                padding: 6px 12px;
                font-size: 0.85rem;
            }
            
        }
    </style>
</head>
<body>
    {{ Auth::check() ? 'LOGIN BERHASIL' : 'BELUM LOGIN' }}
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
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="nav-item login-link">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @else
                    {{-- HANYA ICON PROFILE --}}
                    <a href="{{ route('halaman-profil') }}" class="profile-icon">
                        @php
                            $user = Auth::user();
                        @endphp

                        {{-- Prioritas 1: Foto upload user --}}
                        @if($user->profile_photo)

                            <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
                                class="profile-avatar"
                                alt="Profile Photo">

                        {{-- Prioritas 2: Foto Google --}}
                        @elseif($user->google_avatar)

                            <img src="{{ $user->google_avatar }}"
                                class="profile-avatar"
                                referrerpolicy="no-referrer"
                                alt="Google Photo"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}'">

                        {{-- Prioritas 3: Inisial --}}
                        @else

                            <div class="profile-avatar-default">
                                {{ strtoupper(substr($user->nama_user, 0, 1)) }}
                            </div>

                        @endif

                    </a>
                @endguest
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Tentang Carani Estate</h1>
            <p class="hero-subtitle">Mewujudkan impian memiliki rumah yang nyaman dan berkualitas sejak 2019</p>
        </div>
    </section>
    
    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">Profil Perusahaan</h2>
            <p class="section-subtitle">PT. Carani Bhanu Balakosa adalah perusahaan pengembang properti lokal yang berkomitmen untuk menyediakan hunian berkualitas dengan harga terjangkau bagi masyarakat Bondowoso dan sekitarnya.</p>
            
            <div class="about-content">
                <div class="about-text">
                    <h3 class="about-title">Sejarah & Perjalanan Kami</h3>

                    <p class="about-description">
                        PT. Carani Bhanu Balakosa hadir untuk membantu masyarakat menemukan hunian yang nyaman dan berkualitas di Kabupaten Bondowoso. Dengan berbagai pilihan rumah dan ruko di lokasi yang strategis, kami terus berkomitmen memberikan pelayanan terbaik serta menghadirkan properti yang sesuai dengan kebutuhan masyarakat.
                    </p>

                    <ul class="about-features">
                        <li><i class="fas fa-check-circle"></i> Telah membantu banyak pelanggan mendapatkan hunian impian</li>
                        <li><i class="fas fa-check-circle"></i> Menyediakan pilihan rumah dan ruko di lokasi strategis</li>
                        <li><i class="fas fa-check-circle"></i> Harga kompetitif dengan kualitas yang terjaga</li>
                        <li><i class="fas fa-check-circle"></i> Pelayanan yang ramah dan terpercaya</li>
                    </ul>
                </div>
                
                <div class="about-image">
                    <img src="{{ asset('images/gambar-perusahaan.webp') }}" alt="Gambar Perusahaan">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">150+</div>
                    <div class="stat-label">Properti Tersedia</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">100+</div>
                    <div class="stat-label">Pelanggan Terlayani</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">5+</div>
                    <div class="stat-label">Perumahan Pilihan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">100%</div>
                    <div class="stat-label">Pelayanan Maksimal</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Vision Mission Section -->
    <section class="vision-mission-section">
        <div class="container">
            <h2 class="section-title">Visi & Misi</h2>
            <p class="section-subtitle">Komitmen kami untuk menciptakan hunian terbaik bagi masyarakat Bondowoso.</p>
            
            <div class="vision-mission-grid">
                <div class="vision-card">
                    <div class="card-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="card-title">Visi Kami</h3>
                    <p class="card-description">Menjadi perusahaan pengembang properti terdepan di Bondowoso yang dikenal karena kualitas, inovasi, dan komitmen terhadap kepuasan pelanggan.</p>
                </div>
                
                <div class="mission-card">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="card-title">Misi Kami</h3>
                    <p class="card-description">• Menyediakan hunian berkualitas dengan harga terjangkau<br>
                    • Mengembangkan properti di lokasi strategis Bondowoso<br>
                    • Memberikan pelayanan terbaik sebelum dan sesudah penjualan<br>
                    • Mendukung pembangunan berkelanjutan di Kabupaten Bondowoso<br>
                    • Menciptakan nilai tambah bagi seluruh stakeholder</p>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section light-background">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="cta-content text-center">
            <div class="row align-items-center">
                <div class="col-lg-8">
                <div class="text-content">
                    <h2>Temukan Properti Impian Anda</h2>
                    <p class="lead mb-0">Dapatkan informasi lengkap tentang rumah, villa, guest house, dan properti terbaik di Kota Batu. Hubungi kami sekarang untuk penawaran eksklusif dan properti terbaru.</p>
                </div>
                </div>
                <div class="col-lg-4">
                <div class="cta-action" data-aos="zoom-in" data-aos-delay="200">
                    <a href="{{ route('halaman-katalog') }}" class="btn btn-cta">
                    <i class="bi bi-whatsapp me-2"></i>
                    Jelajahi Properti
                    </a>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

    </div>
    </section><!-- /Call To Action Section -->

    <!-- Footer -->
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
                        <li><a href="{{ route('welcome') }}">Beranda</a></li>
                        <li><a href="{{ route('halaman-katalog') }}">Katalog Properti</a></li>
                        <li><a href="{{ route('halaman-chatbot') }}">ChatBot</a></li>
                        <li><a href="{{ route('halaman-katalog') }}">Kontak</a></li>
                        <li><a href="{{ route('tentang-kami') }}">Tentang Kami</a></li>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
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

<script>
function toggleMenu() {
    document.getElementById('navMenu').classList.toggle('show');
}

function toggleDropdown() {
    document.getElementById('dropdownMenu').classList.toggle('show');
}

// Tutup dropdown kalau klik luar
window.addEventListener('click', function(e) {
    if (!e.target.closest('.profile-dropdown')) {
        document.getElementById('dropdownMenu').classList.remove('show');
    }
});
</script>
</body>
</html>
