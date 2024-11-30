<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Link Reset Password telah berhasil dikirim. Silahkan cek email Anda.'])
            : back()->withErrors(['email' => 'Link Reset Password gagal dikirim. Email Tidak Terdaftar.']);
    }

    public function showResetForm() {
        return 'Berhasil Mengirim Notifikasi Reset Passsword';
    }
}
