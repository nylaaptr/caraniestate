<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - PropertiHarmoni</title>
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
        
        .change-password-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(30, 58, 95, 0.2);
        }
        
        /* Left Side - Branding */
        .branding-section {
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
        
        /* Right Side - Change Password Form */
        .password-form {
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
            text-align: center;
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
        
        .btn-submit {
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
            width: 100%;
        }
        
        .btn-submit:hover {
            background: linear-gradient(135deg, #6aa5c6 0%, #3d85aa 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(var(--primary-blue-rgb), 0.4);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        .btn-cancel {
            background: #e2e8f0;
            color: #4a5568;
            border: none;
            padding: 16px;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 14px;
            transition: all 0.4s ease;
            margin-top: 15px;
            width: 100%;
        }
        
        .btn-cancel:hover {
            background: #cbd5e0;
            transform: translateY(-2px);
        }
        
        .password-requirements {
            background: #f8fafc;
            border-left: 4px solid var(--primary-blue);
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 0.9rem;
        }
        
        .password-requirements ul {
            margin: 8px 0 0 20px;
            padding-left: 10px;
        }
        
        .password-requirements li {
            margin-bottom: 5px;
            color: #4a5568;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .back-link a:hover {
            color: #3d85aa;
            text-decoration: underline;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .change-password-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .branding-section {
                height: 280px;
                padding: 30px 20px;
            }
            
            .password-form {
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
            .change-password-container {
                border-radius: 20px;
                max-width: 100%;
            }
            
            .branding-section {
                height: 240px;
                padding: 25px 15px;
            }
            
            .password-form {
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
            
            .btn-submit, .btn-cancel {
                font-size: 1rem;
                padding: 14px;
                letter-spacing: 0.3px;
            }
        }
    </style>
</head>
<body>
    <div class="change-password-container">
        <!-- Left Side - Branding -->
        <div class="branding-section">
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
        
        <!-- Right Side - Change Password Form -->
        <div class="password-form">
            <div class="form-header">
                <div class="form-logo">
                    <i class="fas fa-key"></i>
                </div>
                <h2 class="form-title">Ganti Password</h2>
                <p class="form-subtitle">Masukkan password lama dan password baru Anda untuk mengubah password akun</p>
            </div>
            
            <form method="POST" action="{{ route('ganti-password.proses') }}">
                @csrf

                {{-- Pesan sukses --}}
                @if(session('success'))
                    <div style="background:#d1fae5; color:#059669; padding:10px; border-radius:8px; margin-bottom:15px;">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                {{-- Pesan error --}}
                @if($errors->any())
                    <div style="background:#fecaca; color:#dc2626; padding:10px; border-radius:8px; margin-bottom:15px;">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                    </div>
                @endif

                {{-- ✅ Ganti dengan ini --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control password-input" 
                            id="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email kamu" required>
                    </div>
                    @error('email')
                        <div style="color:red; font-size:0.85rem; margin-top:5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="newPassword" class="form-label">Password Baru</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" 
                            class="form-control password-input" 
                            id="newPassword"
                            name="password_baru"
                            placeholder="Masukkan password baru" required>
                        <span class="eye-icon" id="toggleNewPassword">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password_baru')
                        <div style="color:red; font-size:0.85rem; margin-top:5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" 
                            class="form-control password-input" 
                            id="confirmPassword"
                            name="konfirmasi_password"
                            placeholder="Konfirmasi password baru" required>
                        <span class="eye-icon" id="toggleConfirmPassword">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('konfirmasi_password')
                        <div style="color:red; font-size:0.85rem; margin-top:5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="fas fa-sync-alt me-2"></i>Ubah Password
                </button>
                
                <div class="back-link" style="margin-top:15px;">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Halaman Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function setupPasswordToggle(toggleId, passwordId) {
            document.getElementById(toggleId).addEventListener('click', function() {
                const passwordInput = document.getElementById(passwordId);
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
        }

        setupPasswordToggle('toggleCurrentPassword', 'currentPassword');
        setupPasswordToggle('toggleNewPassword', 'newPassword');
        setupPasswordToggle('toggleConfirmPassword', 'confirmPassword');
        
        // Add subtle animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.change-password-container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                container.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>

