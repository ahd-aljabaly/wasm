<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    /**
     * إبطال كاش الإعداد تلقائياً عند أي حفظ أو حذف (يشمل التعديل من لوحة التحكم)
     * حتى تظهر التغييرات على الموقع فوراً دون كاش قديم.
     */
    protected static function booted(): void
    {
        static::saved(fn (Setting $setting) => Cache::forget("setting_{$setting->key}"));
        static::deleted(fn (Setting $setting) => Cache::forget("setting_{$setting->key}"));
    }

    /**
     * جلب قيمة إعداد واحد بسرعة من أي مكان بالكود:
     * Setting::get('contact_email')
     * Setting::get('contact_phone', '+970 59 000 0000') // مع قيمة افتراضية
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        return Cache::rememberForever("setting_{$key}", function () use ($key, $default) {
            return static::where('key', $key)->value('value') ?? $default;
        });
    }

    /**
     * تحديث أو إنشاء إعداد، مع تفريغ الكاش تلقائياً.
     * Setting::set('contact_email', 'hello@wasmmedia.com')
     */
    public static function set(string $key, string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting_{$key}");
    }
}
