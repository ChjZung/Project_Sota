<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BannerController extends Controller
{
    /**
     * Danh sách tất cả Banner / Slider
     */
    public function index(): View
    {
        $banners = Banner::orderBy('sort_order', 'asc')->get();

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Form thêm banner mới
     */
    public function create(): View
    {
        $banner = new Banner([
            'sort_order' => (Banner::max('sort_order') ?? 0) + 1,
            'is_active' => true,
        ]);

        return view('admin.banners.form', compact('banner'));
    }

    /**
     * Lưu banner mới vào CSDL
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['nullable', 'string', 'max:255'],
            'subtitle'    => ['nullable', 'string', 'max:255'],
            'image_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'image_url'   => ['nullable', 'string'],
            'link'        => ['nullable', 'string', 'max:255'],
            'sort_order'  => ['required', 'integer'],
            'is_active'   => ['boolean'],
        ]);

        $imagePath = null;

        // Xử lý upload ảnh
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'banner_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/banners'), $filename);
            $imagePath = '/upload/banners/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        } else {
            return back()->withInput()->withErrors(['image_file' => 'Vui lòng chọn ảnh banner hoặc nhập đường dẫn ảnh.']);
        }

        Banner::create([
            'title'      => $validated['title'] ?? null,
            'subtitle'   => $validated['subtitle'] ?? null,
            'image'      => $imagePath,
            'link'       => $validated['link'] ?? null,
            'sort_order' => (int) $validated['sort_order'],
            'is_active'  => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Đã thêm banner slider mới thành công!');
    }

    /**
     * Form chỉnh sửa banner
     */
    public function edit(Banner $banner): View
    {
        return view('admin.banners.form', compact('banner'));
    }

    /**
     * Cập nhật banner
     */
    public function update(Request $request, Banner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['nullable', 'string', 'max:255'],
            'subtitle'    => ['nullable', 'string', 'max:255'],
            'image_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'image_url'   => ['nullable', 'string'],
            'link'        => ['nullable', 'string', 'max:255'],
            'sort_order'  => ['required', 'integer'],
            'is_active'   => ['boolean'],
        ]);

        $imagePath = $banner->image;

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'banner_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/banners'), $filename);
            $imagePath = '/upload/banners/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        $banner->update([
            'title'      => $validated['title'] ?? null,
            'subtitle'   => $validated['subtitle'] ?? null,
            'image'      => $imagePath,
            'link'       => $validated['link'] ?? null,
            'sort_order' => (int) $validated['sort_order'],
            'is_active'  => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Đã cập nhật banner slider thành công!');
    }

    /**
     * Xóa banner
     */
    public function destroy(Banner $banner): RedirectResponse
    {
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Đã xóa banner khỏi danh sách!');
    }

    /**
     * Bật / Tắt nhanh trạng thái hiển thị
     */
    public function toggle(Banner $banner): RedirectResponse
    {
        $banner->update(['is_active' => !$banner->is_active]);

        $statusMsg = $banner->is_active ? 'Đã hiển thị banner trên trang chủ.' : 'Đã ẩn banner khỏi trang chủ.';

        return back()->with('success', $statusMsg);
    }
}
