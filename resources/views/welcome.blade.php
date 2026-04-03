<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PropertiHarmoni - Temukan Rumah Impian Anda</title>
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
            font-family: "Roboto",  system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
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
        
        /* Hero Section */
        .hero {
            background: url('https://placehold.co/1920x1080/e6f2f8/1E3A5F?text=Properti+Impian') no-repeat center center;
            background-size: cover;
            padding: 150px 30px 100px;
            position: relative;
            margin-top: 80px;
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(30, 58, 95, 0.8), rgba(30, 58, 95, 0.8));
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            color: white;
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
        
        .hero-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn-primary {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(var(--primary-blue-rgb), 0.3);
        }
        
        .btn-primary:hover {
            background: #6aa5c6;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(var(--primary-blue-rgb), 0.4);
        }
        
        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-2px);
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

        /* Form Pencarian Properti */
        .property-search {
            margin-top: 40px;
            width: 100%;
        }

        .search-group {
            display: flex;
            gap: 12px;
            background: rgba(255, 255, 255, 0.95);
            padding: 15px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .search-group input,
        .search-group select {
            flex: 1;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid #ddd;
            font-size: 0.95rem;
            outline: none;
        }

        .search-group input:focus,
        .search-group select:focus {
            border-color: var(--primary-blue);
        }

        /* Search Panel di Hero */
        .hero-search {
            position: absolute;
            top: 50%;
            right: 40px;
            transform: translateY(-50%);
            z-index: 3;
            width: 360px;
        }

        .property-search-card {
            background: rgba(20, 40, 70, 0.95);
            padding: 28px;
            border-radius: 20px;
            color: #fff;
            box-shadow: 0 20px 50px rgba(0,0,0,0.35);
            backdrop-filter: blur(8px);
        }

        .search-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .property-search-card label {
            font-size: 0.9rem;
            margin-bottom: 6px;
            display: block;
            opacity: 0.9;
        }

        .property-search-card input,
        .property-search-card select {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            border: none;
            margin-bottom: 16px;
            font-size: 0.95rem;
            outline: none;
        }

        .property-search-card input,
        .property-search-card select {
            background: rgba(255,255,255,0.95);
        }

        .search-row {
            display: flex;
            gap: 12px;
        }

        .search-row > div {
            flex: 1;
        }

        .search-btn {
            width: 100%;
            margin-top: 10px;
        }



        
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
            margin-bottom: 30px;
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
        
        /* Features Section */
        .features-section {
            padding: 80px 30px;
            background: #f8fafc;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
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
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 15px;
        }
        
        .feature-description {
            font-size: 0.95rem;
            color: #4a5568;
            line-height: 1.6;
        }

        /* Properti Unggulan */
        .properti-unggulan {
            background: #ffffff;
            padding: 100px 30px;
        }

        .properti-container {
            max-width: 1200px;
            margin: auto;
        }

        .properti-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .properti-header h2 {
            font-size: 2.6rem;
            font-weight: 800;
            color: #1E3A5F;
        }

        .properti-header p {
            font-size: 1.1rem;
            color: #5a6f85;
            margin-top: 10px;
        }

        /* Grid */
        .properti-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        /* Card */
        .properti-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(30,58,95,0.12);
            transition: all 0.3s ease;
        }

        .properti-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 60px rgba(30,58,95,0.18);
        }

        .properti-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .properti-content {
            padding: 25px;
        }

        .properti-label {
            display: inline-block;
            background: #1E3A5F;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 12px;
        }

        .properti-content h3 {
            font-size: 1.2rem;
            color: #1E3A5F;
            margin-bottom: 8px;
        }

        .properti-location {
            font-size: 0.9rem;
            color: #7b8fa3;
        }

        .properti-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1E3A5F;
            margin: 15px 0;
        }

        .properti-btn {
            width: 100%;
            text-align: center;
            display: block;
            text-decoration: none;
        }

        /* Button bawah */
        .properti-action {
            margin-top: 50px;
            text-align: center; /* bikin tombol ke tengah */
        }

        .properti-action a {
            text-decoration: none;
        }


        /* Testimoni Section */
        .testimoni {
            background: linear-gradient(180deg, #f2f7fb, #ffffff);
            padding: 100px 30px;
        }

        .testimoni-container {
            max-width: 1200px;
            margin: auto;
            text-align: center;
        }

        .testimoni-title {
            font-size: 2.6rem;
            font-weight: 800;
            color: #1E3A5F;
        }

        .testimoni-subtitle {
            color: #5a6f85;
            margin-bottom: 50px;
        }

        /* Slider Wrapper */
        .testimoni-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .testimoni-slider {
            display: flex;
            gap: 25px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 10px;
        }

        .testimoni-slider::-webkit-scrollbar {
            display: none;
        }

        /* Card */
        .testimoni-card {
            min-width: 340px;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(30,58,95,0.12);
            text-align: left;
        }

        .testimoni-text {
            color: #34495e;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        /* User */
        .testimoni-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: #1E3A5F;
            color: #fff;
            font-weight: 700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }


        /* Button */
        .slide-btn {
            background: #1E3A5F;
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }                 
        .slide-btn.left {
            margin-right: 10px;
        }

        .slide-btn.right {
            margin-left: 10px;
        }

        .slide-btn:hover {
            background: #284b7a;
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

            .hero-search {
                position: relative;
                top: auto;
                right: auto;
                transform: none;
                width: 100%;
                max-width: 500px;
                margin: 30px auto 0;
                padding: 0 20px;
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
        }
        
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
            
            .hero {
                padding: 100px 20px 60px;
                padding-top: 100px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }

            .hero-search {
                order: 1; /* ← form naik ke atas */
                position: relative;
                top: auto;
                right: auto;
                transform: none;
                width: 100%;
                max-width: 100%;
                margin: 0 0 20px 0;
                padding: 0 15px;
            }

            .hero-content {
                order: 2; /* ← teks turun ke bawah */
                text-align: center;
            }

            .search-row {
                flex-direction: column;
                gap: 0;
            }

            .property-search-card {
                padding: 20px;
            }

            .property-search-card {
                padding: 20px;
            }

            .search-row {
                flex-direction: column; /* ← tipe & harga jadi satu kolom */
                gap: 0;
            }
            
            .about-title {
                font-size: 1.5rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
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

            .hero-search {
                padding: 0 10px;
            }

            .property-search-card {
                padding: 15px;
                border-radius: 14px;
            }

            .search-title {
                font-size: 1.2rem;
                margin-bottom: 15px;
            }

            .property-search-card input,
            .property-search-card select {
                padding: 12px 14px;
                font-size: 0.9rem;
                margin-bottom: 12px;
            }
            
            .about-title {
                font-size: 1.3rem;
            }
            
            .feature-title {
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
                <a href="{{ route('halaman-notifikasi') }}" class="notification-icon">
                    <i class="fas fa-bell"></i>
                </a>
                
                {{-- Conditional: Guest vs Authenticated --}}
                @guest
                    {{-- BELUM login: Tampilkan tombol Login sederhana --}}
                    <a href="{{ route('login') }}" class="nav-item login-link">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @else
                    {{-- SUDAH login: Tampilkan dropdown Profil --}}
                    <div class="profile-dropdown">
                        <div class="profile-icon" onclick="toggleDropdown()">
                            <i class="fas fa-user"></i>
                        </div>
                        
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="{{ route('halaman-profil') }}">
                                <i class="fas fa-user-circle"></i> Lihat Profil
                            </a>
                            <hr>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </header>
    
    <section class="hero">
    <div class="hero-overlay"></div>

    <!-- Konten teks kiri -->
    <div class="hero-content">
        <h1 class="hero-title">Temukan Rumah Impian Anda</h1>
        <p class="hero-subtitle">
            Kami membantu Anda menemukan properti terbaik sesuai kebutuhan dan anggaran.
        </p>

        <div class="hero-buttons">
            <a href="{{ route('halaman-katalog') }}" class="btn-primary" style="text-decoration: none; display: inline-block;">
                Lihat Katalog
            </a>
            <a href="{{ route('tentang-kami') }}" class="btn-secondary" style="text-decoration: none; display: inline-block;">
                Tentang Kami
            </a>
        </div>
    </div>

    <!-- ✅ FORM PENCARIAN DI SINI -->
    <div class="hero-search">
        <form class="property-search-card" action="properti.html" method="GET">
            <h3 class="search-title">Cari Properti</h3>

            <label>Lokasi</label>
            <input type="text" name="lokasi" placeholder="Masukkan lokasi">

            <div class="search-row">
                <div>
                    <label>Tipe</label>
                    <select name="tipe">
                        <option value="">Pilih Tipe</option>
                        <option value="rumah">Rumah</option>
                        <option value="apartemen">Apartemen</option>
                    </select>
                </div>

                <div>
                    <label>Harga</label>
                    <select name="harga">
                        <option value="">Rentang Harga</option>
                        <option value="0-300">≤ 300 Juta</option>
                        <option value="300-600">300 – 600 Juta</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-primary search-btn">
                Cari Properti
            </button>
        </form>
    </div>
</section>

    
    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            
            <div class="about-content">
                <div class="about-text">
                    <h3 class="about-title">Mengapa Memilih Kami?</h3>
                    <p class="about-description">Kami memahami bahwa membeli rumah adalah keputusan besar. Oleh karena itu, kami menyediakan layanan terbaik dengan tim profesional yang siap membantu Anda setiap langkahnya.</p>
                    
                    <ul class="about-features">
                        <li><i class="fas fa-check-circle"></i> Ribuan properti terverifikasi</li>
                        <li><i class="fas fa-check-circle"></i> Proses transaksi aman & transparan</li>
                        <li><i class="fas fa-check-circle"></i> Tim ahli siap membantu 24/7</li>
                        <li><i class="fas fa-check-circle"></i> Harga kompetitif & negosiasi mudah</li>
                        <li><i class="fas fa-check-circle"></i> Layanan purna jual terbaik</li>
                    </ul>
                </div>
                
                <div class="about-image">
                    <img src="https://placehold.co/600x400/e6f2f8/1E3A5F?text=Gambar+Perusahaan" alt="Gambar Perusahaan">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">Fitur Unggulan Kami</h2>
            <p class="section-subtitle">Kami menyediakan berbagai fitur untuk mempermudah Anda dalam mencari properti impian.</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="feature-title">Pencarian Mudah</h3>
                    <p class="feature-description">Cari properti sesuai kriteria Anda dengan filter lengkap dan sistem pencarian cerdas.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="feature-title">Lokasi Strategis</h3>
                    <p class="feature-description">Temukan properti di lokasi strategis dengan akses mudah ke fasilitas umum.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="feature-title">Transaksi Aman</h3>
                    <p class="feature-description">Proses transaksi yang aman dan terjamin dengan notaris profesional.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Analisis Harga</h3>
                    <p class="feature-description">Dapatkan analisis harga pasar untuk membantu Anda membuat keputusan tepat.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="feature-title">ChatBot 24/7</h3>
                    <p class="feature-description">Dapatkan bantuan instan melalui ChatBot kami yang tersedia 24 jam.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Tim Ahli</h3>
                    <p class="feature-description">Konsultasi langsung dengan agen properti profesional kami.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Properti Unggulan -->
    <section class="properti-unggulan">
        <div class="properti-container">
            <div class="properti-header">
                <h2>Properti Unggulan</h2>
                <p>Pilihan properti terbaik dari PT Carani Bhanu Balakosa</p>
            </div>

            <div class="properti-grid">
                @foreach($unggulan as $p)
                <div class="properti-card">
                    <div class="properti-image">
                        <img src="{{ asset('img/tipe36.jpg') }}" alt="{{ $p->nama_properti }}">
                    </div>
                    <div class="properti-content">
                        <span class="properti-label">{{ ucfirst($p->jenis_properti) }}</span>
                        <h3>{{ $p->nama_properti }}</h3>
                        <p class="properti-location">
                            <i class="fas fa-map-marker-alt"></i> Bondowoso, Jawa Timur
                        </p>
                        <p class="properti-price">
                            Rp {{ number_format($p->harga_properti, 0, ',', '.') }}
                        </p>
                        <a href="{{ route('detail-katalog', $p->id_properti) }}" 
                        class="btn-primary properti-btn">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Button lihat semua -->
            <div class="properti-action">
                <a href="{{ route('halaman-katalog') }}" class="btn-primary">
                    Lihat Semua Properti
                </a>
            </div>
        </div>
    </section>


    <!-- Testimoni Section -->
<section class="testimoni">
    <div class="testimoni-container">
        <h2 class="testimoni-title">Apa Kata Klien Kami</h2>
        <p class="testimoni-subtitle">
            Kepuasan pelanggan adalah prioritas Carani Estate
        </p>

        <div class="testimoni-wrapper">
            <button class="slide-btn left" onclick="slideTestimoni(-1)">❮</button>

            <div class="testimoni-slider" id="testimoniSlider">
                <div class="testimoni-card">
                    <p class="testimoni-text">
                        “Pelayanan sangat profesional dan membantu kami menemukan rumah impian.”
                    </p>
                    <div class="testimoni-user">
                        <div class="user-avatar">
                            <img src="img/user-budi.jpg" alt="Budi Santoso">
                        </div>
                        <div>
                            <h4>Andi Pratama</h4>
                            <span>Pembeli Rumah</span>
                        </div>
                    </div>
                </div>

                <div class="testimoni-card">
                    <p class="testimoni-text">
                        “Website mudah digunakan dan informasinya lengkap.”
                    </p>
                    <div class="testimoni-user">
                        <div class="user-avatar">
                            <img src="img/user-budi.jpg" alt="Budi Santoso">
                        </div>
                        <div>
                            <h4>Siti Rahma</h4>
                            <span>Klien Properti</span>
                        </div>
                    </div>
                </div>

                <div class="testimoni-card">
                    <p class="testimoni-text">
                        “Proses pencarian properti jadi cepat dan transparan.”
                    </p>
                    <div class="testimoni-user">
                        <div class="user-avatar">
                            <img src="img/user-budi.jpg" alt="Budi Santoso">
                        </div>
                        <div>
                            <h4>Budi Santoso</h4>
                            <span>Investor</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimoni-card">
                    <p class="testimoni-text">
                        “Proses pencarian properti jadi cepat dan transparan.”
                    </p>
                    <div class="testimoni-user">
                        <div class="user-avatar">
                            <img src="img/user-budi.jpg" alt="Budi Santoso">
                        </div>
                        <div>
                            <h4>Noera</h4>
                            <span>Investor</span>
                        </div>
                    </div>
                </div>
            </div>

            <button class="slide-btn right" onclick="slideTestimoni(1)">❯</button>
        </div>
    </div>
</section>


    
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
                        <p><i class="fas fa-map-marker-alt"></i> Jl. Melati No. 45, Jakarta Selatan</p>
                        <p><i class="fas fa-phone"></i> 0812-3456-7890</p>
                        <p><i class="fas fa-envelope"></i> info@propertiharmoni.com</p>
                        <p><i class="fas fa-clock"></i> Senin - Sabtu: 08:00 - 17:00</p>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                &copy; 2025 PropertiHarmoni. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Add active state to nav items based on scroll position
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section');
            const navItems = document.querySelectorAll('.nav-item');
            
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.clientHeight;
                
                if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });
            
            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href').includes(current)) {
                    item.classList.add('active');
                }
            });
        });
        
        // Mobile menu toggle (for smaller screens)
        // In this implementation, we're keeping the navigation visible for desktop
        // For mobile, you would typically add a hamburger menu
        
        // Form validation for contact form (if added later)
        // This is just a placeholder for future implementation
        
        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px"
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Animate elements when they come into view
        document.querySelectorAll('.feature-card, .about-content, .section-title').forEach(el => {
            el.style.opacity = 0;
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>

    <!-- Script testimoni -->
     <script>
function slideTestimoni(direction) {
    const slider = document.getElementById('testimoniSlider');
    const scrollAmount = 360; // jarak geser
    slider.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}

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

        function toggleMenu(){
            document.getElementById('navMenu').classList.toggle('show');
        }
</script>

</body>
</html>