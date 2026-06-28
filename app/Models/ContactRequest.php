<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'service',
        'message',
        'status',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * قيم enum الخدمات مع تسمياتها العربية
     */
    public static function serviceLabels(): array
    {
        return [
            'branding'  => 'استراتيجيات وتصميم هوية بصرية كاملة',
            'packaging' => 'تخطيط وتصميم التغليف والطباعة الفاخرة',
            'marketing' => 'إدارة الحملات التسويقية وصناعة المحتوى',
            'digital'   => 'حلول رقمية وتصميم مواقع مخصصة',
        ];
    }

    /**
     * قيم enum الحالات مع تسمياتها العربية
     */
    public static function statusLabels(): array
    {
        return [
            'pending' => 'جديد',
            'read'    => 'تمت القراءة',
            'replied' => 'تم الرد',
            'closed'  => 'مغلق',
        ];
    }

    /**
     * الحصول على تسمية الخدمة بالعربية
     */
    public function getServiceLabelAttribute(): string
    {
        return self::serviceLabels()[$this->service] ?? $this->service;
    }

    /**
     * الحصول على تسمية الحالة بالعربية
     */
    public function getStatusLabelAttribute(): string
    {
        return self::statusLabels()[$this->status] ?? $this->status;
    }

    /**
     * Scope: الطلبات الجديدة فقط
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
