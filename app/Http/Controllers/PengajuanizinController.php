<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuanizin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PengajuanizinController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('permission.pengajuanizin', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'type' => 'required|string',
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'name.required' => 'Nama Wajib Diisi !!!',
            'start_date.required' => 'Tanggal Mulai Izin Wajib Diisi !!!',
            'end_date.required' => 'Tanggal Akhir Izin Wajib Diisi !!!',
            'reason.required' => 'Alasan Izin Wajib Diisi !!!',
            'type.required' => 'Jenis Izin Wajib Diisi !!!',
            'proof.required' => 'Bukti Izin Wajib Diisi !!!',
        ]);

        $izin = new Pengajuanizin();
        $izin->name = $request->input('name');
        $izin->start_date = $request->input('start_date');
        $izin->end_date = $request->input('end_date');
        $izin->reason = $request->input('reason');
        $izin->type = $request->input('type');

        if ($request->hasFile('proof')) {
            $fileName = time() . '.' . $request->file('proof')->extension();
            $request->file('proof')->move(public_path('uploads'), $fileName);
            $izin->proof = $fileName;
        }

        $izin->save();

        return redirect()->route('pengajuanizin.index')->with('success', 'Pengajuan izin berhasil dikirim.');
    }

    public function validateIndex()
    {
        $izins = Pengajuanizin::where('status', 'pending')->get();
        return view('validation.validasi_izin', compact('izins'));
    }

    public function validateRequest(Request $request, $id)
    {
        $izin = Pengajuanizin::findOrFail($id);
        $status = $request->input('status');

        $izin->status = $status;
        $izin->save();

        return redirect()->route('izin.validate.index')->with('success', 'Pengajuan izin berhasil divalidasi.');
    }
}
