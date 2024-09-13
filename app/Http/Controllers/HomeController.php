<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::first() ?? new Setting();
        $userName = auth()->user()->name;

        return view('v_home', compact('settings', 'userName'));
    }
}
