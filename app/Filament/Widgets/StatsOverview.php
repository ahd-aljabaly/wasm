<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * بطاقات إحصائية في أعلى لوحة التحكم تعطي المدير نظرة سريعة على حالة الموقع.
 */
class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -3;

    protected function getStats(): array
    {
        return [
            Stat::make('طلبات تواصل جديدة', ContactSubmission::where('status', 'new')->count())
                ->description('بانتظار المتابعة')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color('warning'),

            Stat::make('إجمالي طلبات التواصل', ContactSubmission::count())
                ->description('كل الطلبات المستلمة')
                ->color('primary'),

            Stat::make('الخدمات المفعّلة', Service::where('is_active', true)->count())
                ->description('من أصل ' . Service::count() . ' خدمة')
                ->color('success'),

            Stat::make('المشاريع المنشورة', Project::where('is_published', true)->count())
                ->description('في معرض الأعمال')
                ->color('info'),
        ];
    }
}
