@extends('admin.layouts.master')

@section('title', 'Quản Lý Sản Phẩm')

@section('content')
<div class="container-fluid p-0">
    <!-- Header title and Action -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-boxes text-danger mr-2"></i> Danh Sách Sản Phẩm
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                Quản lý toàn bộ danh mục sản phẩm nhựa kỹ thuật, đồ chơi, gia dụng của Nhựa Nhị Bình.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary font-weight-bold mr-2">
                <i class="fas fa-sitemap mr-1"></i> Quản Lý Danh Mục
            </a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-danger font-weight-bold shadow-sm">
                <i class="fas fa-plus mr-1"></i> Thêm Sản Phẩm Mới
            </a>
        </div>
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

    <!-- Filter Card -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-body p-3">
            <form action="{{ route('admin.products.index') }}" method="GET" class="row align-items-center">
                <div class="col-md-4 mb-2 mb-md-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-search text-muted"></i></span>
                        </div>
                        <input type="text" name="search" class="form-control border-left-0" 
                               placeholder="Tìm theo tên, mã sản phẩm hoặc chất liệu..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="category_id" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Tất cả danh mục --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->parent_id ? '↳ ' . $cat->name : '📂 ' . $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-2 mb-md-0">
                    <select name="featured" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Nổi bật: Tất cả --</option>
                        <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Có nổi bật</option>
                        <option value="0" {{ request('featured') === '0' ? 'selected' : '' }}>Không nổi bật</option>
                    </select>
                </div>

                <div class="col-md-2 mb-2 mb-md-0">
                    <select name="active" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Trạng thái: Tất cả --</option>
                        <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>Đang hiển thị</option>
                        <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>Đang ẩn</option>
                    </select>
                </div>

                <div class="col-md-1">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-block" title="Đặt lại bộ lọc">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Table Card -->
    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <span class="font-weight-bold text-dark" style="font-size: 15px;">
                <i class="fas fa-list text-secondary mr-2"></i> Danh Sách (Tổng {{ $products->total() }} sản phẩm)
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="thead-light">
                    <tr style="font-size: 13px;">
                        <th style="width: 70px;">Hình ảnh</th>
                        <th>Thông tin sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Chất liệu / Xuất xứ</th>
                        <th class="text-center" style="width: 100px;">Nổi bật</th>
                        <th class="text-center" style="width: 100px;">Hiển thị</th>
                        <th style="width: 130px;" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $prod)
                        <tr>
                            <!-- Thumbnail -->
                            <td class="align-middle">
                                @if($prod->image)
                                    <img src="{{ $prod->image }}" alt="{{ $prod->name }}" 
                                         style="width: 52px; height: 52px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                                @else
                                    <div style="width: 52px; height: 52px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 14px;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Info -->
                            <td class="align-middle">
                                <a href="{{ route('admin.products.edit', $prod) }}" class="font-weight-bold text-dark d-block mb-1" style="font-size: 14.5px;">
                                    {{ $prod->name }}
                                </a>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge badge-light border text-muted mr-2" style="font-size: 11px;">
                                        <i class="fas fa-barcode mr-1"></i> {{ $prod->product_code }}
                                    </span>
                                    <a href="/{{ $prod->slug }}" target="_blank" class="text-muted" style="font-size: 12px;" title="Xem ngoài website">
                                        <i class="fas fa-external-link-alt"></i> /{{ $prod->slug }}
                                    </a>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="align-middle">
                                @if($prod->category)
                                    <span class="badge badge-info px-2 py-1" style="font-size: 12px;">
                                        {{ $prod->category->name }}
                                    </span>
                                @else
                                    <span class="badge badge-secondary">Chưa phân loại</span>
                                @endif
                            </td>

                            <!-- Material / Origin -->
                            <td class="align-middle" style="font-size: 13px;">
                                <div><i class="fas fa-cube text-secondary mr-1"></i> {{ $prod->material ?: 'Chưa cập nhật' }}</div>
                                <small class="text-muted"><i class="fas fa-map-marker-alt mr-1"></i> {{ $prod->origin ?: 'Việt Nam' }}</small>
                            </td>

                            <!-- Featured Toggle -->
                            <td class="text-center align-middle">
                                <form action="{{ route('admin.products.toggleFeatured', $prod) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $prod->is_featured ? 'btn-warning text-dark' : 'btn-light text-muted border' }}" 
                                            title="{{ $prod->is_featured ? 'Bấm để bỏ nổi bật' : 'Bấm để đánh dấu nổi bật' }}" style="border-radius: 20px; font-size: 11px; padding: 3px 10px;">
                                        <i class="fas fa-star mr-1"></i> {{ $prod->is_featured ? 'Nổi bật' : 'Thường' }}
                                    </button>
                                </form>
                            </td>

                            <!-- Active Toggle -->
                            <td class="text-center align-middle">
                                <form action="{{ route('admin.products.toggleActive', $prod) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $prod->is_active ? 'btn-success' : 'btn-secondary' }}" 
                                            title="{{ $prod->is_active ? 'Bấm để ẩn sản phẩm' : 'Bấm để hiện sản phẩm' }}" style="border-radius: 20px; font-size: 11px; padding: 3px 10px;">
                                        <i class="fas fa-{{ $prod->is_active ? 'check' : 'eye-slash' }} mr-1"></i> {{ $prod->is_active ? 'Hiển thị' : 'Đang ẩn' }}
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="text-right align-middle">
                                <a href="{{ route('admin.products.edit', $prod) }}" class="btn btn-sm btn-outline-primary mr-1" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDeleteProduct('{{ $prod->id }}', '{{ addslashes($prod->name) }}')" title="Xóa sản phẩm">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-prod-form-{{ $prod->id }}" action="{{ route('admin.products.destroy', $prod) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-boxes fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Không tìm thấy sản phẩm nào phù hợp với bộ lọc.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="card-footer bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <span class="text-muted" style="font-size: 13px;">
                    Hiển thị từ {{ $products->firstItem() }} đến {{ $products->lastItem() }} trên tổng số {{ $products->total() }} sản phẩm
                </span>
                <div>
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDeleteProduct(id, name) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm: "' + name + '"?\nDữ liệu đã xóa sẽ không thể phục hồi.')) {
            document.getElementById('delete-prod-form-' + id).submit();
        }
    }
</script>
@endpush
