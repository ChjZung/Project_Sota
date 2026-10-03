<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Protected Admin Routes
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Giai đoạn 2: Cấu hình website
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Giai đoạn 2: Quản lý Banners / Slider
        Route::patch('/banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');
        Route::resource('banners', BannerController::class)->except(['show']);

        Route::get('/categories', function () {
            return view('admin.dashboard')->with('info', 'Chức năng Quản lý Danh mục sẽ được mở ở Giai đoạn 3.');
        })->name('categories.index');

        Route::get('/products', function () {
            return view('admin.dashboard')->with('info', 'Chức năng Quản lý Sản phẩm sẽ được mở ở Giai đoạn 3.');
        })->name('products.index');

        Route::get('/products/create', function () {
            return view('admin.dashboard')->with('info', 'Chức năng Thêm Sản phẩm sẽ được mở ở Giai đoạn 3.');
        })->name('products.create');

        Route::get('/posts', function () {
            return view('admin.dashboard')->with('info', 'Chức năng Quản lý Bài viết sẽ được mở ở Giai đoạn 4.');
        })->name('posts.index');

        Route::get('/pages', function () {
            return view('admin.dashboard')->with('info', 'Chức năng Quản lý Trang sẽ được mở ở Giai đoạn 4.');
        })->name('pages.index');

        Route::get('/partners', function () {
            return view('admin.dashboard')->with('info', 'Chức năng Quản lý Đối tác & Thị trường sẽ được mở ở Giai đoạn 4.');
        })->name('partners.index');

        Route::get('/inquiries', function () {
            return view('admin.dashboard')->with('info', 'Chức năng Quản lý Yêu cầu Báo giá sẽ được mở ở Giai đoạn 5.');
        })->name('inquiries.index');
    });
});
