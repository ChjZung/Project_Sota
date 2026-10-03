@extends('admin.layouts.master')

@section('title', 'Quản Lý Danh Mục Sản Phẩm')

@section('content')
<div class="container-fluid p-0">
    <!-- Header title and Action -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-sitemap text-danger mr-2"></i> Danh Mục Sản Phẩm
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                Quản lý cây danh mục sản phẩm 2 cấp (Danh mục cha & Danh mục con), đồng bộ lên Navbar và Trang chủ.
            </p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-danger font-weight-bold shadow-sm">
            <i class="fas fa-plus mr-1"></i> Thêm Danh Mục Mới
        </a>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- Category Table Card -->
    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <span class="font-weight-bold text-dark" style="font-size: 15px;">
                <i class="fas fa-list text-secondary mr-2"></i> Cây Danh Mục ({{ $allCategories->count() }} danh mục)
            </span>
            <span class="badge badge-light text-muted px-3 py-2 border">
                {{ $rootCategories->count() }} Danh mục gốc &bull; {{ $allCategories->whereNotNull('parent_id')->count() }} Danh mục con
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="thead-light">
                    <tr style="font-size: 13px;">
                        <th style="width: 60px;" class="text-center">Thứ tự</th>
                        <th style="width: 70px;">Hình ảnh</th>
                        <th>Tên Danh Mục</th>
                        <th>Cấp bậc</th>
                        <th>Slug (Đường dẫn)</th>
                        <th class="text-center" style="width: 130px;">Số sản phẩm</th>
                        <th style="width: 140px;" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rootCategories as $root)
                        <!-- Root Category Row -->
                        <tr class="table-light font-weight-bold" style="background-color: #f8fafc;">
                            <td class="text-center align-middle">
                                <span class="badge badge-dark px-2 py-1">{{ $root->sort_order }}</span>
                            </td>
                            <td class="align-middle">
                                @if($root->image)
                                    <img src="{{ $root->image }}" alt="{{ $root->name }}" 
                                         style="width: 48px; height: 36px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                @else
                                    <div style="width: 48px; height: 36px; background: #e2e8f0; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 14px;">
                                        <i class="fas fa-folder"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle" style="font-size: 14.5px; color: #0f172a;">
                                <i class="fas fa-folder-open text-warning mr-2"></i> {{ $root->name }}
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-primary px-2 py-1 font-weight-bold">Danh mục Gốc</span>
                            </td>
                            <td class="align-middle text-muted" style="font-size: 13px;">
                                <code>/{{ $root->slug }}</code>
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('admin.products.index', ['category_id' => $root->id]) }}" class="badge badge-pill badge-secondary px-3 py-1 font-weight-bold">
                                    {{ $root->products_count }} SP
                                </a>
                            </td>
                            <td class="text-right align-middle">
                                <a href="{{ route('admin.categories.edit', $root) }}" class="btn btn-sm btn-outline-primary mr-1" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDelete('{{ $root->id }}', '{{ addslashes($root->name) }}')" title="Xóa danh mục">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $root->id }}" action="{{ route('admin.categories.destroy', $root) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        <!-- Children Categories Rows -->
                        @foreach($root->children as $child)
                            <tr>
                                <td class="text-center align-middle">
                                    <span class="text-muted" style="font-size: 12.5px;">{{ $child->sort_order }}</span>
                                </td>
                                <td class="align-middle">
                                    @if($child->image)
                                        <img src="{{ $child->image }}" alt="{{ $child->name }}" 
                                             style="width: 44px; height: 32px; object-fit: cover; border-radius: 5px; border: 1px solid #e2e8f0;">
                                    @else
                                        <div style="width: 44px; height: 32px; background: #f1f5f9; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 12px;">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle pl-4" style="font-size: 13.5px;">
                                    <span class="text-muted mr-1">↳</span>
                                    <i class="fas fa-tag text-info mr-1"></i> {{ $child->name }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-light text-muted border px-2 py-1">Con của: {{ $root->name }}</span>
                                </td>
                                <td class="align-middle text-muted" style="font-size: 12.5px;">
                                    <code>/{{ $child->slug }}</code>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('admin.products.index', ['category_id' => $child->id]) }}" class="badge badge-pill badge-info px-3 py-1">
                                        {{ $child->products_count }} SP
                                    </a>
                                </td>
                                <td class="text-right align-middle">
                                    <a href="{{ route('admin.categories.edit', $child) }}" class="btn btn-sm btn-outline-primary mr-1" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete('{{ $child->id }}', '{{ addslashes($child->name) }}')" title="Xóa danh mục">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $child->id }}" action="{{ route('admin.categories.destroy', $child) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Chưa có danh mục sản phẩm nào. Hãy tạo danh mục đầu tiên!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(id, name) {
        if (confirm('Bạn có chắc chắn muốn xóa danh mục: "' + name + '"?\nLưu ý: Không thể xóa nếu danh mục đang chứa danh mục con hoặc sản phẩm.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush
