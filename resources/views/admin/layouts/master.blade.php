<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bảng Điều Khiển') - Quản Trị Nhựa Nhị Bình</title>

    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        :root {
            --primary: #cd171f;
            --primary-hover: #b01219;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #cd171f;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Sidebar */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            color: #94a3b8;
            z-index: 1040;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 20px 22px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: #090e1a;
        }

        .sidebar-brand img {
            max-height: 38px;
            background: #fff;
            padding: 3px 8px;
            border-radius: 6px;
            margin-right: 12px;
        }

        .sidebar-brand-text {
            color: #ffffff;
            font-weight: 700;
            font-size: 15px;
            line-height: 1.2;
        }

        .sidebar-brand-text small {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            font-weight: 400;
            margin-top: 2px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 15px 12px;
            margin: 0;
        }

        .menu-header {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #64748b;
            font-weight: 700;
            padding: 14px 12px 6px;
        }

        .sidebar-item {
            margin-bottom: 3px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 10px 14px;
            color: #94a3b8;
            text-decoration: none !important;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-link i {
            width: 22px;
            font-size: 15px;
            margin-right: 12px;
            text-align: center;
        }

        .sidebar-link:hover {
            color: #ffffff;
            background-color: var(--sidebar-hover);
        }

        .sidebar-item.active .sidebar-link {
            color: #ffffff;
            background-color: var(--sidebar-active);
            box-shadow: 0 4px 12px rgba(205, 23, 31, 0.35);
        }

        .sidebar-badge {
            margin-left: auto;
            background: #e11d48;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 10px;
        }

        /* Main Content Wrapper */
        #content-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Top Navbar */
        .admin-topbar {
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .topbar-toggle {
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
        }

        .topbar-toggle:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-view-site {
            font-size: 13px;
            font-weight: 500;
            color: #475569;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 6px 14px;
            border-radius: 8px;
            text-decoration: none !important;
            transition: all 0.2s;
        }

        .btn-view-site:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

        .admin-user-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 10px;
            background: #f8fafc;
            border-radius: 30px;
            border: 1px solid #e2e8f0;
        }

        .admin-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #cd171f, #f97316);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .admin-info {
            line-height: 1.2;
            text-align: left;
        }

        .admin-info .name {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
        }

        .admin-info .role {
            font-size: 11px;
            color: #64748b;
        }

        .btn-logout {
            background: none;
            border: none;
            color: #ef4444;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: #fee2e2;
        }

        /* Main Body */
        .admin-content {
            flex: 1;
            padding: 25px;
        }

        .admin-footer {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 15px 25px;
            font-size: 13px;
            color: #64748b;
            text-align: center;
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            #sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content-wrapper {
                margin-left: 0;
            }
            .sidebar-backdrop {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(15, 23, 42, 0.6);
                z-index: 1035;
            }
            .sidebar-backdrop.active {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    {{-- Sidebar --}}
    <aside id="sidebar">
        <div class="sidebar-brand">
            <img src="/upload/photo/nhi-binh-plastic-logo-3632.png" alt="Logo" onerror="this.style.display='none'">
            <div class="sidebar-brand-text">
                NHỰA NHỊ BÌNH
                <small>Hệ Thống Quản Trị CMS</small>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Tổng Quan</li>
            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Bảng Điều Khiển</span>
                </a>
            </li>

            <li class="menu-header">Nội Dung Website</li>
            <li class="sidebar-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.index') }}" class="sidebar-link">
                    <i class="fas fa-sliders-h"></i>
                    <span>Cấu Hình Website</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                <a href="{{ route('admin.banners.index') }}" class="sidebar-link">
                    <i class="fas fa-images"></i>
                    <span>Banner & Slider</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link">
                    <i class="fas fa-sitemap"></i>
                    <span>Danh Mục Sản Phẩm</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}" class="sidebar-link">
                    <i class="fas fa-box-open"></i>
                    <span>Quản Lý Sản Phẩm</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <a href="{{ route('admin.posts.index') }}" class="sidebar-link">
                    <i class="fas fa-newspaper"></i>
                    <span>Tin Tức & Bài Viết</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <a href="{{ route('admin.pages.index') }}" class="sidebar-link">
                    <i class="fas fa-file-alt"></i>
                    <span>Trang Nội Dung (CMS)</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                <a href="{{ route('admin.partners.index') }}" class="sidebar-link">
                    <i class="fas fa-globe-americas"></i>
                    <span>Thị Trường & Đối Tác</span>
                </a>
            </li>

            <li class="menu-header">Khách Hàng & Liên Hệ</li>
            <li class="sidebar-item {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                <a href="{{ route('admin.inquiries.index') }}" class="sidebar-link">
                    <i class="fas fa-envelope-open-text"></i>
                    <span>Yêu Cầu Báo Giá</span>
                    @php
                        $pendingCount = \App\Models\Inquiry::where('status', 'pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="sidebar-badge">{{ $pendingCount }}</span>
                    @endif
                </a>
            </li>
        </ul>
    </aside>

    {{-- Content Wrapper --}}
    <div id="content-wrapper">
        {{-- Topbar --}}
        <header class="admin-topbar">
            <button class="topbar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <div class="topbar-right">
                <a href="{{ route('home') }}" target="_blank" class="btn-view-site">
                    <i class="fas fa-external-link-alt mr-1"></i> Xem Trang Chủ
                </a>

                <a href="{{ route('admin.profile.edit') }}" class="admin-user-pill text-decoration-none" title="Thông tin tài khoản & Đổi mật khẩu">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="admin-info d-none d-sm-block">
                        <div class="name">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="role">Quản trị viên <i class="fas fa-cog ml-1 text-muted"></i></div>
                    </div>
                </a>

                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn đăng xuất?')">
                    @csrf
                    <button type="submit" class="btn-logout" title="Đăng xuất">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </header>

        {{-- Main Body --}}
        <main class="admin-content">
            {{-- Alerts --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="admin-footer">
            <div>
                © {{ date('Y') }} <strong>CÔNG TY TNHH SX TM NHỰA NHỊ BÌNH</strong>. Hệ thống Quản trị Nội dung (CMS).
            </div>
        </footer>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Mobile sidebar toggle
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('active');
                $('#sidebarBackdrop').toggleClass('active');
            });
            $('#sidebarBackdrop').click(function() {
                $('#sidebar').removeClass('active');
                $('#sidebarBackdrop').removeClass('active');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
