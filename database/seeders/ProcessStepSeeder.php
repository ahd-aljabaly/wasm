<?php

namespace Database\Seeders;

use App\Models\ProcessStep;
use Illuminate\Database\Seeder;

class ProcessStepSeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            ['step_number' => 1, 'title' => 'الاستكشاف', 'description' => 'فهم المتطلبات وتحليل واقع السوق والمنافسين.', 'sort_order' => 1],
            ['step_number' => 2, 'title' => 'الاستراتيجية', 'description' => 'بناء حجر الأساس الفكري وتحديد خطة التنفيذ المخصصة.', 'sort_order' => 2],
            ['step_number' => 3, 'title' => 'التصميم والإنتاج', 'description' => 'ترجمة الاستراتيجية لقوالب بصرية فاخرة فائقة الدقة.', 'sort_order' => 3],
            ['step_number' => 4, 'title' => 'الإطلاق والتمكين', 'description' => 'تسليم المواد ومتابعة الأداء لضمان التطبيق السليم.', 'sort_order' => 4],
        ];

        foreach ($steps as $step) {
            ProcessStep::updateOrCreate(['step_number' => $step['step_number']], $step);
        }
    }
}
