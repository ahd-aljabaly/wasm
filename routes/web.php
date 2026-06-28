<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// صفحة كل الأعمال (مع فلترة وترقيم)
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

// صفحة تفاصيل مشروع منفرد (ربط عبر slug)
Route::get('/projects/{project:slug}', 