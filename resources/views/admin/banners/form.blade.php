@extends('admin.layouts.master')

@section('title', $banner->exists ? 'Chỉnh Sửa Banner' : 'Thêm Banner Mới')

@push('styles')
<style>
    .banner-preview-box {
        width: 100%;
        max-width: 500px;
        height: 200px;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        background: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
    }
    .banner-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-images text-danger mr-2"></i> {{ $banner->exists ? 'Chỉnh Sửa Banner Slider' : 'Thêm Banner Mới' }}
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                {{ $banner->exists ? 'Cập nhật lại hình ảnh, tiêu đề và link điều hướng của banner.' : 'Tải lên hình ảnh banner mới cho thanh trượt trang chủ.' }}
            </p>
        </div>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary font-weight-bold">
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
            <form action="{{ $banner->exists ? route('admin.banners.update', $banner) : route('admin.banners.store') }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if($banner->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Tiêu đề Banner (Title)</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $banner->title) }}" placeholder="Ví dụ: Nhi Binh Factory VSIP 2A Front...">
                            <small class="text-muted">Tiêu đề này hiển thị trong thẻ mô tả ảnh và chú thích slider.</small>
                        </div>

                        <div class="form-group">
                            <label for="subtitle" class="font-weight-bold">Mô tả phụ / Slogan ngắn (Subtitle)</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" 
                                   value="{{ old('subtitle', $banner->subtitle) }}" placeholder="Ví dụ: Nhà máy sản xuất ép phun nhựa hiện đại...">
                        </div>

                        <div class="form-group">
                            <label for="link" class="font-weight-bold">Đường dẫn liên kết khi bấm vào (URL)</label>
                            <input type="text" class="form-control" id="link" name="link" 
                                   value="{{ old('link', $banner->link) }}" placeholder="Ví dụ: /products hoặc https://...">
                            <small class="text-muted">Để trống nếu không muốn người dùng bấm chuyển trang.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort_order" class="font-weight-bold">Thứ tự hiển thị <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                           value="{{ old('sort_order', $banner->sort_order ?? 1) }}" required>
                                    <small class="text-muted">Số nhỏ hơn sẽ chạy trước (1, 2, 3...).</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold d-block">Trạng thái hiển thị</label>
                                    <div class="custom-control custom-switch mt-2">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" 
                                               {{ old('is_active', $banner->is_active ?? true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Hiển thị ngay trên trang chủ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="font-weight-bold">Hình ảnh Banner <span class="text-danger">*</span></label>
                            <div class="banner-preview-box">
                                <img src="{{ $banner->image ?: '/thumbs/1366x580x1/upload/photo/nhibinhfactoryvsip2afront-71880.jpg' }}" 
                                     id="bannerPreview" alt="Xem trước banner">
                            </div>
                            <div class="custom-file mb-2">
                                <input type="file" class="custom-file-input" id="image_file" name="image_file" accept="image/*" onchange="previewBanner(this)">
                                <label class="custom-file-label" for="image_file">Chọn ảnh từ máy tính...</label>
                            </div>
                            <small class="text-muted d-block mb-3">
                                <i class="fas fa-info-circle mr-1"></i> Kích thước chuẩn khuyến nghị: <strong>1366 x 580 px</strong> hoặc tỉ lệ ~2.35:1. Dung lượng tối đa: 5MB.
                            </small>

                            <div class="form-group mt-2">
                                <label for="image_url" class="font-weight-bold" style="font-size: 12.5px;">Hoặc dùng đường dẫn ảnh có sẵn trên server:</label>
                                <input type="text" class="form-control form-control-sm" id="image_url" name="image_url" 
                                       value="{{ old('image_url', $banner->image) }}" placeholder="/upload/photo/..." oninput="$('#bannerPreview').attr('src', this.value)">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary px-4 mr-2">Hủy Bỏ</a>
                    <button type="submit" class="btn btn-danger font-weight-bold px-4">
                        <i class="fas fa-save mr-1"></i> {{ $banner->exists ? 'Cập Nhật Banner' : 'Tạo Banner Mới' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewBanner(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#bannerPreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            var fileName = input.files[0].name;
            $(input).next('.custom-file-label').html(fileName);
        }
    }
</script>
@endpush
