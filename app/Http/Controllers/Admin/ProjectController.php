<?php
// app/Http/Controllers/Admin/ProjectController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = ['web' => 'Web', 'mobile' => 'Mobile', 'desktop' => 'Desktop'];
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'required|string',
            'category' => 'required|in:web,mobile,desktop',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'play_store_url' => 'nullable|url',
            'completed_at' => 'required|date',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $project = Project::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                $project->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'تم إنشاء المشروع بنجاح');
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $categories = ['web' => 'Web', 'mobile' => 'Mobile', 'desktop' => 'Desktop'];
        return view('admin.projects.edit', compact('project', 'categories'));
    }

// في ProjectController.php
public function update(Request $request, Project $project)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'technologies' => 'required|string',
        'category' => 'required|in:web,mobile,desktop',
        'github_url' => 'nullable|url',
        'demo_url' => 'nullable|url',
        'play_store_url' => 'nullable|url',
        'completed_at' => 'required|date',
        'is_active' => 'boolean',
        'new_images' => 'nullable|array',
        'new_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
        'existing_images' => 'nullable|array',
    ]);

    $project->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'technologies' => $validated['technologies'],
        'category' => $validated['category'],
        'github_url' => $validated['github_url'] ?? null,
        'demo_url' => $validated['demo_url'] ?? null,
        'play_store_url' => $validated['play_store_url'] ?? null,
        'completed_at' => $validated['completed_at'],
        'is_active' => $request->has('is_active') ? 1 : 0,
    ]);

    // حذف الصور التي تم إزالتها
    if ($request->has('existing_images')) {
        $project->images()
            ->whereNotIn('id', $request->existing_images)
            ->get()
            ->each(function ($image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            });
    }

    // إضافة الصور الجديدة
    if ($request->hasFile('new_images')) {
        foreach ($request->file('new_images') as $image) {
            $path = $image->store('projects', 'public');
            $project->images()->create(['image_path' => $path]);
        }
    }

    return redirect()->route('admin.projects.index')
        ->with('success', 'تم تحديث المشروع بنجاح');
}

// إضافة دالة لحذف الصور بشكل منفصل
public function deleteImage(Project $project, $imageId)
{
    try {
        $image = $project->images()->findOrFail($imageId);
        
        // حذف الملف من التخزين
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        // حذف السجل من قاعدة البيانات
        $image->delete();
        
        return response()->json(['success' => true, 'message' => 'تم حذف الصورة بنجاح']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء حذف الصورة'], 500);
    }
}

    public function destroy(Project $project)
    {
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $project->images()->delete();
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'تم حذف المشروع بنجاح');
    }

    public function destroyImage(Project $project, $imageId)
    {
        $image = $project->images()->findOrFail($imageId);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'تم حذف الصورة بنجاح');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $order => $id) {
            Project::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }

    public function reorderImages(Request $request, Project $project)
    {
        foreach ($request->order as $order => $id) {
            $project->images()->where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }

public function uploadImage(Request $request, Project $project)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $path = $request->file('image')->store('projects', 'public');
    $image = $project->images()->create(['image_path' => $path]);

    return response()->json([
        'id' => $image->id,
        'url' => asset('storage/' . $path)
    ]);
}

}