<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Hiển thị trang cấu hình website dạng tabs
     */
    public function index(): View
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Cập nhật toàn bộ cấu hình website
     */
    public function update(Request $request): RedirectResponse
    {
        // 1. Xử lý upload Logo nếu có
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            ]);
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/photo'), $filename);
            Setting::set('logo', '/upload/photo/' . $filename, 'general');
        }

        // 2. Xử lý upload Favicon nếu có
        if ($request->hasFile('favicon')) {
            $request->validate([
                'favicon' => ['nullable', 'mimes:ico,png,jpg,svg', 'max:1024'],
            ]);
            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/photo'), $filename);
            Setting::set('favicon', '/upload/photo/' . $filename, 'general');
        }

        // 3. Danh sách các trường cài đặt và phân nhóm
        $fields = [
            // Thông tin chung
            'company_name_vi'     => 'general',
            'company_name_en'     => 'general',
            'tax_code'            => 'general',
            'slogan'              => 'general',

            // Liên hệ
            'hotline'             => 'contact',
            'phone'               => 'contact',
            'fax'                 => 'contact',
            'email_sale_1'        => 'contact',
            'email_sale_2'        => 'contact',
            'address_hq'          => 'contact',
            'address_factory'     => 'contact',
            'google_maps'         => 'contact',

            // Mạng xã hội & kênh bán
            'facebook'            => 'social',
            'youtube'             => 'social',
            'linkedin'            => 'social',
            'zalo'                => 'social',
            'alibaba'             => 'social',

            // Năng lực sản xuất
            'stats_factory_area'  => 'stats',
            'stats_machines'      => 'stats',
            'stats_employees'     => 'stats',
            'stats_capacity'      => 'stats',

            // Cấu hình SEO
            'meta_title'          => 'seo',
            'meta_description'    => 'seo',
            'meta_keywords'       => 'seo',
        ];

        foreach ($fields as $key => $group) {
            if ($request->has($key)) {
                $val = $request->input($key);
                Setting::set($key, $val, $group);
            }
        }

        // Xóa toàn bộ cache settings để website cập nhật ngay tức thì
        Cache::flush();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Đã lưu cấu hình website thành công! Toàn bộ website đã được cập nhật.');
    }
}
