<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $branding = Service::where('slug', 'branding')->first();
        $marketing = Service::where('slug', 'marketing')->first();
        $packaging = Service::where('slug', 'packaging')->first();

        $projects = [
            [
                'service_id' => $branding?->id,
                'slug' => 'al-zaitoun-restaurants',
                'title' => 'مجموعة مطاعم ومطابخ الزيتون الفاخرة',
                'client_name' => 'الزيتون',
                'category_label' => 'هوية بصرية كاملة',
                'short_description' => 'هندسة الهوية البصرية ودليل تطبيقات الفروع الشامل.',
                'full_description' => null,
                'cover_image' => null,
                'accent_color' => '#1A2F4C',
                'is_featured' => true,
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'service_id' => $marketing?->id,
                'slug' => 'layan-clinic',
                'title' => 'عيادات ومراكز ليان الطبية',
                'client_name' => 'ليان',
                'category_label' => 'تسويق رقمي',
                'short_description' => 'إدارة الحملات التمويلية وصناعة المحتوى التوعوي.',
                'full_description' => null,
                'cover_image' => null,
                'accent_color' => '#795901',
                'is_featured' => false,
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'service_id' => $marketing?->id,
                'slug' => 'techminds-solutions',
                'title' => 'شركة تك مايندز للحلول التقنية',
                'client_name' => 'تك مايندز',
                'category_label' => 'واجهات رقمية',
                'short_description' => 'تصميم وتطوير الموقع الإلكتروني التعريفي الفخم للشركة.',
                'full_description' => null,
                'cover_image' => null,
                'accent_color' => '#2E4A7D',
                'is_featured' => false,
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'service_id' => $packaging?->id,
                'slug' => 'misk-perfume',
                'title' => 'براند عطور مسك الملكية والفاخرة',
                'client_name' => 'مسك',
                'category_label' => 'هندسة تغليف',
                'short_description' => 'تصميم وتخطيط علب وقوارير خط العطور وإنتاجها بالكامل.',
                'full_description' => null,
                'cover_image' => null,
                'accent_color' => '#8C7A5B',
                'is_featured' => true,
                'sort_order' => 4,
                'is_published' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['slug' => $project['slug']], $project);
        }
    }
}
