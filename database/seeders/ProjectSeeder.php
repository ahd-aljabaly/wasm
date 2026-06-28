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
                'full_description' => "بدأنا مع مجموعة الزيتون من الصفر لبناء هوية بصرية تعكس أصالة المطبخ وفخامة التجربة.\n\nشمل العمل تطوير الشعار، ونظام الألوان والخطوط، ودليل استخدام شامل لكل الفروع، إضافة إلى تطبيقات القوائم واللافتات وتغليف الطلبات الخارجية.\n\nالنتيجة: حضور بصري موحّد ومتناسق عبر جميع الفروع عزّز تميّز العلامة في سوق المطاعم.",
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
                'full_description' => "أدرنا التواجد الرقمي لعيادات ومراكز ليان الطبية عبر استراتيجية محتوى توعوي تبني الثقة وتقرّب المريض من العلامة.\n\nتضمّن المشروع تخطيط الحملات الإعلانية المموّلة، وإنتاج محتوى مرئي ومكتوب متخصص، وإدارة منصات التواصل الاجتماعي بشكل كامل.\n\nحقّقت الحملات نمواً ملحوظاً في عدد الحجوزات والتفاعل مع الجمهور المستهدف.",
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
                'full_description' => "صمّمنا وطوّرنا الموقع التعريفي لشركة تك مايندز بواجهة عصرية تعكس طبيعتها التقنية المتقدمة.\n\nركّزنا على تجربة استخدام سلسة، وسرعة تحميل عالية، وتوافق كامل مع الأجهزة المحمولة، مع هيكلة محتوى تبرز خدمات الشركة بوضوح.\n\nأصبح الموقع واجهة رقمية احترافية تدعم نمو الشركة وتعزّز مصداقيتها أمام عملائها.",
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
                'full_description' => "أنشأنا تجربة تغليف فاخرة لبراند عطور مسك تليق بمكانة المنتج وتثري لحظة اقتنائه.\n\nشمل المشروع تصميم القوارير والعلب الخارجية، واختيار الخامات والتشطيبات الراقية، والإشراف على الإنتاج والطباعة حتى التسليم النهائي.\n\nنتج عن ذلك تغليف متكامل يعزّز القيمة المدركة للعطر ويميّزه على رفوف العرض.",
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
