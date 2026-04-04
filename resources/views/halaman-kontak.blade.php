<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <a href="{{ route('riwayat-pemesanan') }}"
                class="nav-item {{ request()->routeIs('riwayat-pemesanan') ? 'active' : '' }}">
                    Riwayat Pemesanan
                </a>
                <a href="{{ route('halaman-kontak') }}"
                class="nav-item {{ request()->routeIs('halaman-kontak') ? 'active' : '' }}">
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

<!-- Hero Header -->
<section class="hero-header">
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <h1>Layanan Properti</h1>
        <p>
            Temukan layanan terbaik kami untuk membantu Anda membeli, menjual,
            dan mengelola properti dengan mudah dan profesional.
        </p>

        <div class="breadcrumb">
            <a href="#">Beranda</a>
            <span>/</span>
            <span class="active">Layanan</span>
        </div>
    </div>
</section>

<section class="search-filter">
    <div class="filter-left">
        <div class="filter-group">
            <label class="filter-label">Lokasi</label>
            <input type="text" class="filter-input" placeholder="Masukkan kota atau area di sini">
        </div>

        <div class="filter-group">
            <label class="filter-label">Tipe Properti</label>
            <select class="filter-select">
                <option value="">Semua Tipe</option>
                <option value="rumah">Rumah</option>
                <option value="ruko">Ruko</option>
                <option value="apartemen">Apartemen</option>
                <option value="tanah">Tanah</option>
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Kisaran Harga</label>
            <select class="filter-select">
                <option value="">Semua Harga</option>
                <option value="0-500">Rp 0 - 500 Juta</option>
                <option value="500-1000">Rp 500 Juta - 1 Miliar</option>
                <option value="1-2">Rp 1 - 2 Miliar</option>
                <option value="2+">Rp 2 Miliar+</option>
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Kamar Tidur</label>
            <div class="bedroom-buttons">
                <button class="bedroom-btn">Semua</button>
                <button class="bedroom-btn">1</button>
                <button class="bedroom-btn">2</button>
                <button class="bedroom-btn">3</button>
                <button class="bedroom-btn">4+</button>
            </div>
        </div>
    </div>

    <div class="filter-right">
        <button class="search-btn1">
            <i class="fas fa-search"></i> Cari Properti
        </button>
    </div>
</section>

    
    <!-- Properties Section -->
    <section class="properties-section">
        <h2 class="section-title">Properti Terbaru</h2>
        
        <div class="properties-grid">
            <!-- Property 1 -->
            <div class="property-card">
                <div class="property-image">
                    <img src="https://placehold.co/300x200/e6f2f8/1E3A5F?text=Kelapa+Gading+Regency" alt="Kelapa Gading Regency">
                    <div class="property-badge badge-new">Baru</div>
                </div>
                <div class="property-info">
                    <div class="property-price">Rp 285.000.000</div>
                    <div class="property-title">Kelapa Gading Regency</div>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i> Jakarta Utara
                    </div>
                    <div class="property-details">
                        <div class="property-detail">
                            <i class="fas fa-bed"></i> 2 Kamar
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-bath"></i> 1 Kamar Mandi
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-ruler-combined"></i> 30/60 m²
                        </div>
                    </div>
                    <div class="property-actions">
                        <button class="action-btn btn-view">Lihat Detail</button>
                        <button class="action-btn btn-contact">Hubungi</button>
                    </div>
                </div>
            </div>
            
            <!-- Property 2 -->
            <div class="property-card">
                <div class="property-image">
                    <img src="https://placehold.co/300x200/e6f2f8/1E3A5F?text=Green+City" alt="Green City">
                    <div class="property-badge badge-sale">Diskon</div>
                </div>
                <div class="property-info">
                    <div class="property-price">Rp 450.000.000</div>
                    <div class="property-title">Green City</div>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i> Jakarta Selatan
                    </div>
                    <div class="property-details">
                        <div class="property-detail">
                            <i class="fas fa-bed"></i> 3 Kamar
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-bath"></i> 2 Kamar Mandi
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-ruler-combined"></i> 45/84 m²
                        </div>
                    </div>
                    <div class="property-actions">
                        <button class="action-btn btn-view">Lihat Detail</button>
                        <button class="action-btn btn-contact">Hubungi</button>
                    </div>
                </div>
            </div>
            
            <!-- Property 3 -->
            <div class="property-card">
                <div class="property-image">
                    <img src="https://placehold.co/300x200/e6f2f8/1E3A5F?text=Ruko+Sentral" alt="Ruko Sentral">
                    <div class="property-badge badge-new">Baru</div>
                </div>
                <div class="property-info">
                    <div class="property-price">Rp 1.250.000.000</div>
                    <div class="property-title">Ruko Sentral</div>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i> Jakarta Barat
                    </div>
                    <div class="property-details">
                        <div class="property-detail">
                            <i class="fas fa-bed"></i> 1 Lantai
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-bath"></i> 2 Kamar Mandi
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-ruler-combined"></i> 60/90 m²
                        </div>
                    </div>
                    <div class="property-actions">
                        <button class="action-btn btn-view">Lihat Detail</button>
                        <button class="action-btn btn-contact">Hubungi</button>
                    </div>
                </div>
            </div>
            
            <!-- Property 4 -->
            <div class="property-card">
                <div class="property-image">
                    <img src="https://placehold.co/300x200/e6f2f8/1E3A5F?text=Perumahan+Bukit" alt="Perumahan Bukit">
                    <div class="property-badge badge-sale">Diskon</div>
                </div>
                <div class="property-info">
                    <div class="property-price">Rp 695.000.000</div>
                    <div class="property-title">Perumahan Bukit</div>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i> Bogor
                    </div>
                    <div class="property-details">
                        <div class="property-detail">
                            <i class="fas fa-bed"></i> 3 Kamar
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-bath"></i> 2 Kamar Mandi
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-ruler-combined"></i> 60/135 m²
                        </div>
                    </div>
                    <div class="property-actions">
                        <button class="action-btn btn-view">Lihat Detail</button>
                        <button class="action-btn btn-contact">Hubungi</button>
                    </div>
                </div>
            </div>
            
            <!-- Property 5 -->
            <div class="property-card">
                <div class="property-image">
                    <img src="https://placehold.co/300x200/e6f2f8/1E3A5F?text=Villa+Puncak" alt="Villa Puncak">
                    <div class="property-badge badge-new">Baru</div>
                </div>
                <div class="property-info">
                    <div class="property-price">Rp 1.850.000.000</div>
                    <div class="property-title">Villa Puncak</div>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i> Puncak
                    </div>
                    <div class="property-details">
                        <div class="property-detail">
                            <i class="fas fa-bed"></i> 4 Kamar
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-bath"></i> 3 Kamar Mandi
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-ruler-combined"></i> 120/250 m²
                        </div>
                    </div>
                    <div class="property-actions">
                        <button class="action-btn btn-view">Lihat Detail</button>
                        <button class="action-btn btn-contact">Hubungi</button>
                    </div>
                </div>
            </div>
            
            <!-- Property 6 -->
            <div class="property-card">
                <div class="property-image">
                    <img src="https://placehold.co/300x200/e6f2f8/1E3A5F?text=Tanah+Strategis" alt="Tanah Strategis">
                    <div class="property-badge badge-sale">Diskon</div>
                </div>
                <div class="property-info">
                    <div class="property-price">Rp 850.000.000</div>
                    <div class="property-title">Tanah Strategis</div>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i> Depok
                    </div>
                    <div class="property-details">
                        <div class="property-detail">
                            <i class="fas fa-ruler-combined"></i> 150 m²
                        </div>
                        <div class="property-detail">
                            <i class="fas fa-landmark"></i> Lokasi Premium
                        </div>
                    </div>
                    <div class="property-actions">
                        <button class="action-btn btn-view">Lihat Detail</button>
                        <button class="action-btn btn-contact">Hubungi</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
            <div class="page-item">1</div>
            <div class="page-item">2</div>
            <div class="page-item">3</div>
            <div class="page-item">...</div>
            <div class="page-item">10</div>
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

        // TOGGLE NAV
        function toggleMenu(){
            document.getElementById('navMenu').classList.toggle('show');
        }
</script>
</body>
</html>
