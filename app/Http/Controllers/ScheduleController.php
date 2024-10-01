<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::query();

        if ($request->filled('date')) {
            $date = Carbon::parse($request->input('date'));
            $query->whereDate('date', $date->format('Y-m-d'));
        }

        if ($request->filled('month')) {
            $month = (int)$request->input('month');
            $year = Carbon::now()->year;
            $query->whereMonth('date', $month)
                  ->whereYear('date', $year);
        }

        if ($request->filled('type')) {
            $type = $request->input('type');
            $query->where('title', 'like', '%' . $type . '%');
        }

        $schedules = $query->get();
        $user = Auth::user();

        return view('schedules.schedule', compact('schedules'));
    }

    public function create()
    {
        return view('schedules.add_schedules');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'description' => 'required|max:35',
            'time_start' => 'required',
            'time_end' => 'required'
        ],[
            'title.required' => 'Judul Kegiatan Wajib Diisi !!!',
            'date.required' => 'Tanggal Kegiatan Wajib Diisi !!!',
            'description.required' => 'Deskripsi Kegiatan Wajib Diisi !!!',
            'description.max' => 'Deskripsi Kegiatan Max 35 Huruf !!!',
            'time_start.required' => 'Waktu Mulai Kegiatan Wajib Diisi !!!',
            'time_end.required' => 'Waktu Selesai Kegiatan Wajib Diisi !!!'
        ]);

        Schedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $schedules = Schedule::findOrFail($id);

        return view('schedules.edit_schedules', compact('schedules'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'description' => 'required|max:35',
            'time_start' => 'required',
            'time_end' => 'required'
        ], [
            'title.required' => 'Judul Kegiatan Wajib Diisi !!!',
            'date.required' => 'Tanggal Kegiatan Wajib Diisi !!!',
            'description.required' => 'Deskripsi Kegiatan Wajib Diisi !!!',
            'description.max' => 'Deskripsi Kegiatan Max 35 Huruf !!!',
            'time_start.required' => 'Waktu Mulai Kegiatan Wajib Diisi !!!',
            'time_end.required' => 'Waktu Selesai Kegiatan Wajib Diisi !!!'
        ]);

        $schedules = Schedule::findOrFail($id);

        $schedules->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]);

        $schedules->save();
        return redirect()->route('schedules.index')->with('success', 'Data Jadwal Telah Berhasil Diubah !!');
    }

    public function destroy($id)
    {
        $schedules = Schedule::findOrFail($id);
        $schedules->delete();

        return redirect()->route('schedules.index')->with('success', 'Data Jadwal Telah Berhasil Dihapus !!');
    }
}
