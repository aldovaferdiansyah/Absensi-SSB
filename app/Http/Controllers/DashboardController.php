<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Information;
use App\Models\Pengajuanizin;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil nama siswa yang sedang login
        $userName = Auth::user()->name;

        // Hitung jumlah siswa
        $studentCount = User::whereHas('roles', function($query) {
            $query->where('name', 'siswa');
        })->count();

        // Hitung jumlah pelatih
        $pelatihCount = User::whereHas('roles', function($query) {
            $query->where('name', 'pelatih');
        })->count();

        // Ambil informasi
        $information = Information::all();

        // Hitung jumlah pengajuan izin yang pending
        $pendingRequests = Pengajuanizin::where('status', 'pending')->count();

        // Ambil tanggal hari ini
        $todayDate = Carbon::today();

        // Hitung jumlah absensi hari ini untuk siswa yang sedang login
        $attendanceToday = Attendance::whereHas('user', function($query) use ($userName) {
            $query->where('name', $userName);
        })
        ->whereDate('arrival_at', $todayDate)
        ->count();

        // Ambil rekap absensi untuk siswa yang sedang login
        $attendances = Attendance::whereHas('user', function($query) use ($userName) {
            $query->where('name', $userName);
        })
        ->orderBy('arrival_at', 'desc')
        ->limit(7) // Sesuaikan jumlah record yang ditampilkan
        ->get();

        return view('dashboard.v_dashboard', compact('studentCount', 'pelatihCount', 'information', 'pendingRequests', 'attendanceToday', 'attendances'));
    }
}
