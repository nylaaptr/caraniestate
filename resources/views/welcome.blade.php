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
        
        /* ===============================
        SERVICES SECTION - 4 Grid
        =============================== */
        .services-section {
            padding: 100px 30px;
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        /* Background decorative elements */
        .services-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(122, 178, 211, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .services-section::after {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(30, 58, 95, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .services-section .container {
            position: relative;
            z-index: 1;
        }

        /* Section Header */
        .services-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 60px;
        }

        .services-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: var(--light-blue);
            color: var(--dark-blue);
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid rgba(122, 178, 211, 0.3);
        }

        .services-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .services-subtitle {
            font-size: 1.1rem;
            color: #64748b;
            line-height: 1.6;
        }

        /* Services Grid - 4 Columns */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 50px;
        }

        /* Service Card */
        .service-card {
            background: white;
            border-radius: 20px;
            padding: 35px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(226, 232, 240, 0.6);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-blue), var(--dark-blue));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(30, 58, 95, 0.12);
            border-color: rgba(122, 178, 211, 0.4);
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        /* Icon Wrapper with Glow Effect */
        .service-icon-wrapper {
            position: relative;
            width: 70px;
            height: 70px;
            margin-bottom: 25px;
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            transition: transform 0.3s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.05) rotate(-3deg);
        }

        .service-icon i {
            font-size: 1.8rem;
            color: white;
        }

        .service-icon-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(122, 178, 211, 0.4) 0%, transparent 70%);
            border-radius: 16px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .service-card:hover .service-icon-glow {
            opacity: 1;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.2; }
        }

        /* Service Title & Description */
        .service-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .service-description {
            font-size: 0.95rem;
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        /* Service List */
        .service-list {
            list-style: none;
            padding: 0;
            margin: 0 0 25px 0;
        }

        .service-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 6px 0;
            font-size: 0.9rem;
            color: #4a5568;
        }

        .service-list li i {
            color: var(--primary-blue);
            font-size: 0.85rem;
            margin-top: 4px;
            flex-shrink: 0;
        }

        /* Service Link */
        .service-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--dark-blue);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            padding: 10px 0;
            transition: all 0.3s ease;
            position: relative;
            margin-top: auto;
        }

        .service-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-blue);
            transition: width 0.3s ease;
        }

        .service-link:hover {
            color: var(--primary-blue);
            gap: 12px;
        }

        .service-link:hover::after {
            width: 100%;
        }

        .service-link i {
            font-size: 0.85rem;
            transition: transform 0.3s ease;
        }

        .service-link:hover i {
            transform: translateX(4px);
        }

        /* Bottom CTA */
        .services-cta {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(226, 232, 240, 0.6);
            max-width: 600px;
            margin: 0 auto;
        }

        .services-cta p {
            font-size: 1.1rem;
            color: var(--dark-blue);
            margin-bottom: 20px;
            font-weight: 500;
        }

        .btn-services-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 35px;
            background: linear-gradient(135deg, var(--dark-blue), #2a4a6f);
            color: white;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-services-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(30, 58, 95, 0.3);
            background: linear-gradient(135deg, #2a4a6f, var(--dark-blue));
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .services-section {
                padding: 80px 20px;
            }
            
            .services-title {
                font-size: 1.9rem;
            }
            
            .service-card {
                padding: 30px 25px;
            }
        }

        @media (max-width: 768px) {
            .services-section {
                padding: 60px 15px;
            }
            
            .services-header {
                margin-bottom: 45px;
            }
            
            .services-title {
                font-size: 1.7rem;
            }
            
            .services-subtitle {
                font-size: 1rem;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
            
            .service-icon-wrapper {
                width: 60px;
                height: 60px;
                margin: 0 auto 20px;
            }
            
            .service-icon {
                width: 60px;
                height: 60px;
                border-radius: 14px;
            }
            
            .service-icon i {
                font-size: 1.5rem;
            }
            
            .service-card {
                text-align: center;
            }
            
            .service-list {
                text-align: left;
                display: inline-block;
            }
            
            .service-link {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .services-title {
                font-size: 1.5rem;
            }
            
            .service-card {
                padding: 25px 20px;
            }
            
            .service-title {
                font-size: 1.2rem;
            }
            
            .btn-services-cta {
                width: 100%;
                justify-content: center;
            }
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

        /* ===============================
           FAQ SECTION STYLES
        ================================ */
        .faq-section {
            padding: 80px 30px;
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        }

        .faq-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .faq-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .faq-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .faq-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary-blue);
            border-radius: 2px;
        }

        .faq-subtitle {
            font-size: 1.1rem;
            color: #64748b;
            margin-top: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* FAQ Accordion */
        .faq-accordion {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .faq-item {
            border-bottom: 1px solid #e2e8f0;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            width: 100%;
            padding: 25px 30px;
            background: white;
            border: none;
            text-align: left;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-blue);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: var(--light-blue);
            color: var(--dark-blue);
        }

        .faq-question.active {
            background: var(--light-blue);
            color: var(--dark-blue);
        }

        .faq-question i {
            font-size: 1.2rem;
            color: var(--primary-blue);
            transition: transform 0.3s ease;
        }

        .faq-question.active i {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
            background: #fafbfc;
        }

        .faq-answer-content {
            padding: 0 30px 25px 30px;
            color: #4a5568;
            line-height: 1.7;
            font-size: 1rem;
        }

        .faq-answer-content ul {
            padding-left: 20px;
            margin: 10px 0;
        }

        .faq-answer-content li {
            margin-bottom: 8px;
        }

        .faq-answer-content a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
        }

        .faq-answer-content a:hover {
            text-decoration: underline;
        }

        /* FAQ Categories */
        .faq-categories {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .faq-category-btn {
            padding: 10px 25px;
            border: 2px solid var(--primary-blue);
            border-radius: 25px;
            background: white;
            color: var(--dark-blue);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .faq-category-btn:hover,
        .faq-category-btn.active {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }

        /* Contact CTA */
        .faq-contact {
            background: linear-gradient(135deg, var(--dark-blue) 0%, #2a4a6f 100%);
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            margin-top: 50px;
            color: white;
        }

        .faq-contact h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .faq-contact p {
            margin-bottom: 25px;
            opacity: 0.9;
        }

        .faq-contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 35px;
            background: var(--primary-blue);
            color: white;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .faq-contact-btn:hover {
            background: #6aa5c6;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(122, 178, 211, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .faq-section {
                padding: 60px 20px;
            }

            .faq-title {
                font-size: 2rem;
            }

            .faq-question {
                padding: 20px;
                font-size: 1rem;
            }

            .faq-answer-content {
                padding: 0 20px 20px 20px;
            }

            .faq-categories {
                flex-direction: column;
                align-items: center;
            }

            .faq-category-btn {
                width: 100%;
                max-width: 300px;
            }

            .faq-contact {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .faq-title {
                font-size: 1.75rem;
            }

            .faq-question {
                padding: 18px;
            }
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

            .faq-section {
                padding: 60px 20px;
            }

            .faq-title {
                font-size: 2rem;
            }

            .faq-question {
                padding: 20px;
                font-size: 1rem;
            }

            .faq-answer-content {
                padding: 0 20px 20px 20px;
            }

            .faq-categories {
                flex-direction: column;
                align-items: center;
            }

            .faq-category-btn {
                width: 100%;
                max-width: 300px;
            }

            .faq-contact {
                padding: 30px 20px;
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
    
                {{-- Notifikasi hanya muncul kalau sudah login --}}
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

                {{-- Conditional: Guest vs Authenticated --}}
                @guest
                    <a href="{{ route('login') }}" class="nav-item login-link">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @else
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
        <form class="property-search-card" 
            action="{{ route('halaman-katalog') }}" 
            method="GET">
            <h3 class="search-title">Cari Properti</h3>

            <div class="search-row">
                <div>
                    <label>Kategori</label>
                    <select name="kategori">
                        <option value="">Semua Kategori</option>
                        <option value="subsidi" {{ request('kategori') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                        <option value="komersial" {{ request('kategori') == 'komersial' ? 'selected' : '' }}>Komersial</option>
                    </select>
                </div>

                <div>
                    <label>Tipe</label>
                    <select name="jenis">
                        <option value="">Pilih Tipe</option>
                        <option value="rumah" {{ request('jenis') == 'rumah' ? 'selected' : '' }}>Rumah</option>
                        <option value="ruko" {{ request('jenis') == 'ruko' ? 'selected' : '' }}>Ruko</option>
                    </select>
                </div>
            </div>

            <div class="search-row">
                <div>
                    <label>Harga</label>
                    <select name="harga">
                        <option value="">Rentang Harga</option>
                        <option value="0-200" {{ request('harga') == '0-200' ? 'selected' : '' }}>≤ 200 Juta</option>
                        <option value="200-300" {{ request('harga') == '200-300' ? 'selected' : '' }}>200 - 300 Juta</option>
                        <option value="300-500" {{ request('harga') == '300-500' ? 'selected' : '' }}>300 - 500 Juta</option>
                        <option value="500+" {{ request('harga') == '500+' ? 'selected' : '' }}>≥ 500 Juta</option>
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
    
    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            
            <!-- Section Header -->
            <div class="services-header">
                <span class="services-badge">Layanan Kami</span>
                <h2 class="services-title">Solusi Properti Terlengkap untuk Anda</h2>
                <p class="services-subtitle">
                    Kami menyediakan layanan end-to-end untuk membantu Anda menemukan, membeli, dan mengelola properti impian dengan mudah dan aman.
                </p>
            </div>

            <!-- Services Grid (4 Cards) -->
            <div class="services-grid">
                
                <!-- Service 1: Konsultasi via ChatBot -->
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="service-icon-glow"></div>
                    </div>
                    <h3 class="service-title">Konsultasi via ChatBot</h3>
                    <p class="service-description">
                        Tanya jawab instan seputar properti, KPR, dan layanan kami melalui ChatBot AI yang siap membantu 24/7.
                    </p>
                    <ul class="service-list">
                        <li><i class="fas fa-check"></i> Jawaban instan 24 jam</li>
                        <li><i class="fas fa-check"></i> Panduan langkah demi langkah</li>
                        <li><i class="fas fa-check"></i> Rekomendasi properti personal</li>
                    </ul>
                    <a href="{{ route('halaman-chatbot') }}" class="service-link">
                        Open chatbot <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Service 2: Pencarian Properti -->
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="fas fa-search-location"></i>
                        </div>
                        <div class="service-icon-glow"></div>
                    </div>
                    <h3 class="service-title">Pencarian Properti Cerdas</h3>
                    <p class="service-description">
                        Temukan properti impian dengan filter canggih: lokasi, harga, tipe, fasilitas, dan masih banyak lagi.
                    </p>
                    <ul class="service-list">
                        <li><i class="fas fa-check"></i> Filter multi-kriteria</li>
                        <li><i class="fas fa-check"></i> Peta interaktif lokasi</li>
                        <li><i class="fas fa-check"></i> Notifikasi properti baru</li>
                    </ul>
                    <a href="{{ route('halaman-katalog') }}" class="service-link">
                        Mulai Cari <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Service 3: Bantuan KPR -->
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="service-icon-glow"></div>
                    </div>
                    <h3 class="service-title">Pendampingan KPR</h3>
                    <p class="service-description">
                        Kami bantu proses pengajuan KPR Anda dari awal hingga cair, dengan bank partner terpercaya.
                    </p>
                    <ul class="service-list">
                        <li><i class="fas fa-check"></i> Simulasi cicilan gratis</li>
                        <li><i class="fas fa-check"></i> Bantuan dokumen lengkap</li>
                        <li><i class="fas fa-check"></i> Proses cepat 7-14 hari</li>
                    </ul>
                    <a href="{{ route('login') }}" class="service-link">
                        Ajukan KPR <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Service 4: Verifikasi & After-Sales -->
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="service-icon-glow"></div>
                    </div>
                    <h3 class="service-title">Verifikasi & Garansi</h3>
                    <p class="service-description">
                        Semua properti telah diverifikasi legalitasnya, plus garansi bangunan dan layanan purna jual terbaik.
                    </p>
                    <ul class="service-list">
                        <li><i class="fas fa-check"></i> Cek sertifikat & IMB</li>
                        <li><i class="fas fa-check"></i> Garansi struktur 5 tahun</li>
                        <li><i class="fas fa-check"></i> Tim maintenance responsif</li>
                    </ul>
                    <a href="{{ route('halaman-kontak') }}" class="service-link">
                        Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

            </div>

            <!-- CTA Bottom -->
            <div class="services-cta">
                <p>Butuh bantuan lebih lanjut? Tim kami siap membantu Anda!</p>
                <a href="{{ route('halaman-chatbot') }}" class="btn-services-cta">
                    <i class="fas fa-comments me-2"></i>Chat dengan Kami
                </a>
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

<!-- FAQ Section -->
    <section class="faq-section">
        <div class="faq-container">
            
            <!-- Header -->
            <div class="faq-header">
                <h2 class="faq-title">Pertanyaan yang Sering Diajukan</h2>
                <p class="faq-subtitle">
                    Temukan jawaban untuk pertanyaan umum seputar pembelian properti, KPR, dan layanan Carani Estate.
                </p>
            </div>

            <!-- Category Filter -->
            <div class="faq-categories">
                <button class="faq-category-btn" data-category="umum">
                    <i class="fas fa-info-circle me-2"></i>Umum
                </button>
                <button class="faq-category-btn" data-category="pembelian">
                    <i class="fas fa-home me-2"></i>Pembelian
                </button>
                <button class="faq-category-btn" data-category="kpr">
                    <i class="fas fa-university me-2"></i>KPR
                </button>
            </div>

            <!-- FAQ Accordion -->
            <div class="faq-accordion">
                
                <!-- FAQ Item 1 -->
                <div class="faq-item" data-category="pembelian">
                    <button class="faq-question">
                        <span>Bagaimana cara membeli properti di Carani Estate?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Proses pembelian properti di Carani Estate sangat mudah:</p>
                            <ul>
                                <li><strong>Pilih Properti:</strong> Browse katalog properti di website kami</li>
                                <li><strong>Booking:</strong> Isi form pemesanan dan bayar DP minimal 10%</li>
                                <li><strong>Pilih Pembayaran:</strong> Cash, KPR, atau cicilan ke developer</li>
                                <li><strong>Tanda Tangan:</strong> PPJB dengan developer</li>
                                <li><strong>Serah Terima:</strong> Terima kunci setelah pembayaran lunas</li>
                            </ul>
                            <p>Timbangan kami akan memandu Anda di setiap langkah proses.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item" data-category="kpr">
                    <button class="faq-question">
                        <span>Apa syarat mengajukan KPR di Carani Estate?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Syarat umum pengajuan KPR:</p>
                            <ul>
                                <li><strong>KTP:</strong> Suami & Istri (jika sudah menikah)</li>
                                <li><strong>Kartu Keluarga:</strong> Fotokopi KK</li>
                                <li><strong>Penghasilan:</strong> Slip gaji 3 bulan terakhir / rekening koran</li>
                                <li><strong>NPWP:</strong> Fotokopi NPWP pemohon</li>
                                <li><strong>Foto:</strong> Foto 3x4 & selfie 4R</li>
                                <li><strong>Dokumen Usaha:</strong> SIUP / surat keterangan usaha (untuk wiraswasta)</li>
                            </ul>
                            <p>Proses verifikasi KPR biasanya memakan waktu <strong>7-14 hari kerja</strong>.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item" data-category="pembelian">
                    <button class="faq-question">
                        <span>Berapa minimal DP untuk membeli properti?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Minimal DP tergantung metode pembayaran:</p>
                            <ul>
                                <li><strong>KPR Bank:</strong> 10% dari harga properti</li>
                                <li><strong>Cicilan Developer:</strong> 20% dari harga properti</li>
                                <li><strong>Cash Bertahap:</strong> 30% di awal, sisa dicicil 12x</li>
                                <li><strong>Hard Cash:</strong> 100% lunas (dapat diskon hingga 5%)</li>
                            </ul>
                            <p>Booking fee Rp 2-5 juta akan dikembalikan jika KPR disetujui bank.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item" data-category="kpr">
                    <button class="faq-question">
                        <span>Bank apa saja yang bekerja sama dengan Carani Estate?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Kami bekerja sama dengan berbagai bank terpercaya:</p>
                            <ul>
                                <li><strong>BTN</strong> - Spesialis KPR dengan bunga kompetitif</li>
                                <li><strong>Mandiri</strong> - Proses cepat dan fleksibel</li>
                                <li><strong>BCA</strong> - Suku bunga menarik untuk karyawan</li>
                                <li><strong>BRI</strong> - Pilihan tenor hingga 20 tahun</li>
                                <li><strong>BNI</strong> - Paket KPR syariah tersedia</li>
                            </ul>
                            <p>Tim kami akan membantu Anda memilih bank dengan penawaran terbaik.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq-item" data-category="umum">
                    <button class="faq-question">
                        <span>Apakah sertifikat properti sudah SHM?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Ya, semua properti di Carani Estate memiliki:</p>
                            <ul>
                                <li><strong>Sertifikat Hak Milik (SHM)</strong> - Untuk rumah tapak</li>
                                <li><strong>Sertifikat Strata Title</strong> - Untuk apartemen</li>
                                <li><strong>IMB (Izin Mendirikan Bangunan)</strong> lengkap</li>
                                <li><strong>BPHTB & Pajak</strong> sudah termasuk (untuk promo tertentu)</li>
                            </ul>
                            <p>Sertifikat akan diproses setelah pembayaran lunas dan dapat diambil di notaris.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="faq-item" data-category="pembelian">
                    <button class="faq-question">
                        <span>Berapa lama proses sampai serah terima kunci?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Timeline bervariasi tergantung kondisi properti:</p>
                            <ul>
                                <li><strong>Properti Ready Stock:</strong> 1-2 bulan setelah pembayaran lunas</li>
                                <li><strong>Properti Inden:</strong> 6-12 bulan dari waktu booking</li>
                                <li><strong>KPR:</strong> Tambah 2-3 minggu untuk proses akad & pencairan</li>
                            </ul>
                            <p>Kami akan memberikan update progres pembangunan secara berkala via WhatsApp/email.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 7 -->
                <div class="faq-item" data-category="umum">
                    <button class="faq-question">
                        <span>Apakah ada garansi untuk properti yang dibeli?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Ya, kami memberikan garansi:</p>
                            <ul>
                                <li><strong>Garansi Struktur:</strong> 5 tahun untuk kerusakan struktur utama</li>
                                <li><strong>Garansi Atap & Dinding:</strong> 2 tahun untuk kebocoran/retak</li>
                                <li><strong>Garansi Instalasi:</strong> 1 tahun untuk listrik & plumbing</li>
                            </ul>
                            <p>Layanan purna jual kami siap membantu jika ada kendala setelah serah terima.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 8 -->
                <div class="faq-item" data-category="kpr">
                    <button class="faq-question">
                        <span>Berapa bunga KPR yang ditawarkan?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Suku bunga KPR bervariasi:</p>
                            <ul>
                                <li><strong>Fixed Rate:</strong> 6.5% - 8.5% (3 tahun pertama)</li>
                                <li><strong>Floating Rate:</strong> Sesuai BI Rate + spread (setelah periode fixed)</li>
                                <li><strong>KPR Syariah:</strong> Margin 7% - 9% flat hingga lunas</li>
                            </ul>
                            <p>Bunga dapat berubah sesuai kebijakan bank. Kami akan berikan simulasi cicilan detail sebelum pengajuan.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 9 -->
                <div class="faq-item" data-category="pembelian">
                    <button class="faq-question">
                        <span>Apakah bisa membatalkan pemesanan?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Pembatalan dapat dilakukan dengan ketentuan:</p>
                            <ul>
                                <li><strong>Sebelum PPJB:</strong> Booking fee dikembalikan 100%</li>
                                <li><strong>Setelah PPJB:</strong> DP dikembalikan 50-80% (sesuai perjanjian)</li>
                                <li><strong>KPR Ditolak:</strong> DP dikembalikan penuh (jika syarat lengkap)</li>
                            </ul>
                            <p>Silakan hubungi tim kami untuk proses pembatalan.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 10 -->
                <div class="faq-item" data-category="umum">
                    <button class="faq-question">
                        <span>Bagaimana cara menghubungi tim Carani Estate?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Anda dapat menghubungi kami melalui:</p>
                            <ul>
                                <li><strong>WhatsApp:</strong> 0812-3456-7890 (24/7)</li>
                                <li><strong>Email:</strong> info@caraniestate.com</li>
                                <li><strong>Kantor:</strong> Jl. Melati No. 45, Bondowoso, Jawa Timur</li>
                                <li><strong>Live Chat:</strong> Tersedia di website (08:00 - 17:00 WIB)</li>
                            </ul>
                            <p>Tim marketing kami siap membantu konsultasi gratis!</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Contact CTA -->
            <div class="faq-contact">
                <h3>Masih Punya Pertanyaan?</h3>
                <p>Tim kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami!</p>
                <a href="https://wa.me/6281234567890" class="faq-contact-btn" target="_blank">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
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

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ Accordion Functionality
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const isActive = this.classList.contains('active');
                    
                    // Close all other FAQs
                    faqQuestions.forEach(q => {
                        q.classList.remove('active');
                        q.nextElementSibling.style.maxHeight = '0';
                        q.nextElementSibling.style.padding = '0 30px 0 30px';
                    });
                    
                    // Toggle current FAQ
                    if (!isActive) {
                        this.classList.add('active');
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        answer.style.padding = '0 30px 25px 30px';
                    }
                });
            });
            
            // Category Filter
            const categoryBtns = document.querySelectorAll('.faq-category-btn');
            const faqItems = document.querySelectorAll('.faq-item');
            
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active button
                    categoryBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const category = this.dataset.category;
                    
                    // Filter FAQs
                    faqItems.forEach(item => {
                        if (category === 'all' || item.dataset.category === category) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
            
            // Auto-expand first FAQ (optional)
            // faqQuestions[0].click();
        });
    </script>

</body>
</html>