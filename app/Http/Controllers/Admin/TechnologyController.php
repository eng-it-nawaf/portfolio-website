<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('admin.technologies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:technologies',
            'icon' => 'nullable|string|max:255',
        ]);

        Technology::create($validated);

        return redirect()->route('admin.technologies.index')
            ->with('success', __('Technology created successfully.'));
    }

    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    public function update(Request $request, Technology $technology)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:technologies,name,'.$technology->id,
            'icon' => 'nullable|string|max:255',
        ]);

        $technology->update($validated);

        return redirect()->route('admin.technologies.index')
            ->with('success', __('Technology updated successfully.'));
    }

    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')
            ->with('success', __('Technology deleted successfully.'));
    }
}