<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Setting',
            'setting' => Setting::get()->first()
        ];
        return view('setting.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'app_name' => 'required',
            'login_title' => 'required',
            'copyright' => 'required',
            'icon' => 'sometimes|image|mimes:png,jpg,jpeg,svg|max:512'
        ]);

        if ($request->file('icon')) {
            $path = $request->file('icon')->store('img', 'public');
            $validated['icon'] = $path;
            if ($setting->icon) {
                if (Storage::disk('public')->exists($setting->icon)) {
                    Storage::disk('public')->delete($setting->icon);
                }
            }
        }

        $validated['description'] = $request->description;
        $validated['keywords'] = $request->keywords;
        $setting->update($validated);
        return redirect()->route('setting.index')->with('success', successUpdateMessage());
    }
}
