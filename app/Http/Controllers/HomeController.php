<?php

namespace App\Http\Controllers;

use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Stat;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $services = Service::active()->get();

        $stats = Stat::active()->get();

        $processSteps = ProcessStep::active()->get();

       // نقوم بإنشاء كولكشن فارغ للمشاريع
$projects = collect();

// نمر على كل خدمة/قسم جلبناه من قاعدة البيانات
foreach ($services as $service) {
    $serviceProjects = Project::published()
        ->where('service_id', $service->id) // نحدد القسم الحالي
        ->with('service')
        ->latest()
        ->take(3) // نأخذ 3 فقط من هذا القسم
        ->get();
        
    // ندمج مشاريع هذا القسم مع القائمة الكلية
    $projects = $projects->concat($serviceProjects);
}

// (اختياري) إذا كنت تريد إعادة ترتيب المشاريع المجلوبة كلها لتظهر الأحدث فالأحدث في الواجهة:
$projects = $projects->sortByDesc('created_at');

        // الإعدادات مع الكاش الموجود في موديل Setting
        $settings = Setting::all()->pluck('value', 'key');

        return view('index', [
            'services'     => $services,
            'projects'     => $projects,
            'stats'        => $stats,
            'processSteps' => $processSteps,
            'settings'     => $settings,
        ]);
    }
}

