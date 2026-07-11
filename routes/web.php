<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// صفحة كل الأعمال (مع فلترة وترقيم)
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

// صفحة تفاصيل مشروع منفرد (ربط عبر slug)
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])
    ->name('projects.show');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/sitemap.xml', function () {
    $projects = \App\Models\Project::published()->get(['slug', 'updated_at']);
    $content = view('sitemap', ['projects' => $projects])->render();
    return response($content, 200)->header('Content-Type', 'text/xml');
})->name('sitemap');



// manifest.json ديناميكي: يقرأ الشعار الفعلي من الإعدادات بدل ملف ثابت قديم
Route::get('/manifest.json', function () {
    $settings = \App\Models\Setting::all()->pluck('value', 'key');

    $logoValue = $settings['logo'] ?? null;
    $logoUrl = !empty($logoValue)
        ? ((str_starts_with($logoValue, 'http') || str_starts_with($logoValue, '/')) ? $logoValue : asset('storage/' . $logoValue))
        : asset('images/logo.svg');

    $siteName = $settings['site_name'] ?? 'Wasm Media';

    return response()->json([
        'name' => $siteName . ' | وسم ميديا',
        'short_name' => 'وسم ميديا',
        'description' => 'وكالة وسم ميديا الإبداعية: هوية بصرية، تسويق رقمي، صناعة محتوى، وحلول التغليف والطباعة الفاخرة.',
        'start_url' => '/',
        'display' => 'standalone',
        'background_color' => '#FDFDFB',
        'theme_color' => '#172E66',
        'lang' => 'ar',
        'dir' => 'rtl',
        'orientation' => 'portrait-primary',
        'icons' => [
            [
                'src' => $logoUrl,
                'sizes' => 'any',
                'type' => 'image/svg+xml',
                'purpose' => 'any maskable',
            ],
        ],
        'categories' => ['business', 'productivity'],
        'scope' => '/',
    ])->header('Content-Type', 'application/manifest+json');
})->name('manifest');