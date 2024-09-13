<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan nama
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter berdasarkan peran
        if ($request->has('role') && $request->role != '') {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->get();
        $roles = Role::all(); // Ambil semua peran untuk dropdown filter
        return view('dataAkun.v_user', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dataAkun.create_user', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'date_of_birth' => 'required|date',
            'address' => 'required',
            'phone_number' => 'required',
            'role' => 'required|exists:roles,name',
            'coach_category' => 'required_if:role,pelatih',
            'age_group_coach_category' => 'required_if:role,pelatih',
            'parents_name' => 'required_if:role,siswa',
            'parents_telephone_number' => 'required_if:role,siswa',
            'age_group_category' => 'required_if:role,siswa',
            'photo' => 'required|mimes:jpeg,png,jpg'
        ],[
            'name.required' => 'Nama User Wajib Diisi !!',
            'name.max' => 'Nama User Max:100 Huruf !!',
            'email.required' => 'Email User Wajib Diisi !!',
            'email.email' => 'Email User Tidak Sesuai Format Penulisan Email !!',
            'email.unique' => 'Email Ini Telah Terdaftar !!',
            'password.required' => 'Password Default User Wajib Diisi !!',
            'password.min' => 'Password Default User Min 8 karakter !!',
            'role.required' => 'Hak Akses User Wajib Diisi !!',
            'gender.required' => 'Jenis Kelamin User Wajib Diisi !!',
            'date_of_birth.required' => 'Tanggal Lahir Wajib Diisi !!',
            'address.required' => 'Alamat Wajib Diisi !!',
            'phone_number.required' => 'Nomor Telephone Wajib Diisi !!',
            'parents_name.required_if' => 'Nama Orang Tua Wajib Diisi !!',
            'parents_telephone_number.required_if' => 'Nomor Telephone Orang Tua Wajib Diisi !!',
            'age_group_category.required_if' => 'Kelompok Usia Wajib Diisi !!',
            'coach_category.required_if' => 'Kategori Pelatih Wajib Diisi !!',
            'age_group_coach_category.required_if' => 'Kategori Pelatih Kelompok Usia Wajib Diisi !!',
            'photo.required' => 'Photo Wajib Diisi !!',
            'photo.mimes' => 'Photo harus berformat Jpeg, Png, atau Jpg !!',
        ]);

        $role = $request->input('role');
        $folder = ($role === 'pelatih') ? 'foto_pelatih' : 'foto_siswa';
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . '.' . $file->extension();
            $file->move(public_path($folder), $fileName);
            $photoPath = $folder . '/' . $fileName;
        }

        $qrCode = Str::uuid();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'parents_name' => $request->parents_name ?? null,
            'parents_telephone_number' => $request->parents_telephone_number ?? null,
            'age_group_category' => $request->age_group_category ?? null,
            'coach_category' => $request->coach_category ?? null,
            'age_group_coach_category' => $request->age_group_coach_category ?? null,
            'photo' => $photoPath,
            'qr_code' => $qrCode,
        ]);

        $user->assignRole($role);

        return redirect()->route('users.index')->with('success', 'Data User Telah Berhasil Ditambahkan !!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('dataAkun.edit_user', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'role' => 'required|exists:roles,name',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'date_of_birth' => 'nullable|date',
            'age_group_category' => 'nullable',
            'phone_number' => 'nullable|max:20',
            'parents_name' => 'nullable',
            'parents_telephone_number' => 'nullable|max:20',
            'address' => 'nullable',
            'coach_category' => 'nullable',
            'age_group_coach_category' => 'nullable',
        ], [
            'name.required' => 'Nama User Wajib Diisi !!',
            'name.max' => 'Nama User Max:100 Huruf !!',
            'email.required' => 'Email User Wajib Diisi !!',
            'email.email' => 'Email User Tidak Sesuai Format Penulisan Email !!',
            'email.unique' => 'Email Ini Telah Terdaftar !!',
            'password.min' => 'Password Default User Min 8 karakter !!',
            'role.required' => 'Hak Akses User Wajib Diisi !!',
            'gender.required' => 'Jenis Kelamin User Wajib Diisi !!',
            'date_of_birth.required' => 'Tanggal Lahir Wajib Diisi !!',
            'age_group_category.required' => 'Kelompok Usia Wajib Diisi !!',
            'phone_number.required' => 'Nomor Telephone Wajib Diisi !!',
            'parents_name.required' => 'Nama Orang Tua Wajib Diisi !!',
            'parents_telephone_number.required' => 'Nomor Telephone Orang Tua Wajib Diisi !!',
            'address.required' => 'Alamat Wajib Diisi !!',
            'coach_category.required' => 'Kategori Pelatih Wajib Diisi !!',
            'age_group_coach_category.required' => 'Kategori Pelatih Kelompok Usia Wajib Diisi !!',
            'photo.required' => 'Photo Wajib Diisi !!',
            'photo.mimes' => 'Photo harus berformat Jpeg, Png, atau Jpg !!',
        ]);

        $user = User::findOrFail($id);

        $role = $request->input('role');
        $folder = ($role === 'pelatih') ? 'foto_pelatih' : 'foto_siswa';

        if ($request->hasFile('photo')) {
            if ($user->photo && File::exists(public_path($user->photo))) {
                File::delete(public_path($user->photo));
            }

            $file = $request->file('photo');
            $fileName = uniqid() . '.' . $file->extension();
            $photoPath = $folder . '/' . $fileName;
            $file->move(public_path($folder), $fileName);
        } else {
            $photoPath = $user->photo;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'age_group_category' => $request->age_group_category,
            'phone_number' => $request->phone_number,
            'parents_name' => $request->parents_name,
            'parents_telephone_number' => $request->parents_telephone_number,
            'address' => $request->address,
            'coach_category' => $request->coach_category,
            'age_group_coach_category' => $request->age_group_coach_category,
            'photo' => $photoPath,
        ]);

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->syncRoles([$request->role]);
        $user->save();
        return redirect()->route('users.index')->with('success', 'Data User Telah Berhasil Diubah !!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo && File::exists(public_path($user->photo))) {
            File::delete(public_path($user->photo));
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data User Telah Berhasil Dihapus !!');
    }
}
