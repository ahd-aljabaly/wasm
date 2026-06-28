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

            // مجموعة: الهيرو
            ['key' => 'hero_title', 'value' => 'نصمم هوية تترك أثراً ونبني حضوراً يُلاحَظ', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'وكالة إبداعية متخصصة في تقديم حلول متكاملة لبناء العلامات التجارية، استراتيجيات التغليف الفاخر، والتسويق الرقمي المرتكز على النتائج الفعالة.', 'type' => 'textarea', 'group' => 'hero'],
            ['key' => 'logo_url', 'value' => null, 'type' => 'image', 'group' => 'hero'],

            // مجموعة: السوشال ميديا
            ['key' => 'instagram_url', 'value' => '#', 'type' => 'url', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => '#', 'type' => 'url', 'group' => 'social'],
            ['key' => 'whatsapp_url', 'value' => '#', 'type' => 'url', 'group' => 'social'],

            // مجموعة: عام
            ['key' => 'site_name', 'value' => 'Wasm Media', 'type' => 'text', 'group' => 'general'],
            ['key' => 'footer_text', 'value' => 'وكالة إبداعية متخصصة في بناء العلامات التجارية والحلول التسويقية المتكاملة.', 'type' => 'textarea', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
