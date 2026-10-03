<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'group'];

    /**
     * Lấy giá trị cấu hình theo key (có cache 1 giờ)
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        return Cache::remember('setting_' . $key, 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Lưu hoặc cập nhật cấu hình theo key
     */
    public static function set(string $key, ?string $value, string $group = 'general'): self
    {
        Cache::forget('setting_' . $key);

        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }
}
