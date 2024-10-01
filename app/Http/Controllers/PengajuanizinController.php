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
            'proof' => 'nullable|string',
            'fileProof' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $izin = new Pengajuanizin();
        $izin->name = $request->input('name');
        $izin->role = Auth::user()->getRoleNames()->first();
        $izin->start_date = $request->input('start_date');
        $izin->end_date = $request->input('end_date');
        $izin->reason = $request->input('reason');
        $izin->type = $request->input('type');

        if ($request->filled('proof')) {
            $imageData = $request->input('proof');
            $fileName = time() . '_proof_image.png';
            $imagePath = public_path('uploads/' . $fileName);
            \File::put($imagePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));
            $izin->proof = $fileName;
        } elseif ($request->hasFile('fileProof')) {
            $fileName = time() . '_proof_file.' . $request->file('fileProof')->getClientOriginalExtension();
            $request->file('fileProof')->move(public_path('uploads'), $fileName);
            $izin->proof = $fileName;
        }

        $izin->save();

        return redirect()->route('pengajuanizin.index')->with('success', 'Pengajuan izin berhasil dikirim.');
    }

    public function validateIndex()
    {
        $user = Auth::user();

        if ($user->hasRole('pelatih')) {
            $izins = Pengajuanizin::whereHas('user', function ($query) {
                $query->where('role', 'siswa');
            })->where('status', 'pending')->get();
        } elseif ($user->hasRole('admin')) {
            $izins = Pengajuanizin::whereHas('user', function ($query) {
                $query->where('role', 'pelatih');
            })->where('status', 'pending')->get();
        } else {
            $izins = Pengajuanizin::where('status', 'pending')->get();
        }

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
