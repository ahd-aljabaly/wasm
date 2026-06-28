<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * عرض كل الأعمال مع فلترة بالخدمة وترقيم الصفحات.
     */
    public function index(Request $request): View
    {
        $activeSlug = $request->query('service');

        $projects = Project::published()
            ->with('service')
            ->byServiceSlug($activeSlug)
            ->paginate(9)
            ->withQueryString();

        $services = Service::active()->get();
        $settings = Setting::all()->pluck('value', 'key');

        return view('projects.index', [
            'projects' => $projects,
            'services' => $services,
            'activeSlug' => $activeSlug ?: 'all',
            'settings' => $settings,
        ]);
    }

    /**
     * عرض صفحة تفاصيل مشروع منفرد.
     */
    public function show(Project $project): View
    {
        // المشاريع غير المنشورة لا تُعرض للزوار
        abort_unless($project->is_published, 404);

        $project->load('service');

        // مشاريع مقترحة من نفس الخدمة (وإلا أحدث المشاريع)
        $related = Project::published()
            ->where('id', '!=', $project->id)
            ->when(
                $project->service_id,
                fn ($query) => $query->where('service_id', $project->service_id)
            )
            ->take(3)
            ->get();

        $settings = Setting::all()->pluck('value', 'key');

        return view('projects.show', [
            'project' => $project,
            'related' => $related,
            'settings' => $settings,
        ]);
    }
}
