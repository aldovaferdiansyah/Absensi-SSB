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

    $studentTotalCount = User::whereHas('roles', function ($query) {
        $query->where('name', 'siswa');
    })->where('status_user', 'Aktif')->count();

    $months = collect(range(1, 12))->map(function ($month) {
        return Carbon::create()->month($month)->format('F');
    });

    $totalUsers = User::whereHas('roles', function ($query) {
        $query->whereIn('name', ['siswa', 'pelatih']);
    })->where('status_user', 'Aktif')->count();

    $studentAttendance = [];

    foreach ($months as $month) {
        $monthNumber = Carbon::parse($month)->month;

        $totalAgenda = Attendance::whereMonth('created_at', $monthNumber)->count();

        $studentPresent = Attendance::join('users', 'attendances.user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'siswa')
            ->where('users.status_user', 'aktif')
            ->whereMonth('arrival_at', $monthNumber)
            ->whereNotNull('arrival_at')
            ->count();

        $studentExcused = Attendance::join('users', 'attendances.user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('pengajuanizins', 'attendances.user_id', '=', 'pengajuanizins.user_id')
            ->where('roles.name', 'siswa')
            ->where('users.status_user', 'aktif')
            ->whereMonth('pengajuanizins.start_date', $monthNumber)
            ->where('pengajuanizins.status', 'Diterima')
            ->count();

        $studentTotalCount = User::role('siswa')
            ->where('status_user', 'aktif')
            ->count();

        if ($totalAgenda > 0) {
            $studentPercentage = min((($studentPresent + $studentExcused) / $totalAgenda) * 100, 100);
        } else {
            $studentPercentage = 0;
        }

        $studentAttendance[] = [
            'month' => $month,
            'attendance_percentage' => $studentPercentage,
            'total_students' => $studentTotalCount,
        ];
    }

    $pelatihTotalCount = User::whereHas('roles', function ($query) {
        $query->where('name', 'pelatih');
    })->where('status_user', 'Aktif')->count();

    $pelatihAttendance = [];

    foreach ($months as $month) {
        $monthNumber = Carbon::parse($month)->month;

        $totalAgenda = Attendance::whereMonth('created_at', $monthNumber)->count();

        $coachPresent = Attendance::join('users', 'attendances.user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'pelatih')
            ->where('users.status_user', 'aktif')
            ->whereMonth('arrival_at', $monthNumber)
            ->whereNotNull('arrival_at')
            ->count();

        $coachExcused = Attendance::join('users', 'attendances.user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('pengajuanizins', 'attendances.user_id', '=', 'pengajuanizins.user_id')
            ->where('roles.name', 'pelatih')
            ->where('users.status_user', 'aktif')
            ->whereMonth('pengajuanizins.start_date', $monthNumber)
            ->where('pengajuanizins.status', 'Diterima')
            ->count();

        $pelatihTotalCount = User::role('pelatih')
            ->where('status_user', 'aktif')
            ->count();

        if ($totalAgenda > 0) {
            $coachPercentage = min((($coachPresent + $coachExcused) / $totalAgenda) * 100, 100);
        } else {
            $coachPercentage = 0;
        }

        $pelatihAttendance[] = [
            'month' => $month,
            'attendance_percentage' => $coachPercentage,
            'total_coaches' => $pelatihTotalCount,
        ];
    }

    $totalAbsenThisMonth = Attendance::where('user_id', $userId)
        ->whereMonth('arrival_at', Carbon::now()->month)
        ->count();

    $totalAgendaThisMonth = Schedule::whereMonth('date', Carbon::now()->month)
        ->whereYear('date', Carbon::now()->year)
        ->count();

    $ontimeAttendanceCount = Attendance::where('status_arrival', 'Tepat Waktu')
        ->whereMonth('arrival_at', Carbon::now()->month)->count();

    $lateAttendanceCount = Attendance::where('status_arrival', 'Terlambat')
        ->whereMonth('arrival_at', Carbon::now()->month)->count();

    $totalAttendanceThisMonth = $ontimeAttendanceCount + $lateAttendanceCount;

    $ontimeAttendancePercentage = $totalAttendanceThisMonth > 0
        ? ($ontimeAttendanceCount / $totalAttendanceThisMonth) * 100
        : 0;

    $lateAttendancePercentage = $totalAttendanceThisMonth > 0
        ? ($lateAttendanceCount / $totalAttendanceThisMonth) * 100
        : 0;

    $ontimeAttendanceCountUser = Attendance::where('user_id', $userId)
        ->whereMonth('arrival_at', Carbon::now()->month)->count();

    $ontimePercentageUser = $totalAgendaThisMonth > 0
        ? ($ontimeAttendanceCountUser / $totalAgendaThisMonth) * 100
        : 0;

    $personalAttendancePercentage = $totalAgendaThisMonth > 0
        ? ($totalAbsenThisMonth / $totalAgendaThisMonth) * 100
        : 0;

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
