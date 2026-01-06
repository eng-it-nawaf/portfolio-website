<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\{
    HomeController,
    ServiceController as FrontServiceController,
    ContactController
};

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// الصفحات الأخرى
Route::get('/about', [HomeController::class, 'about'])->name('about');

// الخدمات
Route::prefix('services')->group(function () {
    Route::get('/', [FrontServiceController::class, 'index'])->name('services.index');
    Route::get('/{service:slug}', [FrontServiceController::class, 'show'])->name('services.show');
});

// المشاريع
Route::prefix('projects')->group(function () {
    Route::get('/', [HomeController::class, 'projects'])->name('projects');
    Route::get('/{id}', [HomeController::class, 'projectDetail'])->name('project.detail');
});

// اتصل بنا
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// تغيير اللغة
Route::get('/lang/{locale}', [HomeController::class, 'changeLanguage'])->name('lang.switch');