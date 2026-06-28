<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['icon' => 'groups', 'value' => '120+', 'label' => 'عميل سعيد', 'sort_order' => 1],
            ['icon' => 'task_alt', 'value' => '340+', 'label' => 'مشروع منجز', 'sort_order' => 2],
            ['icon' => 'timeline', 'value' => '8+', 'label' => 'سنوات خبرة', 'sort_order' => 3],
            ['icon' => 'support_agent', 'value' => '24h', 'label' => 'استجابة سريعة', 'sort_order' => 4],
        ];

        foreach ($stats as $stat) {
            Stat::updateOrCreate(['label' => $stat['label']], $stat);
        }
    }
}
