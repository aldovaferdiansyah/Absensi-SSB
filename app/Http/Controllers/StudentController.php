<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
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
}
