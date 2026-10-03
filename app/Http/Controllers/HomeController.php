<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // 1. Lấy danh sách banner slider đang hoạt động từ CSDL
        $banners = Banner::active()->get();

        // 2. Lấy 8 sản phẩm nổi bật kèm thông tin danh mục (Eager Loading tối ưu N+1)
        $featuredProducts = Product::featured()
            ->active()
            ->with('category')
            ->take(8)
            ->latest()
            ->get();

        // 3. Lấy danh mục gốc (parent_id = null) kèm danh mục con
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_order')
            ->get();

        // 4. Số liệu năng lực sản xuất (Lấy động từ Cấu hình Website trong Admin)
        $stats = [
            ['icon' => 'fa-industry', 'number' => setting('stats_factory_area', '10,000'), 'unit' => 'm²', 'label' => 'Factory Area'],
            ['icon' => 'fa-cogs',     'number' => setting('stats_machines', '50'),         'unit' => '+',  'label' => 'Injection Machines'],
            ['icon' => 'fa-users',    'number' => setting('stats_employees', '180'),        'unit' => '+',  'label' => 'Employees'],
            ['icon' => 'fa-box-open', 'number' => setting('stats_capacity', '200'),        'unit' => '+ Tons/Month', 'label' => 'Production Capacity'],
        ];

        // 5. Album ảnh nhà xưởng & hoạt động
        $albums = Post::ofType('album')->published()->take(8)->get();

        // 6. Tin tức sự kiện nổi bật
        $news = Post::ofType('news')->published()->take(8)->get();

        // 7. Video phóng sự YouTube
        $videos = Post::ofType('video')->published()->take(8)->get();

        // 8. Thị trường xuất khẩu (Active Market)
        $markets = Partner::where('type', 'market')->active()->get();

        return view('pages.home', compact(
            'banners', 
            'featuredProducts', 
            'categories', 
            'stats', 
            'albums', 
            'news', 
            'videos', 
            'markets'
        ));
    }
}