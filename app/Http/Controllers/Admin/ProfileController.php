<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrNew();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'about' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'social_links' => 'nullable|array',
            'social_links.*' => 'nullable|url',
            'whatsapp' => 'nullable|string',
            'telegram' => 'nullable|string',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'stackoverflow' => 'nullable|url',
            'website' => 'nullable|url'
        ]);

        $profile = Profile::firstOrNew();
        
        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::delete('public/' . $profile->photo);
            }
            $validated['photo'] = $request->file('photo')->store('profile', 'public');
        }

        if (!$profile->exists) {
            $validated['user_id'] = auth()->id();
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->route('admin.dashboard')
            ->with('success', __('Profile updated successfully.'));
    }
}