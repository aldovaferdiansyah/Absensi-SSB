<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PelatihController extends Controller
{
    public function index()
    {
        $pelatih = User::whereHas('roles', function($query) {
            $query->where('name', 'pelatih');
        })->get();

        return view('pelatih.v_pelatih', ['pelatih' => $pelatih]);
    }

    public function detail($id)
    {
        $pelatih = User::find($id);
        return view('pelatih.v_detailpelatih', ['pelatih' => $pelatih]);
    }

    public function qrCode($id)
    {
        $pelatih = User::find($id);
        $qrCode = QrCode::size(200)->generate($pelatih->qr_code);

        return view('qr_code', compact('pelatih', 'qrCode'));
    }

    public function showAbsenPelatih(Request $request)
    {
        $user = auth()->user();
        $query = Attendance::query();

        if ($user->hasRole('pelatih')) {
            $query->where('user_id', $user->id);
        } elseif ($user->hasRole('admin')) {
            $query->whereHas('user.roles', function ($query) {
                $query->where('name', 'pelatih');
            });
        } else {
            return view('errors.index');
        }

        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        }

        if ($request->filled('date')) {
            $date = Carbon::parse($request->input('date'));
            $query->whereDate('arrival_at', $date->format('Y-m-d'));
        }

        if ($request->filled('month')) {
            $month = (int)$request->input('month');
            $year = Carbon::now()->year;
            $query->whereMonth('arrival_at', $month)
                ->whereYear('arrival_at', $year);
        }

        if ($request->filled('type')) {
            $type = $request->input('type');
            $query->where('type', $type);
        }

        $attendances = $query->orderBy('arrival_at', 'desc')->get();

        return view('attendances.absenPelatih', compact('attendances'));
    }
}
