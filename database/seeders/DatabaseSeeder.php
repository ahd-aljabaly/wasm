<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء مستخدم admin للوحة التحكم Filament من ملف البيئة أو الافتراضي
        $adminEmail = env('ADMIN_EMAIL', 'admin@wasmmedia.com');
        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name'     => 'Wasm Admin',
                'email'    => $adminEmail,
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
                'role'     => 'super_admin',
            ]
        );


        // زرع بيانات الموقع
        $this->call([
            ServiceSeeder::class,
            ProjectSeeder::class,
            StatSeeder::class,
            ProcessStepSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
