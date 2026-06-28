<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'service_id',
        'message',
        'status',
        'ip_address',
        'email_sent',
    ];

    protected $casts = [
        'email_sent' => 'boolean',
    ];

    /**
     * الخدمة التي طلبها العميل (اختيارية).
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
