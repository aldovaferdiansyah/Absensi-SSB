<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        if ($user->hasRole('siswa')) {
            return view('profile.student', ['profile' => $user]);
        } elseif ($user->hasRole('pelatih')) {
            return view('profile.pelatih', ['profile' => $user]);
        } else {
            return view('profile.error');
        }
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', ['profile' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                $user->hasRole('admin') ? 'unique:users,email,' . $user->id : 'in:'.$user->email,
            ],
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ];

        if ($user->hasRole('siswa')) {
            $rules += [
                'age_group_category' => 'required',
                'parents_name' => 'required',
                'parents_telephone_number' => 'required|max:15',
            ];
        } elseif ($user->hasRole('pelatih')) {
            $rules += [
                'coach_category' => 'required|string|max:255',
                'age_group_coach_category' => 'required|string|max:255',
            ];
        }

        $validatedData = $request->validate($rules, [
            'name.required' => 'Nama Wajib Diisi !!',
            'parents_name.required' => 'Nama Orang Tua Wajib Diisi !!',
            'date_of_birth.required' => 'Tanggal Lahir Wajib Diisi !!',
            'gender.required' => 'Jenis Kelamin Wajib Diisi !!',
            'address.required' => 'Alamat Wajib Diisi !!',
            'phone_number.required' => 'Nomor Telepon Wajib Diisi !!',
            'parents_phone_number.required' => 'Nomor Telepon Orang Tua Wajib Diisi !!',
            'coach_category.required' => 'Kategori Pelatih Wajib Diisi !!',
            'age_group_coach_category.required' => 'Kategori Umur Pelatih Wajib Diisi !!',
            'age_group_category.required' => 'Kategori Kelompok Umur Wajib Diisi !!',
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'gender' => $validatedData['gender'],
        ]);

        if ($user->hasRole('siswa')) {
            $user->update([
                'age_group_category' => $validatedData['age_group_category'],
                'parents_name' => $validatedData['parents_name'],
                'parents_telephone_number' => $validatedData['parents_telephone_number'],
            ]);
        } elseif ($user->hasRole('pelatih')) {
            $user->update([
                'coach_category' => $validatedData['coach_category'],
                'age_group_coach_category' => $validatedData['age_group_coach_category'],
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Data Profile Berhasil DiUbah.');
    }

    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ],[
            'current_password.required' => 'Password Saat Ini Wajib Diisi !!',
            'new_password.required' => 'Password Baru Wajib Diisi !!',
            'new_password.confirmed' => 'Konfirmasi Password Baru Tidak Sama !!',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Password Telah Berhasil DiUbah.');
    }
}
