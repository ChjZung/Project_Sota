@extends('admin.layouts.master')

@section('title', $partner->exists ? 'Chỉnh Sửa Logo: ' . $partner->name : 'Thêm Logo Mới')

@push('styles')
<style>
    .logo-preview-box {
        width: 100%;
        max-width: 250px;
        height: 120px;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
        padding: 8px;
    }
    .logo-preview-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-handshake text-danger mr-2"></i> {{ $partner->exists ? 'Chỉnh Sửa Logo' : 'Thêm Logo Mới' }}
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                {{ $partner->exists ? 'Cập nhật lại hình ảnh, tên và đường dẫn website của đối tác.' : 'Tải lên logo thị trường xuất khẩu, đối tác chiến lược hoặc chứng nhận chất lượng.' }}
            </p>
        </div>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary font-weight-bold">
            <i class="fas fa-arrow-left mr-1"></i> Quay Lại Danh Sách
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i> <strong>Đã xảy ra lỗi:</strong>
            <ul class="mb-0 mt-1 pl-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-4">
            <form action="{{ $partner->exists ? route('admin.partners.update', $partner) : route('admin.partners.store') }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if($partner->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Tên Đối Tác / Thị Trường <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $partner->name) }}" required placeholder="Ví dụ: USA Market, Japan Market, ISO 9001:2015...">
                        </div>

                        <div class="form-group">
                            <label for="type" class="font-weight-bold">Phân Loại <span class="text-danger">*</span></label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="market" {{ old('type', $partner->type) === 'market' ? 'selected' : '' }}>Thị trường xuất khẩu (Active Market - Trang chủ)</option>
                                <option value="partner" {{ old('type', $partner->type) === 'partner' ? 'selected' : '' }}>Đối tác & Khách hàng chiến lược</option>
                                <option value="certificate" {{ old('type', $partner->type) === 'certificate' ? 'selected' : '' }}>Chứng nhận & Tiêu chuẩn chất lượng</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="link" class="font-weight-bold">Đường dẫn liên kết (URL)</label>
                            <input type="text" class="form-control" id="link" name="link" 
                                   value="{{ old('link', $partner->link) }}" placeholder="Ví dụ: https://... hoặc để trống">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort_order" class="font-weight-bold">Thứ tự hiển thị <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                           value="{{ old('sort_order', $partner->sort_order ?? 1) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold d-block">Trạng thái</label>
                                    <div class="custom-control custom-switch mt-2">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" 
                                               {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Hiển thị ngay</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="font-weight-bold">Hình ảnh Logo <span class="text-danger">*</span></label>
                            <div class="logo-preview-box">
                                <img src="{{ $partner->image ?: '/thumbs/200x100x1/assets/images/noimage.png' }}" 
                                     id="logoPreview" alt="Xem trước logo">
                            </div>
                            <div class="custom-file mb-2">
                                <input type="file" class="custom-file-input" id="image_file" name="image_file" accept="image/*" onchange="previewLogo(this)">
                                <label class="custom-file-label" for="image_file">Chọn file logo...</label>
                            </div>
                            <small class="text-muted d-block mb-3">
                                <i class="fas fa-info-circle mr-1"></i> Khuyến nghị kích thước chuẩn: <strong>200 x 100 px</strong> hoặc file PNG trong suốt.
                            </small>

                            <div class="form-group mt-2">
                                <label for="image_url" class="font-weight-bold" style="font-size: 12.5px;">Hoặc link ảnh có sẵn:</label>
                                <input type="text" class="form-control form-control-sm" id="image_url" name="image_url" 
                                       value="{{ old('image_url', $partner->image) }}" placeholder="/upload/photo/..." oninput="$('#logoPreview').attr('src', this.value)">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary px-4 mr-2">Hủy Bỏ</a>
                    <button type="submit" class="btn btn-danger font-weight-bold px-4">
                        <i class="fas fa-save mr-1"></i> {{ $partner->exists ? 'Cập Nhật Logo' : 'Tạo Logo Mới' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logoPreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            var fileName = input.files[0].name;
            $(input).next('.custom-file-label').html(fileName);
        }
    }
</script>
@endpush
