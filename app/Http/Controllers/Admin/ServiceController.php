<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        
        $validated['slug'] = Str::slug($request->title);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['features'] = $this->processArrayInput($request->features);
        $validated['process'] = $this->processArrayInput($request->process);

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'تم إنشاء الخدمة بنجاح');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateRequest($request);
        
        $validated['slug'] = Str::slug($request->title);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::delete('public/' . $service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['features'] = $this->processArrayInput($request->features);
        $validated['process'] = $this->processArrayInput($request->process);

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::delete('public/' . $service->image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'تم حذف الخدمة بنجاح');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $order => $id) {
            Service::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }

    public function removeImage(Service $service)
    {
        if ($service->image) {
            Storage::delete('public/' . $service->image);
            $service->update(['image' => null]);
        }

        return back()->with('success', 'تم حذف الصورة بنجاح');
    }

    private function validateRequest($request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'process' => 'nullable|array',
            'process.*' => 'string'
        ]);
    }

private function processArrayInput($input)
{
    if (is_null($input)) {
        return [];
    }
    
    if (is_string($input)) {
        return array_filter(explode(',', $input), function($item) {
            return !empty(trim($item));
        });
    }
    
    if (is_array($input)) {
        return array_filter($input, function($item) {
            return !empty(trim($item));
        });
    }
    
    return [];
}
}