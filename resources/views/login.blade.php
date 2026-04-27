<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Carani Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #7AB2D3;
            --primary-blue-rgb: 122, 178, 211;
            --dark-blue: #1E3A5F;
            --light-blue: #e6f2f8;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e1f5fe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(30, 58, 95, 0.2);
        }
        
        /* Left Side - Branding */
        .login-branding {
            flex: 1;
            background: linear-gradient(135deg, var(--dark-blue) 0%, #1a365d 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .branding-content {
            text-align: center;
            max-width: 400px;
            position: relative;
            z-index: 2;
        }
        
        .logo {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            border: 4px solid rgba(255,255,255,0.3);
        }
        
        .logo i {
            font-size: 48px;
            color: var(--dark-blue);
        }
        
        .branding-title {
            color: white;
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .branding-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.2rem;
            line-height: 1.5;
            margin-bottom: 30px;
        }
        
        .features-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .feature-item {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 12px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .feature-item i {
            color: var(--primary-blue);
            font-size: 14px;
        }
        
        /* Right Side - Login Form */
        .login-form {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 35px;
        }
        
        .form-logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, #4a90b7 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(var(--primary-blue-rgb), 0.3);
        }
        
        .form-logo i {
            font-size: 32px;
            color: white;
        }
        
        .form-title {
            color: var(--dark-blue);
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 12px;
        }
        
        .form-subtitle {
            color: #64748b;
            font-size: 1.1rem;
            line-height: 1.5;
        }
        
        .form-group {
            margin-bottom: 22px;
            position: relative;
        }
        
        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }
        
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(var(--primary-blue-rgb), 0.15);
            background-color: white;
            outline: none;
        }
        
        .form-control::placeholder {
            color: #a0aec0;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group-text {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 14px 0 0 14px;
            padding: 14px 20px;
            color: #718096;
            border-right: none;
        }
        
        .form-control.password-input {
            border-radius: 0 14px 14px 0;
            border-left: none;
            background-color: #f8fafc;
        }
        
        .eye-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #718096;
            transition: all 0.3s ease;
            font-size: 18px;
        }
        
        .eye-icon:hover {
            color: var(--primary-blue);
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #4a90b7 100%);
            border: none;
            padding: 16px;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 14px;
            transition: all 0.4s ease;
            box-shadow: 0 6px 20px rgba(var(--primary-blue-rgb), 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 10px;
            color: white;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, #6aa5c6 0%, #3d85aa 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(var(--primary-blue-rgb), 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .forgot-password {
            text-align: right;
            margin-top: 8px;
        }
        
        .forgot-password a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: #3d85aa;
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 30px 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .divider span {
            padding: 0 20px;
            color: #718096;
            font-size: 0.95rem;
            font-weight: 500;
            background: white;
        }
        
        .user-type-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .user-type-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: white;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .user-type-btn.active {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }
        
        .user-type-btn:not(.active):hover {
            border-color: var(--primary-blue);
            background: #f8fafc;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #edf2f7;
        }
        
        .signup-link p {
            margin: 0;
            color: #4a5568;
            font-size: 1rem;
        }
        
        .signup-link a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        
        .signup-link a:hover {
            color: #3d85aa;
            text-decoration: underline;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .login-branding {
                height: 280px;
                padding: 30px 20px;
            }
            
            .login-form {
                padding: 40px 30px;
            }
            
            .branding-title {
                font-size: 1.8rem;
            }
            
            .branding-subtitle {
                font-size: 1rem;
            }
            
            .logo {
                width: 80px;
                height: 80px;
            }
            
            .logo i {
                font-size: 40px;
            }
        }
        
        @media (max-width: 480px) {
            .login-container {
                border-radius: 20px;
                max-width: 100%;
            }
            
            .login-branding {
                height: 240px;
                padding: 25px 15px;
            }
            
            .login-form {
                padding: 35px 25px;
            }
            
            .branding-title {
                font-size: 1.5rem;
            }
            
            .branding-subtitle {
                font-size: 0.9rem;
            }
            
            .form-title {
                font-size: 1.7rem;
            }
            
            .form-subtitle {
                font-size: 1rem;
            }
            
            .logo {
                width: 70px;
                height: 70px;
            }
            
            .logo i {
                font-size: 32px;
            }
            
            .form-logo {
                width: 60px;
                height: 60px;
            }
            
            .form-logo i {
                font-size: 28px;
            }
            
            .btn-login {
                font-size: 1rem;
                padding: 14px;
                letter-spacing: 0.3px;
            }
            
            .user-type-selector {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Branding -->
        <div class="login-branding">
            <div class="branding-content">
                <div class="logo">
                    <i class="fas fa-home"></i>
                </div>
                <h1 class="branding-title">Carani Estate</h1>
                <p class="branding-subtitle">Platform terpercaya untuk membeli, menjual, dan menyewa properti berkualitas sejak 2015</p>
                
                <ul class="features-list">
                    <li class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Lebih dari 10.000 properti tersedia</span>
                    </li>
                    <li class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Proses transaksi aman dan transparan</span>
                    </li>
                    <li class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Dukungan customer service 24/7</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="login-form">
            <div class="form-header">
                <div class="form-logo">
                    <i class="fas fa-user"></i>
                </div>
                <h2 class="form-title">Login ke Akun Anda</h2>
                <p class="form-subtitle">Masuk dengan akun yang sudah terdaftar untuk mengakses layanan kami</p>
            </div>
            
            <form method="POST" action="{{ route('login.proses') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email Anda" required>
                    </div>
                    {{-- Tampilkan error email --}}
                    @error('email')
                        <div style="color:red; font-size:0.85rem; margin-top:5px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" 
                            class="form-control password-input @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password"
                            placeholder="Masukkan password" required>
                        <span class="eye-icon" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    {{-- Tampilkan error password --}}
                    @error('password')
                        <div style="color:red; font-size:0.85rem; margin-top:5px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="forgot-password">
                    <a href="{{ route('ganti-password') }}">Lupa password?</a>
                </div>
                
                <button type="submit" class="btn-login w-100">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Akun
                </button>

                <!-- 🔥 TAMBAHAN: Link ke Register -->
                <div class="signup-link">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // User type selection
        const userButtons = document.querySelectorAll('.user-type-btn');
        userButtons.forEach(button => {
            button.addEventListener('click', function() {
                userButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const userType = document.querySelector('.user-type-btn.active').dataset.type;
            
            // In a real Laravel application, you would submit this to your login route
            console.log('Login attempt:', { email, password, userType });
            
            // Simple validation
            if (email && password) {
                alert(`Login sebagai ${userType === 'user' ? 'Pengguna' : 'Admin'} berhasil!`);
                // Redirect based on user type
                if (userType === 'admin') {
                    window.location.href = 'admin-dashboard.html';
                } else {
                    window.location.href = 'user-dashboard.html';
                }
            } else {
                alert('Mohon lengkapi semua field yang wajib diisi.');
            }
        });
        
        // Add subtle animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const loginContainer = document.querySelector('.login-container');
            loginContainer.style.opacity = '0';
            loginContainer.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                loginContainer.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                loginContainer.style.opacity = '1';
                loginContainer.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>
