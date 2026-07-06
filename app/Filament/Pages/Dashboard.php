<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    // العنوان الرئيسي الذي سيظهر في أعلى الصفحة داخل لوحة التحكم
    protected static ?string $title = 'لوحة التحكم الإحصائية';

    // الاسم الذي سيظهر في القائمة الجانبية (Navigation)
    public static function getNavigationLabel(): string
    {
        return 'الرئيسية';
    }

    // الحل الجذري: استخدام دالة بدلاً من المتغير لتفادي تعارض الأنواع (Type Hinting)
    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return 'heroicon-o-home';
    }

    // توزيع العناصر (Widgets) على 3 أعمدة في الشاشات الكبيرة
    public function getColumns(): int | array
    {
        return [
            'default' => 1,
            'sm' => 2,
            'lg' => 3,
        ];
    }

    public function getWidgets(): array
    {
        $widgets = parent::getWidgets();

        // ❌ شيل السطر هاد إذا بدك تحذف كرت الـ GitHub والمعلومات نهائياً
        if (($key = array_search(\Filament\Widgets\FilamentInfoWidget::class, $widgets)) !== false) {
            unset($widgets[$key]);
        }

        // 🛑 إذا مستقبلاً حبيت تشيل كرت الترحيب بالمستخدم (Account)، بس فك التعليق عن الأسطر التحت:
        /*
        if (($key = array_search(\Filament\Widgets\AccountWidget::class, $widgets)) !== false) {
            unset($widgets[$key]);
        }
        */

        // ➕ هنا تقدر تضيف الكروت المخصصة تبعتك (تبعت الإحصائيات اللي رح تنشأها)
        // $widgets[] = \App\Filament\Widgets\MyCustomStatsWidget::class;

        return $widgets;
    }
}