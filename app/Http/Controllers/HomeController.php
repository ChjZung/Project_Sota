<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Lấy 8 sản phẩm nổi bật kèm thông tin danh mục (Eager Loading tối ưu N+1)
        $featuredProducts = Product::featured()
            ->active()
            ->with('category')
            ->take(8)
            ->latest()
            ->get();

        // Lấy danh mục gốc (parent_id = null) kèm danh mục con
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_order')
            ->get();

        // Số liệu năng lực sản xuất
        $stats = [
            ['icon' => 'fa-industry',     'number' => '10,000', 'unit' => 'm²',         'label' => 'Factory Area'],
            ['icon' => 'fa-cogs',         'number' => '50',     'unit' => '+',           'label' => 'Injection Machines'],
            ['icon' => 'fa-users',        'number' => '180',    'unit' => '+',           'label' => 'Employees'],
            ['icon' => 'fa-box-open',     'number' => '200',    'unit' => '+ Tons/Month','label' => 'Production Capacity'],
        ];

        return view('pages.home', compact('featuredProducts', 'categories', 'stats'));
    }
}