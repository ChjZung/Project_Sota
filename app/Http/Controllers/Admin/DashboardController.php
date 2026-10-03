<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Post;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Hiển thị bảng điều khiển tổng quan
     */
    public function index(): View
    {
        $stats = [
            'total_products'    => Product::count(),
            'total_categories'  => Category::count(),
            'total_banners'     => Banner::count(),
            'total_posts'       => class_exists(Post::class) ? Post::count() : 0,
            'total_inquiries'   => Inquiry::count(),
            'pending_inquiries' => Inquiry::where('status', 'pending')->count(),
        ];

        $latestInquiries = Inquiry::latest()->take(5)->get();
        $latestProducts = Product::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestInquiries', 'latestProducts'));
    }
}
