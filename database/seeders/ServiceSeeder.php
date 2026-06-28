<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'slug' => 'branding',
                'title' => 'استراتيجيات وتصميم الهوية البصرية (Branding)',
                'icon' => 'brush',
                'description' => 'نبدأ ببحوث وتدقيق السوق وجلسات التحليل الاستراتيجي لتحديد تموضع علامتك، ثم نترجم ذلك إلى شعار أيقوني ودليل هوية كامل (Brand Guidelines) وتطبيقات تضمن لك التميز.',
                'badge' => 'الأكثر طلباً',
                'cta_text' => 'استكشف تفاصيل حلول الهوية',
                'sort_order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'slug' => 'marketing',
                'title' => 'الحملات الإعلانية والتسويق الرقمي',
                'icon' => 'campaign',
                'description' => 'إعلانات ممولة مبنية على العائد والأرقام الفعالة. نتولى إدارة ميزانيتك الإعلانية عبر القنوات الرقمية لزيادة مبيعاتك ووعي جمهورك المستهدف.',
                'badge' => null,
                'cta_text' => 'خططنا التسويقية',
                'sort_order' => 2,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'slug' => 'content',
                'title' => 'صناعة المحتوى وإدارة الحسابات',
                'icon' => 'edit_document',
                'description' => 'تصميم منشورات دورية ذكية، كتابة نصوص تسويقية جذابة وكتابة نصوص سيناريو للفيديوهات (Scripts) تحول المتابعين العاديين إلى عملاء دائمين.',
                'badge' => null,
                'cta_text' => 'رؤية نماذج المحتوى',
                'sort_order' => 3,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'slug' => 'packaging',
                'title' => 'حلول التغليف، الطباعة والإنتاج الفاخر',
                'icon' => 'print',
                'description' => 'نوفر خدمات تخطيط وتصاميم عبوات المنتجات الفاخرة (Packaging)، طباعة الكتيبات التعريفية للشركات بجودة استثنائية تعزز موثوقية حضورك على أرض الواقع.',
                'badge' => null,
                'cta_text' => 'استكشف مواصفات الإنتاج والطباعة',
                'sort_order' => 4,
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
