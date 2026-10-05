# Nhi Binh Plastic - Corporate & Product Catalog System

Hệ thống website doanh nghiệp và quản trị nội dung (CMS) toàn diện phục vụ giới thiệu năng lực sản xuất, gia công ép nhựa kỹ thuật cao của **Công ty TNHH SX TM Nhựa Nhị Bình (Nhi Binh Plastic Co., Ltd)**. Dự án được xây dựng trên nền tảng **Laravel 11** với kiến trúc mô-đun hóa hiện đại, tối ưu SEO, tương thích đa thiết bị và tích hợp bảng điều khiển quản trị (Admin Dashboard) chuyên nghiệp.

---

## 🚀 Công nghệ sử dụng (Tech Stack)

* **Backend Framework**: [Laravel 11.x](https://laravel.com) (PHP >= 8.2, tối ưu trên PHP 8.3)
* **Database**: MySQL 8.x / MariaDB / SQLite với Eloquent ORM
* **Frontend Architecture**: Blade Templating Engine, Modular Components
* **CSS Framework & UI**: Bootstrap 4.6, Nina Custom SCSS/CSS, Custom Admin Panel UI
* **Icons & Typography**: Font Awesome 6 Free, Google Fonts (Roboto, Montserrat, Barlow Condensed)
* **Libraries & Plugins**:
  * [AOS (Animate On Scroll)](https://michalsnik.github.io/aos/) - Hiệu ứng cuộn trang mượt mà
  * [OwlCarousel 2](https://owlcarousel2.github.io/OwlCarousel2/) & [Slick](https://kenwheeler.github.io/slick/) - Slider banner, sản phẩm và đối tác xuất khẩu
  * [Fancybox 3](http://fancyapps.com/fancybox/3/) - Lightbox xem ảnh sản phẩm và video popup
  * [CKEditor](https://ckeditor.com/) - Trình soạn thảo nội dung phong phú cho quản trị viên

---

## 📂 Cấu trúc thư mục dự án

```text
Project_Sota/
├── app/
│   ├── Helpers/
│   │   └── SettingHelper.php          # Helper setting() truy xuất cấu hình toàn hệ thống
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php     # Xử lý trang chủ, banner & danh mục nổi bật
│   │   │   ├── PageController.php     # Điều hướng dynamic root-slug SEO (5-Tier Fallback)
│   │   │   ├── ProductController.php  # Quản lý danh mục & chi tiết sản phẩm ngoài frontend
│   │   │   ├── InquiryController.php  # Tiếp nhận yêu cầu báo giá / liên hệ của khách hàng
│   │   │   └── Admin/                 # Bộ điều khiển trung tâm quản trị (Admin CMS)
│   │   │       ├── AuthController.php       # Đăng nhập / đăng xuất quản trị
│   │   │       ├── DashboardController.php  # Tổng quan thống kê KPI hệ thống
│   │   │       ├── SettingController.php    # Quản lý thông tin cấu hình, hotline, MXH, stats
│   │   │       ├── BannerController.php     # Quản lý banner slideshow trang chủ
│   │   │       ├── CategoryController.php   # Quản lý danh mục sản phẩm đa cấp
│   │   │       ├── ProductController.php    # CRUD sản phẩm, thông số động, gallery
│   │   │       ├── PostController.php       # Quản lý tin tức, album hình ảnh, video
│   │   │       ├── PageController.php       # Quản lý nội dung các trang CMS tĩnh
│   │   │       ├── PartnerController.php    # Quản lý đối tác và thị trường xuất khẩu
│   │   │       ├── InquiryController.php    # Xử lý & phản hồi yêu cầu báo giá
│   │   │       └── ProfileController.php    # Cập nhật hồ sơ & đổi mật khẩu admin
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php    # Kiểm soát quyền truy cập khu vực quản trị
│   │   └── Requests/                  # Form request validation dữ liệu đầu vào
│   └── Models/
│       ├── User.php                   # Model tài khoản quản trị viên (role admin)
│       ├── Setting.php                # Model lưu trữ cấu hình key-value
│       ├── Banner.php                 # Model banner quảng cáo / slideshow
│       ├── Category.php               # Model danh mục đa cấp (parent/children)
│       ├── Product.php                # Model sản phẩm, thông số JSON & ảnh phụ
│       ├── Post.php                   # Model bài viết (news, album, video)
│       ├── Page.php                   # Model trang nội dung tĩnh CMS
│       ├── Partner.php                # Model đối tác & thị trường xuất khẩu
│       └── Inquiry.php                # Lưu trữ yêu cầu báo giá & ghi chú xử lý
├── database/
│   ├── migrations/                    # Cấu trúc bảng CSDL
│   └── seeders/                       # Dữ liệu mẫu chuẩn hóa cho doanh nghiệp
├── public/
│   ├── assets/                        # CSS, JS, Fonts, Images nội bộ
│   ├── thumbs/                        # Cache ảnh đại diện sản phẩm & thumbnail
│   └── upload/                        # File tài nguyên ảnh, banner, danh mục tải lên
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php          # Master layout chính frontend
│       ├── components/                # Header, Navbar động, Footer, Social floating
│       ├── pages/                     # Giao diện Trang chủ, Sản phẩm, Chi tiết, Liên hệ
│       └── admin/                     # Hệ thống giao diện quản trị Admin CMS
└── routes/
    ├── web.php                        # Định tuyến người dùng (Frontend)
    └── admin.php                      # Định tuyến khu vực quản trị (/admin)
```

---

## ⚙️ Hướng dẫn cài đặt & Khởi chạy (Local Setup)

### 1. Yêu cầu môi trường
* PHP >= 8.2 (Khuyến nghị PHP 8.3)
* Composer 2.x
* Cơ sở dữ liệu SQLite hoặc MySQL 8.x
* Laragon / XAMPP / Docker (tuỳ chọn)

### 2. Các bước khởi chạy
```bash
# 1. Cài đặt các thư viện phụ thuộc PHP
composer install

# 2. Khởi tạo file cấu hình môi trường
cp .env.example .env

# 3. Tạo Application Encryption Key
php artisan key:generate

# 4. Chạy migration và nạp dữ liệu mẫu
php artisan migrate --seed

# 5. Khởi động máy chủ phát triển
php artisan serve
```

Truy cập hệ thống:
* **Frontend Portal**: `http://127.0.0.1:8000`
* **Admin Dashboard**: `http://127.0.0.1:8000/admin`

### 3. Tài khoản quản trị mặc định
* **URL đăng nhập**: `/admin/login`
* **Email**: `admin@gmail.com`
* **Mật khẩu**: `password` *(có thể cập nhật trực tiếp trong trang Quản lý tài khoản)*

---

## 🌟 Tính năng chính của hệ thống

### 1. Phân hệ Khách hàng (Frontend)
* **Trang chủ trực quan**:
  * Banner trình chiếu tự động, responsive trên mọi kích thước màn hình.
  * Khối số liệu năng lực sản xuất (diện tích nhà máy, số máy ép, công suất, kinh nghiệm) cập nhật động từ hệ thống quản trị.
  * Tab danh mục sản phẩm nổi bật đồng bộ trực tiếp từ CSDL.
  * Phân khu truyền thông đa phương tiện: Giới thiệu, Tin tức doanh nghiệp, Thư viện video với Popup Fancybox, Logo thị trường xuất khẩu quốc tế.
* **Hệ thống danh mục & Sản phẩm chuyên sâu**:
  * Cấu trúc menu điều hướng 3 cấp liên kết tự động theo cây danh mục cha - con.
  * URL thân thiện chuẩn SEO phẳng (`/{slug}`) hỗ trợ cơ chế định tuyến thông minh.
  * Chi tiết sản phẩm hiển thị ảnh chính, bộ sưu tập ảnh góc nhìn (Gallery), bảng thông số kỹ thuật động (Vật liệu, Kích thước, Màu sắc, Trọng lượng...).
* **Kênh tương tác & Báo giá**:
  * Form yêu cầu báo giá tích hợp xác thực dữ liệu chặt chẽ.
  * Thanh liên hệ nổi đa kênh (Hotline, Zalo, WeChat, WhatsApp) hỗ trợ chuyển đổi nhanh.

### 2. Phân hệ Quản trị (Admin CMS)
* **Bảng điều khiển (Dashboard)**: Thống kê nhanh số lượng sản phẩm, danh mục, banner, tin tức và các yêu cầu báo giá mới kèm bảng theo dõi giao dịch gần nhất.
* **Cấu hình hệ thống (Settings)**: Quản lý toàn diện tên công ty, hotline kinh doanh, email liên hệ, địa chỉ nhà máy, mã nhúng bản đồ Google Maps, gian hàng Alibaba và các chỉ số năng lực.
* **Quản lý Banners & Slider**: Thêm mới, thay đổi hình ảnh, sắp xếp thứ tự hiển thị và kích hoạt/tắt banner trực quan.
* **Quản lý Danh mục**: Tổ chức cây danh mục đa cấp, tự động sinh slug SEO, điều chỉnh thứ tự ưu tiên.
* **Quản lý Sản phẩm**: Đầy đủ tính năng Thêm/Sửa/Xóa, tải lên ảnh đại diện & gallery nhiều ảnh, trình soạn thảo mô tả CKEditor, quản lý thông số kỹ thuật dạng cặp key-value linh hoạt, gán nhãn sản phẩm nổi bật.
* **Quản lý Bài viết & Đa phương tiện**: Quản trị tin tức sự kiện, album hình ảnh nhà xưởng và thư viện video YouTube.
* **Quản lý Trang tĩnh (CMS Pages)**: Soạn thảo và cập nhật nội dung cho các trang thông tin doanh nghiệp, chính sách bảo hành, tuyển dụng...
* **Quản lý Đối tác & Thị trường**: Cập nhật danh sách đối tác chiến lược và các quốc gia xuất khẩu.
* **Quản lý Yêu cầu Báo giá (Inquiries)**: Theo dõi tiến độ xử lý khách hàng tiềm năng qua các trạng thái (Chờ xử lý, Đang xử lý, Đã hoàn thành, Từ chối), lưu trữ ghi chú chăm sóc nội bộ.
* **Bảo mật & Tài khoản Quản trị**: Xác thực bảo mật, đổi mật khẩu và cập nhật thông tin cá nhân của người quản trị.

---

## 📄 Bản quyền & Đơn vị phát triển
* Đơn vị thực hiện: **Development Team**
* Khách hàng / Đơn vị thụ hưởng: **Công ty TNHH SX TM Nhựa Nhị Bình**
* Năm thực hiện: 2026