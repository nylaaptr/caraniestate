<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Properti - PropertiHarmoni</title>
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
        
        /* Property Detail Page */
        /* Property Detail Page */ 
        .property-detail { 
            max-width: 1200px; 
            margin: 0 auto; 
        } 
        
        .property-header { 
            display: grid; 
            grid-template-columns: 2fr 1fr; 
            gap: 30px; 
            margin-bottom: 30px; 
        } 
        
        /* Image Gallery */ 
        .image-gallery { 
            background: white; 
            border-radius: 16px; 
            overflow: hidden; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            position: relative; 
        } 

        /* Panah */
        .gallery-arrow {
            position: absolute;
            top: 25%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s ease;
            z-index: 10;
        }

        .gallery-arrow:hover {
            background: rgba(0,0,0,0.8);
        }

        .arrow-left {
            left: 15px;
        }

        .arrow-right {
            right: 15px;
        }
        
        .main-image { 
            width: 100%; 
            height: 500px; 
            object-fit: cover; 
            display: block; 
        } 
        
        .thumbnail-grid { 
            display: grid; 
            grid-template-columns: repeat(5, 1fr); 
            gap: 10px; 
            padding: 15px; 
            background: #f8fafc; 
        } 
        
        .thumbnail { 
            height: 60px; 
            border-radius: 8px; 
            overflow: hidden; 
            cursor: pointer; 
            transition: all 0.3s ease; 
            border: 2px solid transparent; 
        } 
        
        .thumbnail:hover { 
            transform: scale(1.05); 
            border-color: var(--primary-blue); 
        } 
        
        .thumbnail.active { 
            border-color: var(--primary-blue); 
            transform: scale(1.05); 
        } 
        
        .thumbnail img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
        } 
        
        /* Property Info */ 
        .property-info { 
            background: white; 
            border-radius: 16px; 
            padding: 30px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
        } 
        
        .property-title { 
            font-size: 2.2rem; 
            font-weight: 700; 
            color: var(--dark-blue); 
            margin-bottom: 15px; 
        } 
        
        .property-location { 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            color: #64748b; 
            margin-bottom: 20px; 
            font-size: 1rem; 
        } 
        
        .property-location i { 
            color: var(--primary-blue); 
        } 
        
        .price-section { 
            color: var(--primary-blue); 
            padding: 0; 
            margin-top: 10px; /* atur jarak manual */ 
        } 
        
        .price-value { 
            font-size: 2rem; 
            font-weight: 800; 
            line-height: 1.2; 
        } 
        
        .price-label { 
            font-size: 1rem; 
            opacity: 0.9; 
        } 
        
        .property-specs { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); 
            gap: 20px; margin-bottom: 30px; 
        } 
        .spec-item { 
            text-align: center; 
            padding: 20px; 
            background: #f8fafc; 
            border-radius: 12px; 
            transition: all 0.3s ease; 
        } 

        .spec-item:hover { 
            background: white; 
            transform: translateY(-5px); 
            box-shadow: 0 4px 15px rgba(0,0,0,0.08); 
        } 
        
        .spec-value { 
            font-size: 1.8rem; 
            font-weight: 700; 
            color: var(--dark-blue); 
            margin-bottom: 8px; 
        } 
        
        .spec-label { 
            font-size: 0.9rem; 
            color: #64748b; 
        } 
        
        .contact-card { 
            background: white; 
            border-radius: 18px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08), 
            0 4px 10px rgba(0, 0, 0, 0.05); 
            transition: all 0.3s ease; 
        } 
        
        .contact-card:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12), 
            0 6px 15px rgba(0, 0, 0, 0.08); 
        } 
        
        .contact-section { 
            background: #f8fafc; 
            border-radius: 16px; 
            padding: 30px; 
        } 
        
        .contact-title { 
            font-size: 1.4rem; 
            font-weight: 700; 
            color: var(--dark-blue); 
            margin-bottom: 20px; 
            text-align: center; 
        } 
        .agent-info { 
            display: flex; 
            align-items: center; 
            gap: 20px; 
            margin-bottom: 20px; 
        } 
        
        .agent-avatar { 
            width: 80px; 
            height: 80px; 
            border-radius: 50%; 
            background: var(--primary-blue); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 32px; 
            font-weight: 700; 
            color: white; 
        } 
        
        .agent-details { 
            flex: 1; 
        } 
        
        .agent-name { 
            font-size: 1.2rem; 
            font-weight: 700; 
            color: var(--dark-blue);
            margin-bottom: 5px; 
        } 
        
        .agent-role { 
            color: #64748b; 
            margin-bottom: 10px; 
        } 
        
        .agent-rating { 
            display: flex; 
            align-items: center; 
            gap: 5px; 
            color: #f59e0b; 
        } 
        
        .agent-contact { 
            display: flex; 
            gap: 15px; 
            margin-top: 15px; 
        } 
        
        .contact-btn { 
            flex: 1; 
            padding: 14px; 
            border-radius: 12px; 
            font-weight: 600; 
            font-size: 1rem; 
            border: none; 
            cursor: pointer; 
            transition: all 0.3s ease; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            gap: 10px; 
        } 
        
        .btn-whatsapp { 
            background: #25D366; 
            color: white; 
        } 
        
        .btn-whatsapp:hover { 
            background: #128C7E; 
            transform: translateY(-2px); 
        } 

        .btn-call { 
            background: #3B82F6; 
            color: white; 
        } 
        
        .btn-call:hover { 
            background: #2563EB; 
            transform: translateY(-2px); 
        } 
        
        /* Description Section */ 
        .description-section { 
            background: white; 
            border-radius: 16px; 
            padding: 30px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
            margin-bottom: 0; 
        } 
        
        .description-title { 
            font-size: 1.4rem; 
            font-weight: 700; 
            color: var(--dark-blue); 
            margin-bottom: 20px; 
            padding-bottom: 10px; 
            border-bottom: 2px solid var(--primary-blue); 
        } 
        
        .description-content { 
            line-height: 1.7; 
            color: #4a5568; 
            font-size: 1.05rem; 
        }
        
        /* ===============================
                PROPERTY TABS
        ================================ */
        .property-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            margin-left: 25px; /* geser semua tombol ke kanan */
        }

        .tab-btn {
            padding: 10px 18px;
            border-radius: 10px;
            border: none;
            background: #f1f5f9;
            color: #475569;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            margin-top: 15px;
            margin-left: 0px; /* ini yang bikin geser kanan */
        }

        .tab-btn.active {
            background: var(--primary-blue);
            color: white;
        }

        .tab-btn:hover {
            background: var(--primary-blue);
            color: white;
        }

        /* ===============================
        TAB CONTENT
        ================================ */
        .tab-content {
            background: white;
            border-radius: 16px;
            padding: 15px;
        }

        .tab-panel {
            display: none;
            line-height: 1.7;
            color: #4a5568;
            font-size: 1.05rem;
        }

        .tab-panel.active {
            display: block;
        }

        /* ===============================
        DESCRIPTION
        ================================ */
        .description-section {
            padding: 0;
        }

        .description-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-blue);
        }

        .description-content {
            line-height: 1.7;
            color: #4a5568;
            font-size: 1.05rem;
        }
        
        .price-section {
            color: var(--primary-blue);
            padding: 0;
            margin-top: 10px;        /* atur jarak manual */
        }
        
        .price-value {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
        }
        
        .price-label {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .property-specs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .spec-item {
            text-align: center;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .spec-item:hover {
            background: white;
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .spec-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 8px;
        }
        
        .spec-label {
            font-size: 0.9rem;
            color: #64748b;
        }

        .contact-card {
            background: white;
            border-radius: 18px;
            box-shadow: 
                0 4px 10px rgba(0, 0, 0, 0.08),
                0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-4px);
            box-shadow: 
                0 18px 40px rgba(0, 0, 0, 0.12),
                0 6px 15px rgba(0, 0, 0, 0.08);
        }

        
        .contact-section {
            background: #f8fafc;
            border-radius: 16px;
            padding: 30px;
        }
        
        .contact-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .agent-info {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .agent-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 700;
            color: white;
        }
        
        .agent-details {
            flex: 1;
        }
        
        .agent-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }
        
        .agent-role {
            color: #64748b;
            margin-bottom: 10px;
        }
        
        .agent-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #f59e0b;
        }
        
        .agent-contact {
            display: flex;
            gap: 15px;
            margin-top: 15px;
            text-decoration: none;
        }
        
        .contact-btn {
            flex: 1;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }
        
        .btn-whatsapp {
            background: #25D366;
            color: white;
        }
        
        .btn-whatsapp:hover {
            background: #128C7E;
            transform: translateY(-2px);
        }
        
        .btn-call {
            background: #3B82F6;
            color: white;
        }
        
        .btn-call:hover {
            background: #2563EB;
            transform: translateY(-2px);
        }
        
        /* Description Section */
        .description-section {
            background: white;
            padding: 30px;
            margin-bottom: 0;
        }
        
        .description-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-blue);
        }
        
        .description-content {
            line-height: 1.7;
            color: #4a5568;
            font-size: 1.05rem;
        }
        
        /* Similar Properties */
        .similar-properties {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 25px;
            text-align: center;
        }

        /* SLIDER WRAPPER */
        .slider-wrapper {
            position: relative;
            overflow: hidden;
        }
        
        .properties-grid {
            display: flex;
            gap: 25px;
            transition: transform 0.5s ease;
            scroll-behavior: smooth;
        }
        
        .property-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            background: white;
            min-width: 300px;
            flex-shrink: 0;
        }

        /* BUTTON SLIDER */

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border: none;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slider-btn i {
            font-size: 1rem;
            color: #1a365d;
        }

        .slider-prev {
            left: 10px;
        }

        .slider-next {
            right: 10px;
        }

        .slider-btn:hover {
            background: #f1f5f9;
        }
        
        .property-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        }
        
        .property-img {
            height: 180px;
            background: #f8fafc;
            position: relative;
        }
        
        .property-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .property-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
        }
        
        .badge-new {
            background: #10b981;
        }
        
        .property-info-card {
            padding: 20px;
        }
        
        .property-price-card {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 10px;
        }
        
        .property-title-card {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a365d;
            margin-bottom: 10px;
        }
        
        .property-location-card {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .property-details-card {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #4a5568;
        }
        
        .property-detail-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .property-detail-item i {
            color: var(--primary-blue);
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            text-decoration: none;
        }
        
        .action-btn {
            flex: 1;
            padding: 10px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-view {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-view:hover {
            background: #cbd5e0;
        }
        
        .btn-contact {
            background: var(--primary-blue);
            color: white;
        }
        
        .btn-contact:hover {
            background: #6aa5c6;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .property-header {
                grid-template-columns: 1fr;
            }
            
            .header {
                padding: 15px 20px;
            }
            
            .nav-menu {
                gap: 20px;
            }
            
            .nav-item {
                font-size: 0.9rem;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .thumbnail-grid {
                grid-template-columns: repeat(4, 1fr);
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
            
            .property-header {
                grid-template-columns: 1fr;
            }
            
            .main-image {
                height: 400px;
            }
            
            .thumbnail-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .property-specs {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .agent-info {
                flex-direction: column;
                text-align: center;
            }
            
            .agent-avatar {
                margin: 0 auto;
            }
            
            .agent-details {
                text-align: center;
            }
            
            .agent-contact {
                flex-direction: column;
            }
            
            .contact-btn {
                width: 100%;
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
            
            .property-title {
                font-size: 1.8rem;
            }
            
            .price-value {
                font-size: 2rem;
            }
            
            .property-specs {
                grid-template-columns: 1fr;
            }
            
            .thumbnail-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .property-img {
                height: 150px;
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
        <div class="property-detail"> 
            
            <!-- Property Header (GRID: Kiri Gambar+Tab, Kanan Info) --> 
            <div class="property-header"> 
                
                <!-- KOLOM KIRI: Image Gallery + Tabs --> 
                <div class="image-gallery"> 
                    <!-- Main Image -->
                    <img src="img/tipe36.jpg" alt="{{ $properti->nama_properti }}" class="main-image"> 
                    <button class="gallery-arrow arrow-left">&#10094;</button>
                    <button class="gallery-arrow arrow-right">&#10095;</button>

                    <!-- Thumbnail Grid -->
                    <div class="thumbnail-grid"> 
                        <div class="thumbnail active"> 
                            <img src="img/tipe36.jpg" alt="Tampak Depan"> 
                        </div> 
                        <div class="thumbnail"> 
                            <img src="img/tipe36.jpg" alt="Ruang Tamu"> 
                        </div> 
                        <div class="thumbnail"> 
                            <img src="img/tipe36.jpg" alt="Kamar Tidur"> 
                        </div> 
                        <div class="thumbnail"> 
                            <img src="img/tipe36.jpg" alt="Dapur"> 
                        </div> 
                        <div class="thumbnail"> 
                            <img src="img/tipe36.jpg" alt="Kamar Mandi"> 
                        </div> 
                    </div> 

                    <!-- ✅ TABS DI BAWAH GAMBAR (masih dalam .image-gallery) -->
                    <div style="padding: 15px 20px 0 20px;">
                        <div class="property-tabs">
                            <button class="tab-btn active" data-tab="overview">Overview</button>
                            <button class="tab-btn" data-tab="description">Deskripsi</button>
                            <button class="tab-btn" data-tab="address">Lokasi</button>
                        </div>
                        <div class="tab-content">
                            <div class="tab-panel active" id="overview">
                                <p style="margin:0; font-size:0.95rem;">
                                    {{ $properti->nama_properti }} adalah properti {{ $properti->jenis_properti }} 
                                    tipe {{ $properti->tipe_properti }} dengan luas {{ $properti->luas_bangunan }} m², 
                                    terletak di Blok {{ $properti->blok->nama_blok ?? '-' }}.
                                </p>
                            </div>
                            <div class="tab-panel" id="description">
                                <div class="description-section" style="padding:0; box-shadow:none; background:transparent;">
                                    <div class="description-content" style="font-size:0.95rem;">
                                        <p style="margin:10px 0;">
                                            {{ $properti->nama_properti }} merupakan properti {{ $properti->jenis_properti }} 
                                            kategori {{ $properti->kategori_properti }}.
                                        </p>
                                        <ul style="padding-left:20px; margin:10px 0;">
                                            <li>Luas Bangunan: {{ $properti->luas_bangunan }} m²</li>
                                            <li>Luas Tanah: {{ $properti->luas_tanah }} m²</li>
                                            <li>Tipe: {{ $properti->tipe_properti }}</li>
                                            <li>Blok: {{ $properti->blok->nama_blok ?? '-' }}</li>
                                            <li>Status: {{ ucfirst($properti->status_unit) }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-panel" id="address">
                                <p style="margin:10px 0;"><i class="fas fa-map-marker-alt"></i> Bondowoso, Jawa Timur</p>
                                <p style="margin:5px 0;"><strong>Blok:</strong> {{ $properti->blok->nama_blok ?? '-' }}</p>
                                @if($properti->perumahan)
                                    <p style="margin:5px 0;"><strong>Perumahan:</strong> {{ $properti->perumahan->nama_perumahan }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div> <!-- ✅ TUTUP .image-gallery -->

                <!-- KOLOM KANAN: Property Info (SIDEBAR) -->
                <div class="property-info">
                    <!-- Contact Section -->
                    <div class="contact-section">
                        <h3 class="contact-title">Hubungi Agen Properti</h3>
                        <div class="agent-info">
                            <div class="agent-avatar">A</div>
                            <div class="agent-details">
                                <div class="agent-name">Admin Carani Estate</div>
                                <div class="agent-role">Konsultan Properti</div>
                                <div class="agent-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span>5.0</span>
                                </div>
                                <div class="agent-contact">
                                    <a href="tel:+6281234567890" class="contact-btn btn-call">
                                        <i class="fas fa-phone"></i> Hubungi
                                    </a>
                                    <a href="https://wa.me/6281234567890" class="contact-btn btn-whatsapp">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h1 class="property-title">{{ $properti->nama_properti }}</h1>
                    
                    <!-- ✅ LOKASI + BLOK -->
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Bondowoso | Blok {{ $properti->blok->nama_blok ?? '-' }}</span>
                    </div>
                    
                    <div class="price-section">
                        <div class="price-value">Rp {{ number_format($properti->harga_properti, 0, ',', '.') }}</div>
                        <div class="price-label">Harga Jual</div>
                    </div>
                    <div class="buy-section" style="margin-top:25px; margin-bottom:25px; display:flex; gap:15px;">
                        @auth
                            <a href="{{ route('form-pemesanan', $properti->id_properti) }}" 
                            class="contact-btn"
                            style="background:var(--dark-blue); color:white; border-radius:12px; 
                                    padding:14px; font-weight:600; text-decoration:none;
                                    display:flex; align-items:center; justify-content:center; gap:10px; width:100%;">
                                <i class="fas fa-shopping-cart"></i> Beli Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}" 
                            class="contact-btn"
                            style="background:var(--dark-blue); color:white; border-radius:12px; 
                                    padding:14px; font-weight:600; text-decoration:none;
                                    display:flex; align-items:center; justify-content:center; gap:10px; width:100%;">
                                <i class="fas fa-sign-in-alt"></i> Login untuk Beli
                            </a>
                        @endauth
                    </div>
                    <div class="property-specs">
                        <div class="spec-item">
                            <div class="spec-value">{{ $properti->luas_bangunan }}</div>
                            <div class="spec-label">Luas Bangunan (m²)</div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-value">{{ $properti->luas_tanah }}</div>
                            <div class="spec-label">Luas Tanah (m²)</div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-value">{{ $properti->tipe_properti }}</div>
                            <div class="spec-label">Tipe</div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-value">{{ $properti->blok->nama_blok ?? '-' }}</div>
                            <div class="spec-label">Blok</div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-value">{{ $properti->stok_unit }}</div>
                            <div class="spec-label">Stok Unit</div>
                        </div>
                        <div class="spec-item">
                            @php
                                if ($properti->status_unit == 'tersedia') {
                                    $statusWarna = 'color:#059669';
                                } elseif ($properti->status_unit == 'dipesan') {
                                    $statusWarna = 'color:#f59e0b';
                                } else {
                                    $statusWarna = 'color:#dc2626';
                                }
                            @endphp
                            <div class="spec-value" style="font-size:1rem; {{ $statusWarna }}">
                                {{ ucfirst($properti->status_unit) }}
                            </div>
                            <div class="spec-label">Status</div>
                        </div>
                    </div>
                </div> <!-- ✅ TUTUP .property-info -->

            </div> <!-- ✅ TUTUP .property-header -->

            <!-- Similar Properties (FULL WIDTH - di bawah header) -->
            <div class="similar-properties" style="margin-top:30px;">
                <h2 class="section-title">Properti Serupa</h2>
                <div class="slider-wrapper">
                    <button class="slider-btn slider-prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="properties-grid">
                        @php
                            $serupaList = \App\Models\Properti::with('blok')
                                ->where('tipe_properti', $properti->tipe_properti)
                                ->where('id_properti', '!=', $properti->id_properti)
                                ->limit(5)->get();
                        @endphp
                        @foreach($serupaList as $serupa)
                        @php
                            if ($serupa->status_unit == 'tersedia') {
                                $badgeColor = '#10b981';
                            } elseif ($serupa->status_unit == 'dipesan') {
                                $badgeColor = '#f59e0b';
                            } else {
                                $badgeColor = '#dc2626';
                            }
                        @endphp
                        <div class="property-card">
                            <div class="property-img">
                                <img src="{{ asset('img/tipe36.jpg') }}" alt="{{ $serupa->nama_properti }}">
                                <div class="property-badge" style="background:{{ $badgeColor }}">
                                    {{ ucfirst($serupa->status_unit) }}
                                </div>
                            </div>
                            <div class="property-info-card">
                                <div class="property-price-card">
                                    Rp {{ number_format($serupa->harga_properti, 0, ',', '.') }}
                                </div>
                                <h3 class="property-title-card">{{ $serupa->nama_properti }}</h3>
                                
                                <!-- ✅ LOKASI + BLOK di kartu serupa -->
                                <div class="property-location-card">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    <span>Blok {{ $serupa->blok->nama_blok ?? '-' }}, Bondowoso</span>
                                </div>
                                
                                <div class="property-details-card">
                                    <div class="property-detail-item">
                                        <i class="fas fa-ruler-combined"></i> {{ $serupa->tipe_properti }}
                                    </div>
                                    <div class="property-detail-item">
                                        <i class="fas fa-tag"></i> {{ $serupa->kategori_properti }}
                                    </div>
                                </div>
                                <div class="action-buttons">
                                    <a href="{{ route('detail-katalog', $serupa->id_properti) }}" 
                                    class="action-btn btn-view">Lihat Detail</a>
                                    @auth
                                        <a href="{{ route('form-pemesanan', $serupa->id_properti) }}" 
                                        class="action-btn btn-contact">Pesan</a>
                                    @else
                                        <a href="{{ route('login') }}?redirect={{ urlencode(route('detail-katalog', $serupa->id_properti)) }}" 
                                        class="action-btn btn-contact">Login</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="slider-btn slider-next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div> <!-- ✅ TUTUP .similar-properties -->

        </div> <!-- ✅ TUTUP .property-detail -->
    </div> <!-- ✅ TUTUP .main-content -->




    <script>
        // Thumbnail gallery functionality
        document.querySelectorAll('.thumbnail').forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                const mainImage = document.querySelector('.main-image');
                const src = this.querySelector('img').src;
                mainImage.src = src;
            });
        });
        
        // Contact buttons
        document.querySelectorAll('.contact-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const action = this.textContent.trim();
                if (action.includes('WhatsApp')) {
                    alert('Mengarahkan ke WhatsApp...');
                } else if (action.includes('Hubungi')) {
                    alert('Mengarahkan ke panggilan telepon...');
                }
            });
        });
        
        // Action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.textContent.trim();
                const propertyTitle = this.closest('.property-card').querySelector('.property-title-card').textContent;
                
                if (action === 'Lihat Detail') {
                    alert(`Menampilkan detail properti: ${propertyTitle}`);
                } else if (action === 'Hubungi') {
                    alert(`Menghubungi agen untuk properti: ${propertyTitle}`);
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabButtons = document.querySelectorAll(".tab-btn");
            const tabPanels = document.querySelectorAll(".tab-panel");

            tabButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const targetTab = button.getAttribute("data-tab");

                    // reset semua tab
                    tabButtons.forEach(btn => btn.classList.remove("active"));
                    tabPanels.forEach(panel => panel.classList.remove("active"));

                    // aktifkan tab & konten yg diklik
                    button.classList.add("active");
                    document.getElementById(targetTab).classList.add("active");
                });
            });
        });

        // TOGGLE NAV
        function toggleMenu(){
            document.getElementById('navMenu').classList.toggle('show');
        }

        // PROFILE DROPDOWN
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }

        // Tutup dropdown kalau klik di luar
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.profile-dropdown')) {
                document.getElementById('dropdownMenu').classList.remove('show');
            }
        });
    </script>

    <!-- JavaScript untuk Thumbnail & Tabs -->
<script>
    // Thumbnail gallery
    document.querySelectorAll('.thumbnail').forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const mainImage = document.querySelector('.main-image');
            const src = this.querySelector('img').src;
            mainImage.src = src;
        });
    });

    // Tab functionality
    document.addEventListener("DOMContentLoaded", function () {
        const tabButtons = document.querySelectorAll(".tab-btn");
        const tabPanels = document.querySelectorAll(".tab-panel");

        tabButtons.forEach(button => {
            button.addEventListener("click", () => {
                const targetTab = button.getAttribute("data-tab");
                tabButtons.forEach(btn => btn.classList.remove("active"));
                tabPanels.forEach(panel => panel.classList.remove("active"));
                button.classList.add("active");
                document.getElementById(targetTab).classList.add("active");
            });
        });
    });

    // Slider functionality
    document.querySelector('.slider-prev')?.addEventListener('click', function() {
        document.querySelector('.properties-grid')?.scrollBy({ left: -325, behavior: 'smooth' });
    });
    document.querySelector('.slider-next')?.addEventListener('click', function() {
        document.querySelector('.properties-grid')?.scrollBy({ left: 325, behavior: 'smooth' });
    });
</script>

</body>
</html>