@extends('admin.layouts.master')

@section('title', $page->exists ? 'Chỉnh Sửa Trang: ' . $page->title : 'Tạo Trang Mới')

@push('styles')
<style>
    .page-banner-preview {
        width: 100%;
        height: 140px;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
    }
    .page-banner-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .ck-editor__editable_inline {
        min-height: 350px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-file-alt text-danger mr-2"></i> {{ $page->exists ? 'Chỉnh Sửa Trang CMS' : 'Tạo Trang CMS Mới' }}
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                {{ $page->exists ? 'Cập nhật lại nội dung, hình ảnh banner và thông số SEO của trang.' : 'Tạo trang nội dung tĩnh mới có thể truy cập qua URL tùy chỉnh.' }}
            </p>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary font-weight-bold">
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

    <form action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if($page->exists)
            @method('PUT')
        @endif

        <div class="row">
            <!-- Left Column: Content -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Tiêu Đề Trang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg font-weight-bold" id="title" name="title" 
                                   value="{{ old('title', $page->title) }}" required placeholder="Ví dụ: Giới Thiệu Công Ty Nhựa Nhị Bình..." oninput="autoSlug(this.value)">
                        </div>

                        <div class="form-group">
                            <label for="slug" class="font-weight-bold">Đường dẫn trang (Slug URL) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size: 13px;">/</span>
                                </div>
                                <input type="text" class="form-control" id="slug" name="slug" 
                                       value="{{ old('slug', $page->slug) }}" required placeholder="about-us, factory, service...">
                            </div>
                            <small class="text-muted">Đường dẫn dùng để mở trang trên website. Ví dụ: <code>about-us</code>, <code>factory</code></small>
                        </div>

                        <div class="form-group mb-0">
                            <label for="content" class="font-weight-bold">Nội Dung Chi Tiết</label>
                            <textarea class="form-control" id="content" name="content" rows="12">{{ old('content', $page->content) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- SEO Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-search text-info mr-2"></i> Tối Ưu Hóa Tìm Kiếm (SEO)</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="form-group">
                            <label for="meta_title" class="font-weight-bold">Tiêu đề SEO (Meta Title)</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                   value="{{ old('meta_title', $page->meta['title'] ?? '') }}" placeholder="Mặc định lấy theo tiêu đề trang nếu để trống">
                        </div>
                        <div class="form-group mb-0">
                            <label for="meta_desc" class="font-weight-bold">Mô tả SEO (Meta Description)</label>
                            <textarea class="form-control" id="meta_desc" name="meta_desc" rows="3" 
                                      placeholder="Mô tả tóm tắt nội dung để hiển thị trên kết quả tìm kiếm Google...">{{ old('meta_desc', $page->meta['description'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Media & Actions -->
            <div class="col-lg-4">
                <!-- Banner Image Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-image text-danger mr-2"></i> Ảnh Banner Đầu Trang</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="page-banner-preview">
                            <img src="{{ $page->banner_image ?: '/thumbs/1366x300x1/assets/images/noimage.png' }}" 
                                 id="bannerPreview" alt="Xem trước banner">
                        </div>
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="banner_file" name="banner_file" accept="image/*" onchange="previewPageBanner(this)">
                            <label class="custom-file-label" for="banner_file">Chọn ảnh banner...</label>
                        </div>
                        <small class="text-muted d-block mb-3">
                            <i class="fas fa-info-circle mr-1"></i> Khuyến nghị kích thước ngang: <strong>1366 x 300 px</strong>.
                        </small>

                        <div class="form-group mt-2 mb-0">
                            <label for="banner_url" class="font-weight-bold" style="font-size: 12px;">Hoặc link ảnh có sẵn:</label>
                            <input type="text" class="form-control form-control-sm" id="banner_url" name="banner_url" 
                                   value="{{ old('banner_url', $page->banner_image) }}" placeholder="/upload/photo/..." oninput="$('#bannerPreview').attr('src', this.value)">
                        </div>
                    </div>
                </div>

                <!-- Submit Button Card -->
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body p-3">
                        <button type="submit" class="btn btn-danger btn-block btn-lg font-weight-bold mb-2 shadow-sm">
                            <i class="fas fa-save mr-1"></i> {{ $page->exists ? 'Cập Nhật Trang' : 'Lưu & Xuất Bản' }}
                        </button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary btn-block">Hủy Bỏ</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });

    function previewPageBanner(input) {
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

    function autoSlug(text) {
        var slugInput = document.getElementById('slug');
        if (!{{ $page->exists ? 'true' : 'false' }} || slugInput.value === '') {
            slugInput.value = text.toLowerCase()
                .replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a')
                .replace(/[éèẻẽẹêếềểễệ]/g, 'e')
                .replace(/[íìỉĩị]/g, 'i')
                .replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o')
                .replace(/[úùủũụưứừửữự]/g, 'u')
                .replace(/[ýỳỷỹỵ]/g, 'y')
                .replace(/đ/g, 'd')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
    }
</script>
@endpush
