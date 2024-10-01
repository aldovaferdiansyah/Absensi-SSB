<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Pengajuanizin;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;

        $pendingRequests = Pengajuanizin::where('status', 'pending')->count();

        $todayDate = Carbon::today();
        $attendanceToday = Attendance::whereDate('arrival_at', $todayDate)->count();

        $schedules = Schedule::all();

        $studentTotalCount = User::whereHas('roles', function($query) {
            $query->where('name', 'siswa');
        })->count();

        $studentAttendance = [];
        $months = collect(range(1, 12))->map(function($month) {
            return Carbon::create()->month($month)->format('F');
        });

        $totalUsers = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['siswa', 'pelatih']);
        })->count();

        foreach ($months as $month) {
            $monthNumber = Carbon::parse($month)->month;

            $studentPresent = Attendance::whereHas('user', function($query) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', 'siswa');
                });
            })->whereMonth('arrival_at', $monthNumber)->whereNotNull('arrival_at')->count();

            $studentPercentage = $studentTotalCount > 0 ? ($studentPresent / $studentTotalCount) * 100 : 0;

            $studentAttendance[] = [
                'month' => $month,
                'attendance_percentage' => $studentPercentage
            ];
        }

        $pelatihTotalCount = User::whereHas('roles', function($query) {
            $query->where('name', 'pelatih');
        })->count();

        $pelatihAttendance = [];

        foreach ($months as $month) {
            $monthNumber = Carbon::parse($month)->month;

            $coachPresent = Attendance::whereHas('user', function($query) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', 'pelatih');
                });
            })->whereMonth('arrival_at', $monthNumber)->whereNotNull('arrival_at')->count();

            $coachPercentage = $pelatihTotalCount > 0 ? ($coachPresent / $pelatihTotalCount) * 100 : 0;

            $pelatihAttendance[] = [
                'month' => $month,
                'attendance_percentage' => $coachPercentage
            ];
        }

        $totalAbsenThisMonth = Attendance::where('user_id', $userId)
            ->whereMonth('arrival_at', Carbon::now()->month)
            ->count();

        $totalAgendaThisMonth = Schedule::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->count();

        $ontimeAttendanceCount = Attendance::where('status_arrival', 'Tepat Waktu')
            ->whereMonth('arrival_at', Carbon::now()->month)
            ->count();

        $ontimeAttendancePercentage = $totalUsers > 0 ? ($ontimeAttendanceCount / $totalUsers) * 100 : 0;

        $lateAttendanceCount = Attendance::where('status_arrival', 'Terlambat')
                ->whereMonth('arrival_at', Carbon::now()->month)
                ->count();

        $lateAttendancePercentage = $totalUsers > 0 ? ($lateAttendanceCount / $totalUsers) * 100 : 0;

        $ontimeAttendanceCount = Attendance::where('user_id', $userId)
        ->whereMonth('arrival_at', Carbon::now()->month)
        ->where('status_arrival', 'Tepat Waktu')
        ->count();

        $ontimePercentageUser = $totalAgendaThisMonth > 0 ? ($ontimeAttendanceCount / $totalAgendaThisMonth) * 100 : 0;

        $daysInMonth = Carbon::now()->daysInMonth;
        $personalAttendancePercentage = $totalAgendaThisMonth > 0 ? ($totalAbsenThisMonth / $totalAgendaThisMonth) * 100 : 0;

        return view('dashboard.v_dashboard', [
            'studentCount' => $studentTotalCount,
            'pelatihCount' => $pelatihTotalCount,
            'totalUsers' => $totalUsers,
            'pendingRequests' => $pendingRequests,
            'attendanceToday' => $attendanceToday,
            'schedules' => $schedules,
            'studentAttendance' => $studentAttendance,
            'pelatihAttendance' => $pelatihAttendance,
            'totalAbsenThisMonth' => $totalAbsenThisMonth,
            'personalAttendancePercentage' => $personalAttendancePercentage,
            'totalAgendaThisMonth' => $totalAgendaThisMonth,
            'ontimePercentageUser' => $ontimePercentageUser,
            'ontimeAttendancePercentage' => $ontimeAttendancePercentage,
            'lateAttendancePercentage' => $lateAttendancePercentage,
        ]);
    }
}
