<?php

namespace App\Http\Controllers;

use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Stat;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $services = Service::active()->get();

        $projects = Project::published()
            ->with('service')
            ->get();

        $stats = Stat::active()->get();

        $processSteps = ProcessStep::active()->get();

        $settings = Setting::all()->pluck('value', 'key');

        return view('index', [
            'services' => $services,
            'projects' => $projects,
            'stats' => $stats,
            'processSteps' => $processSteps,
            'settings' => $settings,
        ]);
    }
}
