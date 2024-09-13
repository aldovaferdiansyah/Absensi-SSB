<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first(); // Retrieve the first settings record
        return view('settings', compact('settings')); // Pass settings to the view
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_SSB' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'logo_SSB' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'profile_title' => 'nullable|string|max:255',
            'profile_content' => 'nullable|string',
        ]);

        $settingsprofiles = Setting::first();
        $settingsprofiles->nama_SSB = $request->input('nama_SSB');
        $settingsprofiles->alamat = $request->input('alamat');
        $settingsprofiles->profile_title = $request->input('profile_title');
        $settingsprofiles->profile_content = $request->input('profile_content');

        if ($request->hasFile('logo_SSB')) {
            if ($settingsprofiles->logo_SSB && file_exists(public_path('foto_logo/' . $settingsprofiles->logo_SSB))) {
                unlink(public_path('foto_logo/' . $settingsprofiles->logo_SSB));
            }
            
            $image = $request->file('logo_SSB');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('foto_logo'), $imageName);
            $settingsprofiles->logo_SSB = $imageName;
        }

        $settingsprofiles->save();

        return redirect()->route('settings.index')->with('success', 'Pengaturan telah diperbarui');
    }
}