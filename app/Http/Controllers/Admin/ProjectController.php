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
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $project->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                $project->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'تم تحديث المشروع بنجاح');
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

public function deleteImage(Project $project, $imageId)
{
    $image = $project->images()->findOrFail($imageId);
    Storage::disk('public')->delete($image->image_path);
    $image->delete();

    return response()->json(['success' => true]);
}
}