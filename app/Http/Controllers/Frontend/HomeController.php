<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrFail();
        $skills = Skill::orderBy('order')->get();
        $projects = Project::with('images')->latest()->take(3)->get(); // تم إزالة technologies
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $services = Service::where('is_active', true)->orderBy('order')->take(5)->get();
        return view('front.home', compact('profile', 'skills', 'projects', 'experiences' , 'services'));
    }
    
    public function about()
    {
        $profile = Profile::firstOrFail();
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $skills = Skill::orderBy('order')->get()->groupBy('category');
        $services = Service::active()->ordered()->get();
        
        return view('front.about', compact('profile', 'experiences', 'services', 'skills'));
    }
    
    public function projects()
    {
        $profile = Profile::firstOrFail();
        $projects = Project::with('images')->latest()->get(); // تم إزالة technologies
        $categories = ['web' => 'Web', 'mobile' => 'Mobile', 'desktop' => 'Desktop'];
        $services = Service::active()->ordered()->get();
        
        return view('front.projects', compact('profile','projects', 'services', 'categories'));
    }
    
 public function projectDetail($id)
{
    $profile = Profile::firstOrFail();
    $project = Project::with('images')->findOrFail($id);
    $services = Service::active()->ordered()->get();
    
    if ($project->completed_at) {
        $project->completed_at = \Carbon\Carbon::parse($project->completed_at);
    }
    
    $relatedProjects = Project::where('id', '!=', $id)
                            ->with('images')
                            ->latest()
                            ->take(3)
                            ->get();
    
    return view('front.sections.project-detail', compact('profile','project', 'services','relatedProjects'));
}
    
    public function contact()
    {
        $services = Service::active()->ordered()->get();
        $profile = Profile::firstOrFail();
        return view('front.contact', compact('services','profile'));
    }
    
    public function changeLanguage($locale)
    {
        if (!in_array($locale, ['en', 'ar'])) {
            abort(400);
        }
        
        Session::put('locale', $locale);
        return redirect()->back();
    }
}