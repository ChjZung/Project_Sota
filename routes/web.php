<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Giới thiệu & Liên hệ & Nhà máy
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact.us');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/factory', [PageController::class, 'factory'])->name('factory');

// Sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/category/{slug}', [ProductController::class, 'index'])->name('products.category');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Dịch vụ, Album, Tin tức
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('/album', [PageController::class, 'album'])->name('album');
Route::get('/company-news', [PageController::class, 'news'])->name('news');

// Form báo giá
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

// Tìm kiếm & Ngôn ngữ
Route::get('/tim-kiem', [ProductController::class, 'index'])->name('search');
Route::get('/search', [ProductController::class, 'index'])->name('search.en');
Route::get('/ngon-ngu', function (Illuminate\Http\Request $request) {
    return redirect()->back();
})->name('lang');

// Catch-all dynamic slug for all pages, categories, and products matching live site URLs
Route::get('/{slug}', [PageController::class, 'handleSlug'])->name('slug');