<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * دالة التحكم بصلاحية دخول لوحة الإدارة (Filament)
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'editor'])
            || str_ends_with($this->email, 'wasemmedia@gmail.com')
            || $this->email === 'admin@wasmmedia.com';
    }

    /**
     * هل المستخدم مدير فائق كامل الصلاحيات؟
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin' || $this->email === 'admin@wasmmedia.com';
    }

    /**
     * هل يمكن حذف هذا المستخدم؟ (منع حذف الحساب الرئيسي إطلاقاً)
     */
    public function canBeDeleted(): bool
    {
        return !$this->isSuperAdmin();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}