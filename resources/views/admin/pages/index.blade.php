@extends('admin.layouts.master')

@section('title', 'Quản Lý Trang Nội Dung (CMS Pages)')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-file-alt text-danger mr-2"></i> Trang Nội Dung (CMS Pages)
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                Quản lý các trang thông tin tĩnh như Giới thiệu, Năng lực nhà máy, Dịch vụ khuôn ép, Chính sách...
            </p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-danger font-weight-bold shadow-sm">
            <i class="fas fa-plus mr-1"></i> Tạo Trang Mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="thead-light">
                    <tr style="font-size: 13px;">
                        <th style="width: 80px;">Banner</th>
                        <th>Tiêu đề trang</th>
                        <th>Đường dẫn (Slug URL)</th>
                        <th>Cập nhật gần nhất</th>
                        <th style="width: 140px;" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td class="align-middle">
                                @if($page->banner_image)
                                    <img src="{{ $page->banner_image }}" alt="{{ $page->title }}" 
                                         style="width: 65px; height: 35px; object-fit: cover; border-radius: 5px; border: 1px solid #e2e8f0;">
                                @else
                                    <div style="width: 65px; height: 35px; background: #f1f5f9; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 13px;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle font-weight-bold" style="font-size: 14.5px;">
                                <a href="{{ route('admin.pages.edit', $page) }}" class="text-dark">
                                    {{ $page->title }}
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="/{{ $page->slug }}" target="_blank" class="text-primary" style="font-size: 13px;">
                                    <code>/{{ $page->slug }}</code> <i class="fas fa-external-link-alt ml-1" style="font-size: 11px;"></i>
                                </a>
                            </td>
                            <td class="align-middle text-muted" style="font-size: 13px;">
                                {{ $page->updated_at ? $page->updated_at->format('d/m/Y H:i') : 'N/A' }}
                            </td>
                            <td class="text-right align-middle">
                                <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-outline-primary mr-1" title="Sửa">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDeletePage('{{ $page->id }}', '{{ addslashes($page->title) }}')" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-page-form-{{ $page->id }}" action="{{ route('admin.pages.destroy', $page) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-file-alt fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Chưa có trang CMS nào. Hãy tạo trang đầu tiên!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pages->hasPages())
            <div class="card-footer bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <span class="text-muted" style="font-size: 13px;">
                    Hiển thị {{ $pages->total() }} trang
                </span>
                <div>
                    {{ $pages->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDeletePage(id, title) {
        if (confirm('Bạn có chắc chắn muốn xóa trang: "' + title + '"?')) {
            document.getElementById('delete-page-form-' + id).submit();
        }
    }
</script>
@endpush
