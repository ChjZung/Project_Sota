@extends('layouts.app')

@section('title', 'Nhà Máy & Máy Móc Thiết Bị Sản Xuất | Nhị Bình Plastic')
@section('description', 'Quy mô nhà xưởng 10.000m² tại KCN VSIP II-A Bình Dương. Sở hữu hơn 50 máy ép phun nhựa tự động từ 50T đến 800T, cánh tay robot và phòng kiểm định chất lượng hiện đại.')

@section('content')
    {{-- Page Banner & Breadcrumb --}}
    <div class="page-banner">
        <div class="container">
            <h1 class="page-title">Nhà Máy & Thiết Bị Sản Xuất</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li class="active">Nhà máy & Thiết bị</li>
            </ul>
        </div>
    </div>

    {{-- Factory Overview Section --}}
    <section class="page-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-content-col">
                    <span class="sub-badge">QUY MÔ & CÔNG NGHỆ</span>
                    <h2 class="section-title">Nhà Máy Ép Nhựa Chuẩn Quốc Tế Tại KCN VSIP II-A</h2>
                    <p class="lead-text">
                        Với tổng diện tích khuôn viên <strong>10.000m²</strong> và mức vốn đầu tư hơn <strong>45 tỷ đồng</strong> tại Khu công nghiệp VSIP II-A (Bình Dương), Nhị Bình Plastic được xây dựng theo mô hình nhà máy xanh - sạch - tự động hóa cao.
                    </p>
                    <p>
                        Chúng tôi chú trọng đầu tư đồng bộ hệ thống máy ép phun nhựa từ các thương hiệu hàng đầu thế giới (Toshiba, Sumitomo, JSW Nhật Bản), kết hợp hệ thống cấp liệu trung tâm và cánh tay robot tự động hóa nhằm tối ưu năng suất và triệt tiêu sai sót do con người.
                    </p>
                    <div class="stats-mini-row">
                        <div class="stat-mini-box">
                            <span class="stat-mini-num">10,000m²</span>
                            <span class="stat-mini-label">Diện tích nhà máy</span>
                        </div>
                        <div class="stat-mini-box">
                            <span class="stat-mini-num">50+</span>
                            <span class="stat-mini-label">Máy ép phun tự động</span>
                        </div>
                        <div class="stat-mini-box">
                            <span class="stat-mini-num">50T - 800T</span>
                            <span class="stat-mini-label">Dải lực kẹp khuôn</span>
                        </div>
                        <div class="stat-mini-box">
                            <span class="stat-mini-num">200+ Tấn</span>
                            <span class="stat-mini-label">Công suất/tháng</span>
                        </div>
                    </div>
                </div>
                <div class="about-media-col">
                    <div class="media-card">
                        <img src="{{ asset('images/factory.jpg') }}" alt="Toàn cảnh nhà máy Nhị Bình Plastic" onerror="this.src='https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&auto=format&fit=crop&q=80'">
                        <div class="media-badge">
                            <span class="badge-number">100%</span>
                            <span class="badge-text">Dây chuyền tự động hóa cánh tay robot</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Machinery & Equipment Breakdown --}}
    <section class="page-section section-bg-alt">
        <div class="container">
            <div class="section-header">
                <span class="sub-badge">DÂY CHUYỀN THIẾT BỊ</span>
                <h2>Hệ Thống Máy Móc Phục Vụ Sản Xuất</h2>
                <div class="section-line"></div>
                <p>Trang thiết bị hiện đại đảm bảo độ chính xác cơ khí tuyệt đối cho từng chi tiết nhựa kỹ thuật</p>
            </div>

            <div class="equipment-grid">
                <div class="equipment-card">
                    <div class="equip-icon"><i class="fas fa-cogs"></i></div>
                    <h3>Dàn Máy Ép Phun 50T - 800T</h3>
                    <p>Hơn 50 máy ép thế hệ mới nhập khẩu từ Nhật Bản và Đài Loan, cho phép đúc các sản phẩm từ vài gram đến sản phẩm kích thước lớn nặng 5 - 8kg.</p>
                    <ul class="equip-specs">
                        <li><i class="fas fa-check"></i> Hãng máy: Toshiba, JSW, Sumitomo, Haitian</li>
                        <li><i class="fas fa-check"></i> Lực ép: 50T, 100T, 180T, 250T, 380T, 500T, 800T</li>
                        <li><i class="fas fa-check"></i> Kiểm soát nhiệt độ nòng ép đa vùng PID</li>
                    </ul>
                </div>

                <div class="equipment-card">
                    <div class="equip-icon"><i class="fas fa-robot"></i></div>
                    <h3>Cánh Tay Robot Tự Động Hóa</h3>
                    <p>100% máy ép được tích hợp hệ thống cánh tay robot Servo 3 trục và 5 trục gắp cuống keo và lấy sản phẩm tự động, an toàn và đồng đều.</p>
                    <ul class="equip-specs">
                        <li><i class="fas fa-check"></i> Robot Servo tốc độ cao chu kỳ gắp < 0.8s</li>
                        <li><i class="fas fa-check"></i> Tách biệt cuống phun và thành phẩm tự động</li>
                        <li><i class="fas fa-check"></i> Đảm bảo an toàn lao động tối đa</li>
                    </ul>
                </div>

                <div class="equipment-card">
                    <div class="equip-icon"><i class="fas fa-drafting-compass"></i></div>
                    <h3>Xưởng Chế Tạo & Bảo Dưỡng Khuôn</h3>
                    <p>Trang bị máy phay CNC, máy cắt dây EDM, máy mài phẳng chuyên dụng phục vụ việc sửa đổi, tinh chỉnh và bảo dưỡng khuôn mẫu định kỳ.</p>
                    <ul class="equip-specs">
                        <li><i class="fas fa-check"></i> Máy phay CNC độ chính xác ±0.005mm</li>
                        <li><i class="fas fa-check"></i> Máy xung điện EDM và cắt dây cao tốc</li>
                        <li><i class="fas fa-check"></i> Đội ngũ kỹ sư khuôn mẫu túc trực tại xưởng</li>
                    </ul>
                </div>

                <div class="equipment-card">
                    <div class="equip-icon"><i class="fas fa-microscope"></i></div>
                    <h3>Phòng Thí Nghiệm & Kiểm Định QC</h3>
                    <p>Thiết bị kiểm tra đo lường quang học 2D/3D, máy đo độ chảy hạt nhựa MFI, máy đo màu quang phổ đảm bảo sản phẩm đạt dung sai thiết kế.</p>
                    <ul class="equip-specs">
                        <li><i class="fas fa-check"></i> Máy đo kích thước quang học 2D Projector</li>
                        <li><i class="fas fa-check"></i> Thiết bị đo độ bền kéo, uốn và va đập Izod</li>
                        <li><i class="fas fa-check"></i> Kiểm tra 100% lô hàng trước khi xuất kho</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Clean Production & Assembly --}}
    <section class="page-section">
        <div class="container">
            <div class="clean-room-box">
                <div class="clean-text">
                    <span class="sub-badge">TIÊU CHUẨN XUẤT KHẨU</span>
                    <h2>Khu Vực Lắp Ráp & Đóng Gói Sạch Sẽ</h2>
                    <p>Đối với các dòng sản phẩm nhựa gia dụng thực phẩm (Food-contact) và đồ chơi thú cưng xuất khẩu sang thị trường Mỹ & Châu Âu, Nhị Bình Plastic bố trí phòng đóng gói biệt lập, trang bị hệ thống máy hút bụi, đèn kiểm tra dị vật và máy quấn màng co tự động.</p>
                    <div class="clean-features">
                        <div class="clean-feature-item">
                            <i class="fas fa-shield-virus"></i>
                            <span>Ngăn ngừa tuyệt đối nhiễm khuẩn và bụi bẩn bám dính</span>
                        </div>
                        <div class="clean-feature-item">
                            <i class="fas fa-box"></i>
                            <span>Quy cách đóng gói theo chuẩn barcode / pallet xuất khẩu quốc tế</span>
                        </div>
                    </div>
                </div>
                <div class="clean-action">
                    <div class="visit-card">
                        <h3>Đặt Lịch Tham Quan Nhà Máy</h3>
                        <p>Nhị Bình Plastic hân hạnh đón tiếp các đối tác trong và ngoài nước đến tham quan trực tiếp dây chuyền sản xuất tại VSIP II-A Bình Dương.</p>
                        <a href="{{ route('contact') }}" class="btn-primary"><i class="fas fa-calendar-check"></i> Đăng Ký Lịch Tham Quan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
