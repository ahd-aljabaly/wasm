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
        /