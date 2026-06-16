<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Lunas - Kavling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fontsource-roboto@5.1.0/index.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #7AB2D3;
            --primary-blue-rgb: 122, 178, 211;
            --dark-blue: #1E3A5F;
            --light-blue: #e6f2f8;
            --sidebar-width: 260px;
            --success-green: #2ecc71;
            --warning-orange: #f39c12;
            --danger-red: #e74c3c;
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
            padding-top: 80px;
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

        @media (max-width: 768px) {
            .header{
                padding: 15px;
            }

            .header-container{
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                width: 100%;
            }

            .menu-toggle{
                display: block;
                color: white;
                order: 2;
            }

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
            
            .user-actions {
                margin-left: auto;
                display: flex;
                align-items: center;
                gap: 10px;
            }
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
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
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 0.95rem;
        }

        /* Steps Progress */
        .steps-progress {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 35px;
            padding: 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .step-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .step-circle.completed {
            background: var(--success-green);
            color: white;
        }

        .step-circle.current {
            background: var(--primary-blue);
            color: white;
            box-shadow: 0 0 0 4px rgba(122, 178, 211, 0.3);
        }

        .step-circle.pending {
            background: #e2e8f0;
            color: #94a3b8;
        }

        .step-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: #64748b;
        }

        .step-item.active .step-label {
            color: var(--dark-blue);
            font-weight: 600;
        }

        .step-line {
            width: 80px;
            height: 3px;
            background: #e2e8f0;
            border-radius: 2px;
            margin: 0 10px;
        }

        .step-line.completed {
            background: var(--success-green);
        }

        .step-line.active {
            background: linear-gradient(90deg, var(--success-green), var(--primary-blue));
        }

        /* Payment Layout */
        .payment-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 25px;
            align-items: start;
        }

        @media (max-width: 992px) {
            .payment-layout {
                grid-template-columns: 1fr;
            }
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            padding: 25px;
            margin-bottom: 20px;
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f1f5f9;
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

        .card-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-approved {
            background: #d1fae5;
            color: #059669;
        }

        /* Order Summary Card */
        .order-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .order-thumb {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--light-blue), #dbeafe);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .order-thumb i {
            font-size: 2rem;
            color: var(--primary-blue);
        }

        .order-details {
            flex: 1;
        }

        .order-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .order-meta {
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .order-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .order-meta i {
            width: 14px;
            text-align: center;
            color: var(--primary-blue);
        }

        /* Price Breakdown */
        .price-breakdown {
            padding: 15px;
            background: #f8fafc;
            border-radius: 12px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            font-size: 0.9rem;
            color: #475569;
        }

        .price-row.discount {
            color: var(--success-green);
        }

        .price-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 8px 0;
        }

        .price-row.total {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--dark-blue);
            padding: 12px 0 5px;
        }

        .price-row.paid {
            color: var(--primary-blue);
        }

        .price-row.remaining {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--danger-red);
            padding: 12px 0 5px;
        }

        /* Payment Methods */
        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .payment-method-group {
            margin-bottom: 5px;
        }

        .method-group-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            padding-left: 5px;
        }

        .payment-method {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .payment-method:hover {
            border-color: var(--primary-blue);
            background: rgba(122, 178, 211, 0.05);
        }

        .payment-method.selected {
            border-color: var(--primary-blue);
            background: rgba(122, 178, 211, 0.08);
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15);
        }

        .payment-method input[type="radio"] {
            display: none;
        }

        .method-radio {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .payment-method.selected .method-radio {
            border-color: var(--primary-blue);
        }

        .method-radio::after {
            content: '';
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary-blue);
            transform: scale(0);
            transition: transform 0.2s;
        }

        .payment-method.selected .method-radio::after {
            transform: scale(1);
        }

        .method-icon {
            width: 45px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .method-icon.bank { background: #dbeafe; color: #2563eb; }
        .method-icon.ewallet { background: #dcfce7; color: #16a34a; }
        .method-icon.qris { background: #fef3c7; color: #d97706; }
        .method-icon.va { background: #f3e8ff; color: #7c3aed; }

        .method-info {
            flex: 1;
        }

        .method-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.95rem;
        }

        .method-desc {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 2px;
        }

        .method-logo-text {
            font-weight: 700;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
        }

        /* Payment Form */
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

        .form-input {
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

        .form-input:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15);
        }

        .form-input::placeholder {
            color: #cbd5e1;
        }

        .form-input:disabled {
            background: #f1f5f9;
            color: #94a3b8;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* FILEE */
        .upload-area{
            border:2px dashed #cbd5e1;
            border-radius:16px;
            padding:30px;
            text-align:center;
            cursor:pointer;
            transition:0.3s;
            background:#f8fafc;
        }

        .upload-area:hover{
            border-color:#2563eb;
            background:#eff6ff;
        }

        .upload-icon{
            font-size:42px;
            color:#2563eb;
            margin-bottom:10px;
        }

        .upload-text{
            font-size:16px;
            font-weight:600;
            color:#1e293b;
        }

        .upload-hint{
            font-size:13px;
            color:#64748b;
            margin-top:6px;
        }

        /* PREVIEW */

        .file-preview{
            margin-top:16px;
            padding:14px;
            border-radius:14px;
            background:#f8fafc;
            border:1px solid #e2e8f0;

            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .preview-left{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .file-icon{
            width:48px;
            height:48px;
            border-radius:12px;
            background:#dbeafe;

            display:flex;
            align-items:center;
            justify-content:center;

            color:#2563eb;
            font-size:20px;
        }

        .file-name{
            font-weight:600;
            color:#0f172a;
        }

        .file-size{
            font-size:13px;
            color:#64748b;
            margin-top:4px;
        }

        .preview-actions{
            display:flex;
            gap:8px;
        }

        .preview-btn{
            width:38px;
            height:38px;
            border:none;
            border-radius:10px;
            cursor:pointer;
            background:#2563eb;
            color:white;
        }

        .preview-btn.delete{
            background:#dc2626;
        }

        @media (max-width: 500px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-hint {
            font-size: 0.78rem;
            color: #94a3b8;
            margin-top: 4px;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 10px;
            margin-top: 15px;
        }

        .checkbox-group input[type="checkbox"] {
            margin-top: 3px;
            accent-color: var(--primary-blue);
            width: 16px;
            height: 16px;
        }

        .checkbox-label {
            font-size: 0.85rem;
            color: #475569;
            line-height: 1.4;
        }

        .checkbox-label a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
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

        /* Upload Section */
        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .upload-area:hover {
            border-color: var(--primary-blue);
            background: rgba(122, 178, 211, 0.05);
        }

        .upload-area.dragover {
            border-color: var(--primary-blue);
            background: rgba(122, 178, 211, 0.1);
        }

        .upload-area.has-file {
            border-color: var(--success-green);
            background: rgba(46, 204, 113, 0.05);
        }

        .upload-icon {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 10px;
        }

        .upload-text {
            font-weight: 600;
            color: #334155;
            margin-bottom: 5px;
        }

        .upload-hint {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        .upload-preview {
            display: none;
            margin-top: 15px;
            padding: 12px;
            background: #f0fdf4;
            border-radius: 10px;
            align-items: center;
            gap: 10px;
        }

        .upload-preview.show {
            display: flex;
        }

        .upload-preview-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--success-green);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .upload-preview-info {
            flex: 1;
            text-align: left;
        }

        .upload-preview-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.85rem;
        }

        .upload-preview-size {
            font-size: 0.75rem;
            color: #64748b;
        }

        .upload-remove {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: none;
            background: #fee2e2;
            color: #ef4444;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .upload-remove:hover {
            background: #fecaca;
        }

        /* Sidebar Summary */
        .sidebar-sticky {
            position: sticky;
            top: 100px;
        }

        .summary-amount {
            text-align: center;
            padding: 20px;
            background: linear-gradient(135deg, var(--dark-blue), #2563eb);
            border-radius: 12px;
            color: white;
            margin-bottom: 20px;
        }

        .summary-label {
            font-size: 0.85rem;
            opacity: 0.8;
            margin-bottom: 5px;
        }

        .summary-value {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .summary-sub {
            font-size: 0.8rem;
            opacity: 0.7;
            margin-top: 5px;
        }

        .timer-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            background: #fef3c7;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .timer-icon {
            color: #d97706;
            animation: pulse 2s infinite;
        }

        .timer-text {
            font-size: 0.85rem;
            color: #92400e;
            font-weight: 600;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Security Badges */
        .security-badges {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding: 15px;
            margin-top: 15px;
        }

        .security-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            color: #94a3b8;
        }

        .security-badge i {
            color: var(--success-green);
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

        /* QRIS */
        .qris-payment-box{
            margin-top:20px;
            border:1px solid #e2e8f0;
            border-radius:16px;
            padding:20px;
            background:#fff;
        }

        .qris-header{
            font-size:18px;
            font-weight:600;
            margin-bottom:20px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .qris-content{
            text-align:center;
        }

        .qris-image{
            width:250px;
            max-width:100%;
            border-radius:12px;
            border:1px solid #e2e8f0;
            padding:10px;
            background:#fff;
        }

        .qris-text{
            margin-top:15px;
            color:#64748b;
        }

        .qris-apps{
            display:flex;
            flex-wrap:wrap;
            justify-content:center;
            gap:10px;
            margin-top:10px;
        }

        .qris-apps span{
            background:#f1f5f9;
            padding:6px 12px;
            border-radius:999px;
            font-size:13px;
        }

        .qris-expired{
            margin-top:20px;
            color:#ef4444;
            font-weight:600;
        }

        .qris-dropdown{
            padding:20px;
            text-align:center;
        }

        .qris-image{
            width:220px;
            max-width:100%;
            border-radius:16px;
            border:1px solid #e2e8f0;
            padding:12px;
            background:white;
            margin-bottom:15px;
        }

        .qris-text{
            font-size:0.9rem;
            color:#64748b;
            margin-bottom:12px;
        }

        .qris-apps{
            display:flex;
            flex-wrap:wrap;
            gap:8px;
            justify-content:center;
            margin-bottom:16px;
        }

        .qris-apps span{
            padding:6px 12px;
            background:#f1f5f9;
            border-radius:999px;
            font-size:0.8rem;
            font-weight:500;
        }

        .qris-expired{
            margin-top:15px;
            font-size:0.85rem;
            color:#ef4444;
            font-weight:600;
        }

        .qris-actions{
            margin-top:10px;
            display:flex;
            justify-content:center;
        }

        .btn-download-qris{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:10px 16px;
            border-radius:12px;
            background:linear-gradient(135deg, #2563eb, #1d4ed8);
            color:white;
            font-size:0.85rem;
            font-weight:600;
            text-decoration:none;
            transition:all .2s ease;
            box-shadow:0 4px 12px rgba(37,99,235,.2);
        }

        .btn-download-qris:hover{
            transform:translateY(-2px);
            box-shadow:0 8px 20px rgba(37,99,235,.25);
            color:white;
        }

        .btn-download-qris i{
            font-size:0.9rem;
        }

        /* Success State */
        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2ecc71, #27ae60);
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

        .payment-detail-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 15px;
        }

        .payment-detail-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 0.85rem;
        }

        .payment-detail-label {
            color: #64748b;
        }

        .payment-detail-value {
            font-weight: 600;
            color: #1e293b;
        }

        .copy-btn {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            cursor: pointer;
            margin-left: 8px;
            transition: all 0.3s;
        }

        .copy-btn:hover {
            background: var(--dark-blue);
        }

        .copy-btn.copied {
            background: var(--success-green);
        }

        /* Loading Spinner */
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

        /* Toast Notification */
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
            padding: 15px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            min-width: 300px;
            animation: slideInRight 0.3s ease;
            border-left: 4px solid var(--success-green);
        }

        .toast.error {
            border-left-color: var(--danger-red);
        }

        .toast.warning {
            border-left-color: var(--warning-orange);
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .toast-icon {
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .toast-message {
            flex: 1;
            font-size: 0.9rem;
            color: #334155;
            font-weight: 500;
        }

        .toast-close {
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 5px;
            font-size: 1rem;
        }

        /* Status Banner */
        .status-banner {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .status-banner.info {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        .status-banner.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .status-banner.warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }

        .status-banner i {
            font-size: 1.2rem;
        }

        /* DROPDOWN PEMBAYRAN */
        .payment-dropdown{
            display:none;
            margin-top:12px;
            padding:15px;
            background:#f8fafc;
            border-radius:12px;
        }

        .payment-dropdown.show{
            display:block;
        }

        .copy-btn{
            border:none;
            background:#2563eb;
            color:white;
            padding:4px 10px;
            border-radius:8px;
            cursor:pointer;
            font-size:12px;
        }

        .copy-btn:hover{
            opacity:0.9;
        }

        .total-payment{
            margin-top:12px;
            padding-top:12px;
            border-top:1px solid #ddd;
            font-weight:600;
            color:#dc2626;
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

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 20px 15px;
            }

            .page-title {
                font-size: 1.4rem;
            }

            .steps-progress {
                flex-wrap: wrap;
                gap: 10px;
            }

            .step-line {
                width: 40px;
            }

            .step-label {
                display: none;
            }

            .payment-layout {
                grid-template-columns: 1fr;
            }

            .btn-group {
                flex-direction: column;
            }

            .security-badges {
                flex-direction: column;
                gap: 8px;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        .slide-up {
            animation: slideUp 0.5s ease;
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
            <span class="breadcrumb-current">Pembayaran Lunas</span>
        </div>

        <!-- Page Title -->
        <div class="page-title-section">
            <h1 class="page-title">Pembayaran Lunas</h1>
            <p class="page-subtitle">Dokumen Anda telah disetujui. Silakan selesaikan pembayaran lunas untuk kavling Anda.</p>
        </div>

        <!-- Status Banner -->
        <div class="status-banner success">
            <i class="fas fa-check-circle"></i>

            <span>
                <strong>Dokumen telah diverifikasi.</strong>
                Anda dapat melanjutkan pembayaran lunas untuk
                {{ $transaksi->properti->nama_properti ?? 'Properti yang dipilih' }}.
            </span>
        </div>

        <form action="{{ route('pembayaran.lunas.store') }}" id="paymentForm"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        <input type="hidden"
        name="id_transaksi"
        value="{{ $transaksi->id_transaksi }}">

        <input type="hidden"
        name="metode_pembayaran"
        id="metodePembayaran">

        <!-- Payment Layout -->
        <div class="payment-layout">
            <!-- Left Column -->
            <div class="payment-main">
                <!-- Order Summary -->
                <div class="card slide-up">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-receipt"></i>
                            Ringkasan Pesanan
                        </div>
                        <span class="card-badge badge-approved"><i class="fas fa-check"></i> Disetujui</span>
                    </div>

                    <div class="order-item">
                        <div class="order-thumb">
                            <i class="fas fa-map"></i>
                        </div>

                        <div class="order-details">

                            <div class="order-name">
                                {{ $transaksi->properti->nama_properti ?? '-' }}
                            </div>

                            <div class="order-meta">
                                <span>
                                    <i class="fas fa-ruler-combined"></i>
                                    Luas: {{ $transaksi->properti->luas_tanah ?? '-' }} m²
                                </span>

                                <span>
                                    <i class="fas fa-home"></i>
                                    Kategori: {{ $transaksi->properti->kategori_properti ?? '-' }}
                                </span>

                                <span>
                                    <i class="fas fa-road"></i>
                                    {{ $transaksi->properti->blok->nama_blok ?? '-' }}
                                </span>

                                <span>
                                    <i class="fas fa-file-invoice"></i>
                                    No. Booking: {{ $transaksi->kode_booking ?? $transaksi->id_transaksi }}
                                </span>
                            </div>
                        </div>
                    </div>

                        @php
                            $properti = $transaksi->properti;

                            $hargaProperti = $properti->harga_properti ?? 0;

                            $biayaAdmin = 500000;
                            $biayaNotaris = 2500000;

                            // ambil langsung dari database
                            $bookingFee = $properti->bookingFee ?? 0;

                            $uangMuka = 0;

                            if (strtolower($properti->kategori_properti ?? '') == 'komersil') {
                                $uangMuka = $hargaProperti * 0.15;
                            }

                            $totalHarga = $hargaProperti + $biayaAdmin + $biayaNotaris + $uangMuka;

                            $sisaBayar = $totalHarga - $bookingFee;
                        @endphp

                    <div class="price-breakdown">
                        <div class="price-row">
                            <span>Harga Properti</span>
                            <span>
                                Rp {{ number_format($properti->harga_properti ?? 0, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="price-row">
                            <span>Biaya Administrasi</span>
                            <span>Rp {{ number_format($biayaAdmin,0,',','.') }}</span>
                        </div>

                        <div class="price-row">
                            <span>Biaya Notaris & Akta</span>
                            <span>Rp {{ number_format($biayaNotaris,0,',','.') }}</span>
                        </div>

                        @if($uangMuka > 0)
                        <div class="price-row">
                            <span>Uang Muka 15%</span>
                            <span>Rp {{ number_format($uangMuka,0,',','.') }}</span>
                        </div>
                        @endif

                        <div class="price-divider"></div>

                        <div class="price-row total">
                            <span>Total Harga</span>
                            <span>Rp {{ number_format($totalHarga,0,',','.') }}</span>
                        </div>

                        <div class="price-row paid">
                            <span>Booking Fee (sudah dibayar)</span>
                            <span>- Rp {{ number_format($bookingFee,0,',','.') }}</span>
                        </div>

                        <div class="price-divider"></div>

                        <div class="price-row remaining">
                            <span>Sisa Pembayaran Lunas</span>
                            <span>Rp {{ number_format($sisaBayar,0,',','.') }}</span>
                        </div>
                    </div>
                </div>

                    <!-- HIDDEN METODE PEMBAYARAN -->
                    <input type="hidden"
                        name="metode_pembayaran"
                        id="metodePembayaran">

                    <!-- Payment Method -->
                    <div class="card slide-up"
                        style="animation-delay: 0.1s">

                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-credit-card"></i>
                                Metode Pembayaran
                            </div>
                        </div>

                    <div class="payment-methods">
                        <!-- Transfer Bank -->
                        <div class="payment-method-group">
                            <div class="method-group-title">
                                Transfer Bank
                            </div>

                            <!-- BCA -->
                            <div class="payment-item">
                                <div class="payment-method"
                                    onclick="togglePayment(this)">
                                    <div style="display:flex; align-items:center; gap:12px;">
                                        <div class="method-radio"></div>
                                        <div class="method-icon bank">
                                            <i class="fas fa-building-columns"></i>
                                        </div>
                                        <div>
                                            <div class="method-name">
                                                Bank BCA
                                            </div>

                                            <div class="method-desc">
                                                Transfer via BCA
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="payment-dropdown">
                                    <div class="payment-detail-row">
                                        <span>Bank</span>
                                        <span>BCA</span>
                                    </div>
                                    <div class="payment-detail-row">
                                        <span>No. Rekening</span>
                                        <div style="display:flex; gap:8px; align-items:center;">
                                            <span id="rek-bca">
                                                8720193456
                                            </span>
                                            <button class="copy-btn"
                                                onclick="copyRekening('8720193456')">
                                                Salin
                                            </button>
                                        </div>
                                    </div>
                                    <div class="payment-detail-row">
                                        <span>A/N</span>
                                        <span>PT Kavling Bersama Indonesia</span>
                                    </div>
                                    <div class="payment-detail-row total-payment">
                                        <span>Total Bayar</span>
                                        <span>
                                            Rp {{ number_format($sisaBayar,0,',','.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <!-- Mandiri -->
                            <div class="payment-item">
                                <div class="payment-method"
                                    onclick="togglePayment(this)">
                                    <div style="display:flex; align-items:center; gap:12px;">
                                        <div class="method-radio"></div>
                                        <div class="method-icon bank">
                                            <i class="fas fa-building-columns"></i>
                                        </div>
                                        <div>
                                            <div class="method-name">
                                                Bank Mandiri
                                            </div>
                                            <div class="method-desc">
                                                Transfer via Mandiri
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="payment-dropdown">
                                    <div class="payment-detail-row">
                                        <span>Bank</span>
                                        <span>Mandiri</span>
                                    </div>
                                    <div class="payment-detail-row">
                                        <span>No. Rekening</span>
                                        <div style="display:flex; gap:8px; align-items:center;">
                                            <span>
                                                1400012345678
                                            </span>
                                            <button class="copy-btn"
                                                onclick="copyRekening('1400012345678')">
                                                Salin
                                            </button>
                                        </div>
                                    </div>

                                    <div class="payment-detail-row">
                                        <span>A/N</span>
                                        <span>PT Kavling Bersama Indonesia</span>
                                    </div>

                                    <div class="payment-detail-row total-payment">
                                        <span>Total Bayar</span>

                                        <span>
                                            Rp {{ number_format($sisaBayar,0,',','.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PEMBAYARAN QRIS -->
                        <div class="payment-method-group">
                            <div class="method-group-title">QRIS</div>
                                <div class="payment-item">
                                    <!-- HEADER -->
                                    <div class="payment-method"
                                        onclick="toggleQris(this)">
                                        <div style="display:flex; align-items:center; gap:12px;">
                                            <div class="method-radio"></div>
                                            <div class="method-icon qris">
                                                <i class="fas fa-qrcode"></i>
                                            </div>

                                            <div>
                                                <div class="method-name">
                                                    QRIS
                                                </div>

                                                <div class="method-desc">
                                                    Scan QR dari aplikasi apapun
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DROPDOWN -->
                                    <div class="payment-dropdown qris-dropdown">

                                        <div class="qris-content">

                                            <img
                                                src="{{ asset('public/img/qris.png') }}"
                                                alt="QRIS"
                                                class="qris-image"
                                            >

                                            <div class="qris-actions">
                                                <a
                                                    href="{{ asset('public/img/qris.png') }}"
                                                    download="QRIS-Kavling-Bersama.png"
                                                    class="btn-download-qris">
                                                    <i class="fas fa-download"></i>
                                                    Download QRIS
                                                </a>
                                            </div>

                                            <p class="qris-text">
                                                Scan QR menggunakan:
                                            </p>

                                            <div class="qris-apps">
                                                <span>DANA</span>
                                                <span>OVO</span>
                                                <span>GoPay</span>
                                                <span>ShopeePay</span>
                                                <span>Mobile Banking</span>
                                            </div>

                                            <div class="payment-detail-row total-payment">
                                                <span>Total Bayar</span>

                                                <span>
                                                    Rp {{ number_format($sisaBayar,0,',','.') }}
                                                </span>
                                            </div>

                                            <div class="qris-expired">
                                                Berlaku hingga:
                                                <strong id="qrisTimer">
                                                    23:59:59
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <!-- Payment Confirmation (Upload Bukti) -->
                <div class="card slide-up" style="animation-delay: 0.2s" id="uploadCard" style="display:none">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-camera"></i>
                            Upload Bukti Pembayaran
                        </div>
                    </div>

                    <div class="status-banner info">
                        <i class="fas fa-info-circle"></i>
                        <span>Setelah melakukan transfer, upload bukti pembayaran untuk konfirmasi. Admin akan memverifikasi dalam 1×24 jam.</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Upload Bukti Transfer</label>
                        <div class="upload-preview" id="uploadPreview">
                            <div class="upload-preview-icon"><i class="fas fa-check"></i></div>
                            <div class="upload-preview-info">
                                <div class="upload-preview-name" id="previewName">bukti_transfer.jpg</div>
                                <div class="upload-preview-size" id="previewSize">2.4 MB</div>
                            </div>
                            <button class="upload-remove" onclick="removeFile()"><i class="fas fa-times"></i></button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Transfer</label>
                        <input type="date" class="form-input" id="transferDate" name="tanggal_transfer">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Bank / E-Wallet Pengirim
                        </label>

                        <select class="form-input"
                            id="senderBank"
                            name="bank_pengirim" onchange="setPaymentMethod(this)">

                            <option value="">
                                Pilih bank / e-wallet
                            </option>

                            <optgroup label="Transfer Bank">
                                <option value="bca">BCA</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="bni">BNI</option>
                                <option value="bri">BRI</option>
                            </optgroup>

                            <optgroup label="QRIS / E-Wallet">
                                <option value="gopay">GoPay</option>
                                <option value="ovo">OVO</option>
                                <option value="dana">DANA</option>
                                <option value="shopeepay">ShopeePay</option>
                            </optgroup>
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label class="form-label">Nama Pengirim</label>
                        <input type="text" class="form-input" id="senderName" name="nama_pengirim" placeholder="Sesuai rekening pengirim">
                    </div> -->

                    <div class="upload-area"
                        id="uploadArea"
                        onclick="openFileManager()">

                        <div class="upload-icon">
                            <i class="fas fa-cloud-arrow-up"></i>
                        </div>

                        <div class="upload-text">
                            Klik untuk upload bukti pembayaran
                        </div>

                        <div class="upload-hint">
                            JPG, PNG, PDF • Maksimal 5MB
                        </div>

                        <input type="file"
                            id="fileInput"
                            name="bukti_pembayaran"
                            accept="image/*,.pdf"
                            hidden
                            onchange="handleFileUpload(this)">
                    </div>

                    <!-- PREVIEW FILE -->
                    <div class="file-preview"
                        id="filePreview"
                        style="display:none;">

                        <div class="preview-left">

                            <div class="file-icon">
                                <i class="fas fa-folder-open"></i>
                            </div>

                            <div class="file-detail">
                                <div class="file-name" id="previewName"></div>
                                <div class="file-size" id="previewSize"></div>
                            </div>
                        </div>

                        <div class="preview-actions">
                            <button type="button"
                                    class="preview-btn"
                                    id="viewFileBtn">
                                <i class="fas fa-eye"></i>
                            </button>

                            <button type="button"
                                    class="preview-btn delete"
                                    onclick="removeFile()">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="agreeTerms">
                        <label class="checkbox-label" for="agreeTerms">
                            Saya menyatakan bahwa bukti transfer yang saya unggah adalah benar dan saya menyetujui <a href="#">syarat & ketentuan</a> yang berlaku.
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="btn-group">
                    <button class="btn btn-outline" onclick="window.history.back()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                    <button type="submit"
                        class="btn btn-primary btn-full"
                        id="payBtn" onclick="processPayment()">
                        <i class="fas fa-lock"></i>
                        <span>
                            Bayar Lunas —
                            Rp {{ number_format($sisaBayar, 0, ',', '.') }}
                        </span>
                    </button>
                </div>
            </div>
            </form>
            

            <!-- Right Column - Sidebar -->
            <div class="sidebar-sticky">

                <!-- Card Summary -->
                <div class="card">

                    <div class="summary-amount">
                        <div class="summary-label">
                            Sisa Pembayaran
                        </div>

                        <div class="summary-value">
                            Rp {{ number_format($sisaBayar, 0, ',', '.') }}
                        </div>

                        <div class="summary-sub">
                            Termasuk biaya administrasi & notaris
                        </div>
                    </div>


                    <div class="timer-box">
                        <i class="fas fa-clock timer-icon"></i>
                        <span class="timer-text" id="timerText">
                            Batas pembayaran: 24:00:00
                        </span>
                    </div>


                    <div class="payment-detail-box">

                        <div class="payment-detail-row">
                            <span class="payment-detail-label">
                                No. Booking
                            </span>

                            <span class="payment-detail-value">
                                {{ $transaksi->kode_booking ?? $transaksi->id_transaksi }}
                            </span>
                        </div>


                        <div class="payment-detail-row">
                            <span class="payment-detail-label">
                                Blok
                            </span>

                            <span class="payment-detail-value">
                                {{ $transaksi->properti->blok->nama_blok ?? '-' }}
                            </span>
                        </div>


                        <div class="payment-detail-row">
                            <span class="payment-detail-label">
                                Luas
                            </span>

                            <span class="payment-detail-value">
                                {{ $transaksi->properti->luas_tanah ?? 0 }} m²
                            </span>
                        </div>


                        <div class="payment-detail-row">
                            <span class="payment-detail-label">
                                Booking Fee
                            </span>

                            <span class="payment-detail-value"
                                style="color:var(--success-green)">

                                Rp {{ number_format($bookingFee,0,',','.') }} ✓

                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card Bantuan -->
                <div class="card">

                    <div class="card-title"
                        style="margin-bottom:15px; font-size:0.95rem">
                        <i class="fas fa-headset"></i>
                        Butuh Bantuan?
                    </div>


                    <div style="font-size:0.85rem; color:#64748b; line-height:1.6">
                        <p style="margin-bottom:10px">
                            Jika ada kendala dalam pembayaran, hubungi kami:
                        </p>

                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px;">

                            <i class="fas fa-phone"></i>
                            (021) 1234-5678

                        </div>

                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px;">

                            <i class="fab fa-whatsapp"></i>
                            0812-3456-7890

                        </div>

                        <div style="display:flex; align-items:center; gap:8px;">

                            <i class="fas fa-envelope"></i>
                            cs@kavlingbersama.id
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Payment Detail Modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal-content">
            <div class="modal-header">
                <div style="width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg, var(--primary-blue), #2563eb);display:flex;align-items:center;justify-content:center;margin:0 auto 15px;color:white;font-size:1.5rem">
                    <i class="fas fa-building-columns"></i>
                </div>
                <h2 class="success-title">Transfer ke Rekening Berikut</h2>
                <p style="color:#64748b;font-size:0.9rem">Lakukan transfer sesuai nominal di bawah ini</p>
            </div>
            <div class="modal-body">
                <div class="payment-detail-box">
                    <div class="payment-detail-row">
                        <span class="payment-detail-label">Bank</span>
                        <span class="payment-detail-value" id="modalBankName">Bank BCA</span>
                    </div>
                    <div class="payment-detail-row">
                        <span class="payment-detail-label">No. Rekening</span>
                        <span class="payment-detail-value">
                            <span id="modalRekNumber">8720-193-456</span>
                            <button class="copy-btn" onclick="copyToClipboard('8720193456', this)">
                                <i class="fas fa-copy"></i> Salin
                            </button>
                        </span>
                    </div>
                    <div class="payment-detail-row">
                        <span class="payment-detail-label">Atas Nama</span>
                        <span class="payment-detail-value">PT Kavling Bersama Indonesia</span>
                    </div>
                    <div class="payment-detail-row" style="padding-top:10px; border-top:1px solid #e2e8f0; margin-top:8px">
                        <span class="payment-detail-label">Nominal Transfer</span>
                        <span class="payment-detail-value" style="color:var(--danger-red); font-size:1.1rem">Rp 173.000.000</span>
                    </div>
                </div>

                <div class="status-banner warning" style="margin-bottom:15px">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span style="font-size:0.8rem">Transfer <strong>tepat</strong> sesuai nominal untuk verifikasi otomatis. Sisa waktu pembayaran tertera di atas.</span>
                </div>

                <div class="payment-detail-box" style="background:#f0fdf4">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px">
                        <i class="fas fa-info-circle" style="color:var(--success-green)"></i>
                        <span style="font-weight:600;font-size:0.85rem;color:#065f46">Langkah Selanjutnya</span>
                    </div>
                    <ol style="font-size:0.8rem;color:#374151;padding-left:20px;line-height:1.8">
                        <li>Transfer ke rekening di atas</li>
                        <li>Upload bukti transfer di form bawah</li>
                        <li>Tunggu verifikasi admin (maks. 1×24 jam)</li>
                        <li>Pembayaran selesai — Kavling menjadi milik Anda</li>
                    </ol>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-full" onclick="closeModalAndShowUpload()">
                    <i class="fas fa-arrow-down"></i> Sudah Transfer — Upload Bukti
                </button>
                <button class="btn btn-outline btn-full" style="margin-top:10px" onclick="closeModal()">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <div class="modal-header" style="padding-top:30px">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="success-title">Bukti Terkirim!</h2>
                <p class="success-desc">Terima kasih! Bukti pembayaran Anda telah berhasil dikirim. Tim admin kami akan memverifikasi dalam <strong>1×24 jam kerja</strong>.</p>
            </div>
            <div class="modal-body">
                <div class="payment-detail-box">
                    <div class="payment-detail-row">
                        <span class="payment-detail-label">No. Booking</span>
                        <span class="payment-detail-value">BK-2026-00547</span>
                    </div>
                    <div class="payment-detail-row">
                        <span class="payment-detail-label">Kavling</span>
                        <span class="payment-detail-value">A-15 — Bukit Harmoni</span>
                    </div>
                    <div class="payment-detail-row">
                        <span class="payment-detail-label">Jumlah</span>
                        <span class="payment-detail-value">Rp 173.000.000</span>
                    </div>
                    <div class="payment-detail-row">
                        <span class="payment-detail-label">Status</span>
                        <span class="payment-detail-value" style="color:var(--warning-orange)"><i class="fas fa-hourglass-half"></i> Menunggu Verifikasi</span>
                    </div>
                </div>

                <div class="status-banner info">
                    <i class="fas fa-envelope"></i>
                    <span style="font-size:0.85rem">Notifikasi akan dikirim ke email Anda setelah verifikasi selesai.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-full" onclick="window.location.href='#'">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </button>
                <button class="btn btn-outline btn-full" style="margin-top:10px" onclick="window.location.href='#'">
                    <i class="fas fa-list-check"></i> Lihat Pesanan Saya
                </button>
            </div>
        </div>
    </div>

    <script>
        // =========================
// DOM READY
// =========================
document.addEventListener('DOMContentLoaded', function () {

    // MOBILE MENU
    const menuToggle =
        document.getElementById('menuToggle');

    const navMenu =
        document.getElementById('navMenu');

    if (menuToggle && navMenu) {

        menuToggle.addEventListener('click', function () {

            navMenu.classList.toggle('show');

        });

    }

    // TANGGAL HARI INI
    const transferDate =
        document.getElementById('transferDate');

    if (transferDate) {

        const today =
            new Date()
            .toISOString()
            .split('T')[0];

        transferDate.value = today;

    }

    // START TIMER
    startTimer();

});


// =========================
// PAYMENT METHOD
// =========================
function togglePayment(element){

    // reset semua pilihan
    document.querySelectorAll('.payment-method')
        .forEach(item => {
            item.classList.remove('selected');
        });

    // tutup dropdown
    document.querySelectorAll('.payment-dropdown')
        .forEach(dropdown => {
            dropdown.classList.remove('show');
        });

    // hide qris
    const qrisBox =
        document.getElementById('qrisPaymentBox');

    if(qrisBox){
        qrisBox.style.display = 'none';
    }

    // aktifkan bank
    element.classList.add('selected');

    // buka dropdown
    const currentItem =
        element.closest('.payment-item');

    const currentDropdown =
        currentItem.querySelector('.payment-dropdown');

    if(currentDropdown){
        currentDropdown.classList.add('show');
    }

}


// =========================
// QRIS
// =========================
function toggleQris(element){

    // reset semua
    document.querySelectorAll('.payment-method')
        .forEach(item => {
            item.classList.remove('selected');
        });

    // tutup dropdown
    document.querySelectorAll('.payment-dropdown')
        .forEach(dropdown => {
            dropdown.classList.remove('show');
        });

    // aktifkan qris
    element.classList.add('selected');

    // buka dropdown qris
    const currentItem =
        element.closest('.payment-item');

    const dropdown =
        currentItem.querySelector('.payment-dropdown');

    if(dropdown){
        dropdown.classList.add('show');
    }
}


// =========================
// COPY REKENING
// =========================
function copyRekening(rekening){

    navigator.clipboard.writeText(rekening);

    showToast(
        'Nomor rekening berhasil disalin',
        'success'
    );

}


// =========================
// OPEN FILE MANAGER
// =========================
function openFileManager(){

    document
        .getElementById('fileInput')
        .click();

}


// =========================
// HANDLE FILE UPLOAD
// =========================
function handleFileUpload(input){

    const file = input.files[0];

    if(!file) return;

    // VALIDASI SIZE
    if(file.size > 5 * 1024 * 1024){

        showToast(
            'File terlalu besar! Maksimal 5MB.',
            'error'
        );

        input.value = '';

        return;
    }

    // VALIDASI TYPE
    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/jpg',
        'application/pdf'
    ];

    if(!allowedTypes.includes(file.type)){

        showToast(
            'Format file tidak didukung.',
            'error'
        );

        input.value = '';

        return;
    }

    // AMBIL PREVIEW
    const preview =
        document.getElementById('filePreview');

    // TAMPILKAN PREVIEW
    preview.style.display = 'flex';

    // SET NAMA FILE
    preview.querySelector('.file-name')
        .innerText = file.name;

    // SET SIZE FILE
    preview.querySelector('.file-size')
        .innerText =
        (file.size / (1024 * 1024)).toFixed(2)
        + ' MB';

    // URL FILE
    const fileURL =
        URL.createObjectURL(file);

    // BUTTON VIEW
    document.getElementById('viewFileBtn')
        .onclick = function(){

            window.open(fileURL, '_blank');

        };

    showToast(
        'File berhasil dipilih!',
        'success'
    );

}


// =========================
// REMOVE FILE
// =========================
function removeFile(){

    document.getElementById('fileInput').value = '';

    document.getElementById('filePreview')
        .style.display = 'none';

    showToast(
        'File dihapus',
        'warning'
    );

}


// =========================
// DRAG & DROP
// =========================
const uploadArea =
    document.getElementById('uploadArea');

if (uploadArea) {

    uploadArea.addEventListener('dragover', (e) => {

        e.preventDefault();

        uploadArea.classList.add('dragover');

    });

    uploadArea.addEventListener('dragleave', () => {

        uploadArea.classList.remove('dragover');

    });

    uploadArea.addEventListener('drop', (e) => {

        e.preventDefault();

        uploadArea.classList.remove('dragover');

        const fileInput =
            document.getElementById('fileInput');

        fileInput.files = e.dataTransfer.files;

        handleFileUpload(fileInput);

    });

}


// =========================
// TOAST
// =========================
function showToast(message, type = 'success') {

    const container =
        document.getElementById('toastContainer');

    if (!container) return;

    const toast =
        document.createElement('div');

    toast.className = `toast ${type}`;

    const icons = {

        success: 'fa-check-circle',
        error: 'fa-times-circle',
        warning: 'fa-exclamation-triangle'

    };

    toast.innerHTML = `
        <i class="fas ${icons[type]} toast-icon"></i>

        <span class="toast-message">
            ${message}
        </span>
    `;

    container.appendChild(toast);

    setTimeout(() => {

        toast.remove();

    }, 4000);
}


// =========================
// COUNTDOWN TIMER
// =========================
function startTimer() {

    const timerElement =
        document.getElementById('timerText');

    if (!timerElement) return;

    let duration = 24 * 60 * 60;

    function updateTimer() {

        const hours =
            Math.floor(duration / 3600);

        const minutes =
            Math.floor(
                (duration % 3600) / 60
            );

        const seconds =
            duration % 60;

        timerElement.textContent =
            `Batas pembayaran: ${
                String(hours).padStart(2, '0')
            }:${
                String(minutes).padStart(2, '0')
            }:${
                String(seconds).padStart(2, '0')
            }`;

        if (duration <= 0) {

            clearInterval(timerInterval);

            timerElement.textContent =
                'Waktu pembayaran habis!';

            return;
        }

        duration--;
    }

    updateTimer();

    const timerInterval =
        setInterval(updateTimer, 1000);
}


// =========================
// CLOSE MODAL
// =========================
function closeModal() {

    const modal =
        document.getElementById('paymentModal');

    if (modal) {

        modal.classList.remove('show');

        document.body.style.overflow = 'auto';

    }

}


// =========================
// OVERLAY CLICK
// =========================
const paymentModal =
    document.getElementById('paymentModal');

if (paymentModal) {

    paymentModal.addEventListener('click', function (e) {

        if (e.target === this) {

            closeModal();

        }

    });

}
    </script>

    <script>

// =========================
// PROCESS PAYMENT
// =========================
function processPayment() {

    // ambil form
    const form =
        document.getElementById('paymentForm');

    // cek upload file
    const fileInput =
        document.getElementById('fileInput');

    if (!fileInput.value) {

        showToast(
            'Silakan upload bukti pembayaran terlebih dahulu',
            'error'
        );

        return;
    }

    // disable tombol
    const payBtn =
        document.getElementById('payBtn');

    payBtn.disabled = true;

    payBtn.innerHTML = `
        <i class="fas fa-spinner fa-spin"></i>
        <span>Memproses Pembayaran...</span>
    `;

    // submit form
    form.submit();
}

</script>

<script>

function setPaymentMethod(select){

    const value = select.value;

    const metodeInput =
        document.getElementById('metodePembayaran');

    // TRANSFER BANK
    if([
        'bca',
        'mandiri',
        'bni',
        'bri'
    ].includes(value)){

        metodeInput.value =
            'transfer_bank';
    }

    // QRIS / EWALLET
    else if([
        'gopay',
        'ovo',
        'dana',
        'shopeepay'
    ].includes(value)){

        metodeInput.value =
            'qris_ewallet';
    }

    // VIRTUAL ACCOUNT
    else if([
        'bca_va',
        'mandiri_va',
        'bni_va'
    ].includes(value)){

        metodeInput.value =
            'virtual_account';
    }

    else{

        metodeInput.value = '';

    }

}

</script>
</body>
</html>

