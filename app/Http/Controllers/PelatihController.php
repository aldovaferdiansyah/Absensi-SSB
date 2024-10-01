<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Schedule;
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

    public function report(Request $request)
    {
        $user = auth()->user();
        $coaches = User::whereHas('roles', function($query) {
            $query->where('name', 'pelatih');
        });

        if ($request->filled('name')) {
            $name = $request->input('name');
            $coaches->where('name', $name);
        }

        $coaches = $coaches->get();
        $reportData = [];
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        if ($request->filled('month')) {
            $currentMonth = (int)$request->input('month');
        }

        if ($request->filled('year')) {
            $currentYear = (int)$request->input('year');
        }

        foreach ($coaches as $coach) {
            $attendanceQuery = Attendance::join('schedules', \DB::raw('DATE(attendances.arrival_at)'), '=', 'schedules.date')
                ->where('attendances.user_id', $coach->id)
                ->whereMonth('attendances.arrival_at', $currentMonth)
                ->whereYear('attendances.arrival_at', $currentYear);

            if ($request->filled('type')) {
                $type = $request->input('type');
                $attendanceQuery->where('schedules.title', 'like', '%' . $type . '%');
            }

            $attendanceCount = $attendanceQuery->count();
            $totalScheduled = Schedule::whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->when($request->filled('type'), function($query) use ($request) {
                    $type = $request->input('type');
                    return $query->where('title', 'like', '%' . $type . '%');
                })
                ->count();

            $attendancePercentage = $totalScheduled > 0 ? ($attendanceCount / $totalScheduled) * 100 : 0;

            $onTimeCount = $attendanceQuery->where('attendances.status_arrival', 'tepat waktu')->count();
            $onTimePercentage = $totalScheduled > 0 ? ($onTimeCount / $totalScheduled) * 100 : 0;

            $permitCount = \DB::table('pengajuanizins')
            ->where('name', $coach->name)
            ->where('status', 'Diterima')
            ->where(function ($query) use ($currentMonth, $currentYear) {
                $query->whereBetween('start_date', [Carbon::create($currentYear, $currentMonth, 1), Carbon::create($currentYear, $currentMonth)->endOfMonth()])
                    ->orWhereBetween('end_date', [Carbon::create($currentYear, $currentMonth, 1), Carbon::create($currentYear, $currentMonth)->endOfMonth()]);
            })
            ->count();

            $reportData[] = [
                'name' => $coach->name,
                'total_agenda' => $totalScheduled,
                'total_attendance' => $attendanceCount,
                'total_permits' => $permitCount,
                'attendance_percentage' => $attendancePercentage,
                'on_time_percentage' => $onTimePercentage,
            ];
        }

        return view('report.reportPelatih', compact('reportData'));
    }
}
