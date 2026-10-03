@extends('admin.layouts.master')

@section('title', 'Quản Lý Đối Tác & Thị Trường')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-handshake text-danger mr-2"></i> Đối Tác, Thị Trường & Chứng Nhận
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                Quản lý các logo thị trường xuất khẩu (Active Market), đối tác chiến lược và chứng chỉ chất lượng trên website.
            </p>
        </div>
        <a href="{{ route('admin.partners.create', ['type' => request('type', 'market')]) }}" class="btn btn-danger font-weight-bold shadow-sm">
            <i class="fas fa-plus mr-1"></i> Thêm Logo Mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- Type Tabs -->
    <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px;">
        <div class="card-body p-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ !request('type') ? 'active bg-danger' : 'text-dark' }} font-weight-bold py-2 px-3" 
                       href="{{ route('admin.partners.index') }}">
                        <i class="fas fa-th-large mr-1"></i> Tất Cả ({{ $stats['total'] }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type') === 'market' ? 'active bg-danger' : 'text-dark' }} font-weight-bold py-2 px-3" 
                       href="{{ route('admin.partners.index', ['type' => 'market']) }}">
                        <i class="fas fa-globe-americas text-primary mr-1"></i> Thị Trường Xuất Khẩu ({{ $stats['market'] }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type') === 'partner' ? 'active bg-danger' : 'text-dark' }} font-weight-bold py-2 px-3" 
                       href="{{ route('admin.partners.index', ['type' => 'partner']) }}">
                        <i class="fas fa-users text-info mr-1"></i> Đối Tác & Khách Hàng ({{ $stats['partner'] }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type') === 'certificate' ? 'active bg-danger' : 'text-dark' }} font-weight-bold py-2 px-3" 
                       href="{{ route('admin.partners.index', ['type' => 'certificate']) }}">
                        <i class="fas fa-certificate text-warning mr-1"></i> Chứng Nhận Chất Lượng ({{ $stats['certificate'] }})
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Partners Table -->
    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="thead-light">
                    <tr style="font-size: 13px;">
                        <th style="width: 70px;" class="text-center">Thứ tự</th>
                        <th style="width: 120px;">Hình ảnh Logo</th>
                        <th>Tên đối tác / thị trường</th>
                        <th>Phân loại</th>
                        <th>Đường dẫn liên kết</th>
                        <th class="text-center" style="width: 120px;">Hiển thị</th>
                        <th style="width: 120px;" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partners as $partner)
                        <tr>
                            <td class="text-center align-middle font-weight-bold">
                                {{ $partner->sort_order }}
                            </td>
                            <td class="align-middle">
                                <div style="width: 100px; height: 50px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; display: flex; align-items: center; justify-content: center; padding: 4px;">
                                    <img src="{{ $partner->image }}" alt="{{ $partner->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            </td>
                            <td class="align-middle font-weight-bold" style="font-size: 14.5px;">
                                {{ $partner->name }}
                            </td>
                            <td class="align-middle">
                                @if($partner->type === 'market')
                                    <span class="badge badge-primary px-2 py-1"><i class="fas fa-globe-americas mr-1"></i> Thị Trường</span>
                                @elseif($partner->type === 'partner')
                                    <span class="badge badge-info px-2 py-1"><i class="fas fa-handshake mr-1"></i> Đối Tác</span>
                                @elseif($partner->type === 'certificate')
                                    <span class="badge badge-warning text-dark px-2 py-1"><i class="fas fa-certificate mr-1"></i> Chứng Nhận</span>
                                @endif
                            </td>
                            <td class="align-middle text-muted" style="font-size: 13px;">
                                @if($partner->link)
                                    <a href="{{ $partner->link }}" target="_blank" class="text-primary">
                                        <i class="fas fa-external-link-alt mr-1"></i> {{ $partner->link }}
                                    </a>
                                @else
                                    <span class="text-muted">Không có link</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <form action="{{ route('admin.partners.toggleActive', $partner) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $partner->is_active ? 'btn-success' : 'btn-secondary' }}" 
                                            style="border-radius: 20px; font-size: 11px; padding: 3px 10px;">
                                        <i class="fas fa-{{ $partner->is_active ? 'check' : 'eye-slash' }} mr-1"></i> {{ $partner->is_active ? 'Hiển thị' : 'Đang ẩn' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-right align-middle">
                                <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-outline-primary mr-1" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDeletePartner('{{ $partner->id }}', '{{ addslashes($partner->name) }}')" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-partner-form-{{ $partner->id }}" action="{{ route('admin.partners.destroy', $partner) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-handshake fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Chưa có logo nào. Hãy tạo logo đầu tiên!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($partners->hasPages())
            <div class="card-footer bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <span class="text-muted" style="font-size: 13px;">
                    Hiển thị từ {{ $partners->firstItem() }} đến {{ $partners->lastItem() }} trên tổng số {{ $partners->total() }} logo
                </span>
                <div>
                    {{ $partners->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDeletePartner(id, name) {
        if (confirm('Bạn có chắc chắn muốn xóa logo: "' + name + '"?')) {
            document.getElementById('delete-partner-form-' + id).submit();
        }
    }
</script>
@endpush
