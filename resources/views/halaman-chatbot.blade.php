<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>ChatBot - Carani Estate</title>
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
            height: 100vh;
            display: flex;
            flex-direction: column;
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
        
        /* Chat Container */
        .chat-container {
            position: fixed;
            top: 80px;
            left: 0;
            width: 100%;
            height: calc(100vh - 80px);
            display: flex;
            flex-direction: column;
            background: white;
        }
        
        /* Chat Header */
        .chat-header {
            padding: 20px 30px;
            background: linear-gradient(135deg, var(--dark-blue) 0%, #1a365d 100%);
            color: white;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .chat-avatar {
            width: 50px;
            height: 50px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
        }
        
        .chat-info h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .chat-info p {
            opacity: 0.9;
            font-size: 0.95rem;
        }
        
        .status-indicator {
            width: 12px;
            height: 12px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        
        /* Messages Area */
        .messages-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        
        .message {
            max-width: 80%;
            padding: 16px 20px;
            border-radius: 18px;
            line-height: 1.5;
            position: relative;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .bot-message {
            align-self: flex-start;
            background: white;
            border-bottom-left-radius: 6px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .user-message {
            align-self: flex-end;
            background: var(--primary-blue);
            color: white;
            border-bottom-right-radius: 6px;
            box-shadow: 0 2px 10px rgba(122, 178, 211, 0.3);
        }
        
        .message-time {
            font-size: 0.75rem;
            opacity: 0.8;
            margin-top: 8px;
            text-align: right;
        }
        
        .user-message .message-time {
            text-align: right;
        }
        
        .bot-message .message-time {
            text-align: left;
        }
        
        .message-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            font-weight: 600;
        }
        
        .bot-avatar {
            width: 36px;
            height: 36px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            flex-shrink: 0;
        }
        
        /* Input Area */
        .input-area {
            padding: 20px 30px;
            background: white;
            border-top: 1px solid #e2e8f0;
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .message-input {
            flex: 1;
            padding: 16px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }
        
        .message-input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(var(--primary-blue-rgb), 0.2);
        }
        
        .send-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-blue);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        
        .send-btn:hover {
            background: #6aa5c6;
            transform: scale(1.05);
        }
        
        .send-btn:active {
            transform: scale(0.95);
        }
        
        .attachment-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #4a5568;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        
        .attachment-btn:hover {
            background: #cbd5e0;
            transform: scale(1.05);
        }
        
        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 15px;
        }
        
        .quick-btn {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .quick-btn:hover {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }
        
        /* Typing Indicator */
        .typing-indicator {
            display: flex;
            padding: 12px 20px;
            background: white;
            border-radius: 18px;
            border-bottom-left-radius: 6px;
            align-self: flex-start;
            margin-top: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .typing-dot {
            width: 8px;
            height: 8px;
            background: #94a3b8;
            border-radius: 50%;
            margin: 0 2px;
            animation: bounce 1.4s infinite ease-in-out both;
        }
        
        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }
        .typing-dot:nth-child(3) { animation-delay: 0s; }
        
        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
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
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 15px;
            }
            
            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
            
            .logo-text {
                display: none;
            }
            
            .chat-header {
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
    
    <!-- Chat Container -->
    <div class="chat-container">
        <!-- Chat Header -->
        <div class="chat-header">
            <div class="chat-avatar">
                <i class="fas fa-robot"></i>
            </div>
            <div class="chat-info">
                <h1>PropertiBot Assistant</h1>
                <p><span class="status-indicator"></span>Online - Siap membantu Anda</p>
            </div>
        </div>
        
        <!-- Messages Area -->
        <div class="messages-area" id="messagesArea">
            <!-- Bot Welcome Message (Satu-satunya pesan awal) -->
            <div class="message bot-message">
                <div class="message-header">
                    <div class="bot-avatar" style="width:30px; height:30px; font-size:14px;">PH</div>
                    <div>PropertiBot</div>
                </div>
                <div class="message-content">
                    Halo! Saya PropertiBot. Ada yang bisa dibantu hari ini? 😊<br>
                    Silakan tanya tentang harga, lokasi, atau KPR.
                </div>
                <div class="message-time">{{ date('H:i') }}</div>
                
                <!-- Opsi Awal -->
                <div class="quick-actions">
                    <button class="quick-btn" onclick="handleQuickReply('Cari Properti')">Cari Properti</button>
                    <button class="quick-btn" onclick="handleQuickReply('Info Harga')">Info Harga</button>
                    <button class="quick-btn" onclick="handleQuickReply('Simulasi KPR')">Simulasi KPR</button>
                </div>
            </div>

            <!-- Typing Indicator (Tersembunyi) -->
            <!-- <div class="typing-indicator" id="typingIndicator">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div> -->
        </div>
        
        <!-- Input Area -->
        <div class="input-area">
            <input type="text" class="message-input" id="messageInput" placeholder="Ketik pesan Anda di sini..." autocomplete="off">
            <button class="send-btn" id="sendBtn" title="Kirim pesan">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <script>
        // BAGIAN NAV
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

        // TOGGLE NAV
        function toggleMenu(){
            document.getElementById('navMenu').classList.toggle('show');
        }

        // SCRIPT CHAT

        document.addEventListener('DOMContentLoaded', function() {
    // --- KONFIGURASI ELEMENT ---
    const messagesArea = document.getElementById('messagesArea');
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const typingIndicator = document.querySelector('.typing-indicator');
    
    // Kunci penyimpanan di browser
    const STORAGE_KEY = 'properti_chat_history';

    // Token CSRF Laravel
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                      document.querySelector('input[name="_token"]')?.value;

    // --- 1. FUNGSI LOAD CHAT SAAT HALAMAN DIBUKA ---
    function loadChatHistory() {
        const savedChat = sessionStorage.getItem(STORAGE_KEY);
        if (savedChat) {
            const history = JSON.parse(savedChat);
            
            history.forEach(msg => {
                // Render ulang pesan tanpa memicu logika kirim ke server
                renderMessageOnly(msg.text, msg.sender, msg.options);
            });
            scrollToBottom();
        } 
    }

    // --- 2. FUNGSI SIMPAN CHAT ---
    function saveChatToHistory(text, sender, options = null) {
        let history = [];
        const savedChat = sessionStorage.getItem(STORAGE_KEY);
        
        if (savedChat) {
            history = JSON.parse(savedChat);
        }

        // Simpan data sederhana (text, sender, dan label opsi jika ada)
        const optionsLabels = options ? options.map(opt => typeof opt === 'object' ? opt.label : opt) : null;

        history.push({
            text: text,
            sender: sender,
            options: optionsLabels
        });

        sessionStorage.setItem(STORAGE_KEY, JSON.stringify(history));
    }

    // --- 3. FUNGSI UTAMA KIRIM PESAN ---
    async function sendMessage() {
        const text = messageInput.value.trim();
        if (!text) return;

        // Tampilkan pesan user & Simpan
        addMessage(text, 'user');
        saveChatToHistory(text, 'user');
        messageInput.value = '';
        
        showTyping();

        try {
            // Kirim ke Backend Laravel
            const response = await fetch('/api/chat/send', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: text })
            });

            const data = await response.json();

            hideTyping();
            
            // Tampilkan balasan bot & Simpan
            sendBotReply(data.reply, data.options, true); 

        } catch (error) {
            console.error('Error:', error);
            hideTyping();
            const errorMsg = "Maaf, terjadi kesalahan koneksi ke server.";
            addMessage(errorMsg, 'bot');
            saveChatToHistory(errorMsg, 'bot');
        }
    }

    // --- 4. FUNGSI RENDER PESAN KE LAYAR ---
    
    // Fungsi untuk menambah pesan baru (Interaktif + Simpan)
    function addMessage(text, sender) {
        const msgElement = createMessageElement(text, sender);
        messagesArea.appendChild(msgElement);
        scrollToBottom();
        return msgElement;
    }

    // Fungsi khusus untuk render ulang dari History
    function renderMessageOnly(text, sender, savedOptions) {
        const msgElement = createMessageElement(text, sender);
        
        // Jika ada opsi yang tersimpan, buat tombolnya kembali
        if (sender === 'bot' && savedOptions && savedOptions.length > 0) {
            const actionsContainer = msgElement.querySelector('.quick-actions-container');
            const actionsDiv = document.createElement('div');
            actionsDiv.className = 'quick-actions';
            
            savedOptions.forEach(optLabel => {
                const btn = document.createElement('button');
                btn.className = 'quick-btn';
                btn.textContent = optLabel;
                btn.onclick = () => handleQuickReplyClick(optLabel);
                actionsDiv.appendChild(btn);
            });
            actionsContainer.appendChild(actionsDiv);
        }

        messagesArea.appendChild(msgElement);
    }

    // Helper membuat elemen HTML pesan
    function createMessageElement(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}-message`;
        
        const now = new Date();
        const timeString = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
        
        if (sender === 'bot') {
            messageDiv.innerHTML = `
                <div class="message-header">
                    <div class="bot-avatar">PH</div>
                    <div>PropertiBot</div>
                </div>
                <div class="message-content">${text}</div>
                <div class="message-time">${timeString}</div>
                <div class="quick-actions-container"></div> 
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="message-content">${text}</div>
                <div class="message-time">${timeString}</div>
            `;
        }
        return messageDiv;
    }

    // Fungsi kirim balasan bot (dengan opsi simpan)
    function sendBotReply(text, options = [], shouldSave = false) {
        const msgElement = addMessage(text, 'bot');
        const actionsContainer = msgElement.querySelector('.quick-actions-container');
        
        if (options && options.length > 0) {
            const actionsDiv = document.createElement('div');
            actionsDiv.className = 'quick-actions';
            
            options.forEach(opt => {
                const btn = document.createElement('button');
                btn.className = 'quick-btn';
                const label = typeof opt === 'object' ? opt.label : opt;
                btn.textContent = label;
                
                btn.onclick = () => handleQuickReplyClick(label);
                actionsDiv.appendChild(btn);
            });
            
            actionsContainer.appendChild(actionsDiv);
            scrollToBottom();
        }

        if (shouldSave) {
            const optionsLabels = options.map(opt => typeof opt === 'object' ? opt.label : opt);
            saveChatToHistory(text, 'bot', optionsLabels);
        }
    }

    // Handler khusus untuk klik tombol quick reply
    function handleQuickReplyClick(text) {
        addMessage(text, 'user');
        saveChatToHistory(text, 'user');
        processLocalResponse(text);
    }

    // Helper untuk handle klik tombol (kirim ke backend lagi)
    function processLocalResponse(text) {
        showTyping();
        setTimeout(async () => {
            try {
                const response = await fetch('/api/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: text })
                });
                const data = await response.json();
                hideTyping();
                sendBotReply(data.reply, data.options, true);
            } catch (e) {
                hideTyping();
                console.error(e);
            }
        }, 600);
    }

    // --- UTILITIES ---
    // --- UTILITIES (DIPERBARUI) ---
    
    let typingElement = null; // Variabel untuk menyimpan elemen typing

    function showTyping() { 
        // Jika sudah ada, hapus dulu biar tidak duplikat
        if (typingElement) typingElement.remove();

        // Buat elemen typing baru secara dinamis
        typingElement = document.createElement('div');
        typingElement.className = 'typing-indicator';
        typingElement.innerHTML = `
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
        `;
        
        messagesArea.appendChild(typingElement);
        scrollToBottom(); 
    }

    function hideTyping() { 
        if (typingElement) {
            typingElement.remove(); // Hapus elemen dari layar
            typingElement = null;   // Reset variabel
        }
    }

    function scrollToBottom() { 
        messagesArea.scrollTop = messagesArea.scrollHeight; 
    }


    // --- EVENT LISTENERS ---
    sendBtn.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendMessage();
    });

    // Jalankan load history saat DOM siap
    loadChatHistory();
});
    </script>
</body>
</html>

