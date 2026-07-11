<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
        'ip_address',
        'email_sent',
    ];

    protected $casts = [
        'email_sent' => 'boolean',
    ];

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}