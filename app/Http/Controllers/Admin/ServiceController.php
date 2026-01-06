<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * عرض قائمة جميع الخدمات
     */
    public function index()
    {
        $services = Service::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * عرض نموذج إنشاء خدمة جديدة
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * حفظ الخدمة الجديدة
     */
    public function store(Request $request)
    {
        // التحقق من المدخلات
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // إنشاء slug من العنوان
        $slug = Str::slug($request->title);
        $counter = 1;
        while (Service::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->title) . '-' . $counter;
            $counter++;
        }

        // تحضير البيانات
        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'content' => $request->content,
            'icon' => $request->icon,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        // حفظ صورة الخدمة
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services/images', 'public');
        }

        // حفظ صورة الغلاف
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('services/covers', 'public');
        }

        // إنشاء الخدمة
        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'تم إنشاء الخدمة بنجاح');
    }

    /**
     * عرض تفاصيل الخدمة
     */
    public function show($id)
    {
        $service = Service::with('projects')->findOrFail($id);
        return view('admin.services.show', compact('service'));
    }

    /**
     * عرض نموذج تعديل الخدمة
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * تحديث الخدمة
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        // التحقق من المدخلات
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // تحديث slug إذا تغير العنوان
        if ($request->title != $service->title) {
            $slug = Str::slug($request->title);
            $counter = 1;
            while (Service::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = Str::slug($request->title) . '-' . $counter;
                $counter++;
            }
            $service->slug = $slug;
        }

        // تحديث البيانات الأساسية
        $service->title = $request->title;
        $service->description = $request->description;
        $service->content = $request->content;
        $service->icon = $request->icon;
        $service->is_featured = $request->has('is_featured');
        $service->is_active = $request->has('is_active');
        $service->order = $request->order ?? 0;
        $service->meta_title = $request->meta_title;
        $service->meta_description = $request->meta_description;
        $service->meta_keywords = $request->meta_keywords;

        // تحديث صورة الخدمة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($service->image) {
                Storage::delete('public/' . $service->image);
            }
            $service->image = $request->file('image')->store('services/images', 'public');
        }

        // تحديث صورة الغلاف
        if ($request->hasFile('cover_image')) {
            // حذف صورة الغلاف القديمة
            if ($service->cover_image) {
                Storage::delete('public/' . $service->cover_image);
            }
            $service->cover_image = $request->file('cover_image')->store('services/covers', 'public');
        }

        $service->save();

        return redirect()->route('admin.services.index')
            ->with('success', 'تم تحديث الخدمة بنجاح');
    }

    /**
     * حذف الخدمة
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // حذف الصور
        if ($service->image) {
            Storage::delete('public/' . $service->image);
        }
        
        if ($service->cover_image) {
            Storage::delete('public/' . $service->cover_image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'تم حذف الخدمة بنجاح');
    }

    /**
     * تبديل حالة الخدمة (نشط/معطل)
     */
    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->update(['is_active' => !$service->is_active]);
        
        $status = $service->is_active ? 'تم تفعيل الخدمة' : 'تم تعطيل الخدمة';
        return back()->with('success', $status);
    }

    /**
     * تبديل حالة التميز
     */
    public function toggleFeatured($id)
    {
        $service = Service::findOrFail($id);
        $service->update(['is_featured' => !$service->is_featured]);
        
        $status = $service->is_featured ? 'تم تمييز الخدمة' : 'تم إلغاء تمييز الخدمة';
        return back()->with('success', $status);
    }

    /**
     * إعادة ترتيب الخدمات
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array'
        ]);

        foreach ($request->order as $index => $id) {
            Service::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * حذف صورة الخدمة
     */
    public function removeImage($id)
    {
        $service = Service::findOrFail($id);
        
        if ($service->image) {
            Storage::delete('public/' . $service->image);
            $service->image = null;
            $service->save();
        }

        return back()->with('success', 'تم حذف صورة الخدمة بنجاح');
    }

    /**
     * حذف صورة الغلاف
     */
    public function removeCoverImage($id)
    {
        $service = Service::findOrFail($id);
        
        if ($service->cover_image) {
            Storage::delete('public/' . $service->cover_image);
            $service->cover_image = null;
            $service->save();
        }

        return back()->with('success', 'تم حذف صورة الغلاف بنجاح');
    }
}