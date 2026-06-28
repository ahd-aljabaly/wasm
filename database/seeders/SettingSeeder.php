<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // مجموعة: التواصل
            ['key' => 'contact_email', 'value' => 'hello@wasmmedia.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+966 50 000 0000', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '+966500000000', 'type' => 'text', 'group' => 'contact'],
            // الإيميل الذي تصله إشعارات طلبات التواصل (قابل للتغيير من لوحة التحكم)
            ['key' => 'notification_email', 'value' => 'hello@wasmmedia.com', 'type' => 'text', 'group' => 'contact'],

            // مجموعة: الهيرو
            ['key' => 'hero_title', 'value' => 'نصمم هوية تترك أثراً ونبني حضوراً يُلاحَظ', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'وكالة إبداعية متخصصة في تقديم حلول متكاملة لبناء العلامات التجارية، استراتيجيات التغليف الفاخر، والتسويق الرقمي المرتكز على النتائج الفعالة.', 'type' => 'textarea', 'group' => 'hero'],
            // الشعار: افتراضياً شعار SVG محلي في public/images، ويمكن استبداله بالرفع من لوحة التحكم
            ['key' => 'logo', 'value' => '/images/logo.svg', 'type' => 'image', 'group' => 'hero'],
            ['key' => 'video', 'value' => null, 'type' => 'video', 'group' => 'hero'],

            // مجموعة: السوشال ميديا
            ['key' => 'instagram_url', 'value' => '#', 'type' => 'url', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => '#', 'type' => 'url', 'group' => 'social'],
            ['key' => 'whatsapp_url', 'value' => '#', 'type' => 'url', 'group' => 'social'],

            // مجموعة: عام
            ['key' => 'site_name', 'value' => 'Wasm Media', 'type' => 'text', 'group' => 'general'],
            ['key' => 'footer_text', 'value' => 'وكالة إبداعية متخصصة في بناء العلامات التجارية والحلول التسويقية المتكاملة.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'copyright', 'value' => 'جميع الحقوق محفوظة © وسم ميديا', 'type' => 'text', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
