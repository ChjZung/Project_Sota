@extends('admin.layouts.master')

@section('title', 'Quản Lý Banner & Slider')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-images text-danger mr-2"></i> Danh Sách Banner Slider Trang Chủ
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                Quản lý các hình ảnh chạy slider ở đầu trang chủ website. Bạn có thể sắp xếp thứ tự, đổi ảnh và liên kết.
            </p>
        </div>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-danger font-weight-bold shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Thêm Banner Mới
        </a>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 70px;" class="text-center">Thứ Tự</th>
                            <th style="width: 180px;">Hình Ảnh</th>
                            <th>Tiêu Đề & Mô Tả</th>
                            <th>Link Điều Hướng</th>
                            <th style="width: 140px;" class="text-center">Trạng Thái</th>
                            <th style="width: 140px;" class="text-right">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr>
                                <td class="text-center font-weight-bold text-muted">
                                    <span class="badge badge-light border" style="font-size: 13px;">{{ $banner->sort_order }}</span>
                                </td>
                                <td>
                                    <div style="width: 160px; height: 70px; border-radius: 8px; overflow: hidden; background: #000; border: 1px solid #e2e8f0;">
                                        <img src="{{ $banner->image }}" alt="{{ $banner->title }}" 
                                             style="width: 100%; height: 100%; object-fit: cover;"
                                             onerror="this.src='/thumbs/0x100x1/assets/images/noimage.png';">
                                    </div>
                                </td>
                                <td>
                                    <div class="font-weight-bold" style="font-size: 14px; color: #0f172a;">
                                        {{ $banner->title ?: '(Không có tiêu đề)' }}
                                    </div>
                                    @if($banner->subtitle)
                                        <small class="text-muted d-block mt-1">{{ $banner->subtitle }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($banner->link)
                                        <a href="{{ $banner->link }}" target="_blank" class="text-primary" style="font-size: 13px;">
                                            <i class="fas fa-link mr-1"></i> {{ Str::limit($banner->link, 40) }}
                                        </a>
                                    @else
                                        <span class="text-muted" style="font-size: 13px;">(Không có link)</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.banners.toggle', $banner) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        @if($banner->is_active)
                                            <button type="submit" class="btn btn-sm btn-success px-2 py-1 shadow-none" title="Bấm để ẩn khỏi trang chủ">
                                                <i class="fas fa-check-circle mr-1"></i> Đang hiện
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-secondary px-2 py-1 shadow-none" title="Bấm để hiện lên trang chủ">
                                                <i class="fas fa-eye-slash mr-1"></i> Đang ẩn
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-outline-primary mr-1" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa banner này không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa banner">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-images fa-2x mb-3 text-secondary d-block"></i>
                                    Chưa có banner nào. Hãy bấm nút <strong>Thêm Banner Mới</strong> ở trên để tạo.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
