@extends('admin.layouts.master')

@section('title', 'Quản Lý Tin Tức & Truyền Thông')

@section('content')
<div class="container-fluid p-0">
    <!-- Header title and Action -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-newspaper text-danger mr-2"></i> Tin Tức & Truyền Thông
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                Quản lý các bài viết tin tức sự kiện, album ảnh nhà xưởng và video YouTube trên website.
            </p>
        </div>
        <div class="dropdown">
            <button class="btn btn-danger font-weight-bold dropdown-toggle shadow-sm" type="button" data-toggle="dropdown">
                <i class="fas fa-plus mr-1"></i> Thêm Mới Bài Đăng
            </button>
            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                <a class="dropdown-item py-2" href="{{ route('admin.posts.create', ['type' => 'news']) }}">
                    <i class="fas fa-newspaper text-primary mr-2"></i> Bài Viết Tin Tức Mới
                </a>
                <a class="dropdown-item py-2" href="{{ route('admin.posts.create', ['type' => 'album']) }}">
                    <i class="fas fa-images text-warning mr-2"></i> Ảnh Album Nhà Xưởng Mới
                </a>
                <a class="dropdown-item py-2" href="{{ route('admin.posts.create', ['type' => 'video']) }}">
                    <i class="fab fa-youtube text-danger mr-2"></i> Video YouTube Mới
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- Type Tabs Filter -->
    <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px;">
        <div class="card-body p-2 d-flex flex-wrap justify-content-between align-items-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ !request('type') ? 'active bg-danger' : 'text-dark' }} font-weight-bold py-2 px-3" 
                       href="{{ route('admin.posts.index') }}">
                        <i class="fas fa-layer-group mr-1"></i> Tất Cả ({{ $stats['total'] }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type') === 'news' ? 'active bg-danger' : 'text-dark' }} font-weight-bold py-2 px-3" 
                       href="{{ route('admin.posts.index', ['type' => 'news']) }}">
                        <i class="fas fa-newspaper text-primary mr-1"></i> Tin Tức ({{ $stats['news'] }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type') === 'album' ? 'active bg-danger' : 'text-dark' }} font-weight-bold py-2 px-3" 
                       href="{{ route('admin.posts.index', ['type' => 'album']) }}">
                        <i class="fas fa-images text-warning mr-1"></i> Album Ảnh ({{ $stats['album'] }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type') === 'video' ? 'active bg-danger' : 'text-dark' }} font-weight-bold py-2 px-3" 
                       href="{{ route('admin.posts.index', ['type' => 'video']) }}">
                        <i class="fab fa-youtube text-danger mr-1"></i> Video ({{ $stats['video'] }})
                    </a>
                </li>
            </ul>

            <form action="{{ route('admin.posts.index') }}" method="GET" class="form-inline mt-2 mt-md-0">
                @if(request('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                @endif
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-sm" 
                           placeholder="Tìm kiếm tiêu đề..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Posts Table Card -->
    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="thead-light">
                    <tr style="font-size: 13px;">
                        <th style="width: 70px;">Hình ảnh</th>
                        <th>Tiêu đề bài viết / video</th>
                        <th>Phân loại</th>
                        <th class="text-center" style="width: 120px;">Trạng thái</th>
                        <th style="width: 130px;">Ngày đăng</th>
                        <th style="width: 120px;" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $p)
                        <tr>
                            <!-- Thumbnail -->
                            <td class="align-middle">
                                @if($p->image)
                                    <img src="{{ $p->image }}" alt="{{ $p->title }}" 
                                         style="width: 56px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                @else
                                    <div style="width: 56px; height: 40px; background: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 13px;">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Title & Info -->
                            <td class="align-middle">
                                <a href="{{ route('admin.posts.edit', $p) }}" class="font-weight-bold text-dark d-block mb-1" style="font-size: 14.5px;">
                                    {{ $p->title }}
                                </a>
                                @if($p->type === 'video' && $p->video_url)
                                    <a href="{{ $p->video_url }}" target="_blank" class="text-danger" style="font-size: 12px;">
                                        <i class="fab fa-youtube mr-1"></i> {{ $p->video_url }}
                                    </a>
                                @else
                                    <span class="text-muted" style="font-size: 12px;">
                                        <code>/{{ $p->slug }}</code>
                                    </span>
                                @endif
                            </td>

                            <!-- Type Badge -->
                            <td class="align-middle">
                                @if($p->type === 'news')
                                    <span class="badge badge-primary px-2 py-1"><i class="fas fa-newspaper mr-1"></i> Tin Tức</span>
                                @elseif($p->type === 'album')
                                    <span class="badge badge-warning text-dark px-2 py-1"><i class="fas fa-images mr-1"></i> Album Ảnh</span>
                                @elseif($p->type === 'video')
                                    <span class="badge badge-danger px-2 py-1"><i class="fab fa-youtube mr-1"></i> Video</span>
                                @endif
                            </td>

                            <!-- Status Toggle -->
                            <td class="text-center align-middle">
                                <form action="{{ route('admin.posts.togglePublish', $p) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $p->is_published ? 'btn-success' : 'btn-secondary' }}" 
                                            title="{{ $p->is_published ? 'Bấm để ẩn' : 'Bấm để xuất bản' }}" style="border-radius: 20px; font-size: 11px; padding: 3px 10px;">
                                        <i class="fas fa-{{ $p->is_published ? 'check' : 'eye-slash' }} mr-1"></i> {{ $p->is_published ? 'Đã xuất bản' : 'Bản nháp' }}
                                    </button>
                                </form>
                            </td>

                            <!-- Created At -->
                            <td class="align-middle text-muted" style="font-size: 12.5px;">
                                {{ $p->created_at ? $p->created_at->format('d/m/Y') : 'Vừa tạo' }}
                            </td>

                            <!-- Actions -->
                            <td class="text-right align-middle">
                                <a href="{{ route('admin.posts.edit', $p) }}" class="btn btn-sm btn-outline-primary mr-1" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDeletePost('{{ $p->id }}', '{{ addslashes($p->title) }}')" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-post-form-{{ $p->id }}" action="{{ route('admin.posts.destroy', $p) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-newspaper fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Chưa có bài viết hoặc mục nào. Hãy bấm "Thêm Mới Bài Đăng" để tạo bài viết đầu tiên!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="card-footer bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <span class="text-muted" style="font-size: 13px;">
                    Hiển thị từ {{ $posts->firstItem() }} đến {{ $posts->lastItem() }} trên tổng số {{ $posts->total() }} mục
                </span>
                <div>
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDeletePost(id, title) {
        if (confirm('Bạn có chắc chắn muốn xóa bài viết: "' + title + '"?')) {
            document.getElementById('delete-post-form-' + id).submit();
        }
    }
</script>
@endpush
