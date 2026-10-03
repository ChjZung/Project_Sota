<?php

declare(strict_types=1);

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Lấy giá trị cài đặt từ bảng settings
     */
    function setting(string $key, ?string $default = null): ?string
    {
        return Setting::get($key, $default);
    }
}
