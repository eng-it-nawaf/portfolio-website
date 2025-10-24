<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $skillsCount = Skill::count();
        $projectsCount = Project::count();
        $messagesCount = Message::where('is_read', false)->count(); // تغيير من 'read' إلى 'is_read'

        return view('admin.dashboard.index', compact('skillsCount', 'projectsCount', 'messagesCount'));
    }
}