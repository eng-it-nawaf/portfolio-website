<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\{
    HomeController,
    ServiceController as FrontServiceController,
    ContactController
};

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [FrontServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [FrontServiceController::class, 'show'])->name('services.show');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/{id}', [HomeController::class, 'projectDetail'])->name('project.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/lang/{locale}', [HomeController::class, 'changeLanguage'])->name('lang.switch');