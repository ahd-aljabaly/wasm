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
        // إنشاء مستخدم admin للوحة التحكم Filament
        User::updateOrCreate(
            ['email' => 'admin@wasmmedia.com'],
            [
                'name'     => 'Wasm Admin',
                'email'    => 'admin@wasmmedia.com',
                'password' => Hash::make('admin123'),
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
