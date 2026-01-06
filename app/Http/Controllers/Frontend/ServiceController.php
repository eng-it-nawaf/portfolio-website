<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Profile;

class ServiceController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrFail();
        $services = Service::active()->ordered()->get();
        $featuredServices = Service::active()->where('is_featured', true)->ordered()->get();
        
        return view('front.services.index', compact('profile', 'services', 'featuredServices'));
    }

    public function show($slug)
    {
        $profile = Profile::firstOrFail();
        
        // إزالة with('projects') مؤقتاً لحل المشكلة
        $service = Service::where('slug', $slug)->active()->firstOrFail();
        
        $services = Service::active()->ordered()->get();
        
        $relatedServices = Service::where('id', '!=', $service->id)
                                ->active()
                                ->inRandomOrder()
                                ->limit(3)
                                ->get();

        // جلب المشاريع المرتبطة بالخدمة بشكل منفصل
        $relatedProjects = $service->projects()->with('images')->latest()->take(3)->get();

        return view('front.services.show', compact(
            'profile', 
            'service', 
            'services', 
            'relatedServices',
            'relatedProjects'
        ));
    }
}