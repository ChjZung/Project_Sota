@extends('admin.layouts.master')

@section('title', 'Chi Tiết Yêu Cầu Báo Giá #' . $inquiry->id)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
        <i class="fas fa-arrow-left mr-1"></i> Quay lại danh sách yêu cầu
    </a>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h4 class="font-weight-bold mb-1 text-dark">
                <i class="fas fa-file-contract text-danger mr-2"></i>Chi Tiết Yêu Cầu Báo Giá #{{ $inquiry->id }}
            </h4>
            <p class="text-muted small mb-0">Tiếp nhận lúc {{ $inquiry->created_at->format('d/m/Y H:i:s') }} ({{ $inquiry->created_at->diffForHumans() }})</p>
        </div>
        <div>
            @if($inquiry->status === 'pending')
                <span class="badge badge-warning px-3 py-2 font-weight-bold" style="font-size: 13px;"><i class="fas fa-clock mr-1"></i>Chờ xử lý</span>
            @elseif($inquiry->status === 'processing')
                <span class="badge badge-info px-3 py-2 font-weight-bold" style="font-size: 13px;"><i class="fas fa-spinner mr-1"></i>Đang xử lý</span>
            @else
                <span class="badge badge-success px-3 py-2 font-weight-bold" style="font-size: 13px;"><i class="fas fa-check-circle mr-1"></i>Đã giải quyết</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        {{-- Nội dung yêu cầu --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-comment-alt text-primary mr-2"></i>Nội Dung Khách Hàng Gửi
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="p-3 bg-light rounded text-dark" style="white-space: pre-line; line-height: 1.8; font-size: 14.5px; border: 1px solid #e2e8f0;">
                    {{ $inquiry->message }}
                </div>
            </div>
        </div>

        {{-- Cập nhật trạng thái & Ghi chú --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-edit text-success mr-2"></i>Xử Lý Yêu Cầu & Ghi Chú Nội Bộ
                </h6>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Trạng Thái Xử Lý</label>
                        <select name="status" class="form-control custom-select col-md-6">
                            <option value="pending" {{ $inquiry->status === 'pending' ? 'selected' : '' }}>⏳ Chờ xử lý (Mới nhận)</option>
                            <option value="processing" {{ $inquiry->status === 'processing' ? 'selected' : '' }}>🔄 Đang xử lý (Đang liên hệ / Báo giá)</option>
                            <option value="closed" {{ $inquiry->status === 'closed' ? 'selected' : '' }}>✅ Đã giải quyết (Hoàn tất)</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark">Ghi Chú Nội Bộ</label>
                        <textarea name="admin_notes" rows="4" class="form-control" placeholder="Ghi lại tiến trình làm việc với khách hàng...">{{ old('admin_notes', $inquiry->admin_notes) }}</textarea>
                        <small class="text-muted">Chỉ hiển thị cho nội bộ ban quản lý.</small>
                    </div>

                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Lưu Thay Đổi
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Thông tin liên hệ --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-user text-info mr-2"></i>Thông Tin Đối Tác / Khách Hàng
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <div class="text-muted small text-uppercase font-weight-bold">Họ và tên</div>
                    <div class="h6 font-weight-bold text-dark mb-0">{{ $inquiry->name }}</div>
                </div>

                @if($inquiry->company)
                    <div class="mb-3">
                        <div class="text-muted small text-uppercase font-weight-bold">Công ty / Tổ chức</div>
                        <div class="text-dark"><i class="fas fa-building mr-1 text-muted"></i>{{ $inquiry->company }}</div>
                    </div>
                @endif

                <div class="mb-3">
                    <div class="text-muted small text-uppercase font-weight-bold">Email</div>
                    <div>
                        <a href="mailto:{{ $inquiry->email }}" class="text-primary font-weight-bold">
                            <i class="fas fa-envelope mr-1"></i>{{ $inquiry->email }}
                        </a>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small text-uppercase font-weight-bold">Số điện thoại</div>
                    <div>
                        <a href="tel:{{ $inquiry->phone }}" class="text-success font-weight-bold">
                            <i class="fas fa-phone-alt mr-1"></i>{{ $inquiry->phone }}
                        </a>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted">Hành động:</span>
                    <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa yêu cầu này vĩnh viễn?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-trash-alt mr-1"></i> Xóa yêu cầu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
