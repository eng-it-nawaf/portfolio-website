<?php

use App\Http\Controllers\Admin\{
    AdminController,
    ProfileController,
    ProjectController,
    SkillController,
    TechnologyController,
    ExperienceController,
    MessageController,
    DashboardController,
    ServiceController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Skills
    Route::resource('skills', SkillController::class)->except(['show']);
    Route::post('skills/reorder', [SkillController::class, 'reorder'])->name('skills.reorder');

    // Technologies
    Route::resource('technologies', TechnologyController::class)->except(['show']);
    
// Projects
Route::resource('projects', ProjectController::class);
Route::post('projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
Route::post('projects/{project}/upload-image', [ProjectController::class, 'uploadImage'])
    ->name('projects.uploadImage');
Route::delete('projects/{project}/images/{image}', [ProjectController::class, 'deleteImage'])
    ->name('projects.deleteImage');
Route::post('projects/{project}/reorder-images', [ProjectController::class, 'reorderImages'])
    ->name('projects.reorderImages');
    
    // Experiences
    Route::resource('experiences', ExperienceController::class);
    
    // Messages
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
    Route::post('messages/{message}/mark-as-read', [MessageController::class, 'markAsRead'])
        ->name('messages.markAsRead');

        // Services
    Route::resource('services', ServiceController::class);
    Route::post('services/reorder', [ServiceController::class, 'reorder'])->name('services.reorder');
    Route::delete('services/{service}/remove-image', [ServiceController::class, 'removeImage'])
         ->name('services.remove-image');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');





// <?php

// use App\Http\Controllers\Admin\{
//     AdminController,
//     ProfileController,
//     ProjectController,
//     SkillController,
//     TechnologyController,
//     ExperienceController,
//     MessageController,
//     DashboardController,
//     ServiceController
// };
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });

// require __DIR__.'/auth.php';

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
//     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
//     // Skills
//     Route::resource('skills', SkillController::class)->except(['show']);
//     Route::post('skills/reorder', [SkillController::class, 'reorder'])->name('skills.reorder');

//     // Technologies
//     Route::resource('technologies', TechnologyController::class)->except(['show']);
    
//     // Projects
//     Route::resource('projects', ProjectController::class);
//     Route::post('projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
//     Route::post('projects/{project}/upload-image', [ProjectController::class, 'uploadImage'])
//         ->name('projects.uploadImage');
//     Route::delete('projects/{project}/images/{image}', [ProjectController::class, 'deleteImage'])
//         ->name('projects.deleteImage');
//     Route::post('projects/{project}/reorder-images', [ProjectController::class, 'reorderImages'])
//         ->name('projects.reorderImages');
    
//     // Experiences
//     Route::resource('experiences', ExperienceController::class);
    
//     // Messages
//     Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
//     Route::post('messages/{message}/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
    
//     // Services
//     Route::resource('services', ServiceController::class);
//     Route::post('services/reorder', [ServiceController::class, 'reorder'])->name('services.reorder');
//     Route::delete('services/{service}/remove-image', [ServiceController::class, 'removeImage'])
//          ->name('services.remove-image');
// });

