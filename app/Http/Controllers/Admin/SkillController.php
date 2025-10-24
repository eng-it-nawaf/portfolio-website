<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('order')->get();
        $categories = Skill::categories();
        return view('admin.skills.index', compact('skills', 'categories'));
    }

    public function create()
    {
        $categories = Skill::categories();
        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:1|max:100',
            'icon' => 'required|string|max:50',
            'category' => 'required|in:' . implode(',', Skill::categories()),
        ]);

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', __('Skill created successfully.'));
    }

    public function edit(Skill $skill)
    {
        $categories = Skill::categories();
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:1|max:100',
            'icon' => 'required|string|max:50',
            'category' => 'required|in:' . implode(',', Skill::categories()),
        ]);

        $skill->update($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', __('Skill updated successfully.'));
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')
            ->with('success', __('Skill deleted successfully.'));
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $order => $id) {
            Skill::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}