<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
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

Route::get('/clear-everything', function() {
    Artisan::call('optimize:clear');
    return "تم مسح كل الكاش القديم بنجاح!";
});
