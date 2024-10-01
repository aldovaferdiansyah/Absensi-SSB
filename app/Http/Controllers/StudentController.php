<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::whereHas('roles', function($query) {
            $query->where('name', 'siswa');
        })->get();

        foreach ($students as $student) {
            if (!$student->qr_code) {
                $student->qr_code = Str::uuid();
                $student->save();
            }
        }

        return view('students.index', ['students' => $students]);
    }

    public function detail($id)
    {
        $student = User::findOrFail($id);

        return view('students.v_detailsiswa', ['student' => $student]);
    }

    public function qrCode($id)
    {
        $student = User::find($id);
        $qrCode = QrCode::size(200)->generate($student->qr_code);

        return view('qr_code', compact('student', 'qrCode'));
    }

    public function showAbsenSiswa(Request $request)
    {
        $user = auth()->user();
        $query = Attendance::query();

        if ($user->hasRole('siswa')) {
            $query->where('user_id', $user->id);
        } elseif ($user->hasRole('admin') || $user->hasRole('pelatih')) {
            $query->whereHas('user.roles', function ($query) {
                $query->where('name', 'siswa');
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

        return view('attendances.absenSiswa', compact('attendances'));
    }

    public function report(Request $request)
    {
        $user = auth()->user();
        $students = User::whereHas('roles', function($query) {
            $query->where('name', 'siswa');
        });

        if ($request->filled('name')) {
            $name = $request->input('name');
            $students->where('name', $name);
        }

        $students = $students->get();
        $reportData = [];
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        if ($request->filled('month')) {
            $currentMonth = (int)$request->input('month');
        }

        if ($request->filled('year')) {
            $currentYear = (int)$request->input('year');
        }

        foreach ($students as $student) {
            $attendanceQuery = Attendance::join('schedules', \DB::raw('DATE(attendances.arrival_at)'), '=', 'schedules.date')
                ->where('attendances.user_id', $student->id)
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
            ->where('name', $student->name)
            ->where('status', 'Diterima')
            ->where(function ($query) use ($currentMonth, $currentYear) {
                $query->whereBetween('start_date', [Carbon::create($currentYear, $currentMonth, 1), Carbon::create($currentYear, $currentMonth)->endOfMonth()])
                    ->orWhereBetween('end_date', [Carbon::create($currentYear, $currentMonth, 1), Carbon::create($currentYear, $currentMonth)->endOfMonth()]);
            })
            ->count();

            $reportData[] = [
                'name' => $student->name,
                'total_agenda' => $totalScheduled,
                'total_attendance' => $attendanceCount,
                'total_permits' => $permitCount,
                'attendance_percentage' => $attendancePercentage,
                'on_time_percentage' => $onTimePercentage,
            ];
        }

        return view('report.reportSiswa', compact('reportData'));
    }

}
