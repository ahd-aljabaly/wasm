<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'icon',
        'description',
        'badge',
        'cta_text',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * مسح كاش الصفحة الرئيسية تلقائياً عند تعديل أي خدمة من لوحة التحكم.
     */
    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home_services'));
        static::deleted(fn () => Cache::forget('home_services'));
    }

    /**
     * كل المشاريع المرتبطة بهذه الخدمة.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Scope: فقط الخدمات المفعّلة، مرتبة حسب sort_order.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
