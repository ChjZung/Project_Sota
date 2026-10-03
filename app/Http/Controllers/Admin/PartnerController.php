<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnerController extends Controller
{
    /**
     * Danh sách logo Thị trường xuất khẩu / Đối tác / Chứng nhận
     */
    public function index(Request $request): View
    {
        $query = Partner::orderBy('sort_order', 'asc');

        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        $partners = $query->paginate(20)->withQueryString();

        $stats = [
            'total'       => Partner::count(),
            'market'      => Partner::where('type', 'market')->count(),
            'partner'     => Partner::where('type', 'partner')->count(),
            'certificate' => Partner::where('type', 'certificate')->count(),
        ];

        return view('admin.partners.index', compact('partners', 'stats'));
    }

    /**
     * Form thêm đối tác / thị trường mới
     */
    public function create(Request $request): View
    {
        $partner = new Partner([
            'type'       => $request->input('type', 'market'),
            'sort_order' => (Partner::max('sort_order') ?? 0) + 1,
            'is_active'  => true,
        ]);

        return view('admin.partners.form', compact('partner'));
    }

    /**
     * Lưu đối tác mới
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'type'       => ['required', 'string', 'in:market,partner,certificate'],
            'link'       => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'image_url'  => ['nullable', 'string'],
            'is_active'  => ['boolean'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'partner_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/partners'), $filename);
            $imagePath = '/upload/partners/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        } else {
            return back()->withInput()->withErrors(['image_file' => 'Vui lòng chọn hình ảnh logo.']);
        }

        Partner::create([
            'name'       => $validated['name'],
            'type'       => $validated['type'],
            'link'       => $validated['link'] ?? null,
            'sort_order' => (int) $validated['sort_order'],
            'image'      => $imagePath,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.partners.index', ['type' => $validated['type']])
            ->with('success', 'Đã thêm logo đối tác / thị trường mới thành công!');
    }

    /**
     * Form chỉnh sửa đối tác
     */
    public function edit(Partner $partner): View
    {
        return view('admin.partners.form', compact('partner'));
    }

    /**
     * Cập nhật đối tác
     */
    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'type'       => ['required', 'string', 'in:market,partner,certificate'],
            'link'       => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'image_url'  => ['nullable', 'string'],
            'is_active'  => ['boolean'],
        ]);

        $imagePath = $partner->image;
        if ($request->hasFile('image_file')) {
            if ($partner->image && file_exists(public_path($partner->image)) && !str_contains($partner->image, 'photo') && !str_contains($partner->image, 'noimage')) {
                @unlink(public_path($partner->image));
            }
            $file = $request->file('image_file');
            $filename = 'partner_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/partners'), $filename);
            $imagePath = '/upload/partners/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        $partner->update([
            'name'       => $validated['name'],
            'type'       => $validated['type'],
            'link'       => $validated['link'] ?? null,
            'sort_order' => (int) $validated['sort_order'],
            'image'      => $imagePath,
            'is_active'  => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.partners.index', ['type' => $partner->type])
            ->with('success', 'Đã cập nhật thông tin thành công!');
    }

    /**
     * Xóa đối tác
     */
    public function destroy(Partner $partner): RedirectResponse
    {
        $type = $partner->type;

        if ($partner->image && file_exists(public_path($partner->image)) && !str_contains($partner->image, 'photo') && !str_contains($partner->image, 'noimage')) {
            @unlink(public_path($partner->image));
        }

        $partner->delete();

        return redirect()->route('admin.partners.index', ['type' => $type])
            ->with('success', 'Đã xóa logo đối tác thành công!');
    }

    /**
     * Bật/tắt trạng thái hiển thị
     */
    public function toggleActive(Partner $partner): RedirectResponse
    {
        $partner->update(['is_active' => !$partner->is_active]);

        $status = $partner->is_active ? 'Đã hiển thị' : 'Đã ẩn';
        return back()->with('success', "{$status}: {$partner->name}");
    }
}
