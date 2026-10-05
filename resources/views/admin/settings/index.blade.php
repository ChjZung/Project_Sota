@extends('admin.layouts.master')

@section('title', 'Cấu Hình Website')

@push('styles')
<style>
    .settings-nav .nav-link {
        font-weight: 600;
        color: #64748b;
        padding: 12px 20px;
        border: none;
        border-bottom: 2px solid transparent;
        border-radius: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .settings-nav .nav-link:hover {
        color: #cd171f;
        background: rgba(205, 23, 31, 0.03);
    }
    .settings-nav .nav-link.active {
        color: #cd171f;
        background: transparent;
        border-bottom: 2px solid #cd171f;
    }
    .settings-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    .settings-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    .settings-body {
        padding: 24px;
    }
    .form-section-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 18px;
        padding-bottom: 8px;
        border-bottom: 1px dashed #e2e8f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }
    .form-group small {
        font-size: 12px;
        color: #64748b;
    }
    .img-preview-box {
        width: 140px;
        height: 70px;
        border: 2px dashed #cbd5e1;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        overflow: hidden;
        margin-bottom: 10px;
    }
    .img-preview-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .btn-save-sticky {
        position: sticky;
        bottom: 20px;
        z-index: 100;
        background: #ffffff;
        padding: 14px 24px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="settings-card">
            <div class="settings-header">
                <div>
                    <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">
                        <i class="fas fa-sliders-h text-danger mr-2"></i> Cấu Hình Toàn Diện Website
                    </h4>
                    <p class="text-muted mb-0" style="font-size: 13.5px;">
                        Chỉnh sửa thông tin công ty, hotline, địa chỉ 2 nhà máy, logo, mạng xã hội và SEO. Dữ liệu sẽ tự động cập nhật ra Header, Footer và toàn bộ trang web.
                    </p>
                </div>
                <button type="submit" class="btn btn-danger font-weight-bold px-4 py-2 shadow-sm">
                    <i class="fas fa-save mr-1"></i> Lưu Cấu Hình
                </button>
            </div>

            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs settings-nav px-3 bg-light" id="settingTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab">
                        <i class="fas fa-building"></i> Thông Tin Chung & Logo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab">
                        <i class="fas fa-phone-alt"></i> Liên Hệ & 2 Nhà Máy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab">
                        <i class="fas fa-share-alt"></i> Mạng Xã Hội & Kênh Bán
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="stats-tab" data-toggle="tab" href="#stats" role="tab">
                        <i class="fas fa-industry"></i> Năng Lực Sản Xuất
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab">
                        <i class="fas fa-search"></i> Cấu Hình SEO
                    </a>
                </li>
            </ul>

            {{-- Tab Contents --}}
            <div class="tab-content settings-body" id="settingTabContent">
                {{-- TAB 1: THÔNG TIN CHUNG --}}
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="form-section-title">
                        <i class="fas fa-info-circle text-primary"></i> Tên Công Ty & Pháp Nhân
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_name_vi">Tên công ty (Tiếng Việt) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="company_name_vi" name="company_name_vi" 
                                       value="{{ $settings['company_name_vi'] ?? 'CÔNG TY TNHH SX TM NHỰA NHỊ BÌNH' }}" required>
                                <small>Hiển thị ở tiêu đề chân trang (Footer) và văn bản chính thức.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_name_en">Tên công ty (Tiếng Anh)</label>
                                <input type="text" class="form-control" id="company_name_en" name="company_name_en" 
                                       value="{{ $settings['company_name_en'] ?? 'NHI BINH PLASTIC CO., LTD' }}">
                                <small>Tên giao dịch quốc tế.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tax_code">Mã số thuế (Tax Code)</label>
                                <input type="text" class="form-control" id="tax_code" name="tax_code" 
                                       value="{{ $settings['tax_code'] ?? '0308365215' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slogan">Khẩu hiệu / Slogan công ty</label>
                                <input type="text" class="form-control" id="slogan" name="slogan" 
                                       value="{{ $settings['slogan'] ?? 'Custom Plastic Injection Molding Manufacturer in Vietnam' }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-section-title mt-4">
                        <i class="fas fa-image text-success"></i> Hình Ảnh Thương Hiệu (Logo & Favicon)
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo Website (Header & Footer)</label>
                                <div class="img-preview-box" id="logoPreviewBox">
                                    <img src="{{ $settings['logo'] ?? '/upload/photo/nhi-binh-plastic-logo-3632.png' }}" 
                                         id="logoPreview" alt="Logo preview">
                                </div>
                                <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*" onchange="previewImage(this, 'logoPreview')">
                                <small class="text-muted">Định dạng PNG/JPG/WEBP trong suốt, kích thước khuyến nghị chiều cao ~80px.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Biểu tượng Favicon (Icon trên tab trình duyệt)</label>
                                <div class="img-preview-box" style="width: 50px; height: 50px;" id="faviconPreviewBox">
                                    <img src="{{ $settings['favicon'] ?? '/assets/images/favicon.ico' }}" 
                                         id="faviconPreview" alt="Favicon preview">
                                </div>
                                <input type="file" class="form-control-file" id="favicon" name="favicon" accept=".ico,.png,.svg" onchange="previewImage(this, 'faviconPreview')">
                                <small class="text-muted">Định dạng .ico hoặc .png (16x16 hoặc 32x32 px).</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 2: LIÊN HỆ & NHÀ MÁY --}}
                <div class="tab-pane fade" id="contact" role="tabpanel">
                    <div class="form-section-title">
                        <i class="fas fa-headset text-danger"></i> Đường Dây Nóng & Email Tiếp Nhận
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hotline">Hotline chính (Hiện nổi bật & Floating Widget) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="hotline" name="hotline" 
                                       value="{{ $settings['hotline'] ?? '+84 853 543 353 / 0917 543 353' }}" required>
                                <small>Số hotline tư vấn bán hàng & Zalo.</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Điện thoại bàn (Tel)</label>
                                <input type="text" class="form-control" id="phone" name="phone" 
                                       value="{{ $settings['phone'] ?? '028 3712 3748' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fax">Số Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax" 
                                       value="{{ $settings['fax'] ?? '028 3712 3749' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_sale_1">Email phòng kinh doanh 1</label>
                                <input type="email" class="form-control" id="email_sale_1" name="email_sale_1" 
                                       value="{{ $settings['email_sale_1'] ?? 'sales@nibiplastic.com' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_sale_2">Email phòng kinh doanh 2</label>
                                <input type="email" class="form-control" id="email_sale_2" name="email_sale_2" 
                                       value="{{ $settings['email_sale_2'] ?? 'nhibinhsale01@gmail.com' }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-section-title mt-4">
                        <i class="fas fa-map-marked-alt text-warning"></i> Địa Chỉ Trụ Sở & Các Nhà Máy
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address_hq">Trụ sở chính & Nhà máy 1 (TP. Hồ Chí Minh)</label>
                                <input type="text" class="form-control" id="address_hq" name="address_hq" 
                                       value="{{ $settings['address_hq'] ?? '33 Đường Nhị Bình 2, Xã Nhị Bình (Đông Thạnh), Huyện Hóc Môn, TP. Hồ Chí Minh, Việt Nam (700000)' }}">
                                <small>Hiển thị ở Topbar trên cùng và Cột 2 Footer.</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address_factory">Chi nhánh & Nhà máy 2 (KCN VSIP II-A Bình Dương)</label>
                                <input type="text" class="form-control" id="address_factory" name="address_factory" 
                                       value="{{ $settings['address_factory'] ?? 'Lô 5, KCN VSIP II-A, Đường số 25, P. Vĩnh Tân, TP. Tân Uyên, Tỉnh Bình Dương, Việt Nam' }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="google_maps">Mã nhúng bản đồ Google Maps (iframe hoặc URL)</label>
                                <textarea class="form-control" id="google_maps" name="google_maps" rows="3">{{ $settings['google_maps'] ?? '' }}</textarea>
                                <small class="text-muted">Nhúng link bản đồ để khách hàng xem vị trí trên trang Liên hệ.</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 3: MẠNG XÃ HỘI & KÊNH BÁN --}}
                <div class="tab-pane fade" id="social" role="tabpanel">
                    <div class="form-section-title">
                        <i class="fas fa-share-nodes text-info"></i> Các Kênh Mạng Xã Hội & Sàn Thương Mại
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook"><i class="fab fa-facebook text-primary mr-1"></i> Fanpage Facebook</label>
                                <input type="url" class="form-control" id="facebook" name="facebook" 
                                       value="{{ $settings['facebook'] ?? 'https://www.facebook.com/nibiplastic' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube"><i class="fab fa-youtube text-danger mr-1"></i> Kênh YouTube</label>
                                <input type="url" class="form-control" id="youtube" name="youtube" 
                                       value="{{ $settings['youtube'] ?? 'https://www.youtube.com/@nhibinhplastic2668' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="linkedin"><i class="fab fa-linkedin text-info mr-1"></i> LinkedIn Company Page</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin" 
                                       value="{{ $settings['linkedin'] ?? 'https://www.linkedin.com/company/nhi-binh-plastic/' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zalo"><i class="fas fa-comment-dots text-primary mr-1"></i> Số điện thoại Zalo kết nối</label>
                                <input type="text" class="form-control" id="zalo" name="zalo" 
                                       value="{{ $settings['zalo'] ?? '0917543353' }}">
                                <small>Hệ thống tự động tạo link chat <code>https://zalo.me/[số]</code> ở nút floating widget.</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alibaba"><i class="fas fa-store text-warning mr-1"></i> Gian hàng Alibaba Verified Supplier</label>
                                <input type="url" class="form-control" id="alibaba" name="alibaba" 
                                       value="{{ $settings['alibaba'] ?? 'https://nibiplastic.trustpass.alibaba.com' }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 4: NĂNG LỰC SẢN XUẤT --}}
                <div class="tab-pane fade" id="stats" role="tabpanel">
                    <div class="form-section-title">
                        <i class="fas fa-chart-pie text-success"></i> 4 Con Số Thống Kê Năng Lực Ở Trang Chủ
                    </div>
                    <p class="text-muted" style="font-size: 13.5px;">
                        Các số liệu năng lực sản xuất được đồng bộ hiển thị tại khối thống kê trang chủ và trang năng lực doanh nghiệp.
                    </p>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stats_factory_area">Diện tích nhà máy (m²)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="stats_factory_area" name="stats_factory_area" 
                                           value="{{ $settings['stats_factory_area'] ?? '10,000' }}">
                                    <div class="input-group-append"><span class="input-group-text">m²</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stats_machines">Số máy ép phun (Machines)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="stats_machines" name="stats_machines" 
                                           value="{{ $settings['stats_machines'] ?? '50' }}">
                                    <div class="input-group-append"><span class="input-group-text">+ máy</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stats_employees">Đội ngũ CBCNV (Employees)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="stats_employees" name="stats_employees" 
                                           value="{{ $settings['stats_employees'] ?? '180' }}">
                                    <div class="input-group-append"><span class="input-group-text">+ người</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stats_capacity">Năng lực sản xuất (Capacity)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="stats_capacity" name="stats_capacity" 
                                           value="{{ $settings['stats_capacity'] ?? '200' }}">
                                    <div class="input-group-append"><span class="input-group-text">+ Tấn/Tháng</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 5: CẤU HÌNH SEO --}}
                <div class="tab-pane fade" id="seo" role="tabpanel">
                    <div class="form-section-title">
                        <i class="fas fa-search-plus text-primary"></i> Tối Ưu Hóa Tìm Kiếm (SEO Mặc Định)
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meta_title">Tiêu đề trang web mặc định (Meta Title)</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                       value="{{ $settings['meta_title'] ?? 'CÔNG TY TNHH SX TM NHỰA NHỊ BÌNH | Custom Plastic Injection Molding Manufacturer in Vietnam' }}">
                                <small>Hiển thị trên tab trình duyệt và tiêu đề kết quả tìm kiếm Google (khoảng 60-70 ký tự).</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meta_description">Mô tả tóm tắt trang web (Meta Description)</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ $settings['meta_description'] ?? 'Sản xuất các sản phẩm nhựa kỹ thuật cao theo yêu cầu của khách hàng, với nhà xưởng và máy móc hiện đại. Products are exported to the US, Japan, EU.' }}</textarea>
                                <small>Đoạn trích giới thiệu khi chia sẻ link lên Facebook/Zalo/Google (khoảng 150-160 ký tự).</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meta_keywords">Từ khóa tìm kiếm (Meta Keywords)</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                                       value="{{ $settings['meta_keywords'] ?? 'sản xuất đồ nhựa, ép nhựa, gia công khuôn nhựa, Nhựa Nhị Bình, plastic injection molding' }}">
                                <small>Các từ khóa phân cách bởi dấu phẩy.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sticky Action Bar --}}
        <div class="btn-save-sticky">
            <div class="text-muted" style="font-size: 13.5px;">
                <i class="fas fa-info-circle text-primary mr-1"></i> Nhấn <strong>Lưu Cấu Hình</strong> để áp dụng các thay đổi ra trang web ngoài.
            </div>
            <button type="submit" class="btn btn-danger font-weight-bold px-4 py-2 shadow-sm">
                <i class="fas fa-save mr-1"></i> Lưu Cấu Hình Ngay
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + previewId).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
