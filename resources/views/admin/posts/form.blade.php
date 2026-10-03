@extends('admin.layouts.master')

@section('title', $post->exists ? 'Chỉnh Sửa: ' . $post->title : 'Thêm Mới Bài Đăng')

@push('styles')
<style>
    .post-preview-box {
        width: 100%;
        max-width: 320px;
        height: 200px;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
    }
    .post-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .ck-editor__editable_inline {
        min-height: 250px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                <i class="fas fa-edit text-danger mr-2"></i> {{ $post->exists ? 'Chỉnh Sửa Bài Đăng' : 'Thêm Mới Bài Đăng' }}
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                {{ $post->exists ? 'Cập nhật lại nội dung, hình ảnh hoặc link video.' : 'Đăng bài viết tin tức, tạo album ảnh nhà máy hoặc thêm video YouTube.' }}
            </p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary font-weight-bold">
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

    <form action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if($post->exists)
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-lg-8">
                <!-- Core Info Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Loại Nội Dung <span class="text-danger">*</span></label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="custom-control custom-radio custom-control-inline mr-4">
                                    <input type="radio" id="type_news" name="type" value="news" class="custom-control-input" 
                                           {{ old('type', $post->type ?? 'news') === 'news' ? 'checked' : '' }} onchange="toggleTypeFields()">
                                    <label class="custom-control-label font-weight-bold text-primary" for="type_news">
                                        <i class="fas fa-newspaper mr-1"></i> Bài Viết Tin Tức
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mr-4">
                                    <input type="radio" id="type_album" name="type" value="album" class="custom-control-input" 
                                           {{ old('type', $post->type ?? 'news') === 'album' ? 'checked' : '' }} onchange="toggleTypeFields()">
                                    <label class="custom-control-label font-weight-bold text-warning" for="type_album">
                                        <i class="fas fa-images mr-1"></i> Ảnh Album Nhà Xưởng
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="type_video" name="type" value="video" class="custom-control-input" 
                                           {{ old('type', $post->type ?? 'news') === 'video' ? 'checked' : '' }} onchange="toggleTypeFields()">
                                    <label class="custom-control-label font-weight-bold text-danger" for="type_video">
                                        <i class="fab fa-youtube mr-1"></i> Video YouTube
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Tiêu Đề <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg font-weight-bold" id="title" name="title" 
                                   value="{{ old('title', $post->title) }}" required placeholder="Ví dụ: Lễ khánh thành nhà máy Nhựa Nhị Bình..." oninput="autoSlug(this.value)">
                        </div>

                        <div class="form-group" id="videoUrlGroup" style="display: none;">
                            <label for="video_url" class="font-weight-bold text-danger">
                                <i class="fab fa-youtube mr-1"></i> Đường Dẫn Video YouTube (URL)
                            </label>
                            <input type="text" class="form-control" id="video_url" name="video_url" 
                                   value="{{ old('video_url', $post->video_url) }}" placeholder="Ví dụ: https://www.youtube.com/watch?v=CVmL6suEY2A">
                            <small class="text-muted">Nhập link YouTube để hiển thị popup xem video trực tiếp khi click.</small>
                        </div>

                        <div class="form-group">
                            <label for="slug" class="font-weight-bold">Đường dẫn thân thiện (Slug URL)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size: 13px;">/</span>
                                </div>
                                <input type="text" class="form-control" id="slug" name="slug" 
                                       value="{{ old('slug', $post->slug) }}" placeholder="tu-dong-tao-khi-nhap-tieu-de">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="summary" class="font-weight-bold">Mô tả tóm tắt ngắn</label>
                            <textarea class="form-control" id="summary" name="summary" rows="3" 
                                      placeholder="Tóm tắt 1-2 câu về nội dung bài viết...">{{ old('summary', $post->summary) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Content Card (CKEditor) -->
                <div class="card shadow-sm border-0 mb-4" id="contentGroup" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-file-alt text-primary mr-2"></i> Nội Dung Chi Tiết</h6>
                    </div>
                    <div class="card-body pt-0">
                        <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', $post->content) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Status Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-toggle-on text-secondary mr-2"></i> Trạng Thái</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_published" name="is_published" value="1" 
                                   {{ old('is_published', $post->is_published ?? true) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="is_published">Xuất bản công khai</label>
                            <small class="form-text text-muted">Nếu tắt, bài đăng sẽ lưu ở dạng bản nháp và không hiện ngoài trang chủ.</small>
                        </div>
                    </div>
                </div>

                <!-- Image Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-image text-danger mr-2"></i> Hình Ảnh Đại Diện</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="post-preview-box mx-auto">
                            <img src="{{ $post->image ?: '/thumbs/400x300x1/assets/images/noimage.png' }}" 
                                 id="postPreview" alt="Xem trước ảnh">
                        </div>
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="image_file" name="image_file" accept="image/*" onchange="previewPost(this)">
                            <label class="custom-file-label" for="image_file">Chọn ảnh...</label>
                        </div>
                        <small class="text-muted d-block mb-3">
                            <i class="fas fa-info-circle mr-1"></i> Khuyến nghị kích thước: <strong>400 x 300 px</strong> hoặc <strong>400 x 250 px</strong>.
                        </small>

                        <div class="form-group mt-2 mb-0">
                            <label for="image_url" class="font-weight-bold" style="font-size: 12px;">Hoặc link ảnh có sẵn:</label>
                            <input type="text" class="form-control form-control-sm" id="image_url" name="image_url" 
                                   value="{{ old('image_url', $post->image) }}" placeholder="/upload/news/..." oninput="$('#postPreview').attr('src', this.value)">
                        </div>
                    </div>
                </div>

                <!-- Submit Button Card -->
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body p-3">
                        <button type="submit" class="btn btn-danger btn-block btn-lg font-weight-bold mb-2 shadow-sm">
                            <i class="fas fa-save mr-1"></i> {{ $post->exists ? 'Cập Nhật Bài Đăng' : 'Đăng Bài Ngay' }}
                        </button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary btn-block">Hủy Bỏ</a>
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
    // 1. Initialize CKEditor 5
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });

    // 2. Image Live Preview
    function previewPost(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#postPreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            var fileName = input.files[0].name;
            $(input).next('.custom-file-label').html(fileName);
        }
    }

    // 3. Auto Slug
    function autoSlug(text) {
        var slugInput = document.getElementById('slug');
        if (!{{ $post->exists ? 'true' : 'false' }} || slugInput.value === '') {
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

    // 4. Toggle fields depending on type
    function toggleTypeFields() {
        var isVideo = document.getElementById('type_video').checked;
        document.getElementById('videoUrlGroup').style.display = isVideo ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleTypeFields();
    });
</script>
@endpush
