<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuanizin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RekapizinController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuanizin::query();

        $user = Auth::user();

        if ($user->hasrole('siswa')) {
            $userName = $user->name;
            $query->where('name', $userName);
        }

        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where('name', 'LIKE', "%{$name}%");
        }

        if ($request->filled('date')) {
            $date = Carbon::parse($request->input('date'))->format('Y-m-d');
            $query->where(function($q) use ($date) {
                $q->whereDate('start_date', $date)
                  ->orWhereDate('end_date', $date)
                  ->orWhere(function($q) use ($date) {
                      $q->whereDate('start_date', '<=', $date)
                        ->whereDate('end_date', '>=', $date);
                  });
            });
        }

        if ($request->filled('month')) {
            $month = $request->input('month');
            $query->whereMonth('start_date', $month);
        }

        $izins = $query->get();

        return view('rekap.v_rekapizin', compact('izins'));
    }
}