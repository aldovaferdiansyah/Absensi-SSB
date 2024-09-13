<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class QrCodeController extends Controller
{
    public function generateForUsers()
    {
        $users = User::whereNull('qr_code')
            ->whereIn('role', ['siswa', 'pelatih'])
            ->get();

        foreach ($users as $user) {
            $user->qr_code = Str::uuid();
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'QR-Code Berhasil DiSimpan.');
    }
}
