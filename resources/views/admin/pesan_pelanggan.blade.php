<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot Admin - Carani Estate</title>
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
            color: #ffff;
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
        
        .search-bar {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 8px 15px;
            width: 300px;
        }
        
        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            padding: 5px;
            width: 100%;
            font-size: 0.95rem;
        }
        
        .search-bar i {
            color: #64748b;
            margin-right: 10px;
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
        
        /* Chat Container */
        .chat-container {
            display: flex;
            height: calc(100vh - 160px);
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        /* Chat List Sidebar */
        .chat-list {
            width: 320px;
            border-right: 1px solid #e2e8f0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        
        .chat-list-header {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }
        
        .chat-list-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a365d;
            margin-bottom: 15px;
        }
        
        .chat-stats {
            display: flex;
            gap: 15px;
        }
        
        .stat-item {
            text-align: center;
            flex: 1;
        }
        
        .stat-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-blue);
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .chat-filters {
            padding: 15px 20px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            display: flex;              /* kunci utama */
            align-items: center;        /* sejajar secara vertikal */
            justify-content: flex-start;/* kiri ke kanan */
            gap: 8px;
        }
        
        .filter-btn {
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 0.85rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-btn.active {
            background: var(--primary-blue);
            color: white;
        }
        
        .filter-btn:not(.active) {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .chat-items {
            flex-grow: 1;
            overflow-y: auto;
        }
        
        .chat-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .chat-item:hover {
            background: #f8fafc;
        }
        
        .chat-item.active {
            background: #e0f2fe;
            border-left: 4px solid var(--primary-blue);
        }
        
        .chat-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .chat-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .chat-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 16px;
        }

        .chat-avatar-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .chat-user-details {
            flex: 1;
        }
        
        .chat-user-name {
            font-weight: 600;
            color: #1a365d;
            font-size: 0.95rem;
        }
        
        .chat-user-id {
            font-size: 0.75rem;
            color: #64748b;
        }
        
        .chat-time {
            font-size: 0.75rem;
            color: #64748b;
        }
        
        .chat-preview {
            font-size: 0.85rem;
            color: #4a5568;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 5px;
        }
        
        .chat-tags {
            display: flex;
            gap: 5px;
        }
        
        .chat-tag {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 500;
        }
        
        .tag-new {
            background: #fef3c7;
            color: #f59e0b;
        }
        
        .tag-pending {
            background: #e0f2fe;
            color: #0369a1;
        }
        
        .tag-resolved {
            background: #d1fae5;
            color: #059669;
        }
        
        /* Chat Content */
        .chat-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .chat-header {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .chat-user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 20px;
        }
        
        .chat-user-info-large {
            flex: 1;
        }
        
        .chat-user-name-large {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a365d;
            margin-bottom: 3px;
        }
        
        .chat-user-details-large {
            display: flex;
            gap: 15px;
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .chat-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-online {
            background: #d1fae5;
            color: #059669;
        }
        
        .status-offline {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .chat-actions {
            display: flex;
            gap: 10px;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-resolve {
            background: #d1fae5;
            color: #059669;
        }
        
        .btn-resolve:hover {
            background: #86efac;
        }
        
        .btn-delete {
            background: #fecaca;
            color: #dc2626;
        }
        
        .btn-delete:hover {
            background: #fca5a5;
        }
        
        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .message {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 12px;
            position: relative;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .message-user {
            align-self: flex-start;
            background: #f1f5f9;
            color: #1a365d;
            border-bottom-left-radius: 4px;
        }
        
        .message-admin {
            align-self: flex-end;
            background: var(--primary-blue);
            color: white;
            border-bottom-right-radius: 4px;
        }
        
        .message-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 0.8rem;
        }
        
        .message-sender {
            font-weight: 600;
        }
        
        .message-time {
            opacity: 0.8;
        }
        
        .message-content {
            line-height: 1.5;
        }
        
        .message-actions {
            position: absolute;
            top: 5px;
            right: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .message:hover .message-actions {
            opacity: 1;
        }
        
        .message-action-btn {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
            background: rgba(0,0,0,0.1);
            color: white;
        }
        
        .chat-input form {
            padding: 20px;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
            display: flex;
            gap: 10px;
        }
        
        .message-input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            resize: none;
            min-height: 60px;
            max-height: 120px;
        }
        
        .message-input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(var(--primary-blue-rgb), 0.2);
            outline: none;
        }
        
        .send-btn {
            background: var(--primary-blue);
            color: white;
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .send-btn:hover {
            background: #6aa5c6;
            transform: scale(1.05);
        }
        
        .send-btn:disabled {
            background: #cbd5e0;
            cursor: not-allowed;
            transform: none;
        }

        /* KATALOG CARD */
        .chat-katalog-wrapper {
            max-width: 80%; /* samakan dengan bubble chat */
            width: fit-content;
            margin-top: 8px;
            margin-left: 0;
            padding-left: 46px; /* sejajar avatar bot */
        }

        /* Property Cards */
        .properti-cards {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 12px;
        }

        .properti-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
        }

        .properti-card:hover {
            box-shadow: 0 4px 15px rgba(122, 178, 211, 0.3);
            border-color: var(--primary-blue);
        }

        .properti-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .properti-card-nama {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--dark-blue);
        }

        .properti-card-badge {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 20px;
            font-weight: 600;
        }

        .badge-subsidi {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-komersial {
            background: #fef3c7;
            color: #d97706;
        }

        .properti-card-info {
            display: flex;
            gap: 12px;
            font-size: 0.82rem;
            color: #64748b;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }

        .properti-card-info span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .properti-card-harga {
            font-weight: 700;
            color: var(--primary-blue);
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .properti-card-btn {
            width: 100%;
            padding: 8px;
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .properti-card-btn:hover {
            background: var(--dark-blue);
            color: white;
        }

        /* ADDED: Recommend Properties Styles */
        .btn-recommend {
            background: #f59e0b;
            color: white;
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-recommend:hover {
            background: #d97706;
            transform: scale(1.05);
        }

        .recommend-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .recommend-modal-overlay.show {
            display: flex;
        }

        .recommend-modal {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 800px;
            max-height: 85vh;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            animation: slideUp 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .recommend-modal-header {
            padding: 20px 25px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .recommend-modal-title {
            font-size: 1.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .recommend-modal-close {
            background: rgba(255,255,255,0.2);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .recommend-modal-close:hover {
            background: rgba(255,255,255,0.3);
        }

        .recommend-modal-search {
            padding: 15px 25px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            gap: 10px;
        }

        .recommend-search-input {
            flex: 1;
            padding: 10px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
            transition: all 0.3s;
        }

        .recommend-search-input:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
        }

        .recommend-filter-select {
            padding: 10px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            background: white;
            cursor: pointer;
            outline: none;
        }

        .recommend-modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px 25px;
        }

        .recommend-property-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .recommend-property-item:hover {
            border-color: #f59e0b;
            background: #fffbeb;
        }

        .recommend-property-item.selected {
            border-color: #f59e0b;
            background: #fef3c7;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
        }

        .recommend-prop-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary-blue), #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .recommend-prop-info {
            flex: 1;
        }

        .recommend-prop-name {
            font-weight: 700;
            color: var(--dark-blue);
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .recommend-prop-details {
            font-size: 0.82rem;
            color: #64748b;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 6px;
        }

        .recommend-prop-details span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .recommend-prop-price {
            font-weight: 700;
            color: #f59e0b;
            font-size: 0.95rem;
        }

        .recommend-prop-check {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s;
            color: transparent;
        }

        .recommend-property-item.selected .recommend-prop-check {
            background: #f59e0b;
            border-color: #f59e0b;
            color: white;
        }

        .recommend-selected-bar {
            padding: 15px 25px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .recommend-count {
            font-size: 0.9rem;
            color: #64748b;
        }

        .recommend-count strong {
            color: #f59e0b;
        }

        .recommend-send-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .recommend-send-btn:hover {
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
            transform: translateY(-1px);
        }

        .recommend-send-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .recommend-empty {
            text-align: center;
            padding: 40px;
            color: #64748b;
        }

        .recommend-empty i {
            font-size: 3rem;
            color: #cbd5e1;
            margin-bottom: 15px;
        }

        /* ADDED: Selected Properties Tags in Input Area */
        .selected-props-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 10px 20px;
            background: #fffbeb;
            border-top: 1px solid #fde68a;
        }

        .selected-prop-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: white;
            border: 1px solid #fde68a;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #92400e;
        }

        .selected-prop-tag button {
            background: #fde68a;
            border: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: #92400e;
            transition: all 0.3s;
        }

        .selected-prop-tag button:hover {
            background: #fca5a5;
            color: white;
        }

        .recommend-prop-card{
            display:flex;
            gap:12px;
            align-items:center;
        }

        .recommend-prop-image img{
            width:80px;
            height:80px;
            object-fit:cover;
            border-radius:10px;
        }

        .recommend-prop-info{
            flex:1;
        }

        .recommend-prop-name{
            font-weight:600;
            margin-bottom:4px;
        }

        .recommend-prop-block{
            font-size:13px;
            color:#666;
            margin-bottom:4px;
        }

        .recommend-prop-detail{
            font-size:12px;
            color:#777;
        }

        .recommend-prop-price{
            margin-top:6px;
            font-weight:700;
            color:#1E3A5F;
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .chat-list {
                width: 280px;
            }
        }
        
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
            
            .search-bar {
                width: 100%;
            }
            
            .page-title {
                font-size: 1.3rem;
            }
            
            .chat-container {
                height: calc(100vh - 140px);
            }

            .recommend-modal {
                width: 95%;
                max-height: 90vh;
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
            
            .chat-container {
                flex-direction: column;
                height: calc(100vh - 120px);
            }
            
            .chat-list {
                width: 100%;
                max-height: 300px;
            }
            
            .chat-content {
                height: calc(100% - 300px);
            }

            .recommend-modal-body {
                padding: 15px;
            }

            .recommend-property-item {
                flex-direction: column;
                align-items: flex-start;
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
                font-size: 1.1rem;
            }
            
            .chat-list-header, .chat-filters {
                padding: 12px 15px;
                flex-wrap: wrap;
            }
            
            .chat-item {
                padding: 12px 15px;
            }
            
            .chat-user-name {
                font-size: 0.9rem;
            }
            
            .chat-preview {
                font-size: 0.8rem;
            }
            
            .chat-header {
                padding: 15px;
            }
            
            .chat-user-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
            
            .chat-user-name-large {
                font-size: 1rem;
            }
            
            .chat-messages {
                padding: 15px;
            }
            
            .message {
                max-width: 80%;
            }
            
            .chat-input {
                padding: 15px;
            }
            
            .message-input {
                min-height: 50px;
            }
            
            .send-btn {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }

            .btn-recommend {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-home"></i>
            </div>
            <div class="company-name">PT. Carani Bhanu Balakosa</div>
        </div> -->
        
        <!-- <div class="sidebar"  id="sidebar"> -->
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
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title">Pesan Pelanggan</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
        
        <!-- Chat Container -->
        <div class="chat-container">
            <!-- Chat List -->
            <div class="chat-list">
                <div class="chat-list-header">
                    <h2 class="chat-list-title">
                        Riwayat Chat Pengguna
                    </h2>

                    <div class="chat-stats">

                        <div class="stat-item">
                            <div class="stat-value">
                                {{ $totalActiveChats }}
                            </div>
                            <div class="stat-label">
                                Aktif
                            </div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-value">
                                {{ $newChatsToday }}
                            </div>
                            <div class="stat-label">
                                Baru
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="chat-filters">
                    <button class="filter-btn active">
                        Semua
                    </button>

                    <button class="filter-btn">
                        Pending
                    </button>

                    <button class="filter-btn">
                        Ditanggapi
                    </button>
                </div>


                <div class="chat-items">
                    @forelse($chatSessions as $chat)
                        <div class="chat-item {{ request()->get('chat_session') == $chat['session_id'] ? 'active' : '' }}"
                        onclick="window.location='{{ route('admin.pesan_pelanggan', ['chat_session' => $chat['session_id']]) }}'">
                            <div class="chat-item-header">
                                <div class="chat-user-info">
                                    @if(str_contains($chat['avatar'], 'http') || str_contains($chat['avatar'], 'storage'))
                                        <img src="{{ $chat['avatar'] }}" class="chat-avatar-img">
                                    @else
                                        <div class="chat-avatar">
                                            {{ $chat['avatar'] }}
                                        </div>
                                    @endif

                                    <div class="chat-user-details">
                                        <div class="chat-user-name">
                                            {{ $chat['nama'] }}
                                        </div>
                                        <div class="chat-user-id">
                                            SESSION:
                                            {{ $chat['session_id'] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="chat-time">
                                    {{ \Carbon\Carbon::parse($chat['time'])->diffForHumans() }}
                                </div>
                            </div>

                            <div class="chat-preview">
                                {{ $chat['preview'] }}
                            </div>

                            <div class="chat-tags">
                                @if($chat['status'] == 'pending')
                                    <span class="chat-tag tag-pending">
                                        Pending
                                    </span>
                                @else
                                    <span class="chat-tag tag-resolved">
                                        Ditanggapi
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="chat-item">
                            Belum ada chat pelanggan
                        </div>

                    @endforelse
                </div>
            </div>
            
            <!-- Chat Content -->
            @php
                $user = $selectedChat?->user;
            @endphp

            <div class="chat-content">

                {{-- HEADER --}}
                <div class="chat-header">
                    <div class="chat-user-avatar">
                        {{ strtoupper(substr($user->nama_user ?? 'U',0,1)) }}
                    </div>
                    <div class="chat-user-info-large">
                        <div class="chat-user-name-large">
                            {{ $user->nama_user ?? 'Pengguna' }}
                        </div>

                        <div class="chat-user-details-large">
                            <span>
                                Session #{{ $selectedChat?->id_sessions }}
                            </span>

                            <span>|</span>
                            <span>
                                {{ $user->pekerjaan_user ?? 'Pekerjaan belum diisi' }}
                            </span>

                            <span class="chat-status status-online">
                                {{ $selectedChat?->status_chat }}
                            </span>
                        </div>
                    </div>
                </div>


                {{-- ISI CHAT --}}
                <div class="chat-messages">
                    @foreach($selectedChat?->messages ?? [] as $msg)
                        <div class="message {{ $msg->sender == 'user' ? 'message-user' : 'message-admin' }}">
                            <div class="message-header">
                                <span class="message-sender">
                                    @if($msg->sender == 'user')
                                        {{ $user->nama_user ?? 'User' }}
                                    @elseif($msg->sender == 'bot')
                                        Chatbot
                                    @else
                                        Admin
                                    @endif
                                </span>
                                <span class="message-time">
                                    {{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}
                                </span>
                            </div>

                            <div class="message-content">
                                {{ $msg->message }}
                                @if($msg->properti_data)
                                @php
                                    $propertiList = json_decode(
                                        $msg->properti_data
                                    );
                                @endphp

                                <div class="properti-cards">
                                    @foreach($propertiList as $item)
                                        <div class="properti-card">
                                            <div class="properti-card-header">
                                                <div class="properti-card-nama">
                                                    {{ $item->nama_properti }}
                                                </div>
                                                <div class="
                                                    properti-card-badge
                                                    {{ $item->kategori_properti == 'subsidi'
                                                        ? 'badge-subsidi'
                                                        : 'badge-komersial'
                                                    }}
                                                ">
                                                    {{ $item->kategori_properti }}
                                                </div>
                                            </div>

                                            <div class="properti-card-info">
                                                <span>
                                                    {{ $item->jenis_properti }}
                                                </span>

                                                <span>
                                                    LT {{ $item->luas_tanah }} m²
                                                </span>

                                                <span>
                                                    LB {{ $item->luas_bangunan }} m²
                                                </span>

                                            </div>

                                            <div class="properti-card-harga">

                                                Rp {{ number_format(
                                                    $item->harga_properti,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}

                                            </div>

                                            <a
                                                href="{{ url('/detail-katalog/' . $item->id_properti) }}"
                                                class="properti-card-btn"
                                                target="_blank"
                                            >
                                                Lihat Detail
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ADDED: Selected Properties Tags --}}
                <div class="selected-props-tags" id="selectedPropsTags" style="display: none;">
                </div>

                {{-- INPUT --}}
                <div class="chat-input">

                    <form id="adminChatForm">

                        @csrf

                        <input
                            type="hidden"
                            name="session_id"
                            value="{{ $selectedChat?->id_sessions }}"
                        >

                        <textarea
                            name="message"
                            class="message-input"
                            placeholder="Ketik balasan admin..."
                            required></textarea>

                        <button type="button" class="btn-recommend" id="btnRecommend" title="Rekomendasikan Properti">
                            <i class="fas fa-star"></i>
                        </button>

                        <button type="submit" class="send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- ADDED: Recommend Properties Modal -->
    <div class="recommend-modal-overlay" id="recommendModal">
        <div class="recommend-modal">
            <div class="recommend-modal-header">
                <div class="recommend-modal-title">
                    <i class="fas fa-star"></i>
                    Rekomendasikan Properti ke Pengguna
                </div>
                <button class="recommend-modal-close" id="closeRecommendModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="recommend-modal-search">
                <input
                    type="text"
                    id="recommendSearch"
                    class="recommend-search-input"
                    placeholder="Cari nama, blok, atau perumahan..."
                >

                <select
                    id="recommendFilter"
                    class="recommend-filter-select"
                >
                    <option value="all">Semua Tipe</option>
                </select>

            </div>

            <div class="recommend-modal-body" id="recommendPropertyList">
                <!-- Properties will be loaded here -->
            </div>

            <div class="recommend-selected-bar">
                <div class="recommend-count">
                    Dipilih: <strong id="selectedCount">0</strong> properti
                </div>
                <button class="recommend-send-btn" id="sendRecommendBtn" disabled>
                    <i class="fas fa-paper-plane"></i>
                    Kirim Rekomendasi
                </button>
            </div>
        </div>
    </div>
<!-- </div> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ===============================
            // ELEMENT
            // ===============================
            const chatItems = document.querySelectorAll('.chat-item');
            const filterButtons = document.querySelectorAll('.filter-btn');

            const messageInput = document.querySelector('.message-input');
            const sendBtn = document.querySelector('.send-btn');
            const chatMessages = document.querySelector('.chat-messages');
            const adminChatForm = document.getElementById('adminChatForm');

            const btnRecommend = document.getElementById('btnRecommend');
            const recommendModal = document.getElementById('recommendModal');
            const closeRecommendModal = document.getElementById('closeRecommendModal');
            const recommendSearch = document.getElementById('recommendSearch');
            const recommendFilter = document.getElementById('recommendFilter');
            const recommendPropertyList = document.getElementById('recommendPropertyList');
            const selectedCount = document.getElementById('selectedCount');
            const sendRecommendBtn = document.getElementById('sendRecommendBtn');
            const selectedPropsTags = document.getElementById('selectedPropsTags');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            const allProperties = @json($allProperties ?? []);
            // console.log(allProperties[0]);
            const uniqueTipe = [
                ...new Set(
                    allProperties
                        .map(p => p.tipe_properti)
                        .filter(Boolean)
                )
            ];

            uniqueTipe.forEach(tipe => {

                const option =
                    document.createElement('option');

                option.value =
                    tipe.toLowerCase();

                option.textContent =
                    `Tipe ${tipe}`;

                recommendFilter.appendChild(option);

            });

            let selectedPropertiIds = [];

            // ===============================
            // CHAT ITEM ACTIVE
            // ===============================
            chatItems.forEach(item => {
                item.addEventListener('click', function() {
                    chatItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // ===============================
            // FILTER BUTTON
            // ===============================
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // ===============================
            // AUTO SCROLL
            // ===============================
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // ===============================
            // KIRIM PESAN ADMIN (FIXED)
            // ===============================
            async function kirimPesanAdmin(propertiIds = []) {

                const message = messageInput?.value.trim();

                if (!message && (!propertiIds || propertiIds.length === 0)) return;

                try {
                    const response = await fetch("{{ route('admin.kirim_chat') }}", {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            session_id: "{{ $selectedChat?->id_sessions  ?? '' }}",
                            message: message || "Berikut rekomendasi properti untuk Anda:",
                            properti_ids: propertiIds
                        })
                    });

                    const data = await response.json();

                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    const newMessage = document.createElement('div');
                    newMessage.className = 'message message-admin';

                    let propertiHTML = '';

                    if (data.properti && data.properti.length > 0) {
                        propertiHTML += `<div class="properti-cards">`;

                        data.properti.forEach(item => {
                            propertiHTML += `
                                <div class="properti-card">
                                    <div class="properti-card-header">
                                        <div class="properti-card-nama">${item.nama_properti}</div>

                                        <div class="properti-card-badge ${
                                            item.kategori_properti === 'subsidi'
                                                ? 'badge-subsidi'
                                                : 'badge-komersial'
                                        }">
                                            ${item.kategori_properti}
                                        </div>
                                    </div>

                                    <div class="properti-card-info">
                                        <span>${item.jenis_properti}</span>
                                        <span>LT ${item.luas_tanah} m²</span>
                                        <span>LB ${item.luas_bangunan} m²</span>
                                    </div>

                                    <div class="properti-card-harga">
                                        Rp ${Number(item.harga_properti).toLocaleString('id-ID')}
                                    </div>

                                    <a href="/detail-katalog/${item.id_properti}"
                                    class="properti-card-btn"
                                    target="_blank">
                                        Lihat Detail
                                    </a>
                                </div>
                            `;
                        });

                        propertiHTML += `</div>`;
                    }

                    newMessage.innerHTML = `
                        <div class="message-header">
                            <span class="message-sender">Admin</span>
                            <span class="message-time">${data.time}</span>
                        </div>
                        <div class="message-content">
                            ${data.message}
                            ${propertiHTML}
                        </div>
                    `;

                    chatMessages.appendChild(newMessage);

                    messageInput.value = '';
                    chatMessages.scrollTop = chatMessages.scrollHeight;

                } catch (error) {
                    console.error("ERROR:", error);
                }
            }

            // ===============================
            // FIX: FORM SUBMIT
            // ===============================
            if (adminChatForm) {
                adminChatForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    kirimPesanAdmin(selectedPropertiIds);
                });
            }

            // ===============================
            // FIX: ENTER SEND
            // ===============================
            if (messageInput) {
                messageInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        kirimPesanAdmin(selectedPropertiIds);
                    }
                });
            }

            // ===============================
            // FIX: BUTTON SEND
            // ===============================
            if (sendBtn) {
                sendBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    kirimPesanAdmin(selectedPropertiIds);
                });
            }

            // ===============================
            // REKOMENDASI MODAL
            // ===============================
            function renderProperties() {

                const searchQuery = recommendSearch.value.toLowerCase();
                const filterValue = recommendFilter.value;
                const filtered = allProperties.filter(prop => {
                    const search = searchQuery.toLowerCase();

                    const nama =
                        (prop.nama_properti || '').toLowerCase();

                    const blok =
                        (prop.blok?.nama_blok || '').toLowerCase();

                    const perumahan =
                        (prop.perumahan?.nama_perumahan || '').toLowerCase();

                    const tipe =
                        (prop.tipe_properti || '').toLowerCase();

                    const cocokSearch =
                        nama.includes(search) ||
                        blok.includes(search) ||
                        perumahan.includes(search) ||
                        tipe.includes(search);

                    const cocokFilter =
                        filterValue === 'all' ||
                        tipe === filterValue;

                    return cocokSearch && cocokFilter;
                });

                recommendSearch.addEventListener(
                    'input',
                    renderProperties
                );

                recommendFilter.addEventListener(
                    'change',
                    renderProperties
                );

                if (filtered.length === 0) {
                    recommendPropertyList.innerHTML = `
                        <div class="recommend-empty">
                            <i class="fas fa-search"></i>
                            <p>Tidak ada properti ditemukan</p>
                        </div>
                    `;
                    return;
                }

                recommendPropertyList.innerHTML = filtered.map(prop => `
                <div class="recommend-property-item ${
                    selectedPropertiIds.includes(prop.id_properti)
                        ? 'selected'
                        : ''
                }"
                onclick="toggleProperty(${prop.id_properti})">

                    <div class="recommend-prop-card">

                        <div class="recommend-prop-image">

                            <img
                                src="${
                                    prop.gambar && prop.gambar.length > 0
                                        ? `/storage/images/${prop.gambar[0].path_gambar}`
                                        : '/images/placeholder-properti.png'
                                }"
                                alt="${prop.nama_properti}"
                            >

                        </div>

                        <div class="recommend-prop-info">

                            <div class="recommend-prop-name">
                                ${prop.nama_properti}
                            </div>

                            <div class="recommend-prop-detail">
                                ${prop.perumahan?.nama_perumahan || '-'}
                            </div>

                            <div class="recommend-prop-block">
                                Blok:
                                ${prop.blok?.nama_blok || '-'}
                            </div>

                            <div class="recommend-prop-detail">
                                ${prop.kategori_properti}
                            </div>

                            <div class="recommend-prop-detail">
                                LT ${prop.luas_tanah} m² |
                                LB ${prop.luas_bangunan} m²
                            </div>

                            <div class="recommend-prop-price">
                                Rp ${Number(
                                    prop.harga_properti
                                ).toLocaleString('id-ID')}
                            </div>

                        </div>

                    </div>

                </div>

                `).join('');
            }

            // JS REKOMENDASI
            window.toggleProperty = function(id) {
                if (selectedPropertiIds.includes(id)) {
                    selectedPropertiIds =
                        selectedPropertiIds.filter(i => i !== id);
                } else {
                    selectedPropertiIds.push(id);
                }
                selectedCount.textContent =
                    selectedPropertiIds.length;
                sendRecommendBtn.disabled =
                    selectedPropertiIds.length === 0;
                renderProperties();
            };

            // TOMBOL REKOM
            sendRecommendBtn.addEventListener('click', function() {
                kirimPesanAdmin(selectedPropertiIds);
                recommendModal.classList.remove('show');
                selectedPropertiIds = [];
                selectedCount.textContent = '0';
                sendRecommendBtn.disabled = true;
            });

            // ===============================
            // MODAL CONTROL
            // ===============================
            if (btnRecommend) {
                btnRecommend.addEventListener('click', () => {
                    recommendModal.classList.add('show');
                    renderProperties();
                });
            }

            if (closeRecommendModal) {
                closeRecommendModal.addEventListener('click', () => {
                    recommendModal.classList.remove('show');
                });
            }

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

