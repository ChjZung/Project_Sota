<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Quản trị - Nhựa Nhị Bình</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-header {
            background: linear-gradient(135deg, #cd171f 0%, #a00e14 100%);
            padding: 35px 25px 25px;
            text-align: center;
            color: #ffffff;
        }
        .login-header img {
            max-height: 55px;
            background: #ffffff;
            padding: 6px 14px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .login-header h4 {
            font-weight: 700;
            margin-bottom: 4px;
            font-size: 20px;
            letter-spacing: 0.5px;
        }
        .login-header p {
            font-size: 13px;
            opacity: 0.9;
            margin: 0;
        }
        .login-body {
            padding: 30px 30px 35px;
        }
        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }
        .input-group-text {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #64748b;
        }
        .form-control {
            border-color: #cbd5e1;
            padding: 10px 14px;
            font-size: 14px;
            border-radius: 8px;
        }
        .form-control:focus {
            border-color: #cd171f;
            box-shadow: 0 0 0 3px rgba(205, 23, 31, 0.15);
        }
        .btn-login {
            background: #cd171f;
            color: #ffffff;
            font-weight: 600;
            padding: 12px;
            font-size: 15px;
            border-radius: 8px;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-login:hover {
            background: #b01219;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(205, 23, 31, 0.3);
        }
        .custom-control-label {
            font-size: 13px;
            color: #64748b;
        }
        .footer-note {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <img src="/upload/photo/nhi-binh-plastic-logo-3632.png" alt="Nhựa Nhị Bình Logo" onerror="this.style.display='none'">
            <h4>HỆ THỐNG QUẢN TRỊ</h4>
            <p>Công Ty TNHH SX TM Nhựa Nhị Bình</p>
        </div>
        <div class="login-body">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope mr-1"></i> Email đăng nhập</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', 'admin@gmail.com') }}" placeholder="Nhập email..." required autofocus>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="password"><i class="fas fa-lock mr-1"></i> Mật khẩu</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Nhập mật khẩu..." required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" checked>
                        <label class="custom-control-label" for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                    <span class="badge badge-light text-muted p-2"><i class="fas fa-shield-alt text-success mr-1"></i> SSL Bảo Mật</span>
                </div>

                <button type="submit" class="btn btn-login btn-block">
                    <i class="fas fa-sign-in-alt mr-2"></i> Đăng Nhập Quản Trị
                </button>
            </form>

            <div class="footer-note">
                <i class="fas fa-info-circle mr-1"></i> Tài khoản mặc định: <strong>admin@gmail.com</strong> / <strong>admin123</strong>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
