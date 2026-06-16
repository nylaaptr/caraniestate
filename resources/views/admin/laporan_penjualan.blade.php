<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fontsource-roboto@5.1.0/index.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --primary-blue: #7AB2D3;
            --primary-blue-rgb: 122, 178, 211;
            --dark-blue: #1E3A5F;
            --light-blue: #e6f2f8;
            --sidebar-width-collapsed: 80px;
            --sidebar-width-expanded: 250px;
            --success-green: #2ecc71;
            --warning-orange: #f39c12;
            --danger-red: #e74c3c;
            --purple: #9b59b6;
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
            width: var(--sidebar-width-collapsed);
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
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            flex-shrink: 0;
        }

        .logo i {
            font-size: 20px;
            color: var(--dark-blue);
        }

        .company-name {
            font-weight: 700;
            font-size: 0.85rem;
            line-height: 1.2;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

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
            padding: 15px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 4px solid transparent;
            white-space: nowrap;
            overflow: hidden;
        }

        .nav-group {
            display: flex;
            flex-direction: column;
        }

        .nav-parent {
            justify-content: space-between;
        }

        .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .nav-submenu {
            display: none;
            flex-direction: column;
            padding-left: 40px;
            transition: all 0.2s ease;
        }
        

        /* optional arrow */
        .nav-group.open .arrow {
            transform: rotate(180deg);
        }

        .nav-submenu a {
            padding: 10px 20px;
            font-size: 0.9rem;
            opacity: 0.85;
        }

        .nav-submenu a:hover {
            opacity: 1;
        }

        /* open state */
        .nav-group.open .nav-submenu {
            display: flex;
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
            flex-shrink: 0;
        }

        .nav-item span {
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            display: inline-block;
        }

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
            color: #ffff;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
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
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar:hover .logout-btn span {
            opacity: 1;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width-collapsed);
            overflow-y: auto;
            padding: 25px 30px;
            background: #f8fafc;
            transition: margin-left 0.3s ease;
            height: 100vh;
        }

        .sidebar:hover + .main-content {
            margin-left: var(--sidebar-width-expanded);
        }

        /* Header Section */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title-section h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }

        .page-title-section p {
            color: #64748b;
            font-size: 0.95rem;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            font-family: inherit;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--dark-blue), #2563eb);
            color: white;
            box-shadow: 0 3px 10px rgba(30, 58, 95, 0.25);
        }

        .btn-primary:hover {
            box-shadow: 0 5px 15px rgba(30, 58, 95, 0.35);
            transform: translateY(-1px);
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            box-shadow: 0 3px 10px rgba(46, 204, 113, 0.25);
        }

        .btn-success:hover {
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.35);
            transform: translateY(-1px);
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

        /* Filter Bar */
        .filter-bar {
            background: white;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            display: flex;
            gap: 15px;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 150px;
        }

        .filter-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-input, .filter-select {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: inherit;
            color: #334155;
            background: white;
            transition: all 0.3s;
        }

        .filter-input:focus, .filter-select:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15);
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            border-radius: 4px 0 0 4px;
        }

        .summary-card.revenue::before { background: var(--primary-blue); }
        .summary-card.orders::before { background: var(--success-green); }
        .summary-card.pending::before { background: var(--warning-orange); }
        .summary-card.cancelled::before { background: var(--danger-red); }

        .summary-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .card-info h3 {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .card-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .card-change {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8rem;
            margin-top: 8px;
            font-weight: 500;
        }

        .card-change.positive { color: var(--success-green); }
        .card-change.negative { color: var(--danger-red); }

        .card-icon {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .summary-card.revenue .card-icon { background: rgba(122, 178, 211, 0.12); color: var(--primary-blue); }
        .summary-card.orders .card-icon { background: rgba(46, 204, 113, 0.12); color: var(--success-green); }
        .summary-card.pending .card-icon { background: rgba(243, 156, 18, 0.12); color: var(--warning-orange); }
        .summary-card.cancelled .card-icon { background: rgba(231, 76, 60, 0.12); color: var(--danger-red); }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        @media (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .chart-subtitle {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 2px;
        }

        .chart-tabs {
            display: flex;
            gap: 5px;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 3px;
        }

        .chart-tab {
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            background: none;
            color: #64748b;
            transition: all 0.3s;
        }

        .chart-tab.active {
            background: white;
            color: var(--dark-blue);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .chart-container-sm {
            position: relative;
            height: 280px;
        }

        /* Data Table */
        .table-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .table-header {
            padding: 22px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .table-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .table-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 12px;
            transition: all 0.3s;
        }

        .search-box:focus-within {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(122, 178, 211, 0.15);
        }

        .search-box input {
            border: none;
            background: none;
            outline: none;
            font-size: 0.9rem;
            font-family: inherit;
            color: #334155;
            width: 180px;
        }

        .search-box i {
            color: #94a3b8;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 14px 18px;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #f8fafc;
            border-bottom: 2px solid #f1f5f9;
            white-space: nowrap;
        }

        tbody td {
            padding: 14px 18px;
            font-size: 0.9rem;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            white-space: nowrap;
        }

        tbody tr {
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-badge.lunas {
            background: rgba(46, 204, 113, 0.12);
            color: #27ae60;
        }

        .status-badge.pending {
            background: rgba(243, 156, 18, 0.12);
            color: #e67e22;
        }

        .status-badge.booking {
            background: rgba(122, 178, 211, 0.12);
            color: var(--primary-blue);
        }

        .status-badge.batal {
            background: rgba(231, 76, 60, 0.12);
            color: #e74c3c;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }

        .status-badge.lunas .status-dot { background: #27ae60; }
        .status-badge.pending .status-dot { background: #e67e22; }
        .status-badge.booking .status-dot { background: var(--primary-blue); }
        .status-badge.batal .status-dot { background: #e74c3c; }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: none;
            cursor: pointer;
            transition: all 0.3s;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover {
            background: #f1f5f9;
            color: var(--dark-blue);
        }

        .action-btn.view:hover { background: rgba(122, 178, 211, 0.12); color: var(--primary-blue); }
        .action-btn.edit:hover { background: rgba(46, 204, 113, 0.12); color: #27ae60; }
        .action-btn.delete:hover { background: rgba(231, 76, 60, 0.12); color: #e74c3c; }

        /* Pagination */
        .table-footer {
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f1f5f9;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination-info {
            font-size: 0.85rem;
            color: #64748b;
        }

        .pagination {
            display: flex;
            gap: 5px;
            margin-left: auto;
            align-items: center;
        }

        .page-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 500;
            color: #64748b;
            transition: all 0.3s;
        }

        .page-btn:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
        }

        .page-btn.active {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .page-btn.dots {
            pointer-events: none;
            background: transparent;
            box-shadow: none;
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
            z-index: 1000;
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
            border-radius: 16px;
            max-width: 600px;
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
            padding: 22px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: #f1f5f9;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.3s;
        }

        .modal-close:hover {
            background: #fee2e2;
            color: #ef4444;
        }

        .modal-body {
            padding: 22px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .detail-label {
            font-size: 0.8rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .detail-value {
            font-size: 0.95rem;
            color: #1e293b;
            font-weight: 500;
        }

        .detail-section {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
        }

        .detail-section-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-section-title i {
            color: var(--primary-blue);
        }

        .modal-footer {
            padding: 18px 22px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        /* Toast */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2000;
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
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            min-width: 280px;
            animation: slideInRight 0.3s ease;
            border-left: 4px solid var(--success-green);
        }

        .toast.error { border-left-color: var(--danger-red); }
        .toast.warning { border-left-color: var(--warning-orange); }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .toast-icon { font-size: 1.1rem; }
        .toast-message { flex: 1; font-size: 0.85rem; color: #334155; font-weight: 500; }
        .toast-close { background: none; border: none; color: #94a3b8; cursor: pointer; }

        /* Print Styles */
        @media print {
            .sidebar, .header-actions, .filter-bar, .table-actions, .action-btn, .table-footer, .modal-overlay, .toast-container {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }
            .page-title-section h1 {
                font-size: 1.4rem;
            }
            .summary-cards {
                grid-template-columns: repeat(2, 1fr);
            }
            .filter-bar {
                flex-direction: column;
            }
            .filter-group {
                width: 100%;
            }
            .detail-grid {
                grid-template-columns: 1fr;
            }
            .header-actions {
                width: 100%;
            }
            .header-actions .btn {
                flex: 1;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .summary-cards {
                grid-template-columns: 1fr;
            }
        }

        /* Loading Spinner */
        .spinner {
            width: 18px;
            height: 18px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar"  id="sidebar">
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

            <div class="nav-group" id="propertiMenu">
                <div class="nav-item nav-parent" onclick="toggleMenu('propertiMenu')">
                    <i class="fas fa-house"></i>
                    <span>Properti</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>

                <div class="nav-submenu">
                    <a href="{{ route('admin.data_rumah') }}" class="nav-subitem">
                        <span>Data Rumah</span>
                    </a>

                    <a href="{{ route('admin.perumahan') }}" class="nav-subitem">
                        <span>Perumahan</span>
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.halaman_verifikasi') }}"
                class="nav-item {{ request()->routeIs('admin.halaman_verifikasi') ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i>
                <span>Verifikasi Data</span>
            </a>

            <a href="{{ route('admin.monitoring-pemesanan') }}"
                class="nav-item {{ request()->routeIs('admin.monitoring-pemesanan') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Monitoring</span>
            </a>

            <a href="{{ route('admin.laporan_penjualan') }}"
                class="nav-item {{ request()->routeIs('admin.laporan_penjualan') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan Penjualan</span>
            </a>

            <a href="{{ route('admin.pesan_pelanggan') }}"
                class="nav-item {{ request()->routeIs('admin.pesan_pelanggan') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Pesan Pelanggan</span>
            </a>
        
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn" style="width:100%; background:none; border:none; cursor:pointer; text-align:left;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
    

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title-section">
                <h1><i class="fas fa-chart-line" style="color:var(--primary-blue); margin-right:10px;"></i>Laporan Penjualan</h1>
                <p>Ringkasan dan analisis data penjualan properti</p>
            </div>
            <div class="header-actions">
                <a
                    href="{{ route('laporan.penjualan.export', request()->query()) }}"
                    class="btn btn-success">

                    <i class="fas fa-file-excel"></i>
                    Export Excel
                </a>
                <button class="btn btn-primary" onclick="showToast('Laporan berhasil diperbarui!', 'success')">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>

        <!-- Filter Bar -->
        <!-- FILTER BAR -->
<form method="GET">
    <div class="filter-bar">

        <div class="filter-group">
            <label class="filter-label">Tanggal Mulai</label>
            <input
                type="date"
                class="filter-input"
                name="date_start"
                value="{{ request('date_start') }}">
        </div>

        <div class="filter-group">
            <label class="filter-label">Tanggal Akhir</label>
            <input
                type="date"
                class="filter-input"
                name="date_end"
                value="{{ request('date_end') }}">
        </div>

        <div class="filter-group">
            <label class="filter-label">Status</label>
            <select class="filter-select" name="status_transaksi">
                <option value="all">
                    Semua Status
                </option>

                <option value="menunggu_pembayaran"
                    {{ request('status_transaksi') == 'menunggu_pembayaran' ? 'selected' : '' }}>
                    Menunggu Pembayaran
                </option>

                <option value="menunggu_verifikasi"
                    {{ request('status_transaksi') == 'menunggu_verifikasi' ? 'selected' : '' }}>
                    Menunggu Verifikasi
                </option>

                <option value="berhasil"
                    {{ request('status_transaksi') == 'berhasil' ? 'selected' : '' }}>
                    Berhasil
                </option>

                <option value="ditolak"
                    {{ request('status_transaksi') == 'ditolak' ? 'selected' : '' }}>
                    Ditolak
                </option>

                <option value="perlu_upload_ulang"
                    {{ request('status_transaksi') == 'perlu_upload_ulang' ? 'selected' : '' }}>
                    Perlu Upload Ulang
                </option>

                <option value="pending"
                    {{ request('status_transaksi') == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Tipe Properti</label>

            <select class="filter-select" name="type">
                <option value="all">Semua Tipe</option>

                <option value="30/60" {{ request('type') == '30/60' ? 'selected' : '' }}>
                    30/60
                </option>

                <option value="36/72" {{ request('type') == '36/72' ? 'selected' : '' }}>
                    36/72
                </option>

                <option value="45/84" {{ request('type') == '45/84' ? 'selected' : '' }}>
                    45/84
                </option>

                <option value="60/135" {{ request('type') == '60/135' ? 'selected' : '' }}>
                    60/135
                </option>

                <option value="Ruko" {{ request('type') == 'Ruko' ? 'selected' : '' }}>
                    Ruko
                </option>
            </select>
        </div>

        <button class="btn btn-primary" style="align-self:flex-end">
            <i class="fas fa-filter"></i>
            Terapkan
        </button>

    </div>
</form>


<!-- SUMMARY CARDS -->
<div class="summary-cards">

    <!-- TOTAL PENDAPATAN -->
    <div class="summary-card revenue">
        <div class="card-info">

            <h3>Total Pendapatan</h3>

            <div class="card-value">
                Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
            </div>
        </div>

        <div class="card-icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
    </div>

    <!-- TOTAL TRANSAKSI -->
    <div class="summary-card orders">
        <div class="card-info">

            <h3>Total Transaksi</h3>

            <div class="card-value">
                {{ $totalTransaksi }}
            </div>
        </div>

        <div class="card-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
    </div>

    <!-- TOTAL PENDING -->
    <div class="summary-card pending">
        <div class="card-info">

            <h3>Menunggu Pembayaran</h3>

            <div class="card-value">
                {{ $totalPending }}
            </div>
        </div>

        <div class="card-icon">
            <i class="fas fa-clock"></i>
        </div>
    </div>

    <!-- TOTAL BATAL -->
    <div class="summary-card cancelled">
        <div class="card-info">

            <h3>Pembatalan</h3>

            <div class="card-value">
                {{ $totalBatal }}
            </div>
        </div>

        <div class="card-icon">
            <i class="fas fa-times-circle"></i>
        </div>
    </div>

</div>


<!-- TABLE -->
<div class="table-card">

    <div class="table-header">

        <div class="table-title">
            Detail Transaksi Penjualan
        </div>

        <div class="table-actions">

            <form method="GET">
                <div class="search-box">
                    <i class="fas fa-search"></i>

                    <input
                        type="text"
                        name="search"
                        placeholder="Cari transaksi..."
                        value="{{ request('search') }}">
                </div>
            </form>

        </div>

    </div>

    <div class="table-wrapper">

        <table id="salesTable">

            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Pembeli</th>
                    <th>Tipe Properti</th>
                    <th>Unit</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="tableBody">

                @forelse($transaksi as $item)

                    <tr>

                        <td>
                            {{ $transaksi->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <strong>
                                {{ $item->id_transaksi }}
                            </strong>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d M Y') }}
                        </td>

                        <td>
                            {{ $item->user->nama_user ?? '-' }}
                        </td>

                        <td>
                            {{ $item->properti->nama_properti ?? '-' }}
                        </td>

                        <td>
                            {{ $item->properti->tipe_properti ?? '-' }}
                        </td>

                        <td>
                            <strong>
                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </strong>
                        </td>

                        <td>
                            <span class="status-badge {{ $item->status }}">
                                <span class="status-dot"></span>

                                {{ ucwords(str_replace('_', ' ', $item->status_transaksi)) }}
                            </span>
                        </td>

                        <td>
                            <button
                                class="action-btn delete"
                                onclick="confirmDelete('{{ $item->id }}')"
                                title="Hapus">

                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty

                    <tr>
                        <td colspan="9" style="text-align:center; padding:30px;">
                            Data transaksi tidak ditemukan
                        </td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="table-footer">

        <div class="pagination">

            {{-- Tombol Previous --}}
            @if ($transaksi->onFirstPage())
                <button class="page-btn" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
            @else
                <a href="{{ $transaksi->previousPageUrl() }}"
                class="page-btn">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif


            {{-- Nomor Halaman --}}
            @for ($i = 1; $i <= $transaksi->lastPage(); $i++)

                @if (
                    $i == 1 ||
                    $i == $transaksi->lastPage() ||
                    ($i >= $transaksi->currentPage() - 1 &&
                    $i <= $transaksi->currentPage() + 1)
                )

                    <a href="{{ $transaksi->url($i) }}"
                    class="page-btn {{ $transaksi->currentPage() == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>

                @elseif (
                    $i == $transaksi->currentPage() - 2 ||
                    $i == $transaksi->currentPage() + 2
                )

                    <span class="page-btn dots">...</span>

                @endif

            @endfor


            {{-- Tombol Next --}}
            @if ($transaksi->hasMorePages())
                <a href="{{ $transaksi->nextPageUrl() }}"
                class="page-btn">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <button class="page-btn" disabled>
                    <i class="fas fa-chevron-right"></i>
                </button>
            @endif

        </div>

    </div>

</div>

    <!-- Detail Modal -->
    <div class="modal-overlay" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Detail Transaksi</div>
                <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Dynamic content -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal()">Tutup</button>
                <button class="btn btn-primary" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <script>
    const salesData = @json($transaksi->items());
</script>

    <script>
        // Render Table
        function renderTable(data) {
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';
            
            data.forEach((item, index) => {
                const statusLabels = {
                    lunas: 'Lunas',
                    pending: 'Pending',
                    booking: 'Booking',
                    batal: 'Batal'
                };
                
                const row = document.createElement('tr');
                row.setAttribute('data-status', item.status);
                row.setAttribute('data-type', item.type.toLowerCase());
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td><strong>${item.id}</strong></td>
                    <td>${formatDate(item.date)}</td>
                    <td>${item.buyer}</td>
                    <td>${item.type}</td>
                    <td>${item.unit}</td>
                    <td><strong>${formatCurrency(item.price)}</strong></td>
                    <td><span class="status-badge ${item.status}"><span class="status-dot"></span>${statusLabels[item.status]}</span></td>
                    <td>
                        <button class="action-btn view" onclick="showDetail('${item.id}')" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                        <button class="action-btn edit" onclick="showToast('Edit ${item.id}', 'success')" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn delete" onclick="confirmDelete('${item.id}')" title="Hapus"><i class="fas fa-trash"></i></button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Format Currency
        function formatCurrency(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        // Format Date
        function formatDate(dateStr) {
            const options = { day: '2-digit', month: 'short', year: 'numeric' };
            return new Date(dateStr).toLocaleDateString('id-ID', options);
        }

        // Search Table
        function searchTable() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const filtered = salesData.filter(item => 
                item.id.toLowerCase().includes(query) ||
                item.buyer.toLowerCase().includes(query) ||
                item.unit.toLowerCase().includes(query)
            );
            renderTable(filtered);
        }

        // Filter Table
        function filterTable() {
            applyFilters();
        }

        // Apply Filters
        function applyFilters() {
            const status = document.getElementById('statusFilter').value;
            const type = document.getElementById('typeFilter').value;
            
            let filtered = [...salesData];
            
            if (status !== 'all') {
                filtered = filtered.filter(item => item.status === status);
            }
            if (type !== 'all') {
                filtered = filtered.filter(item => item.type.toLowerCase() === type);
            }
            
            renderTable(filtered);
            showToast(`Ditemukan ${filtered.length} data`, 'success');
        }

        // Show Detail Modal
        function showDetail(id) {
            const item = salesData.find(d => d.id === id);
            if (!item) return;
            
            const statusLabels = {
                lunas: 'Lunas',
                pending: 'Pending',
                booking: 'Booking',
                batal: 'Batal'
            };
            
            const modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = `
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">ID Transaksi</span>
                        <span class="detail-value">${item.id}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal</span>
                        <span class="detail-value">${formatDate(item.date)}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nama Pembeli</span>
                        <span class="detail-value">${item.buyer}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tipe Properti</span>
                        <span class="detail-value">${item.type}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Unit</span>
                        <span class="detail-value">${item.unit}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-value"><span class="status-badge ${item.status}"><span class="status-dot"></span>${statusLabels[item.status]}</span></span>
                    </div>
                </div>
                <div class="detail-section">
                    <div class="detail-section-title"><i class="fas fa-home"></i> Detail Properti</div>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Nama Properti</span>
                            <span class="detail-value">${item.name}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Harga</span>
                            <span class="detail-value" style="font-weight:700; color:var(--dark-blue)">${formatCurrency(item.price)}</span>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('detailModal').classList.add('show');
        }

        // Close Modal
        function closeModal() {
            document.getElementById('detailModal').classList.remove('show');
        }

        // Confirm Delete
        function confirmDelete(id) {
            if (confirm(`Apakah Anda yakin ingin menghapus transaksi ${id}?`)) {
                const index = salesData.findIndex(d => d.id === id);
                if (index !== -1) {
                    salesData.splice(index, 1);
                    renderTable(salesData);
                    showToast(`Transaksi ${id} berhasil dihapus`, 'success');
                }
            }
        }

        // Toast Notification
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            
            const icons = { success: 'fa-check-circle', error: 'fa-times-circle', warning: 'fa-exclamation-triangle' };
            const colors = { success: 'var(--success-green)', error: 'var(--danger-red)', warning: 'var(--warning-orange)' };
            
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

        // Export to Excel
        function exportToExcel() {
            let csv = 'No,ID Transaksi,Tanggal,Pembeli,Tipe,Unit,Harga,Status\n';
            
            salesData.forEach((item, index) => {
                csv += `${index + 1},${item.id},${item.date},${item.buyer},${item.type},${item.unit},${item.price},${item.status}\n`;
            });
            
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `laporan_penjualan_${new Date().toISOString().split('T')[0]}.csv`;
            a.click();
            window.URL.revokeObjectURL(url);
            
            showToast('File berhasil di-export!', 'success');
        }

        // Chart Initialization
        let salesChartInstance = null;
        let statusChartInstance = null;

        function initCharts() {
            // Sales Chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            
            salesChartInstance = new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pendapatan (Juta Rp)',
                        data: [180, 220, 195, 250, 280, 310, 290, 320, 350, 380, 340, 400],
                        backgroundColor: 'rgba(122, 178, 211, 0.7)',
                        borderColor: 'rgba(122, 178, 211, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }, {
                        label: 'Jumlah Transaksi',
                        data: [12, 15, 13, 18, 20, 22, 19, 24, 26, 28, 25, 30],
                        type: 'line',
                        borderColor: 'rgba(46, 204, 113, 1)',
                        backgroundColor: 'rgba(46, 204, 113, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: 'rgba(46, 204, 113, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                font: { size: 12, family: "'Segoe UI', sans-serif" }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(30, 58, 95, 0.9)',
                            titleFont: { size: 13, weight: '600' },
                            bodyFont: { size: 12 },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: true
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { size: 12, family: "'Segoe UI', sans-serif" },
                                color: '#64748b'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.05)' },
                            ticks: {
                                font: { size: 11 },
                                color: '#64748b',
                                callback: function(value) { return value + ' Jt'; }
                            }
                        },
                        y1: {
                            position: 'right',
                            beginAtZero: true,
                            grid: { display: false },
                            ticks: {
                                font: { size: 11 },
                                color: '#64748b',
                                stepSize: 5
                            }
                        }
                    }
                }
            });

            // Status Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            
            statusChartInstance = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Lunas', 'Pending', 'Booking', 'Batal'],
                    datasets: [{
                        data: [98, 23, 18, 7],
                        backgroundColor: [
                            'rgba(46, 204, 113, 0.8)',
                            'rgba(243, 156, 18, 0.8)',
                            'rgba(122, 178, 211, 0.8)',
                            'rgba(231, 76, 60, 0.8)'
                        ],
                        borderColor: [
                            'rgba(46, 204, 113, 1)',
                            'rgba(243, 156, 18, 1)',
                            'rgba(122, 178, 211, 1)',
                            'rgba(231, 76, 60, 1)'
                        ],
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                font: { size: 12, family: "'Segoe UI', sans-serif" }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(30, 58, 95, 0.9)',
                            titleFont: { size: 13, weight: '600' },
                            bodyFont: { size: 12 },
                            padding: 12,
                            cornerRadius: 8
                        }
                    }
                }
            });
        }

        // Update Chart
        function updateChart(period, btn) {
            document.querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');
            
            if (period === 'weekly') {
                salesChartInstance.data.labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                salesChartInstance.data.datasets[0].data = [65, 78, 82, 55];
                salesChartInstance.data.datasets[1].data = [4, 6, 7, 3];
            } else {
                salesChartInstance.data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                salesChartInstance.data.datasets[0].data = [180, 220, 195, 250, 280, 310, 290, 320, 350, 380, 340, 400];
                salesChartInstance.data.datasets[1].data = [12, 15, 13, 18, 20, 22, 19, 24, 26, 28, 25, 30];
            }
            
            salesChartInstance.update();
        }

        // Pagination
        document.querySelectorAll('.page-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.disabled) return;
                document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Close modal on overlay click
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initCharts();
        });
    </script>


    <script>
document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    if (!sidebar || !mainContent) {
        console.error("sidebar / mainContent tidak ditemukan");
        return;
    }

    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

    function closeAllDropdowns() {
        document.querySelectorAll('.nav-group.open').forEach(el => {
            el.classList.remove('open');
        });
    }

    // INIT STATE
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
        mainContent.classList.add('expanded');
        closeAllDropdowns();
    }

    // HOVER IN
    sidebar.addEventListener('mouseenter', function () {
        if (this.classList.contains('collapsed')) {
            this.classList.add('hovering');
        }
    });

    // HOVER OUT
    sidebar.addEventListener('mouseleave', function () {
        this.classList.remove('hovering');
        closeAllDropdowns();
    });
});


/* ===================================================
   TOGGLE DROPDOWN (INI WAJIB GLOBAL BIAR onclick WORK)
=================================================== */
window.toggleMenu = function (id) {

    const sidebar = document.getElementById('sidebar');
    const el = document.getElementById(id);

    if (!el || !sidebar) return;

    // kalau sidebar collapsed DAN tidak hover → blok
    const isBlocked =
        sidebar.classList.contains('collapsed') &&
        !sidebar.classList.contains('hovering');

    if (isBlocked) return;

    el.classList.toggle('open');
};
</script>
</body>
</html>

