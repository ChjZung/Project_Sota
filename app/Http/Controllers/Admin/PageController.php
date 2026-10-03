<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Danh sách các trang nội dung tĩnh CMS
     */
    public function index(): View
    {
        $pages = Page::latest()->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Form tạo trang mới
     */
    public function create(): View
    {
        $page = new Page();

        return view('admin.pages.form', compact('page'));
    }

    /**
     * Lưu trang mới vào CSDL
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['required', 'string', 'max:255', 'unique:pages,slug'],
            'content'      => ['nullable', 'string'],
            'banner_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'banner_url'   => ['nullable', 'string'],
            'meta_title'   => ['nullable', 'string', 'max:255'],
            'meta_desc'    => ['nullable', 'string'],
        ]);

        $slug = Str::slug($validated['slug']);

        $bannerPath = null;
        if ($request->hasFile('banner_file')) {
            $file = $request->file('banner_file');
            $filename = 'page_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/pages'), $filename);
            $bannerPath = '/upload/pages/' . $filename;
        } elseif (!empty($validated['banner_url'])) {
            $bannerPath = $validated['banner_url'];
        }

        Page::create([
            'title'        => $validated['title'],
            'slug'         => $slug,
            'content'      => $validated['content'] ?? null,
            'banner_image' => $bannerPath,
            'meta'         => [
                'title'       => $validated['meta_title'] ?? $validated['title'],
                'description' => $validated['meta_desc'] ?? null,
            ],
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Đã tạo trang CMS mới thành công!');
    }

    /**
     * Form chỉnh sửa trang
     */
    public function edit(Page $page): View
    {
        return view('admin.pages.form', compact('page'));
    }

    /**
     * Cập nhật trang
     */
    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['required', 'string', 'max:255', 'unique:pages,slug,' . $page->id],
            'content'      => ['nullable', 'string'],
            'banner_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'banner_url'   => ['nullable', 'string'],
            'meta_title'   => ['nullable', 'string', 'max:255'],
            'meta_desc'    => ['nullable', 'string'],
        ]);

        $slug = Str::slug($validated['slug']);

        $bannerPath = $page->banner_image;
        if ($request->hasFile('banner_file')) {
            if ($page->banner_image && file_exists(public_path($page->banner_image)) && !str_contains($page->banner_image, 'photo') && !str_contains($page->banner_image, 'noimage')) {
                @unlink(public_path($page->banner_image));
            }
            $file = $request->file('banner_file');
            $filename = 'page_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/pages'), $filename);
            $bannerPath = '/upload/pages/' . $filename;
        } elseif (!empty($validated['banner_url'])) {
            $bannerPath = $validated['banner_url'];
        }

        $page->update([
            'title'        => $validated['title'],
            'slug'         => $slug,
            'content'      => $validated['content'] ?? null,
            'banner_image' => $bannerPath,
            'meta'         => [
                'title'       => $validated['meta_title'] ?? $validated['title'],
                'description' => $validated['meta_desc'] ?? null,
            ],
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Đã cập nhật trang CMS thành công!');
    }

    /**
     * Xóa trang
     */
    public function destroy(Page $page): RedirectResponse
    {
        if ($page->banner_image && file_exists(public_path($page->banner_image)) && !str_contains($page->banner_image, 'photo') && !str_contains($page->banner_image, 'noimage')) {
            @unlink(public_path($page->banner_image));
        }

        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Đã xóa trang thành công!');
    }
}
