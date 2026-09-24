# Nhi Binh Plastic - Corporate & Product Catalog System

Hệ thống website doanh nghiệp và giới thiệu năng lực sản xuất, gia công ép nhựa kỹ thuật cao của **Công ty TNHH SX TM Nhựa Nhị Bình (Nhi Binh Plastic Co., Ltd)**. Dự án được xây dựng trên nền tảng **Laravel 11** với kiến trúc mô-đun hóa hiện đại, tối ưu SEO và tương thích đa thiết bị.

---

## 🚀 Công nghệ sử dụng (Tech Stack)

* **Backend Framework**: [Laravel 11.x](https://laravel.com) (PHP >= 8.2, tối ưu trên PHP 8.3)
* **Database**: MySQL 8.x / MariaDB với Eloquent ORM
* **Frontend Architecture**: Blade Templating Engine, Modular Components
* **CSS Framework & UI**: Bootstrap 4.6, Nina Custom SCSS/CSS
* **Icons & Typography**: Font Awesome 6 Free, Google Fonts (Roboto, Montserrat, Barlow Condensed)
* **Libraries & Plugins**:
  * [AOS (Animate On Scroll)](https://michalsnik.github.io/aos/) - Hiệu ứng cuộn trang mượt mà
  * [OwlCarousel 2](https://owlcarousel2.github.io/OwlCarousel2/) & [Slick](https://kenwheeler.github.io/slick/) - Slider banner và đối tác xuất khẩu
  * [Fancybox 3](http://fancyapps.com/fancybox/3/) - Lightbox xem ảnh sản phẩm chi tiết

---

## 📂 Cấu trúc thư mục nổi bật

```text
nibiplastic-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php         # Xử lý trang chủ, banner & danh mục nổi bật
│   │   │   ├── PageController.php         # Điều hướng dynamic root-slug SEO (5-Tier Fallback)
│   │   │   ├── ProductController.php      # Quản lý danh mục & chi tiết sản phẩm
│   │   │   └── InquiryController.php      # Xử lý form gửi yêu cầu báo giá / liên hệ
│   │   └── Requests/
│   └── Models/
│       ├── Category.php                   # Model danh mục đa cấp (parent/children)
│       ├── Product.php                    # Model sản phẩm, thông số kỹ thuật JSON
│       └── Inquiry.php                    # Lưu trữ yêu cầu báo giá của khách hàng
├── database/
│   ├── migrations/                        # Cấu trúc bảng CSDL
│   └── seeders/                           # Dữ liệu mẫu danh mục và sản phẩm tiêu biểu
├── public/
│   ├── assets/                            # CSS, JS, Fonts, Images nội bộ
│   ├── thumbs/                            # Thư mục cache ảnh đại diện sản phẩm
│   └── upload/                            # File tài nguyên ảnh, banner, danh mục tải lên
└── resources/
    └── views/
        ├── layouts/
        │   └── app.blade.php              # Master layout chính, tối ưu SEO, base url
        ├── components/                    # Các thành phần giao diện tái sử dụng
        │   ├── header.blade.php           # Thanh thông tin đỉnh, logo, hotline, tìm kiếm
        │   ├── navbar.blade.php           # Menu điều hướng đa cấp, dropdown danh mục
        │   ├── footer.blade.php           # Chân trang đầy đủ thông tin pháp lý 2 nhà máy & MST
        │   └── social_widgets.blade.php   # Thanh liên hệ nổi (Zalo, Hotline, WeChat, WhatsApp)
        └── pages/
            ├── home.blade.php             # Giao diện trang chủ đầy đủ các phân khu chức năng
            ├── products.blade.php         # Lưới hiển thị danh mục sản phẩm kèm sidebar lọc
            ├── product-detail.blade.php   # Chi tiết sản phẩm, thông số ABS/PP, form báo giá
            └── static/                    # 19 trang danh mục sản phẩm chuyên sâu
```

---

## ⚙️ Hướng dẫn cài đặt & Chạy dự án (Local Setup)

### 1. Yêu cầu môi trường
* PHP >= 8.2 (Khuyến nghị PHP 8.3)
* Composer 2.x
* MySQL hoặc MariaDB (đã có sẵn trong Laragon / XAMPP)

### 2. Các bước khởi chạy
```bash
# 1. Cài đặt các thư viện phụ thuộc PHP
composer install

# 2. Khởi tạo file cấu hình môi trường (nếu chưa có)
cp .env.example .env

# 3. Tạo Application Encryption Key
php artisan key:generate

# 4. Chạy migration và nạp dữ liệu mẫu
php artisan migrate --seed

# 5. Khởi động máy chủ phát triển
php artisan serve
```
Truy cập hệ thống tại: `http://127.0.0.1:8000` hoặc virtual host của Laragon `http://nibiplastic-app.test`.

---

## 🌟 Tính năng chính đã hoàn thiện

1. **Kiến trúc Routing SEO Friendly**:
   * Hệ thống URL phẳng không tiền tố (`/{slug}`) đồng bộ với cấu trúc website gốc.
   * Cơ chế **5-Tier Fallback Router** trong `PageController` ngăn ngừa hoàn toàn lỗi 404 cho tất cả các danh mục và mã sản phẩm.
2. **Giao diện chuẩn Responsive**:
   * Tương thích hoàn toàn trên Desktop, Tablet và Mobile.
   * Khắc phục triệt để lỗi icon FontAwesome Pro Light sang Free Solid.
   * Tinh chỉnh độ tương phản chân trang (Footer), hiển thị đầy đủ MST và thông tin 2 nhà máy sản xuất (Hóc Môn & VSIP II-A Bình Dương).
3. **Hiệu ứng tương tác**:
   * Banner slideshow trượt tự động mượt mà.
   * Thanh tiện ích đa kênh liên hệ nhanh bên cạnh trái màn hình.
   * Hiệu ứng Fade-in tuần tự theo chiều cuộn trang với AOS.

---

## 📄 Bản quyền & Đơn vị phát triển
* Dự án phát triển bởi: **Development Team**
* Khách hàng / Đơn vị thụ hưởng: **Công ty TNHH SX TM Nhựa Nhị Bình**
* Năm thực hiện: 2026