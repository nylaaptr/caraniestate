<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot - PropertiHarmoni</title>
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
            <!-- Bot Welcome Message -->
            <div class="message bot-message">
                <div class="message-header">
                    <div class="bot-avatar">PH</div>
                    <div>PropertiBot</div>
                </div>
                <div class="message-content">
                    Halo! Saya PropertiBot, asisten virtual dari PropertiHarmoni. Ada yang bisa saya bantu hari ini? 😊
                </div>
                <div class="message-time">10:24 AM</div>
            </div>
            
            <!-- Bot Message -->
            <div class="message bot-message">
                <div class="message-header">
                    <div class="bot-avatar">PH</div>
                    <div>PropertiBot</div>
                </div>
                <div class="message-content">
                    Saya bisa membantu Anda dengan:
                    <ul style="padding-left: 20px; margin-top: 8px;">
                        <li>Mencari properti sesuai kebutuhan</li>
                        <li>Informasi detail properti</li>
                        <li>Proses pemesanan dan pembayaran</li>
                        <li>Verifikasi dokumen</li>
                        <li>Dan masih banyak lagi!</li>
                    </ul>
                </div>
                <div class="message-time">10:24 AM</div>
                
                <div class="quick-actions">
                    <button class="quick-btn">Cari Properti</button>
                    <button class="quick-btn">Info Harga</button>
                    <button class="quick-btn">Proses Pemesanan</button>
                    <button class="quick-btn">Bantuan Dokumen</button>
                </div>
            </div>
            
            <!-- User Message -->
            <div class="message user-message">
                <div class="message-content">
                    Saya tertarik dengan Apartemen Begawan Malang. Bisa kasih info detailnya?
                </div>
                <div class="message-time">10:26 AM</div>
            </div>
            
            <!-- Bot Response -->
            <div class="message bot-message">
                <div class="message-header">
                    <div class="bot-avatar">PH</div>
                    <div>PropertiBot</div>
                </div>
                <div class="message-content">
                    Tentu! Apartemen Begawan Malang adalah hunian modern di pusat kota Malang dengan fasilitas lengkap:
                    <br><br>
                    <strong>Spesifikasi:</strong>
                    • Lokasi: Kota Malang, Kecamatan Klojen
                    • Harga: Rp 3.500.000.000
                    • Luas Bangunan: 150 m²
                    • Kamar Tidur: 3
                    • Kamar Mandi: 2
                    • Garasi: 1 mobil
                    • Lantai: 30
                    <br>
                    <strong>Fasilitas:</strong>
                    • Kolam renang infinity
                    • Gym & fitness center
                    • Keamanan 24 jam
                    • Parkir bawah tanah
                    • Co-working space
                </div>
                <div class="message-time">10:27 AM</div>
                
                <div class="quick-actions">
                    <button class="quick-btn">Lihat Gambar</button>
                    <button class="quick-btn">Cek Ketersediaan</button>
                    <button class="quick-btn">Simulasi Kredit</button>
                </div>
            </div>
            
            <!-- User Message -->
            <div class="message user-message">
                <div class="message-content">
                    Bagaimana simulasi kredit untuk apartemen ini?
                </div>
                <div class="message-time">10:29 AM</div>
            </div>
            
            <!-- Bot Response with Typing Indicator -->
            <div class="typing-indicator">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const messagesArea = document.getElementById('messagesArea');
            const messageInput = document.getElementById('messageInput');
            const sendBtn = document.getElementById('sendBtn');
            const typingIndicator = document.querySelector('.typing-indicator');
            
            // Quick action buttons
            document.querySelectorAll('.quick-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const message = this.textContent;
                    addMessage(message, 'user');
                    simulateBotResponse(message);
                });
            });
            
            // Send message on button click
            sendBtn.addEventListener('click', sendMessage);
            
            // Send message on Enter key
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && messageInput.value.trim() !== '') {
                    sendMessage();
                }
            });
            
            // Auto-resize textarea (not needed since we're using input, but keeping for future)
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            
            function sendMessage() {
                const message = messageInput.value.trim();
                if (message) {
                    addMessage(message, 'user');
                    messageInput.value = '';
                    messageInput.style.height = 'auto';
                    
                    // Show typing indicator
                    typingIndicator.style.display = 'flex';
                    
                    // Simulate bot response after delay
                    setTimeout(() => {
                        typingIndicator.style.display = 'none';
                        simulateBotResponse(message);
                    }, 1500);
                }
            }
            
            function addMessage(text, sender) {
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
                    `;
                } else {
                    messageDiv.innerHTML = `
                        <div class="message-content">${text}</div>
                        <div class="message-time">${timeString}</div>
                    `;
                }
                
                messagesArea.appendChild(messageDiv);
                
                // Scroll to bottom
                messagesArea.scrollTop = messagesArea.scrollHeight;
            }
            
            function simulateBotResponse(userMessage) {
                // Simple response logic based on user message
                let botResponse = '';
                
                const lowerMessage = userMessage.toLowerCase();
                
                if (lowerMessage.includes('halo') || lowerMessage.includes('hai') || lowerMessage.includes('hello')) {
                    botResponse = 'Halo! Ada yang bisa saya bantu hari ini? 😊';
                } else if (lowerMessage.includes('terima kasih') || lowerMessage.includes('makasih')) {
                    botResponse = 'Sama-sama! Jangan ragu untuk bertanya lagi jika ada yang ingin Anda ketahui. 😊';
                } else if (lowerMessage.includes('harga') || lowerMessage.includes('biaya')) {
                    botResponse = 'Untuk informasi harga yang lebih detail, silakan berikan kriteria properti yang Anda cari (lokasi, tipe, budget) atau lihat katalog properti kami di halaman Katalog.';
                } else if (lowerMessage.includes('kredit') || lowerMessage.includes('cicilan')) {
                    botResponse = 'Kami menyediakan opsi KPR dengan tenor hingga 25 tahun. Untuk simulasi kredit yang akurat, silakan lengkapi data diri Anda di halaman Simulasi Kredit atau hubungi agen kami.';
                } else if (lowerMessage.includes('properti') || lowerMessage.includes('rumah') || lowerMessage.includes('apartemen')) {
                    botResponse = 'Kami memiliki berbagai pilihan properti di Malang dan sekitarnya. Untuk pencarian yang lebih spesifik, silakan gunakan filter di halaman Katalog atau beri tahu saya kriteria properti yang Anda inginkan.';
                } else if (lowerMessage.includes('dokumen') || lowerMessage.includes('syarat')) {
                    botResponse = 'Untuk pembelian properti, dokumen yang diperlukan antara lain: KTP, KK, NPWP, Slip Gaji 3 bulan terakhir, dan Rekening Koran. Untuk info lebih lengkap, silakan kunjungi halaman Panduan Dokumen.';
                } else {
                    botResponse = 'Terima kasih atas pertanyaan Anda! Tim kami akan segera memproses permintaan Anda. Untuk informasi lebih detail, silakan hubungi agen kami atau kunjungi halaman Bantuan.';
                }
                
                addMessage(botResponse, 'bot');
                
                // Add quick actions for common queries
                if (lowerMessage.includes('properti') || lowerMessage.includes('rumah') || lowerMessage.includes('apartemen')) {
                    const lastMessage = document.querySelectorAll('.message.bot-message').item(-1);
                    const quickActions = document.createElement('div');
                    quickActions.className = 'quick-actions';
                    quickActions.innerHTML = `
                        <button class="quick-btn">Lihat Katalog</button>
                        <button class="quick-btn">Filter Lokasi</button>
                        <button class="quick-btn">Budget di Bawah 1M</button>
                        <button class="quick-btn">Hubungi Agen</button>
                    `;
                    lastMessage.appendChild(quickActions);
                    
                    // Add event listeners to new quick buttons
                    quickActions.querySelectorAll('.quick-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const message = this.textContent;
                            addMessage(message, 'user');
                            simulateBotResponse(message);
                        });
                    });
                }
            }
            
            // Initialize with welcome message after a short delay
            setTimeout(() => {
                typingIndicator.style.display = 'none';
            }, 1000);
            
            // Focus input on load
            messageInput.focus();
        });

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

        // TOGGLE NAV
        function toggleMenu(){
            document.getElementById('navMenu').classList.toggle('show');
        }
    </script>
</body>
</html>

