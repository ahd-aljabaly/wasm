<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'slug',
        'title',
        'client_name',
        'category_label',
        'short_description',
        'full_description',
        'cover_image',
        'gallery_images',
        'accent_color',
        'is_featured',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    /**
     * الخدمة التي ينتمي إليها هذا المشروع.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Scope: فقط المشاريع المنشورة، مرتبة حسب sort_order.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('sort_order');
    }

    /**
     * Scope: فلترة المشاريع حسب slug الخدمة (لزر الفلتر بصفحة أعمالنا).
     * استخدام: Project::published()->byServiceSlug('branding')->get();
     */
    public function scopeByServiceSlug($query, ?string $slug)
    {
        if (!$slug || $slug === 'all') {
            return $query;
        }

        return $query->whereHas('service', function ($q) use ($slug) {
            $q->where('slug', $slug);
        });
    }

    /**
     * رابط الصورة الكاملة (يدعم تخزين محلي عبر storage:link).
     */
    public function getCoverImageUrlAttribute(): ?string
    {
        if (!$this->cover_image) {
            return null;
        }

        return str_starts_with($this->cover_image, 'http')
            ? $this->cover_image
            : asset('storage/' . $this->cover_image);
    }
}
