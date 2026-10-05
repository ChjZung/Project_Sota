@extends('admin.layouts.master')

@section('title', 'Bảng Điều Khiển')

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 14px;
        padding: 24px 28px;
        color: #ffffff;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }
    .welcome-card h3 {
        font-weight: 700;
        margin-bottom: 6px;
        font-size: 22px;
    }
    .welcome-card p {
        color: #94a3b8;
        margin: 0;
        font-size: 14px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.2s ease;
        margin-bottom: 20px;
        text-decoration: none !important;
        color: inherit !important;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .stat-icon.blue { background: #eff6ff; color: #2563eb; }
    .stat-icon.green { background: #f0fdf4; color: #16a34a; }
    .stat-icon.purple { background: #faf5ff; color: #9333ea; }
    .stat-icon.amber { background: #fffbeb; color: #d97706; }
    .stat-icon.red { background: #fef2f2; color: #dc2626; }
    .stat-icon.teal { background: #f0fdfa; color: #0d9488; }

    .stat-number {
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }
    .stat-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
        margin-top: 2px;
    }

    .card-box {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        overflow: hidden;
    }
    .card-box-header {
        padding: 16px 20px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .card-box-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .card-box-body {
        padding: 20px;
    }

    .badge-pending { background: #fef3c7; color: #92400e; }
    .badge-processed { background: #dbeafe; color: #1e40af; }
    .badge-closed { background: #dcfce7; color: #166534; }

    .quick-btn {
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    {{-- Welcome banner --}}
    <div class="welcome-card">
        <div>
            <h3>Xin chào, {{ auth()->user()->name ?? 'Quản trị viên' }}! 👋</h3>
            <p>Hệ thống Quản trị Nội dung Website Công ty TNHH SX TM Nhựa Nhị Bình</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-light btn-sm px-3">
                <i class="fas fa-external-link-alt mr-1"></i> Xem Website Trực Tuyến
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row">
        <div class="col-xl-2 col-md-4 col-sm-6">
            <a href="{{ route('admin.products.index') }}" class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-box-open"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $stats['total_products'] }}</div>
                    <div class="stat-label">Sản phẩm</div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <a href="{{ route('admin.categories.index') }}" class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-sitemap"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $stats['total_categories'] }}</div>
                    <div class="stat-label">Danh mục</div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <a href="{{ route('admin.banners.index') }}" class="stat-card">
                <div class="stat-icon teal">
                    <i class="fas fa-images"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $stats['total_banners'] }}</div>
                    <div class="stat-label">Banners</div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <a href="{{ route('admin.posts.index') }}" class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $stats['total_posts'] }}</div>
                    <div class="stat-label">Bài viết</div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <a href="{{ route('admin.inquiries.index') }}" class="stat-card">
                <div class="stat-icon amber">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $stats['total_inquiries'] }}</div>
                    <div class="stat-label">Yêu cầu báo giá</div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <a href="{{ route('admin.inquiries.index') }}" class="stat-card" style="{{ $stats['pending_inquiries'] > 0 ? 'border-color: #fca5a5; background: #fff5f5;' : '' }}">
                <div class="stat-icon red">
                    <i class="fas fa-bell"></i>
                </div>
                <div>
                    <div class="stat-number text-danger">{{ $stats['pending_inquiries'] }}</div>
                    <div class="stat-label">Chờ xử lý</div>
                </div>
            </a>
        </div>
    </div>

    {{-- Main 2 Column Tables --}}
    <div class="row mt-2">
        {{-- Yêu cầu báo giá mới nhất --}}
        <div class="col-lg-7">
            <div class="card-box">
                <div class="card-box-header">
                    <h5 class="card-box-title">
                        <i class="fas fa-inbox text-primary mr-2"></i> Yêu Cầu Báo Giá Mới Nhất
                    </h5>
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-link text-primary p-0">
                        Xem tất cả <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                </div>
                <div class="card-box-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-top-0">Khách Hàng</th>
                                    <th class="border-top-0">SĐT / Email</th>
                                    <th class="border-top-0">Công Ty</th>
                                    <th class="border-top-0 text-center">Trạng Thái</th>
                                    <th class="border-top-0 text-right">Ngày Gửi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestInquiries as $inquiry)
                                    <tr>
                                        <td>
                                            <strong>{{ $inquiry->name }}</strong>
                                        </td>
                                        <td>
                                            <div><i class="fas fa-phone-alt text-muted mr-1" style="font-size: 11px;"></i> {{ $inquiry->phone }}</div>
                                            <small class="text-muted"><i class="fas fa-envelope text-muted mr-1" style="font-size: 11px;"></i> {{ $inquiry->email }}</small>
                                        </td>
                                        <td>{{ $inquiry->company ?: 'Cá nhân' }}</td>
                                        <td class="text-center">
                                            @if($inquiry->status === 'pending')
                                                <span class="badge badge-pending px-2 py-1">Chờ xử lý</span>
                                            @elseif($inquiry->status === 'processing' || $inquiry->status === 'processed')
                                                <span class="badge badge-processed px-2 py-1">Đang xử lý</span>
                                            @else
                                                <span class="badge badge-closed px-2 py-1">Hoàn thành</span>
                                            @endif
                                        </td>
                                        <td class="text-right text-muted" style="font-size: 12px;">
                                            {{ $inquiry->created_at ? $inquiry->created_at->format('d/m/Y H:i') : 'N/A' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-info-circle mr-1"></i> Chưa có yêu cầu báo giá nào từ khách hàng.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sản phẩm mới cập nhật --}}
        <div class="col-lg-5">
            <div class="card-box">
                <div class="card-box-header">
                    <h5 class="card-box-title">
                        <i class="fas fa-box text-success mr-2"></i> Sản Phẩm Mới Nhất
                    </h5>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-link text-primary p-0">
                        Xem tất cả <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                </div>
                <div class="card-box-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-top-0">Ảnh</th>
                                    <th class="border-top-0">Tên Sản Phẩm</th>
                                    <th class="border-top-0">Danh Mục</th>
                                    <th class="border-top-0 text-center">Nổi Bật</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestProducts as $prod)
                                    <tr>
                                        <td style="width: 50px;">
                                            <img src="{{ $prod->image ?: '/assets/images/noimage.png' }}" 
                                                 alt="{{ $prod->name }}" 
                                                 style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;"
                                                 onerror="this.src='/thumbs/0x100x1/assets/images/noimage.png';">
                                        </td>
                                        <td>
                                            <div class="font-weight-bold" style="font-size: 13.5px;">{{ $prod->name }}</div>
                                            <small class="text-muted">Mã: {{ $prod->product_code ?: 'N/A' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-light border">{{ $prod->category->name ?? 'Chưa phân loại' }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($prod->is_featured)
                                                <i class="fas fa-star text-warning" title="Nổi bật"></i>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="fas fa-info-circle mr-1"></i> Chưa có sản phẩm nào.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
