@extends('admin.layouts.master')

@section('title', $product->exists ? 'Chỉnh Sửa Sản Phẩm: ' . $product->name : 'Thêm Sản Phẩm Mới')

@push('styles')
<style>
    .prod-preview-box {
        width: 100%;
        max-width: 320px;
        height: 240px;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
    }
    .prod-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .gallery-preview-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    .gallery-item {
        position: relative;
        width: 75px;
        height: 75px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
    }
    .gallery-item img {
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
                <i class="fas fa-boxes text-danger mr-2"></i> {{ $product->exists ? 'Chỉnh Sửa Sản Phẩm' : 'Thêm Sản Phẩm Mới' }}
            </h4>
            <p class="text-muted mb-0" style="font-size: 13.5px;">
                {{ $product->exists ? 'Cập nhật lại hình ảnh, mô tả, thông số kỹ thuật và danh mục của sản phẩm.' : 'Tạo mới sản phẩm hoàn chỉnh với hình ảnh, thông số kỹ thuật và nội dung giới thiệu.' }}
            </p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary font-weight-bold">
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

    <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if($product->exists)
            @method('PUT')
        @endif

        <div class="row">
            <!-- Left Column: Core Info & Content -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-info-circle text-primary mr-2"></i> Thông Tin Chung</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Tên Sản Phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg font-weight-bold" id="name" name="name" 
                                   value="{{ old('name', $product->name) }}" required placeholder="Ví dụ: Small Black ABS Plastic Broom Handle End Cap..." oninput="autoSlug(this.value)">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id" class="font-weight-bold">Danh Mục Sản Phẩm <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        @foreach($categories as $root)
                                            <optgroup label="📂 {{ $root->name }}">
                                                <option value="{{ $root->id }}" {{ old('category_id', $product->category_id ?: request('category_id')) == $root->id ? 'selected' : '' }}>
                                                    {{ $root->name }} (Gốc)
                                                </option>
                                                @foreach($root->children as $child)
                                                    <option value="{{ $child->id }}" {{ old('category_id', $product->category_id ?: request('category_id')) == $child->id ? 'selected' : '' }}>
                                                        &nbsp;&nbsp;↳ {{ $child->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_code" class="font-weight-bold">Mã Sản Phẩm (SKU / Code)</label>
                                    <input type="text" class="form-control" id="product_code" name="product_code" 
                                           value="{{ old('product_code', $product->product_code) }}" placeholder="Ví dụ: NBP-8899, ABS-LOCK-01...">
                                    <small class="text-muted">Để trống hệ thống sẽ tự động sinh mã ngẫu nhiên.</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="slug" class="font-weight-bold">Đường dẫn thân thiện (Slug URL)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size: 13px;">/</span>
                                </div>
                                <input type="text" class="form-control" id="slug" name="slug" 
                                       value="{{ old('slug', $product->slug) }}" placeholder="tu-dong-tao-khi-nhap-ten">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="material" class="font-weight-bold">Chất liệu nhựa</label>
                                    <input type="text" class="form-control" id="material" name="material" 
                                           value="{{ old('material', $product->material) }}" placeholder="Ví dụ: ABS / PP / HDPE / POM nguyên sinh">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="origin" class="font-weight-bold">Xuất xứ / Nơi gia công</label>
                                    <input type="text" class="form-control" id="origin" name="origin" 
                                           value="{{ old('origin', $product->origin) }}" placeholder="Ví dụ: Việt Nam (Nhà máy Nhựa Nhị Bình - VSIP II-A)">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="summary" class="font-weight-bold">Tóm tắt ngắn</label>
                            <textarea class="form-control" id="summary" name="summary" rows="2" 
                                      placeholder="Mô tả tóm tắt 1-2 câu về sản phẩm...">{{ old('summary', $product->summary) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Description Card with CKEditor -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-file-alt text-success mr-2"></i> Bài Viết Mô Tả Chi Tiết</h6>
                    </div>
                    <div class="card-body pt-0">
                        <textarea class="form-control" id="description" name="description" rows="10">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <!-- Dynamic Specifications Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-0 text-dark">
                            <i class="fas fa-sliders-h text-info mr-2"></i> Bảng Thông Số Kỹ Thuật (Specifications)
                        </h6>
                        <button type="button" class="btn btn-sm btn-outline-info font-weight-bold" onclick="addSpecRow()">
                            <i class="fas fa-plus mr-1"></i> Thêm Hàng Thông Số
                        </button>
                    </div>
                    <div class="card-body pt-0">
                        <p class="text-muted" style="font-size: 13px;">
                            Bảng này sẽ hiển thị trực quan dạng bảng thông số kỹ thuật bên dưới trang chi tiết sản phẩm.
                        </p>
                        <table class="table table-bordered mb-0" id="specsTable">
                            <thead class="thead-light" style="font-size: 13px;">
                                <tr>
                                    <th style="width: 40%;">Tên thông số (Thuộc tính)</th>
                                    <th>Giá trị / Chi tiết</th>
                                    <th style="width: 50px;" class="text-center">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $specs = old('spec_keys') 
                                        ? array_combine(old('spec_keys'), old('spec_vals', [])) 
                                        : ($product->specifications ?: [
                                            'Công nghệ sản xuất' => 'Ép phun nhựa chính xác (Plastic Injection Molding)',
                                            'Chất liệu hạt nhựa' => $product->material ?: 'ABS / PP nguyên sinh cao cấp',
                                            'Màu sắc'            => 'Theo yêu cầu (Đen / Trắng / Theo Pantone)',
                                            'Tiêu chuẩn chất lượng' => 'ISO 9001:2015, BSCI, RoHS'
                                        ]);
                                @endphp
                                @foreach($specs as $key => $val)
                                    <tr>
                                        <td>
                                            <input type="text" name="spec_keys[]" class="form-control form-control-sm" value="{{ $key }}" placeholder="Ví dụ: Kích thước, Màu sắc...">
                                        </td>
                                        <td>
                                            <input type="text" name="spec_vals[]" class="form-control form-control-sm" value="{{ $val }}" placeholder="Ví dụ: 150 x 80 mm, Trắng sứ...">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeSpecRow(this)">
                                                <i class="fas fa-times-circle fa-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Media & Switches -->
            <div class="col-lg-4">
                <!-- Status & Visibility Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-toggle-on text-secondary mr-2"></i> Trạng Thái & Hiển Thị</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="is_active">Hiển thị ngoài Website</label>
                            <small class="form-text text-muted">Nếu tắt, sản phẩm sẽ ẩn khỏi toàn bộ danh sách và trang chủ.</small>
                        </div>

                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" 
                                   {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="is_featured">Sản phẩm Nổi Bật (Featured)</label>
                            <small class="form-text text-muted">Ưu tiên hiển thị trên Tab trang chủ và mục sản phẩm gợi ý.</small>
                        </div>
                    </div>
                </div>

                <!-- Main Image Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-image text-danger mr-2"></i> Hình Ảnh Đại Diện</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="prod-preview-box mx-auto">
                            <img src="{{ $product->image ?: '/thumbs/300x300x1/assets/images/noimage.png' }}" 
                                 id="prodPreview" alt="Xem trước ảnh">
                        </div>
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="image_file" name="image_file" accept="image/*" onchange="previewProd(this)">
                            <label class="custom-file-label" for="image_file">Chọn ảnh đại diện...</label>
                        </div>
                        <small class="text-muted d-block mb-3">
                            <i class="fas fa-info-circle mr-1"></i> Khuyến nghị ảnh vuông hoặc chữ nhật (ví dụ: 600x600 px hoặc 800x600 px).
                        </small>

                        <div class="form-group mt-2 mb-0">
                            <label for="image_url" class="font-weight-bold" style="font-size: 12px;">Hoặc link ảnh trên server:</label>
                            <input type="text" class="form-control form-control-sm" id="image_url" name="image_url" 
                                   value="{{ old('image_url', $product->image) }}" placeholder="/upload/product/..." oninput="$('#prodPreview').attr('src', this.value)">
                        </div>
                    </div>
                </div>

                <!-- Gallery Images Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-weight-bold mb-0 text-dark"><i class="fas fa-images text-warning mr-2"></i> Bộ Sưu Tập Ảnh Phụ (Gallery)</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="gallery_files" name="gallery_files[]" multiple accept="image/*">
                            <label class="custom-file-label" for="gallery_files">Chọn thêm nhiều ảnh...</label>
                        </div>
                        <small class="text-muted d-block mb-3">Có thể chọn nhiều ảnh cùng lúc để tạo album ảnh chi tiết cho sản phẩm.</small>

                        @if(!empty($product->gallery) && is_array($product->gallery))
                            <label class="font-weight-bold" style="font-size: 12.5px;">Các ảnh gallery hiện tại:</label>
                            <div class="gallery-preview-grid">
                                @foreach($product->gallery as $idx => $gImg)
                                    <div class="gallery-item" title="Bỏ chọn để xóa ảnh này">
                                        <img src="{{ $gImg }}" alt="Gallery image">
                                        <input type="hidden" name="existing_gallery[]" value="{{ $gImg }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Button Card -->
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body p-3">
                        <button type="submit" class="btn btn-danger btn-block btn-lg font-weight-bold mb-2 shadow-sm">
                            <i class="fas fa-save mr-1"></i> {{ $product->exists ? 'Cập Nhật Sản Phẩm' : 'Lưu & Đăng Sản Phẩm' }}
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-block">Hủy Bỏ</a>
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
        .create(document.querySelector('#description'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });

    // 2. Main Image Live Preview
    function previewProd(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#prodPreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            var fileName = input.files[0].name;
            $(input).next('.custom-file-label').html(fileName);
        }
    }

    // 3. Multi Gallery Label
    $('#gallery_files').on('change', function() {
        var numFiles = $(this)[0].files.length;
        $(this).next('.custom-file-label').html('Đã chọn ' + numFiles + ' file ảnh');
    });

    // 4. Auto Slug Generation
    function autoSlug(text) {
        var slugInput = document.getElementById('slug');
        if (!{{ $product->exists ? 'true' : 'false' }} || slugInput.value === '') {
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

    // 5. Dynamic Technical Specs Rows
    function addSpecRow() {
        var table = document.getElementById('specsTable').getElementsByTagName('tbody')[0];
        var newRow = table.insertRow();
        newRow.innerHTML = `
            <td>
                <input type="text" name="spec_keys[]" class="form-control form-control-sm" placeholder="Tên thuộc tính...">
            </td>
            <td>
                <input type="text" name="spec_vals[]" class="form-control form-control-sm" placeholder="Giá trị...">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeSpecRow(this)">
                    <i class="fas fa-times-circle fa-lg"></i>
                </button>
            </td>
        `;
    }

    function removeSpecRow(button) {
        var row = button.closest('tr');
        row.parentNode.removeChild(row);
    }
</script>
@endpush
