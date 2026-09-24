<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function factory(): View
    {
        return view('pages.factory');
    }

    public function service(): View
    {
        if (view()->exists('pages.static.service')) {
            return view('pages.static.service');
        }
        return view('pages.about');
    }

    public function album(): View
    {
        if (view()->exists('pages.static.album')) {
            return view('pages.static.album');
        }
        return view('pages.about');
    }

    public function news(): View
    {
        if (view()->exists('pages.static.company-news')) {
            return view('pages.static.company-news');
        }
        return view('pages.about');
    }

    public function handleSlug(string $slug): View
    {
        // 1. Direct aliases
        if (in_array($slug, ['about-us', 'about', 'gioi-thieu'])) {
            return view('pages.about');
        }
        if (in_array($slug, ['contact-us', 'contact', 'lien-he'])) {
            return view('pages.contact');
        }
        if (in_array($slug, ['product', 'products', 'san-pham'])) {
            return view('pages.products');
        }
        if (in_array($slug, ['factory', 'nha-may'])) {
            return view('pages.factory');
        }
        if (in_array($slug, ['service', 'services', 'dich-vu'])) {
            return $this->service();
        }
        if (in_array($slug, ['album', 'album-2'])) {
            return $this->album();
        }
        if (in_array($slug, ['company-news', 'news', 'tin-tuc', 'product-news', 'learning-center', 'life-tips'])) {
            return $this->news();
        }

        // 2. Check if static view exists
        if (view()->exists('pages.static.' . $slug)) {
            return view('pages.static.' . $slug);
        }

        // 3. Check if it's an existing Category
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $products = Product::where('category_id', $category->id)->paginate(12);
            $categories = Category::whereNull('parent_id')->with('children')->orderBy('sort_order')->get();
            return view('pages.products', compact('products', 'categories', 'category'));
        }

        // 4. Check if it's an existing Product in DB
        $product = Product::where('slug', $slug)->with('category')->first();
        if ($product) {
            $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get();
            return view('pages.product-detail', compact('product', 'relatedProducts'));
        }

        // 5. Dynamic fallback for any product or category slug
        $cleanName = ucwords(str_replace('-', ' ', $slug));
        
        if (str_contains($slug, 'products') || str_contains($slug, 'toys') || str_contains($slug, 'industry')) {
            $products = Product::latest()->paginate(12);
            $categories = Category::whereNull('parent_id')->with('children')->orderBy('sort_order')->get();
            return view('pages.products', compact('products', 'categories'));
        }

        $dynamicProduct = new Product([
            'name' => $cleanName,
            'slug' => $slug,
            'product_code' => 'NBP-' . strtoupper(substr(md5($slug), 0, 4)),
            'material' => 'ABS / PP / HDPE / POM (Nguyên sinh cao cấp)',
            'origin' => 'Việt Nam (Nhà máy Nhựa Nhị Bình - VSIP II-A)',
            'description' => '<p><strong>' . $cleanName . '</strong> được sản xuất và gia công chính xác theo yêu cầu kỹ thuật tại Công ty TNHH Nhựa Nhị Bình (Nhi Binh Plastic).</p><p>Sản phẩm đạt tiêu chuẩn quản lý chất lượng ISO 9001:2015, chứng nhận trách nhiệm xã hội BSCI và an toàn RoHS/REACH, đáp ứng các tiêu chuẩn khắt khe xuất khẩu sang Mỹ, Nhật Bản và Châu Âu.</p>',
            'specifications' => [
                'Công nghệ sản xuất' => 'Ép phun nhựa chính xác (Plastic Injection Molding)',
                'Chất liệu hạt nhựa' => 'ABS / PP / PC / POM nguyên sinh cao cấp',
                'Màu sắc' => 'Theo mẫu hoặc bảng màu quốc tế Pantone/RAL',
                'Năng lực đáp ứng' => 'Gia công số lượng lớn theo bản vẽ 2D/3D OEM & ODM',
                'Tiêu chuẩn chất lượng' => 'ISO 9001:2015, BSCI, RoHS'
            ],
            'is_featured' => true,
            'status' => 'active'
        ]);
        $relatedProducts = Product::take(4)->get();

        return view('pages.product-detail', [
            'product' => $dynamicProduct,
            'relatedProducts' => $relatedProducts
        ]);
    }
}