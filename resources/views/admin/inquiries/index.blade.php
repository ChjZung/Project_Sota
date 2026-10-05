@extends('admin.layouts.master')

@section('title', 'Quản Lý Yêu Cầu Báo Giá')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h4 class="font-weight-bold mb-1 text-dark">
            <i class="fas fa-envelope-open-text text-danger mr-2"></i>Quản Lý Yêu Cầu Báo Giá & Liên Hệ
        </h4>
        <p class="text-muted small mb-0">Theo dõi, tiếp nhận và phân loại các yêu cầu từ đối tác & khách hàng gửi qua website.</p>
    </div>
</div>

{{-- Thống kê theo trạng thái (Tabs) --}}
<div class="row mb-3">
    <div class="col-md-3 col-sm-6 mb-2">
        <a href="{{ route('admin.inquiries.index') }}" class="card border-0 shadow-sm text-decoration-none {{ !request('status') || request('status') === 'all' ? 'border-left-primary bg-light' : '' }}" style="border-left: 4px solid #4f46e5 !important;">
            <div class="card-body py-3 px-3 d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small font-weight-bold text-uppercase">Tất Cả Yêu Cầu</div>
                    <div class="h5 mb-0 font-weight-bold text-dark">{{ $statusCounts['all'] }}</div>
                </div>
                <div class="rounded-circle bg-primary text-white p-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-inbox"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-2">
        <a href="{{ route('admin.inquiries.index', ['status' => 'pending']) }}" class="card border-0 shadow-sm text-decoration-none {{ request('status') === 'pending' ? 'bg-light' : '' }}" style="border-left: 4px solid #f59e0b !important;">
            <div class="card-body py-3 px-3 d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-warning small font-weight-bold text-uppercase">Chờ Xử Lý</div>
                    <div class="h5 mb-0 font-weight-bold text-dark">{{ $statusCounts['pending'] }}</div>
                </div>
                <div class="rounded-circle bg-warning text-white p-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-2">
        <a href="{{ route('admin.inquiries.index', ['status' => 'processing']) }}" class="card border-0 shadow-sm text-decoration-none {{ request('status') === 'processing' ? 'bg-light' : '' }}" style="border-left: 4px solid #0284c7 !important;">
            <div class="card-body py-3 px-3 d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-info small font-weight-bold text-uppercase">Đang Xử Lý</div>
                    <div class="h5 mb-0 font-weight-bold text-dark">{{ $statusCounts['processing'] }}</div>
                </div>
                <div class="rounded-circle bg-info text-white p-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-2">
        <a href="{{ route('admin.inquiries.index', ['status' => 'closed']) }}" class="card border-0 shadow-sm text-decoration-none {{ request('status') === 'closed' ? 'bg-light' : '' }}" style="border-left: 4px solid #10b981 !important;">
            <div class="card-body py-3 px-3 d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-success small font-weight-bold text-uppercase">Đã Giải Quyết</div>
                    <div class="h5 mb-0 font-weight-bold text-dark">{{ $statusCounts['closed'] }}</div>
                </div>
                <div class="rounded-circle bg-success text-white p-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- Bảng dữ liệu --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <form method="GET" action="{{ route('admin.inquiries.index') }}" class="row g-2 align-items-center">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Tìm theo tên, email, SĐT, công ty hoặc nội dung..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>Tất cả trạng thái</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý ({{ $statusCounts['pending'] }})</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý ({{ $statusCounts['processing'] }})</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Đã giải quyết ({{ $statusCounts['closed'] }})</option>
                </select>
            </div>

            @if(request('search') || request('status'))
                <div class="col-md-2">
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-link text-muted btn-sm">
                        <i class="fas fa-undo mr-1"></i> Xóa bộ lọc
                    </a>
                </div>
            @endif
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 50px;" class="text-center">#</th>
                        <th style="width: 220px;">Khách Hàng / Đơn Vị</th>
                        <th style="width: 200px;">Thông Tin Liên Hệ</th>
                        <th>Nội Dung Yêu Cầu</th>
                        <th style="width: 140px;" class="text-center">Trạng Thái</th>
                        <th style="width: 130px;">Thời Gian</th>
                        <th style="width: 120px;" class="text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $item)
                        <tr class="{{ $item->status === 'pending' ? 'table-warning-light font-weight-bold' : '' }}">
                            <td class="text-center text-muted small">{{ $item->id }}</td>
                            <td>
                                <div class="font-weight-bold text-dark">{{ $item->name }}</div>
                                @if($item->company)
                                    <div class="small text-muted"><i class="fas fa-building mr-1"></i>{{ $item->company }}</div>
                                @endif
                            </td>
                            <td>
                                <div><a href="mailto:{{ $item->email }}" class="text-primary small"><i class="fas fa-envelope mr-1"></i>{{ $item->email }}</a></div>
                                <div><a href="tel:{{ $item->phone }}" class="text-dark small"><i class="fas fa-phone-alt mr-1"></i>{{ $item->phone }}</a></div>
                            </td>
                            <td>
                                <div class="text-truncate-2 small text-dark" title="{{ $item->message }}" style="max-width: 320px;">
                                    {{ Str::limit($item->message, 120) }}
                                </div>
                                @if($item->admin_notes)
                                    <div class="small text-muted mt-1 font-italic">
                                        <i class="fas fa-sticky-note text-warning mr-1"></i><strong>Ghi chú:</strong> {{ Str::limit($item->admin_notes, 60) }}
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->status === 'pending')
                                    <span class="badge badge-warning px-2 py-1"><i class="fas fa-clock mr-1"></i>Chờ xử lý</span>
                                @elseif($item->status === 'processing')
                                    <span class="badge badge-info px-2 py-1"><i class="fas fa-spinner mr-1"></i>Đang xử lý</span>
                                @else
                                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Đã giải quyết</span>
                                @endif
                            </td>
                            <td class="small text-muted">
                                <div>{{ $item->created_at->format('d/m/Y') }}</div>
                                <div class="text-muted" style="font-size: 11px;">{{ $item->created_at->format('H:i') }} ({{ $item->created_at->diffForHumans() }})</div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-primary" 
                                            onclick="openDetailModal({{ json_encode($item) }})" 
                                            title="Xem chi tiết & Cập nhật">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <form method="POST" action="{{ route('admin.inquiries.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa yêu cầu báo giá của khách hàng {{ $item->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Không tìm thấy yêu cầu báo giá nào phù hợp với điều kiện tìm kiếm.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($inquiries->hasPages())
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
            <span class="small text-muted">Hiển thị {{ $inquiries->firstItem() }} - {{ $inquiries->lastItem() }} trên tổng số {{ $inquiries->total() }} yêu cầu</span>
            {{ $inquiries->links() }}
        </div>
    @endif
</div>

{{-- Modal Chi tiết & Cập nhật Trạng thái --}}
<div class="modal fade" id="inquiryDetailModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modalLabel">
                    <i class="fas fa-file-contract text-warning mr-2"></i>Chi Tiết Yêu Cầu Báo Giá
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateInquiryForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    {{-- Thông tin người gửi --}}
                    <div class="row mb-3 pb-3 border-bottom">
                        <div class="col-md-6 mb-2">
                            <label class="text-muted small text-uppercase font-weight-bold">Khách Hàng</label>
                            <h5 id="m_name" class="font-weight-bold text-dark mb-1"></h5>
                            <div id="m_company" class="text-muted small"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-muted small text-uppercase font-weight-bold">Thời Gian Tiếp Nhận</label>
                            <div id="m_created_at" class="text-dark font-weight-bold"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase font-weight-bold">Email</label>
                            <div><a id="m_email" href="" class="text-primary font-weight-bold"></a></div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase font-weight-bold">Số Điện Thoại</label>
                            <div><a id="m_phone" href="" class="text-success font-weight-bold"></a></div>
                        </div>
                    </div>

                    {{-- Nội dung tin nhắn --}}
                    <div class="mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold">Nội Dung Yêu Cầu / Đơn Hàng Báo Giá</label>
                        <div class="p-3 bg-light rounded text-dark" id="m_message" style="white-space: pre-line; line-height: 1.6; border: 1px solid #e2e8f0;"></div>
                    </div>

                    {{-- Cập nhật trạng thái và ghi chú --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark small text-uppercase">Cập Nhật Trạng Thái</label>
                            <select name="status" id="m_status_select" class="form-control custom-select">
                                <option value="pending">⏳ Chờ xử lý (Mới)</option>
                                <option value="processing">🔄 Đang xử lý (Đã liên hệ)</option>
                                <option value="closed">✅ Đã giải quyết (Hoàn tất)</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="font-weight-bold text-dark small text-uppercase">Ghi Chú Nội Bộ Của Quản Trị Viên</label>
                            <textarea name="admin_notes" id="m_admin_notes" rows="3" class="form-control" placeholder="Nhập ghi chú (VD: Đã gọi điện lúc 10h, hẹn gửi bảng báo giá khuôn ép nhựa qua email...)"></textarea>
                            <small class="text-muted">Ghi chú này chỉ hiển thị trong nội bộ ban quản trị, khách hàng không thấy.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Lưu Cập Nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table-warning-light {
        background-color: #fffbeb !important;
    }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
    function openDetailModal(item) {
        document.getElementById('m_name').innerText = item.name;
        document.getElementById('m_company').innerHTML = item.company ? '<i class="fas fa-building mr-1"></i> ' + item.company : '<span class="text-muted font-italic">Không có tên công ty</span>';
        
        var emailEl = document.getElementById('m_email');
        emailEl.innerText = item.email;
        emailEl.href = 'mailto:' + item.email;

        var phoneEl = document.getElementById('m_phone');
        phoneEl.innerText = item.phone;
        phoneEl.href = 'tel:' + item.phone;

        var createdAt = new Date(item.created_at);
        document.getElementById('m_created_at').innerText = createdAt.toLocaleString('vi-VN');

        document.getElementById('m_message').innerText = item.message;
        document.getElementById('m_status_select').value = item.status;
        document.getElementById('m_admin_notes').value = item.admin_notes || '';

        var form = document.getElementById('updateInquiryForm');
        form.action = '/admin/inquiries/' + item.id;

        $('#inquiryDetailModal').modal('show');
    }
</script>
@endpush
