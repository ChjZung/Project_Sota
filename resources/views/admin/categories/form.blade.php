@extends('admin.layouts.master')

@section('title', $category->exists ? 'Chỉnh Sửa Danh Mục: ' . $category->name : 'Thêm Danh Mục Mới')

@push('styles')
<style>
    .cat-preview-box {
        width: 100%;
        max-width: 320px;
        height: 180px;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
    }
    .cat-preview-box img {
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
                <i class="fas fa-sitemap text-danger mr-2"></i> {{ $category->exists ? 'Chỉnh Sửa Danh Mục Sản Phẩm' : 'Thêm Danh Mục Mới' }}
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                {{ $category->exists ? 'Cập nhật lại tên, danh mục cha, hình ảnh và đường dẫn danh mục.' : 'Tạo mới danh mục gốc hoặc danh mục con để phân nhóm sản phẩm.' }}
            </p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary font-weight-bold">
            <i class="fas fa-arrow-left mr-1"></i> Quay Lại Danh Sách
        </a>
    </div>

    @if(isset($errors) && $errors->any())
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
            <form action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if($category->exists)
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Tên Danh Mục <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $category->name) }}" required placeholder="Ví dụ: CUSTOM PLASTIC PRODUCTS..." oninput="autoSlug(this.value)">
                            <small class="text-muted">Tên hiển thị trên menu Navbar và danh mục sản phẩm.</small>
                        </div>

                        <div class="form-group">
                            <label for="parent_id" class="font-weight-bold">Danh Mục Cha (Cấp bậc)</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="">-- [Là Danh mục Gốc (Cấp 1)] --</option>
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                        📂 {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Chọn nếu muốn danh mục này là danh mục con (Cấp 2) của một danh mục khác.</small>
                        </div>

                        <div class="form-group">
                            <label for="slug" class="font-weight-bold">Đường dẫn thân thiện (Slug URL)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size: 13px;">/</span>
                                </div>
                                <input type="text" class="form-control" id="slug" name="slug" 
                                       value="{{ old('slug', $category->slug) }}" placeholder="tu-dong-tao-neu-de-trong">
                            </div>
                            <small class="text-muted">Tự động sinh từ tên nếu để trống. Ví dụ: <code>custom-plastic-products</code></small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort_order" class="font-weight-bold">Thứ tự hiển thị <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                           value="{{ old('sort_order', $category->sort_order ?? 1) }}" required>
                                    <small class="text-muted">Số nhỏ hơn sẽ đứng trước (1, 2, 3...).</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Mô tả ngắn về danh mục</label>
                            <textarea class="form-control" id="description" name="description" rows="3" 
                                      placeholder="Mô tả tóm tắt về nhóm sản phẩm này...">{{ old('description', $category->description) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="font-weight-bold">Hình ảnh đại diện danh mục</label>
                            <div class="cat-preview-box">
                                <img src="{{ $category->image ?: '/thumbs/300x300x1/assets/images/noimage.png' }}" 
                                     id="catPreview" alt="Xem trước ảnh">
                            </div>
                            <div class="custom-file mb-2">
                                <input type="file" class="custom-file-input" id="image_file" name="image_file" accept="image/*" onchange="previewCat(this)">
                                <label class="custom-file-label" for="image_file">Chọn ảnh từ máy tính...</label>
                            </div>
                            <small class="text-muted d-block mb-3">
                                <i class="fas fa-info-circle mr-1"></i> Định dạng: JPG, PNG, WEBP. Tối đa 5MB.
                            </small>

                            <div class="form-group mt-2">
                                <label for="image_url" class="font-weight-bold" style="font-size: 12.5px;">Hoặc đường dẫn ảnh có sẵn:</label>
                                <input type="text" class="form-control form-control-sm" id="image_url" name="image_url" 
                                       value="{{ old('image_url', $category->image) }}" placeholder="/upload/photo/..." oninput="$('#catPreview').attr('src', this.value)">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary px-4 mr-2">Hủy Bỏ</a>
                    <button type="submit" class="btn btn-danger font-weight-bold px-4">
                        <i class="fas fa-save mr-1"></i> {{ $category->exists ? 'Cập Nhật Danh Mục' : 'Tạo Danh Mục Mới' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewCat(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#catPreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            var fileName = input.files[0].name;
            $(input).next('.custom-file-label').html(fileName);
        }
    }

    function autoSlug(text) {
        var slugInput = document.getElementById('slug');
        if (!{{ $category->exists ? 'true' : 'false' }} || slugInput.value === '') {
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
