<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    ProfileController,
    SkillController,
    TechnologyController,
    ProjectController,
    ExperienceController,
    MessageController,
    ServiceController
};
use Illuminate\Support\Facades\Route;

// مجموعة المسارات الإدارية
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::prefix('admin')->name('admin.')->group(function () {
        // لوحة التحكم
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // الملف الشخصي
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        
        // المهارات
        Route::resource('skills', SkillController::class)->except(['show']);
        Route::post('skills/reorder', [SkillController::class, 'reorder'])->name('skills.reorder');
        
        // التقنيات
        Route::resource('technologies', TechnologyController::class)->except(['show']);
        
        // المشاريع
        Route::resource('projects', ProjectController::class);
        Route::post('projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
        Route::post('projects/{project}/upload-image', [ProjectController::class, 'uploadImage'])->name('projects.uploadImage');
        Route::delete('projects/{project}/images/{image}', [ProjectController::class, 'deleteImage'])->name('projects.deleteImage');
        Route::post('projects/{project}/reorder-images', [ProjectController::class, 'reorderImages'])->name('projects.reorderImages');
        
        // الخبرات
        Route::resource('experiences', ExperienceController::class);
        
        // الرسائل
        Route::resource('messages', MessageController::class)->except(['create', 'store', 'edit', 'update']);
        Route::post('messages/{message}/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
        
        // ============ الخدمات ============
        Route::prefix('services')->name('services.')->group(function () {
            // المسارات الرئيسية
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/create', [ServiceController::class, 'create'])->name('create');
            Route::post('/', [ServiceController::class, 'store'])->name('store');
            Route::get('/{service}', [ServiceController::class, 'show'])->name('show');
            Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
            Route::put('/{service}', [ServiceController::class, 'update'])->name('update');
            Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
            
            // المسارات الإضافية - تعريفها هنا
            Route::post('/reorder', [ServiceController::class, 'reorder'])->name('reorder');
            Route::post('/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('toggle-status');
            Route::post('/{service}/toggle-featured', [ServiceController::class, 'toggleFeatured'])->name('toggle-featured');
            
            // المسارات المفقودة - إضافتها
            Route::delete('/{service}/remove-image', [ServiceController::class, 'removeImage'])->name('remove-image');
            Route::delete('/{service}/remove-cover-image', [ServiceController::class, 'removeCoverImage'])->name('remove-cover-image');
        });
    });
});

// إعادة توجيه /dashboard إلى لوحة التحكم الإدارية
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');