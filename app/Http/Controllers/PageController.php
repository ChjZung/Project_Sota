<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $cmsPage = Page::whereIn('slug', ['about-us', 'about'])->first();
        if ($cmsPage && !empty($cmsPage->content)) {
            return view('pages.cms-page', compact('cmsPage'));
        }
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function factory(): View
    {
        $cmsPage = Page::where('slug', 'factory')->first();
        if ($cmsPage && !empty($cmsPage->content)) {
            return view('pages.cms-page', compact('cmsPage'));
        }
        return view('pages.factory');
    }

    public function service(): View
    {
        $cmsPage = Page::where('slug', 'service')->first();
        if ($cmsPage && !empty($cmsPage->content)) {
            return view('pages.cms-page', compact('cmsPage'));
        }
        if (view()->exists('pages.static.service')) {
            return view('pages.static.service');
        }
        return view('pages.about');
    }

    public function album(): View
    {
        $albums = Post::ofType('album')->published()->paginate(12);
        return view('pages.album', compact('albums'));
    }

    public function news(): View
    {
        $news = Post::ofType('news')->published()->paginate(10);
        return view('pages.news', compact('news'));
    }

    public function handleSlug(string $slug): View
    {
        // 1. Check if it's a Post in DB (News, Album, Video)
        $post = Post::where('slug', $slug)->first();
        if ($post) {
            $relatedPosts = Post::where('type', $post->type)
                ->where('id', '!=', $post->id)
                ->published()
                ->take(4)
                ->get();
            return view('pages.post-detail', compact('post', 'relatedPosts'));
        }

        // 2. Check if it's a CMS Page in DB
        $cmsPage = Page::where('slug', $slug)->first();
        if ($cmsPage && !empty($cmsPage->content)) {
            return view('pages.cms-page', compact('cmsPage'));
        }

        // 3. Direct route aliases
        if (in_array($slug, ['about-us', 'about', 'gioi-thieu'])) {
            return $this->about();
        }
        if (in_array($slug, ['contact-us', 'contact', 'lien-he'])) {
            return $this->contact();
        }
        if (in_array($slug, ['product', 'products', 'san-pham'])) {
            return view('pages.products');
        }
        if (in_array($slug, ['factory', 'nha-may'])) {
            return $this->factory();
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

        // 4. Check if static view exists
        if (view()->exists('pages.static.' . $slug)) {
            return view('pages.static.' . $slug);
        }

        // 5. Check if it's an existing Category
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $products = $category->all_products()->paginate(12);
            $categories = Category::whereNull('parent_id')->with('children')->orderBy('sort_order')->get();
            return view('pages.products', compact('products', 'categories', 'category'));
        }

        // 6. Check if it's an existing Product in DB
        $product = Product::where('slug', $slug)->with('category')->first();
        if ($product) {
            $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get();
            return view('pages.product-detail', compact('product', 'relatedProducts'));
        }

        // 7. Fallback
        abort(404);
    }
}