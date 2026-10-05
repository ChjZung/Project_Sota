<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Protected Admin Routes
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Module: Cấu hình hệ thống
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Module: Quản lý Banners & Slider
        Route::patch('/banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');
        Route::resource('banners', BannerController::class)->except(['show']);

        // Module: Quản lý Danh mục sản phẩm
        Route::resource('categories', CategoryController::class)->except(['show']);

        // Module: Quản lý Sản phẩm
        Route::patch('/products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.toggleFeatured');
        Route::patch('/products/{product}/toggle-active', [ProductController::class, 'toggleActive'])->name('products.toggleActive');
        Route::resource('products', ProductController::class)->except(['show']);

        // Module: Quản lý Bài viết & Truyền thông
        Route::patch('/posts/{post}/toggle-publish', [PostController::class, 'togglePublish'])->name('posts.togglePublish');
        Route::resource('posts', PostController::class)->except(['show']);

        // Module: Quản lý Trang nội dung CMS
        Route::resource('pages', PageController::class)->except(['show']);

        // Module: Quản lý Đối tác & Thị trường xuất khẩu
        Route::patch('/partners/{partner}/toggle-active', [PartnerController::class, 'toggleActive'])->name('partners.toggleActive');
        Route::resource('partners', PartnerController::class)->except(['show']);

        // Module: Quản lý Yêu cầu Báo giá & Liên hệ
        Route::patch('/inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.updateStatus');
        Route::resource('inquiries', InquiryController::class)->only(['index', 'show', 'update', 'destroy']);

        // Module: Quản trị viên & Đổi mật khẩu
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});
