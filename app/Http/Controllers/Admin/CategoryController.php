<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Danh sách tất cả Danh mục sản phẩm (hiển thị dạng phân cấp)
     */
    public function index(): View
    {
        // Lấy các danh mục gốc kèm danh mục con và đếm số sản phẩm
        $rootCategories = Category::whereNull('parent_id')
            ->with(['children' => function ($q) {
                $q->withCount('products')->orderBy('sort_order');
            }])
            ->withCount('products')
            ->orderBy('sort_order')
            ->get();

        $allCategories = Category::with('parent')->withCount('products')->orderBy('sort_order')->get();

        return view('admin.categories.index', compact('rootCategories', 'allCategories'));
    }

    /**
     * Form tạo danh mục mới
     */
    public function create(): View
    {
        $category = new Category([
            'sort_order' => (Category::max('sort_order') ?? 0) + 1,
        ]);

        $parentCategories = Category::whereNull('parent_id')->orderBy('sort_order')->get();

        return view('admin.categories.form', compact('category', 'parentCategories'));
    }

    /**
     * Lưu danh mục mới vào CSDL
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'parent_id'   => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'image_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'image_url'   => ['nullable', 'string'],
            'sort_order'  => ['required', 'integer'],
        ]);

        $slug = !empty($validated['slug']) 
            ? Str::slug($validated['slug']) 
            : Str::slug($validated['name']);

        // Đảm bảo slug không bị trùng
        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'cat_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/categories'), $filename);
            $imagePath = '/upload/categories/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        Category::create([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'parent_id'   => $validated['parent_id'] ?: null,
            'description' => $validated['description'] ?? null,
            'image'       => $imagePath,
            'sort_order'  => (int) $validated['sort_order'],
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Đã thêm danh mục sản phẩm mới thành công!');
    }

    /**
     * Form chỉnh sửa danh mục
     */
    public function edit(Category $category): View
    {
        // Loại trừ chính danh mục hiện tại và các danh mục con để tránh vòng lặp cha-con
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('sort_order')
            ->get();

        return view('admin.categories.form', compact('category', 'parentCategories'));
    }

    /**
     * Cập nhật danh mục
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255', 'unique:categories,slug,' . $category->id],
            'parent_id'   => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'image_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'image_url'   => ['nullable', 'string'],
            'sort_order'  => ['required', 'integer'],
        ]);

        // Tránh chọn chính nó làm cha
        if (!empty($validated['parent_id']) && (int)$validated['parent_id'] === $category->id) {
            return back()->withInput()->withErrors(['parent_id' => 'Không thể chọn chính danh mục này làm danh mục cha.']);
        }

        $slug = !empty($validated['slug']) 
            ? Str::slug($validated['slug']) 
            : Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $imagePath = $category->image;
        if ($request->hasFile('image_file')) {
            // Xóa ảnh cũ nếu có
            if ($category->image && file_exists(public_path($category->image)) && !str_contains($category->image, 'noimage')) {
                @unlink(public_path($category->image));
            }
            $file = $request->file('image_file');
            $filename = 'cat_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/categories'), $filename);
            $imagePath = '/upload/categories/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        $category->update([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'parent_id'   => $validated['parent_id'] ?: null,
            'description' => $validated['description'] ?? null,
            'image'       => $imagePath,
            'sort_order'  => (int) $validated['sort_order'],
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Đã cập nhật danh mục sản phẩm thành công!');
    }

    /**
     * Xóa danh mục
     */
    public function destroy(Category $category): RedirectResponse
    {
        // Kiểm tra xem danh mục có danh mục con hoặc sản phẩm không
        $childrenCount = $category->children()->count();
        $productsCount = $category->products()->count();

        if ($childrenCount > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', "Không thể xóa vì danh mục này đang chứa {$childrenCount} danh mục con. Hãy xóa hoặc chuyển danh mục con trước.");
        }

        if ($productsCount > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', "Không thể xóa vì danh mục này đang chứa {$productsCount} sản phẩm. Hãy chuyển sản phẩm sang danh mục khác trước.");
        }

        // Xóa ảnh danh mục nếu có
        if ($category->image && file_exists(public_path($category->image)) && !str_contains($category->image, 'noimage')) {
            @unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Đã xóa danh mục thành công!');
    }
}
