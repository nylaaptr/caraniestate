<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serah Terima - Carani Estate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fontsource-roboto@5.1.0/index.min.css" rel="stylesheet">
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
            max-width: 1400px;
            margin: 0 auto;
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
            position: relative;
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
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px;
            }
            
            .logo-text {
                display: none;
            }
            
            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .menu-toggle{
                display: block;
                color: white;
                order: 2;
            }
            
            .nav-menu {
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

            .user-actions {
                gap: 15px;
            }
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 100px 20px 40px;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
            font-size: 0.9rem;
            color: #64748b;
        }

        .breadcrumb a {
            color: var(--primary-blue);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: var(--dark-blue);
        }

        .breadcrumb-sep {
            color: #cbd5e1;
        }

        .breadcrumb-current {
            color: #334155;
            font-weight: 600;
        }

        /* Page Title */
        .page-title-section {
            margin-bottom: 25px;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: var(--primary-blue);
        }

        .page-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Info Banner */
        .info-banner {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 20px;
            background: linear-gradient(135deg, #dbeafe, #e0f2fe);
            border-radius: 14px;
            border: 1px solid #93c5fd;
            margin-bottom: 30px;
        }

        .info-banner-icon {
            width: 45px;
            height: 45px;
            background: var(--primary-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .info-banner-content h3 {
            font-size: 1rem;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }

        .info-banner-content p {
            font-size: 0.85rem;
            color: #475569;
            line-height: 1.5;
        }

        /* Steps Progress */
        .steps-progress {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 35px;
            padding: 25px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .step-circle.completed {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
        }

        .step-circle.current {
            background: linear-gradient(135deg, var(--dark-blue), #2563eb);
            color: white;
            box-shadow: 0 0 0 4px rgba(122, 178, 211, 0.3);
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 4px rgba(122, 178, 211, 0.3); }
            50% { box-shadow: 0 0 0 8px rgba(122, 178, 211, 0.1); }
            100% { box-shadow: 0 0 0 4px rgba(122, 178, 211, 0.3); }
        }

        .step-circle.pending {
            background: #e2e8f0;
            color: #94a3b8;
        }

        .step-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #64748b;
            text-align: center;
            max-width: 100px;
        }

        .step-item.active .step-label {
            color: var(--dark-blue);
        }

        .step-item.completed .step-label {
            color: #27ae60;
        }

        .step-line {
            width: 60px;
            height: 3px;
            background: #e2e8f0;
            border-radius: 2px;
            margin: 0 15px;
            margin-bottom: 30px;
        }

        .step-line.completed {
            background: linear-gradient(90deg, #27ae60, #2ecc71);
        }

        .step-line.active {
            background: linear-gradient(90deg, #27ae60, var(--primary-blue));
        }

        /* Layout Grid */
        .handover-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 25px;
            align-items: start;
        }

        @media (max-width: 992px) {
            .handover-layout {
                grid-template-columns: 1fr;
            }
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .card-header {
            padding: 22px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark-blue);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--primary-blue);
        }

        .card-body {
            padding: 22px;
        }

        /* Handover Type Cards */
        .handover-types {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        @media (max-width: 600px) {
            .handover-types {
                grid-template-columns: 1fr;
            }
        }

        .handover-type-card {
            padding: 20px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            position: relative;
        }

        .handover-type-card:hover {
            border-color: var(--primary-blue);
            background: rgba(122, 178, 211, 0.05);
            transform: translateY(-2px);
        }

        .handover-type-card.selected {
            border-color: var(--primary-blue);
            background: rgba(122, 178, 211, 0.08);
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15);
        }

        .handover-type-card.completed {
            border-color: #27ae60;
            background: rgba(46, 204, 113, 0.05);
        }

        .type-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 1.3rem;
        }

        .type-icon.sertifikat { background: rgba(122, 178, 211, 0.12); color: var(--primary-blue); }
        .type-icon.baliknama { background: rgba(155, 89, 182, 0.12); color: #9b59b6; }
        .type-icon.kunci { background: rgba(243, 156, 18, 0.12); color: #f39c12; }

        .type-name {
            font-weight: 700;
            color: var(--dark-blue);
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .type-desc {
            font-size: 0.78rem;
            color: #94a3b8;
        }

        .type-check {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: white;
        }

        .type-check.done {
            background: #27ae60;
        }

        .type-check.not-done {
            background: #e2e8f0;
            color: #94a3b8;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.3s;
            color: #1e293b;
            background: white;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-hint {
            font-size: 0.78rem;
            color: #94a3b8;
            margin-top: 4px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 500px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Time Slots */
        .time-slots-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 10px;
        }

        .time-slots {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }

        @media (max-width: 500px) {
            .time-slots {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .time-slot {
            padding: 10px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.85rem;
            font-weight: 500;
            color: #475569;
        }

        .time-slot:hover {
            border-color: var(--primary-blue);
            background: rgba(122, 178, 211, 0.05);
        }

        .time-slot.selected {
            border-color: var(--primary-blue);
            background: var(--primary-blue);
            color: white;
        }

        .time-slot.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f1f5f9;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--dark-blue), #2563eb);
            color: white;
            box-shadow: 0 4px 15px rgba(30, 58, 95, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(30, 58, 95, 0.4);
            transform: translateY(-1px);
        }

        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-outline {
            background: white;
            color: var(--dark-blue);
            border: 2px solid #e2e8f0;
        }

        .btn-outline:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
        }

        .btn-full {
            width: 100%;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        @media (max-width: 500px) {
            .btn-group {
                flex-direction: column;
            }
        }

        /* Appointment List */
        .appointment-item {
            display: flex;
            gap: 15px;
            padding: 18px;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 12px;
            border-left: 4px solid transparent;
            transition: all 0.3s;
        }

        .appointment-item:hover {
            background: #f1f5f9;
            transform: translateX(3px);
        }

        .appointment-item.status-upcoming {
            border-left-color: var(--primary-blue);
        }

        .appointment-item.status-done {
            border-left-color: #27ae60;
        }

        .appointment-item.status-cancelled {
            border-left-color: #e74c3c;
            opacity: 0.7;
        }

        .appointment-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .appointment-icon.upcoming { background: rgba(122, 178, 211, 0.12); color: var(--primary-blue); }
        .appointment-icon.done { background: rgba(46, 204, 113, 0.12); color: #27ae60; }
        .appointment-icon.cancelled { background: rgba(231, 76, 60, 0.12); color: #e74c3c; }

        .appointment-content {
            flex: 1;
        }

        .appointment-title {
            font-weight: 700;
            color: var(--dark-blue);
            font-size: 0.95rem;
            margin-bottom: 4px;
        }

        .appointment-meta {
            display: flex;
            flex-direction: column;
            gap: 3px;
            font-size: 0.82rem;
            color: #64748b;
        }

        .appointment-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .appointment-meta i {
            width: 14px;
            text-align: center;
            color: var(--primary-blue);
        }

        .appointment-actions {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-badge.upcoming { background: rgba(122, 178, 211, 0.12); color: var(--dark-blue); }
        .status-badge.done { background: rgba(46, 204, 113, 0.12); color: #27ae60; }
        .status-badge.cancelled { background: rgba(231, 76, 60, 0.12); color: #e74c3c; }

        .action-btn-sm {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            background: white;
            color: #475569;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .action-btn-sm:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
        }

        .action-btn-sm.danger:hover {
            border-color: #e74c3c;
            color: #e74c3c;
        }

        /* Sidebar */
        .sidebar-sticky {
            position: sticky;
            top: 100px;
        }

        .summary-box {
            background: linear-gradient(135deg, var(--dark-blue), #2563eb);
            border-radius: 14px;
            padding: 22px;
            color: white;
            margin-bottom: 20px;
        }

        .summary-box h3 {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 5px;
        }

        .summary-box .value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .summary-box .sub {
            font-size: 0.8rem;
            opacity: 0.7;
            margin-top: 5px;
        }

        .checklist-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .checklist-item:last-child {
            border-bottom: none;
        }

        .checklist-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.7rem;
            margin-top: 2px;
        }

        .checklist-icon.done { background: #27ae60; color: white; }
        .checklist-icon.pending { background: #e2e8f0; color: #94a3b8; }

        .checklist-text {
            flex: 1;
        }

        .checklist-title {
            font-weight: 600;
            color: var(--dark-blue);
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .checklist-desc {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.show {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            padding: 25px 25px 0;
            text-align: center;
        }

        .modal-body {
            padding: 20px 25px;
        }

        .modal-footer {
            padding: 0 25px 25px;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 2.5rem;
            box-shadow: 0 8px 25px rgba(46, 204, 113, 0.3);
        }

        .success-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-blue);
            text-align: center;
            margin-bottom: 8px;
        }

        .success-desc {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .detail-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 15px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 0.85rem;
        }

        .detail-label { color: #64748b; }
        .detail-value { font-weight: 600; color: #1e293b; }

        /* Toast */
        .toast-container {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 3000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            min-width: 300px;
            animation: slideInRight 0.3s ease;
            border-left: 4px solid #27ae60;
        }

        .toast.error { border-left-color: #e74c3c; }
        .toast.warning { border-left-color: #f39c12; }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .toast-icon { font-size: 1.1rem; }
        .toast-message { flex: 1; font-size: 0.85rem; color: #334155; font-weight: 500; }
        .toast-close { background: none; border: none; color: #94a3b8; cursor: pointer; }

        /* Spinner */
        .spinner {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 100px 15px 30px;
            }
            .page-title {
                font-size: 1.4rem;
            }
            .steps-progress {
                flex-wrap: wrap;
                gap: 10px;
            }
            .step-line {
                width: 30px;
            }
            .step-label {
                display: none;
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
                <a href="#" class="nav-item">Beranda</a>
                <a href="#" class="nav-item">Tentang Kami</a>
                <a href="#" class="nav-item">Katalog</a>
                <a href="#" class="nav-item">ChatBot</a>
                <a href="#" class="nav-item">Riwayat Pemesanan</a>
                <a href="#" class="nav-item active">Serah Terima</a>
                <a href="#" class="nav-item">Kontak</a>
            </nav>
            <div class="user-actions">
                <a href="#" class="notification-icon" style="position:relative;">
                    <i class="fas fa-bell"></i>
                    <span style="position:absolute; top:-5px; right:-5px; background:#ef4444; color:white; border-radius:50%; width:18px; height:18px; font-size:0.65rem; display:flex; align-items:center; justify-content:center; font-weight:700;">2</span>
                </a>
                <a href="#" class="profile-icon">
                    <div class="profile-avatar-default">A</div>
                </a>
            </div>
        </div>
    </header>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <span class="breadcrumb-sep"><i class="fas fa-chevron-right" style="font-size:0.7rem"></i></span>
            <a href="#">Pesanan Saya</a>
            <span class="breadcrumb-sep"><i class="fas fa-chevron-right" style="font-size:0.7rem"></i></span>
            <span class="breadcrumb-current">Serah Terima</span>
        </div>

        <!-- Page Title -->
        <div class="page-title-section">
            <h1 class="page-title"><i class="fas fa-handshake"></i> Serah Terima</h1>
            <p class="page-subtitle">Buat janji temu dengan perusahaan untuk proses serah terima dokumen sertifikat, balik nama, dan kunci rumah/kavling di kantor Carani Estate.</p>
        </div>

        <!-- Info Banner -->
        <div class="info-banner">
            <div class="info-banner-icon"><i class="fas fa-info-circle"></i></div>
            <div class="info-banner-content">
                <h3>Penting: Persiapkan Dokumen Berikut</h3>
                <p>Untuk proses serah terima di kantor, harap siapkan KTP asli, KK, NPWP, bukti pembayaran lunas, dan dokumen booking. Semua dokumen wajib dibawa saat janji temu.</p>
            </div>
        </div>

        <!-- Steps Progress -->
        <div class="steps-progress">
            <div class="step-item completed">
                <div class="step-circle completed"><i class="fas fa-check" style="font-size:0.8rem"></i></div>
                <span class="step-label">Pembayaran Lunas</span>
            </div>
            <div class="step-line completed"></div>
            <div class="step-item active">
                <div class="step-circle current">2</div>
                <span class="step-label">Jadwal Serah Terima</span>
            </div>
            <div class="step-line active"></div>
            <div class="step-item">
                <div class="step-circle pending">3</div>
                <span class="step-label">TTD Sertifikat</span>
            </div>
            <div class="step-line"></div>
            <div class="step-item">
                <div class="step-circle pending">4</div>
                <span class="step-label">Balik Nama</span>
            </div>
            <div class="step-line"></div>
            <div class="step-item">
                <div class="step-circle pending">5</div>
                <span class="step-label">Terima Kunci</span>
            </div>
        </div>

        <!-- Handover Layout -->
        <div class="handover-layout">
            <!-- Left Column -->
            <div class="handover-main">
                <!-- Handover Type Selection -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-list-check"></i> Pilih Jenis Serah Terima</div>
                    </div>
                    <div class="card-body">
                        <div class="handover-types">
                            <div class="handover-type-card selected" onclick="selectType(this, 'sertifikat')">
                                <div class="type-check not-done"><i class="fas fa-clock"></i></div>
                                <div class="type-icon sertifikat"><i class="fas fa-file-signature"></i></div>
                                <div class="type-name">TTD Sertifikat</div>
                                <div class="type-desc">Penandatanganan sertifikat kepemilikan</div>
                            </div>
                            <div class="handover-type-card" onclick="selectType(this, 'baliknama')">
                                <div class="type-check not-done"><i class="fas fa-clock"></i></div>
                                <div class="type-icon baliknama"><i class="fas fa-exchange-alt"></i></div>
                                <div class="type-name">Balik Nama</div>
                                <div class="type-desc">Proses pengalihan nama sertifikat</div>
                            </div>
                            <div class="handover-type-card" onclick="selectType(this, 'kunci')">
                                <div class="type-check not-done"><i class="fas fa-clock"></i></div>
                                <div class="type-icon kunci"><i class="fas fa-key"></i></div>
                                <div class="type-name">Terima Kunci</div>
                                <div class="type-desc">Serah terima kunci rumah/kavling</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="card" style="margin-top:20px">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-calendar-plus"></i> Buat Jadwal Temu</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Properti</label>
                            <select class="form-select" id="propertySelect">
                                <option value="">Pilih properti</option>
                                <option value="bukit-harmoni-a15" selected>Kavling A-15 — Bukit Harmoni</option>
                                <option value="green-valley-c22">Kavling C-22 — Green Valley</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Pilih Tanggal Temu</label>
                            <input type="date" class="form-input" id="meetingDate" min="">
                            <div class="form-hint"><i class="fas fa-info-circle"></i> Tersedia: Senin - Sabtu (09:00 - 16:00 WIB) — Lokasi: Kantor Carani Estate</div>
                        </div>

                        <div class="form-group">
                            <div class="time-slots-label">Pilih Waktu</div>
                            <div class="time-slots">
                                <div class="time-slot" onclick="selectTime(this, '09:00')">09:00</div>
                                <div class="time-slot" onclick="selectTime(this, '09:30')">09:30</div>
                                <div class="time-slot" onclick="selectTime(this, '10:00')">10:00</div>
                                <div class="time-slot" onclick="selectTime(this, '10:30')">10:30</div>
                                <div class="time-slot disabled" title="Penuh">11:00</div>
                                <div class="time-slot" onclick="selectTime(this, '13:00')">13:00</div>
                                <div class="time-slot" onclick="selectTime(this, '13:30')">13:30</div>
                                <div class="time-slot" onclick="selectTime(this, '14:00')">14:00</div>
                                <div class="time-slot" onclick="selectTime(this, '14:30')">14:30</div>
                                <div class="time-slot" onclick="selectTime(this, '15:00')">15:00</div>
                                <div class="time-slot disabled" title="Penuh">15:30</div>
                                <div class="time-slot" onclick="selectTime(this, '16:00')">16:00</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jumlah Peserta</label>
                            <select class="form-select" id="participantCount">
                                <option value="1">1 Orang</option>
                                <option value="2" selected>2 Orang</option>
                                <option value="3">3 Orang</option>
                                <option value="4">4 Orang</option>
                                <option value="5">5 Orang</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Catatan Tambahan (Opsional)</label>
                            <textarea class="form-textarea" id="notes" placeholder="Contoh: Saya ingin sekalian konsultasi mengenai balik nama..."></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">No. HP / WhatsApp</label>
                                <input type="tel" class="form-input" id="phone" placeholder="0812xxxxxxxxx" value="0812-3456-7890">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-input" id="email" placeholder="email@contoh.com" value="ahmad@email.com">
                            </div>
                        </div>

                        <div class="btn-group">
                            <button class="btn btn-outline" onclick="window.history.back()">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </button>
                            <button class="btn btn-primary btn-full" id="bookBtn" onclick="bookAppointment()">
                                <i class="fas fa-calendar-check"></i>
                                <span>Buat Jadwal Temu</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Appointment History -->
                <div class="card" style="margin-top:20px">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-clock-rotate-left"></i> Riwayat Janji Temu</div>
                    </div>
                    <div class="card-body" id="appointmentList">
                        <!-- Appointment items -->
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="sidebar-sticky">
                <!-- Summary -->
                <div class="summary-box">
                    <h3>Status Serah Terima</h3>
                    <div class="value" style="color:#2ecc71"><i class="fas fa-check-circle"></i> 1/3 Selesai</div>
                    <div class="sub">Kavling A-15 — Bukit Harmoni</div>
                </div>

                <!-- Checklist -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title" style="font-size:0.95rem"><i class="fas fa-clipboard-list"></i> Checklist Serah Terima</div>
                    </div>
                    <div class="card-body">
                        <div class="checklist-item">
                            <div class="checklist-icon done"><i class="fas fa-check"></i></div>
                            <div class="checklist-text">
                                <div class="checklist-title">Pembayaran Lunas</div>
                                <div class="checklist-desc">Selesai pada 10 Mei 2026</div>
                            </div>
                        </div>
                        <div class="checklist-item">
                            <div class="checklist-icon pending"><i class="fas fa-clock"></i></div>
                            <div class="checklist-text">
                                <div class="checklist-title">TTD Sertifikat</div>
                                <div class="checklist-desc">Menunggu jadwal temu di kantor</div>
                            </div>
                        </div>
                        <div class="checklist-item">
                            <div class="checklist-icon pending"><i class="fas fa-clock"></i></div>
                            <div class="checklist-text">
                                <div class="checklist-title">Balik Nama Sertifikat</div>
                                <div class="checklist-desc">Menunggu jadwal temu di kantor</div>
                            </div>
                        </div>
                        <div class="checklist-item">
                            <div class="checklist-icon pending"><i class="fas fa-clock"></i></div>
                            <div class="checklist-text">
                                <div class="checklist-title">Terima Kunci</div>
                                <div class="checklist-desc">Menunggu jadwal temu di kantor</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="card">
                    <div class="card-title" style="margin-bottom:15px; font-size:0.95rem; padding:22px 22px 0;">
                        <i class="fas fa-headset"></i> Butuh Bantuan?
                    </div>
                    <div style="padding:0 22px 22px; font-size:0.85rem; color:#64748b; line-height:1.6">
                        <p style="margin-bottom:10px">Hubungi tim kami untuk informasi lebih lanjut:</p>
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px; color:#334155; font-weight:500">
                            <i class="fas fa-phone" style="color:var(--primary-blue); width:16px"></i>
                            (021) 1234-5678
                        </div>
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px; color:#334155; font-weight:500">
                            <i class="fab fa-whatsapp" style="color:#27ae60; width:16px"></i>
                            0812-3456-7890
                        </div>
                        <div style="display:flex; align-items:center; gap:8px; color:#334155; font-weight:500">
                            <i class="fas fa-envelope" style="color:#f39c12; width:16px"></i>
                            cs@caraniestate.id
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Success Modal -->
    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="success-icon"><i class="fas fa-check"></i></div>
                <h2 class="success-title">Jadwal Berhasil Dibuat!</h2>
                <p class="success-desc">Janji temu Anda telah berhasil dijadwalkan. Konfirmasi akan dikirim melalui email dan WhatsApp.</p>
            </div>
            <div class="modal-body">
                <div class="detail-box">
                    <div class="detail-row">
                        <span class="detail-label">Kode Booking</span>
                        <span class="detail-value" id="bookingCode">ST-2026-00128</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal</span>
                        <span class="detail-value" id="bookingDate">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Waktu</span>
                        <span class="detail-value" id="bookingTime">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Jenis</span>
                        <span class="detail-value" id="bookingType">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Lokasi</span>
                        <span class="detail-value">Kantor Carani Estate Lt. 2</span>
                    </div>
                </div>
                <div style="background:#fef3c7; border-radius:10px; padding:12px; display:flex; align-items:center; gap:10px; margin-bottom:15px">
                    <i class="fas fa-exclamation-triangle" style="color:#e67e22; font-size:1.1rem"></i>
                    <span style="font-size:0.85rem; color:#92400e">Harap datang 15 menit sebelum jadwal dan bawa dokumen lengkap.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-full" onclick="closeModal()">
                    <i class="fas fa-check"></i> Mengerti
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toggle Mobile Menu
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('show');
        }

        // Set minimum date to tomorrow
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById('meetingDate').min = tomorrow.toISOString().split('T')[0];

        // State
        let selectedType = 'sertifikat';
        let selectedTime = null;

        // Appointment Data
        const appointments = [
            {
                id: 'ST-2026-00125',
                type: 'sertifikat',
                typeName: 'TTD Sertifikat',
                date: '2026-05-20',
                time: '10:00',
                property: 'Kavling A-15 — Bukit Harmoni',
                status: 'upcoming',
                notes: 'Bawa KTP dan KK asli'
            },
            {
                id: 'ST-2026-00098',
                type: 'kunci',
                typeName: 'Terima Kunci',
                date: '2026-04-15',
                time: '14:00',
                property: 'Kavling C-22 — Green Valley',
                status: 'done',
                notes: 'Selesai - Kunci sudah diterima'
            }
        ];

        // Select Handover Type
        function selectType(el, type) {
            document.querySelectorAll('.handover-type-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            selectedType = type;
        }

        // Select Time
        function selectTime(el, time) {
            if (el.classList.contains('disabled')) return;
            document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
            el.classList.add('selected');
            selectedTime = time;
        }

        // Book Appointment
        function bookAppointment() {
            const date = document.getElementById('meetingDate').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            
            if (!selectedType) {
                showToast('Pilih jenis serah terima terlebih dahulu.', 'warning');
                return;
            }
            if (!date) {
                showToast('Pilih tanggal temu terlebih dahulu.', 'warning');
                return;
            }
            if (!selectedTime) {
                showToast('Pilih waktu temu terlebih dahulu.', 'warning');
                return;
            }
            if (!phone || !email) {
                showToast('Isi nomor HP dan email dengan benar.', 'warning');
                return;
            }

            const btn = document.getElementById('bookBtn');
            btn.disabled = true;
            btn.innerHTML = '<div class="spinner"></div> Memproses...';

            const typeNames = {
                sertifikat: 'TTD Sertifikat',
                baliknama: 'Balik Nama Sertifikat',
                kunci: 'Terima Kunci'
            };

            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-calendar-check"></i><span>Buat Jadwal Temu</span>';

                const newId = 'ST-2026-' + String(Math.floor(Math.random() * 90000) + 10000);
                
                // Update modal
                document.getElementById('bookingCode').textContent = newId;
                document.getElementById('bookingDate').textContent = formatDate(date);
                document.getElementById('bookingTime').textContent = selectedTime + ' WIB';
                document.getElementById('bookingType').textContent = typeNames[selectedType];

                // Add to appointments
                appointments.unshift({
                    id: newId,
                    type: selectedType,
                    typeName: typeNames[selectedType],
                    date: date,
                    time: selectedTime,
                    property: document.getElementById('propertySelect').options[document.getElementById('propertySelect').selectedIndex].text,
                    status: 'upcoming',
                    notes: document.getElementById('notes').value || '-'
                });

                renderAppointments();
                document.getElementById('successModal').classList.add('show');
                document.body.style.overflow = 'hidden';

                showToast('Jadwal temu berhasil dibuat!', 'success');
            }, 1500);
        }

        // Render Appointments
        function renderAppointments() {
            const container = document.getElementById('appointmentList');
            container.innerHTML = '';

            if (appointments.length === 0) {
                container.innerHTML = '<div style="text-align:center; padding:30px; color:#94a3b8"><i class="fas fa-calendar-xmark" style="font-size:2rem; margin-bottom:10px; display:block"></i>Belum ada janji temu</div>';
                return;
            }

            appointments.forEach(item => {
                const statusLabels = {
                    upcoming: 'Menunggu',
                    done: 'Selesai',
                    cancelled: 'Dibatalkan'
                };

                const statusIcons = {
                    upcoming: 'fa-clock',
                    done: 'fa-check',
                    cancelled: 'fa-times'
                };

                const div = document.createElement('div');
                div.className = `appointment-item status-${item.status}`;
                div.innerHTML = `
                    <div class="appointment-icon ${item.status}">
                        <i class="fas ${item.type === 'sertifikat' ? 'fa-file-signature' : item.type === 'baliknama' ? 'fa-exchange-alt' : 'fa-key'}"></i>
                    </div>
                    <div class="appointment-content">
                        <div class="appointment-title">${item.typeName}</div>
                        <div class="appointment-meta">
                            <span><i class="fas fa-calendar"></i> ${formatDate(item.date)} — ${item.time} WIB</span>
                            <span><i class="fas fa-map-marker-alt"></i> ${item.property}</span>
                            <span><i class="fas fa-sticky-note"></i> ${item.notes}</span>
                        </div>
                        <div class="appointment-actions">
                            <span class="status-badge ${item.status}">
                                <i class="fas ${statusIcons[item.status]}"></i>
                                ${statusLabels[item.status]}
                            </span>
                            ${item.status === 'upcoming' ? `
                                <button class="action-btn-sm" onclick="reschedule('${item.id}')"><i class="fas fa-pencil"></i> Reschedule</button>
                                <button class="action-btn-sm danger" onclick="cancelAppointment('${item.id}')"><i class="fas fa-times"></i> Batal</button>
                            ` : ''}
                        </div>
                    </div>
                `;
                container.appendChild(div);
            });
        }

        // Cancel Appointment
        function cancelAppointment(id) {
            if (!confirm('Yakin ingin membatalkan janji temu ini?')) return;
            
            const idx = appointments.findIndex(a => a.id === id);
            if (idx !== -1) {
                appointments[idx].status = 'cancelled';
                renderAppointments();
                showToast('Janji temu berhasil dibatalkan.', 'warning');
            }
        }

        // Reschedule
        function reschedule(id) {
            showToast('Fitur reschedule akan segera tersedia.', 'success');
        }

        // Format Date
        function formatDate(dateStr) {
            const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            return new Date(dateStr).toLocaleDateString('id-ID', options);
        }

        // Close Modal
        function closeModal() {
            document.getElementById('successModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Toast
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            
            const icons = { success: 'fa-check-circle', error: 'fa-times-circle', warning: 'fa-exclamation-triangle' };
            const colors = { success: '#27ae60', error: '#e74c3c', warning: '#f39c12' };
            
            toast.innerHTML = `
                <i class="fas ${icons[type]} toast-icon" style="color:${colors[type]}"></i>
                <span class="toast-message">${message}</span>
                <button class="toast-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
            `;
            
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                toast.style.transition = 'all 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderAppointments();
        });
    </script>
</body>
</html>

