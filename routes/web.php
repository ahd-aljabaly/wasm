<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// صفحة تفاصيل مشروع منفرد (ربط عبر slug)
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])
    ->name('projects.show');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throt