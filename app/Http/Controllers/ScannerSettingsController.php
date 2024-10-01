<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ScannerSettingsController extends Controller
{
    public function index()
    {
        $scannerVisibility = Cache::get('scanner_visibility', true);
        $latitude = Cache::get('scanner_latitude', -6.175110); // Default Jakarta
        $longitude = Cache::get('scanner_longitude', 106.865036); // Default Jakarta
        $radius = Cache::get('scanner_radius', 100); // Default radius

        return view('settingscanner', compact('scannerVisibility', 'latitude', 'longitude', 'radius'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'scanner_visibility' => 'required|boolean',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|integer',
            'location_name' => 'nullable|string',
        ]);

        Cache::put('location_name', $request->input('location_name'));
        $scannerVisibility = $request->input('scanner_visibility');
        Cache::put('scanner_visibility', (bool)$scannerVisibility);
        Cache::put('scanner_latitude', $request->input('latitude'));
        Cache::put('scanner_longitude', $request->input('longitude'));
        Cache::put('scanner_radius', $request->input('radius'));

        return redirect()->route('settingscanner')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
