<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Danh sách sản phẩm (hỗ trợ tìm kiếm, lọc theo danh mục, trạng thái)
     */
    public function index(Request $request): View
    {
        $query = Product::with('category')->latest();

        // 1. Lọc theo từ khóa tìm kiếm
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('product_code', 'like', "%{$search}%")
                  ->orWhere('material', 'like', "%{$search}%");
            });
        }

        // 2. Lọc theo danh mục
        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        // 3. Lọc theo trạng thái nổi bật
        if ($request->filled('featured')) {
            $query->where('is_featured', $request->boolean('featured'));
        }

        // 4. Lọc theo trạng thái hoạt động
        if ($request->filled('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        $products = $query->paginate(15)->withQueryString();

        // Danh sách danh mục để đổ vào bộ lọc
        $categories = Category::with('parent')->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Form thêm sản phẩm mới
     */
    public function create(): View
    {
        $product = new Product([
            'is_active'   => true,
            'is_featured' => false,
            'origin'      => 'Việt Nam (Nhựa Nhị Bình)',
            'material'    => 'Nhựa ABS / PP / POM nguyên sinh',
        ]);

        $categories = Category::with('children')->whereNull('parent_id')->orderBy('sort_order')->get();
        $flatCategories = Category::orderBy('name')->get();

        return view('admin.products.form', compact('product', 'categories', 'flatCategories'));
    }

    /**
     * Lưu sản phẩm mới vào CSDL
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'slug'          => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'category_id'   => ['required', 'exists:categories,id'],
            'product_code'  => ['nullable', 'string', 'max:50'],
            'material'      => ['nullable', 'string', 'max:255'],
            'origin'        => ['nullable', 'string', 'max:255'],
            'summary'       => ['nullable', 'string'],
            'description'   => ['nullable', 'string'],
            'image_file'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'image_url'     => ['nullable', 'string'],
            'gallery_files' => ['nullable', 'array'],
            'gallery_files.*' => ['image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'is_featured'   => ['boolean'],
            'is_active'     => ['boolean'],
        ]);

        // Tạo Slug URL duy nhất
        $slug = !empty($validated['slug']) 
            ? Str::slug($validated['slug']) 
            : Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Tự sinh mã sản phẩm nếu chưa có
        $productCode = !empty($validated['product_code']) 
            ? strtoupper(trim($validated['product_code']))
            : 'NBP-' . strtoupper(substr(md5($slug . time()), 0, 5));

        // Xử lý ảnh chính (Main Image)
        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'prod_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/products'), $filename);
            $imagePath = '/upload/products/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        // Xử lý bộ ảnh chi tiết (Gallery Images)
        $gallery = [];
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $gFile) {
                $gFilename = 'gal_' . time() . '_' . uniqid() . '.' . $gFile->getClientOriginalExtension();
                $gFile->move(public_path('upload/products/gallery'), $gFilename);
                $gallery[] = '/upload/products/gallery/' . $gFilename;
            }
        }

        // Xử lý bảng thông số kỹ thuật động (Dynamic Specifications key-value)
        $specifications = [];
        $specKeys = $request->input('spec_keys', []);
        $specVals = $request->input('spec_vals', []);
        if (is_array($specKeys) && is_array($specVals)) {
            foreach ($specKeys as $index => $key) {
                $trimmedKey = trim((string)$key);
                $val = trim((string)($specVals[$index] ?? ''));
                if ($trimmedKey !== '') {
                    $specifications[$trimmedKey] = $val;
                }
            }
        }

        Product::create([
            'category_id'    => (int) $validated['category_id'],
            'name'           => $validated['name'],
            'slug'           => $slug,
            'product_code'   => $productCode,
            'material'       => $validated['material'] ?? null,
            'origin'         => $validated['origin'] ?? null,
            'summary'        => $validated['summary'] ?? null,
            'description'    => $validated['description'] ?? null,
            'specifications' => !empty($specifications) ? $specifications : null,
            'image'          => $imagePath,
            'gallery'        => !empty($gallery) ? $gallery : null,
            'is_featured'    => $request->boolean('is_featured'),
            'is_active'      => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Đã thêm sản phẩm mới thành công!');
    }

    /**
     * Form chỉnh sửa sản phẩm
     */
    public function edit(Product $product): View
    {
        $categories = Category::with('children')->whereNull('parent_id')->orderBy('sort_order')->get();
        $flatCategories = Category::orderBy('name')->get();

        return view('admin.products.form', compact('product', 'categories', 'flatCategories'));
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'slug'          => ['nullable', 'string', 'max:255', 'unique:products,slug,' . $product->id],
            'category_id'   => ['required', 'exists:categories,id'],
            'product_code'  => ['nullable', 'string', 'max:50'],
            'material'      => ['nullable', 'string', 'max:255'],
            'origin'        => ['nullable', 'string', 'max:255'],
            'summary'       => ['nullable', 'string'],
            'description'   => ['nullable', 'string'],
            'image_file'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'image_url'     => ['nullable', 'string'],
            'gallery_files' => ['nullable', 'array'],
            'gallery_files.*' => ['image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'is_featured'   => ['boolean'],
            'is_active'     => ['boolean'],
        ]);

        $slug = !empty($validated['slug']) 
            ? Str::slug($validated['slug']) 
            : Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Ảnh chính
        $imagePath = $product->image;
        if ($request->hasFile('image_file')) {
            if ($product->image && file_exists(public_path($product->image)) && !str_contains($product->image, 'thumbs') && !str_contains($product->image, 'noimage')) {
                @unlink(public_path($product->image));
            }
            $file = $request->file('image_file');
            $filename = 'prod_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/products'), $filename);
            $imagePath = '/upload/products/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        // Gallery ảnh: giữ lại các ảnh hiện có nếu chưa bị xóa
        $existingGallery = $request->input('existing_gallery', []);
        $gallery = is_array($existingGallery) ? $existingGallery : [];

        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $gFile) {
                $gFilename = 'gal_' . time() . '_' . uniqid() . '.' . $gFile->getClientOriginalExtension();
                $gFile->move(public_path('upload/products/gallery'), $gFilename);
                $gallery[] = '/upload/products/gallery/' . $gFilename;
            }
        }

        // Thông số kỹ thuật
        $specifications = [];
        $specKeys = $request->input('spec_keys', []);
        $specVals = $request->input('spec_vals', []);
        if (is_array($specKeys) && is_array($specVals)) {
            foreach ($specKeys as $index => $key) {
                $trimmedKey = trim((string)$key);
                $val = trim((string)($specVals[$index] ?? ''));
                if ($trimmedKey !== '') {
                    $specifications[$trimmedKey] = $val;
                }
            }
        }

        $product->update([
            'category_id'    => (int) $validated['category_id'],
            'name'           => $validated['name'],
            'slug'           => $slug,
            'product_code'   => $validated['product_code'] ? strtoupper(trim($validated['product_code'])) : $product->product_code,
            'material'       => $validated['material'] ?? null,
            'origin'         => $validated['origin'] ?? null,
            'summary'        => $validated['summary'] ?? null,
            'description'    => $validated['description'] ?? null,
            'specifications' => !empty($specifications) ? $specifications : null,
            'image'          => $imagePath,
            'gallery'        => !empty($gallery) ? $gallery : null,
            'is_featured'    => $request->boolean('is_featured'),
            'is_active'      => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Đã cập nhật thông tin sản phẩm thành công!');
    }

    /**
     * Xóa sản phẩm
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Xóa file ảnh chính nếu lưu trong thư mục upload riêng
        if ($product->image && file_exists(public_path($product->image)) && !str_contains($product->image, 'thumbs') && !str_contains($product->image, 'noimage')) {
            @unlink(public_path($product->image));
        }

        // Xóa các file gallery
        if (is_array($product->gallery)) {
            foreach ($product->gallery as $gImg) {
                if (file_exists(public_path($gImg))) {
                    @unlink(public_path($gImg));
                }
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Đã xóa sản phẩm thành công!');
    }

    /**
     * Bật/tắt trạng thái nổi bật nhanh
     */
    public function toggleFeatured(Product $product): RedirectResponse
    {
        $product->update(['is_featured' => !$product->is_featured]);

        $status = $product->is_featured ? 'Đã bật' : 'Đã tắt';
        return back()->with('success', "{$status} trạng thái nổi bật cho sản phẩm: {$product->name}");
    }

    /**
     * Bật/tắt trạng thái hiển thị nhanh
     */
    public function toggleActive(Product $product): RedirectResponse
    {
        $product->update(['is_active' => !$product->is_active]);

        $status = $product->is_active ? 'Đã kích hoạt' : 'Đã ẩn';
        return back()->with('success', "{$status} hiển thị sản phẩm: {$product->name}");
    }
}
