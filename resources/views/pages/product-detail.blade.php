@extends('layouts.app')

@section('title', $product->name . ' | Nhi Binh Plastic')
@section('description', Str::limit(strip_tags($product->summary ?? $product->description ?? 'Sản phẩm nhựa ép phun chất lượng cao Nhị Bình Plastic'), 150))

@section('content')
<div class="breadCrumbs">
    <div class="wrap-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}"><span>Home</span></a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('products.index') }}"><span>Product</span></a></li>
            @if($product->category)
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url($product->category->slug) }}"><span>{{ $product->category->name }}</span></a></li>
            @endif
            <li class="breadcrumb-item active"><a class="text-decoration-none" href="{{ url($product->slug) }}"><span>{{ $product->name }}</span></a></li>
        </ol>
    </div>
</div>

<div class="wrap-main w-clear">
    <div class="row box_content">
        <div class="col-md-9" data-aos="fade-right">
            <div class="clearfix">
                <div class="wrap_right_detail w-100">
                    <div class="grid-pro-detail w-clear">
                        {{-- Cột hình ảnh sản phẩm bên trái --}}
                        <div class="left-pro-detail w-clear">
                            <div class="main-pro-img text-center p-3" style="border: 1px solid #eee; border-radius: 6px; background: #fff;">
                                @php
                                    $imgSrc = '/thumbs/760x540x2/upload/product/logo-kh01-kh02-2-9503-9082.jpg';
                                    if (!empty($product->image)) {
                                        $imgSrc = str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image);
                                    }
                                @endphp
                                <img src="{{ $imgSrc }}"
                                     alt="{{ $product->name }}"
                                     id="mainProductImg"
                                     style="max-width: 100%; height: auto; max-height: 420px; object-fit: contain;"
                                     onerror="this.src='/thumbs/760x540x2/assets/images/noimage.png';" />
                            </div>
                        </div>

                        {{-- Cột thông tin sản phẩm bên phải --}}
                        <div class="right-pro-detail w-clear">
                            <h1 class="title-pro-detail" style="font-size: 24px; font-weight: 700; color: #212529; margin-bottom: 12px; line-height: 1.3;">
                                {{ $product->name }}
                            </h1>

                            <ul class="attr-pro-detail list-unstyled mb-3" style="line-height: 2;">
                                <li>
                                    <strong style="min-width: 120px; display: inline-block;">Mã sản phẩm:</strong>
                                    <span>{{ $product->product_code ?? 'NBP-' . strtoupper(substr(md5($product->slug), 0, 4)) }}</span>
                                </li>
                                <li>
                                    <strong style="min-width: 120px; display: inline-block;">Chất liệu:</strong>
                                    <span>{{ $product->material ?? 'ABS / PP / POM / PC nguyên sinh' }}</span>
                                </li>
                                <li>
                                    <strong style="min-width: 120px; display: inline-block;">Xuất xứ:</strong>
                                    <span>{{ $product->origin ?? 'Việt Nam (Nhi Binh Plastic - VSIP II-A)' }}</span>
                                </li>
                                <li>
                                    <strong style="min-width: 120px; display: inline-block;">Tiêu chuẩn:</strong>
                                    <span class="badge badge-success px-2 py-1">ISO 9001:2015 / BSCI / RoHS</span>
                                </li>
                            </ul>

                            <div class="desc-pro-detail mb-4" style="color: #4b5563; font-size: 14.5px; line-height: 1.6;">
                                {!! $product->description !!}
                            </div>

                            <div class="contact_pro d-flex align-items-center mt-3">
                                <a class="btn btn-danger btn-lg mr-3 px-4" href="tel:0917543353" style="background-color: var(--color-main, #cd171f); border-color: var(--color-main, #cd171f); font-weight: 600;">
                                    <i class="fas fa-phone-alt mr-2"></i> Hotline: 0917 543 353
                                </a>
                                <a class="btn btn-outline-danger btn-lg px-4" href="https://zalo.me/0917543353" target="_blank" style="font-weight: 600;">
                                    <b>Zalo</b> Tư vấn báo giá
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Tabs chi tiết sản phẩm --}}
                    <div class="tabs-pro-detail mt-5">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" id="desc-tab" data-toggle="tab" href="#desc" role="tab" style="color: var(--color-main, #cd171f);">
                                    MÔ TẢ CHI TIẾT SẢN PHẨM
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-dark" id="specs-tab" data-toggle="tab" href="#specs" role="tab">
                                    THÔNG SỐ KỸ THUẬT
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content p-4 border border-top-0 bg-white" id="myTabContent" style="line-height: 1.8;">
                            <div class="tab-pane fade show active" id="desc" role="tabpanel">
                                <p><strong>Nhị Bình Plastic</strong> là nhà máy chuyên gia công ép nhựa kỹ thuật cao, đáp ứng các tiêu chuẩn khắt khe cho thị trường nội địa và xuất khẩu (Mỹ, Nhật, Châu Âu).</p>
                                <p>Tất cả sản phẩm đều được kiểm định chất lượng nghiêm ngặt theo quy trình ISO 9001:2015, sử dụng 100% hạt nhựa nguyên sinh chất lượng cao, không lẫn tạp chất gây hại.</p>
                                <ul>
                                    <li>Hỗ trợ thiết kế và chế tạo khuôn mẫu chính xác OEM/ODM.</li>
                                    <li>Nhận ép số lượng lớn với hơn 50 máy ép hiện đại từ 50T - 800T trang bị cánh tay robot tự động.</li>
                                    <li>Thời gian giao hàng nhanh chóng, hỗ trợ in ấn logo và đóng gói hoàn thiện theo yêu cầu.</li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="specs" role="tabpanel">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%;">Công nghệ sản xuất</th>
                                            <td>Ép phun nhựa chính xác (Plastic Injection Molding)</td>
                                        </tr>
                                        <tr>
                                            <th>Vật liệu</th>
                                            <td>ABS, PP, PC, PA6, POM, HDPE (Nguyên sinh)</td>
                                        </tr>
                                        <tr>
                                            <th>Màu sắc</th>
                                            <td>Đa dạng theo yêu cầu (Pantone / RAL)</td>
                                        </tr>
                                        <tr>
                                            <th>Chứng chỉ</th>
                                            <td>ISO 9001:2015, BSCI Social Compliance, RoHS, REACH</td>
                                        </tr>
                                        <tr>
                                            <th>Thị trường xuất khẩu</th>
                                            <td>Mỹ, Nhật Bản, Liên minh Châu Âu (EU), Canada</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Sản phẩm liên quan --}}
                    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
                        <div class="title mt-5">SẢN PHẨM CÙNG LOẠI</div>
                        <div class="loadkhung_product mainkhung_product mt-3">
                            @foreach($relatedProducts as $rel)
                                <div class="sp_item">
                                    <a class="scale-img" href="{{ url($rel->slug) }}">
                                        @php
                                            $relImg = '/thumbs/300x300x1/assets/images/noimage.png';
                                            if (!empty($rel->image)) {
                                                $relImg = str_starts_with($rel->image, 'http') ? $rel->image : asset('storage/' . $rel->image);
                                            }
                                        @endphp
                                        <img src="{{ $relImg }}" alt="{{ $rel->name }}" onerror="this.src='/thumbs/300x300x1/assets/images/noimage.png';" />
                                    </a>
                                    <div class="sp_content">
                                        <a href="{{ url($rel->slug) }}" class="sp_name" title="{{ $rel->name }}">{{ $rel->name }}</a>
                                        <a href="{{ url($rel->slug) }}" class="chitiet_sp">Chi tiết</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Cột sidebar bên phải --}}
        <div class="col-md-3" data-aos="fade-left">
            <div class="box_right_content mb-4 p-3 bg-white" style="border: 1px solid #eee; border-radius: 6px;">
                <div class="title-left-detail font-weight-bold mb-3" style="font-size: 16px; border-bottom: 2px solid var(--color-main, #cd171f); padding-bottom: 8px;">
                    HỖ TRỢ TRỰC TUYẾN
                </div>
                <div class="contact_sidebar">
                    <p class="mb-2"><i class="fas fa-phone-alt text-danger mr-2"></i> <strong>Hotline:</strong> 0917 543 353</p>
                    <p class="mb-2"><i class="fas fa-envelope text-danger mr-2"></i> <strong>Email:</strong> sales@nibiplastic.com</p>
                    <p class="mb-2"><i class="fas fa-map-marker-alt text-danger mr-2"></i> <strong>NM1:</strong> Hóc Môn, TP.HCM</p>
                    <p class="mb-0"><i class="fas fa-industry text-danger mr-2"></i> <strong>NM2:</strong> VSIP II-A, Bình Dương</p>
                </div>
            </div>

            <div class="box_right_content p-3 bg-white" style="border: 1px solid #eee; border-radius: 6px;">
                <div class="title-left-detail font-weight-bold mb-3" style="font-size: 16px; border-bottom: 2px solid var(--color-main, #cd171f); padding-bottom: 8px;">
                    CAM KẾT CHẤT LƯỢNG
                </div>
                <ul class="list-unstyled" style="font-size: 13.5px; line-height: 1.8;">
                    <li><i class="fas fa-check-circle text-success mr-2"></i> 100% hạt nhựa nguyên sinh</li>
                    <li><i class="fas fa-check-circle text-success mr-2"></i> Đạt chuẩn ISO 9001:2015</li>
                    <li><i class="fas fa-check-circle text-success mr-2"></i> Kiểm định an toàn RoHS/REACH</li>
                    <li><i class="fas fa-check-circle text-success mr-2"></i> Giao hàng đúng tiến độ</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
