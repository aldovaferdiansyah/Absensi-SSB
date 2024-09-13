@extends('layout.v_template')

@section('title', 'Edit Data Akun User')
@section('content')

<link rel="stylesheet" href="{{ asset('style/dataAkun/editDataAkun.css') }}">

<form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h2>Edit Akun User</h2>

    <div class="form-group">
        <label>Nama</label>
        <input type="text" id="name" placeholder="Silahkan Masukkan Nama User ..." name="name" value="{{ old('name', $user->name) }}">
        <div class="text-danger">
            @error('name')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" id="email" placeholder="Silahkan Masukkan Email User ..." name="email" value="{{ old('email', $user->email) }}">
        <div class="text-danger">
            @error('email')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Password Baru</label>
        <input type="password" id="password" placeholder="Silahkan Masukkan Password Baru User ..." name="password">
        <div class="text-danger">
            @error('password')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Konfirmasi Password Baru</label>
        <input type="password" id="confirm_password" placeholder="Konfirmasi Password Baru ..." name="confirm_password">
        <div class="text-danger">
            @error('confirm_password')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select id="gender" name="gender">
            <option value="">Pilih Kategori</option>
            <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        <div class="text-danger">
            @error('gender')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Tanggal Lahir</label>
        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
        <div class="text-danger">
            @error('date_of_birth')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Nomor Telepon</label>
        <input type="text" id="phone_number" name="phone_number" placeholder="Silahkan Masukkan Nomor Telepon ..." value="{{ old('phone_number', $user->phone_number) }}">
        <div class="text-danger">
            @error('phone_number')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <input type="text" id="address" name="address" placeholder="Silahkan Masukkan Alamat ..." value="{{ old('address', $user->address) }}">
        <div class="text-danger">
            @error('address')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Foto User Saat Ini</label>
        @if ($user->photo)
            <img src="{{ asset('/' . $user->photo) }}" alt="{{ $user->name }}">
        @endif
    </div>

    <div class="form-group">
        <label>Ubah Foto User</label>
        <input type="file" id="photo" name="photo">
        <div class="text-danger">
            @error('photo')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="role">Hak Akses User</label>
        <select id="role" name="role" class="form-control">
            <option value="">Pilih Hak Akses</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ old('role', $user->roles->first()->name ?? '') == $role->name ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        <div class="text-danger">
            @error('role')
                {{ $message }}
            @enderror
        </div>
    </div>

    <!-- Input khusus untuk siswa -->
    <div id="siswa-fields" class="form-group" style="display: none;">
        <h3>Edit Data Siswa</h3>

        <div class="form-group">
            <label>Kategori Kelompok Usia</label>
            <select name="age_group_category">
                <option value="">Pilih Kategori</option>
                <option value="U-16" {{ old('age_group_category', $user->age_group_category) == 'U-16' ? 'selected' : '' }}>U-16</option>
                <option value="U-19" {{ old('age_group_category', $user->age_group_category) == 'U-19' ? 'selected' : '' }}>U-19</option>
                <option value="U-21" {{ old('age_group_category', $user->age_group_category) == 'U-21' ? 'selected' : '' }}>U-21</option>
                <option value="Senior" {{ old('age_group_category', $user->age_group_category) == 'Senior' ? 'selected' : '' }}>Senior</option>
            </select>
            <div class="text-danger">
                @error('age_group_category')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Nama Orang Tua</label>
            <input type="text" id="parents_name" name="parents_name" placeholder="Silahkan Masukkan Nama Orang Tua ..." value="{{ old('parents_name', $user->parents_name) }}">
            <div class="text-danger">
                @error('parents_name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Nomor Telepon Orang Tua</label>
            <input type="text" id="parents_telephone_number" name="parents_telephone_number" placeholder="Silahkan Masukkan Nomor Telepon Orang Tua ..." value="{{ old('parents_telephone_number', $user->parents_telephone_number) }}">
            <div class="text-danger">
                @error('parents_telephone_number')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <!-- Input khusus untuk pelatih -->
    <div id="pelatih-fields" class="form-group" style="display: none;">
        <h3>Edit Data Pelatih</h3>

        <div class="form-group">
            <label>Kategori Pelatih</label>
            <select name="coach_category">
                <option value="">Pilih Kategori</option>
                <option value="Pelatih Kepala" {{ old('coach_category', $user->coach_category) == 'Pelatih Kepala' ? 'selected' : '' }}>Pelatih Kepala</option>
                <option value="Asisten Pelatih" {{ old('coach_category', $user->coach_category) == 'Asisten Pelatih' ? 'selected' : '' }}>Asisten Pelatih</option>
                <option value="Pelatih Kiper" {{ old('coach_category', $user->coach_category) == 'Pelatih Kiper' ? 'selected' : '' }}>Pelatih Kiper</option>
                <option value="Pelatih Kebugaran Fisik" {{ old('coach_category', $user->coach_category) == 'Pelatih Kebugaran Fisik' ? 'selected' : '' }}>Pelatih Kebugaran Fisik</option>
            </select>
            <div class="text-danger">
                @error('coach_category')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Kategori Pelatih Kelompok Usia</label>
            <select name="age_group_coach_category">
                <option value="">Pilih Kategori</option>
                <option value="U-16" {{ old('age_group_coach_category', $user->age_group_coach_category) == 'U-16' ? 'selected' : '' }}>U-16</option>
                <option value="U-19" {{ old('age_group_coach_category', $user->age_group_coach_category) == 'U-19' ? 'selected' : '' }}>U-19</option>
                <option value="U-21" {{ old('age_group_coach_category', $user->age_group_coach_category) == 'U-21' ? 'selected' : '' }}>U-21</option>
                <option value="Senior" {{ old('age_group_coach_category', $user->age_group_coach_category) == 'Senior' ? 'selected' : '' }}>Senior</option>
            </select>
            <div class="text-danger">
                @error('age_group_coach_category')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <button type="submit">Ubah Data</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const siswaFields = document.getElementById('siswa-fields');
    const pelatihFields = document.getElementById('pelatih-fields');

    function toggleFieldsByRole(role) {
        if (role === 'siswa') {
            siswaFields.style.display = 'block';
            pelatihFields.style.display = 'none';
        } else if (role === 'pelatih') {
            pelatihFields.style.display = 'block';
            siswaFields.style.display = 'none';
        } else {
            siswaFields.style.display = 'none';
            pelatihFields.style.display = 'none';
        }
    }

    roleSelect.addEventListener('change', function() {
        toggleFieldsByRole(roleSelect.value);
    });

    toggleFieldsByRole(roleSelect.value);
});
</script>

@endsection
