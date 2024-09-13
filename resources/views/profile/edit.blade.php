@extends('layout.v_template')

@section('title', 'Edit Data Diri Profile')
@section('content')

<link rel="stylesheet" href="{{ asset('style/profile/editProfile.css') }}">

    <div class="form-container">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if(auth()->user()->hasRole('siswa'))
                <h2>Edit Data Profile</h2>

                <div class="form-group">
                    <label>Email</label> <br>
                    @if (!Auth::user()->hasRole('admin'))
                        <small class="form-text text-muted" style="color: red;">Email Hanya Dapat Diubah Oleh Admin.</small>
                    @endif
                    <input type="email" name="email" placeholder="Silahkan Masukkan Email ..." value="{{ old('email', $profile->email) }}" class="{{ Auth::user()->hasRole('admin') ? '' : 'input-readonly' }}" {{ Auth::user()->hasRole('admin') ? '' : 'readonly' }}>
                    <div class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Silahkan Masukkan Nama ..." value="{{ old('name', $profile->name) }}">
                    <div class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select id="gender" name="gender">
                        <option value="">Pilih Kategori</option>
                        <option value="Laki-laki" {{ old('gender', $profile->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $profile->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <div class="text-danger">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '') }}">
                    <div class="text-danger">
                        @error('date_of_birth')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Kategori Kelompok Usia</label> <br>
                    @if (!Auth::user()->hasRole('admin'))
                        <small class="form-text text-muted" style="color: red;">Kategori Kelompok Usia Hanya Dapat Diubah Oleh Admin.</small>
                    @endif
                    <input type="text" id="age_group_category" name="age_group_category" value="{{ old('age_group_category', $profile->age_group_category) }}" class="{{ Auth::user()->hasRole('admin') ? '' : 'input-readonly' }}" {{ Auth::user()->hasRole('admin') ? '' : 'readonly' }}">
                    <div class="text-danger">
                        @error('age_group_category')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Nomor Handphone</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}">
                    <div class="text-danger">
                        @error('phone_number')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Orang Tua</label> <br>
                    @if (!Auth::user()->hasRole('admin'))
                        <small class="form-text text-muted" style="color: red;">Nama Orang Tua Hanya Dapat Diubah Oleh Admin.</small>
                    @endif
                    <input type="text" id="parents_name" name="parents_name" value="{{ old('parents_name', $profile->parents_name) }}" class="{{ Auth::user()->hasRole('admin') ? '' : 'input-readonly' }}" {{ Auth::user()->hasRole('admin') ? '' : 'readonly' }}">
                    <div class="text-danger">
                        @error('parents_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Nomor Handphone Orang Tua</label> <br>
                    @if (!Auth::user()->hasRole('admin'))
                        <small class="form-text text-muted" style="color: red;">Nomor Hp Orang Tua Hanya Dapat Diubah Oleh Admin.</small>
                    @endif
                    <input type="text" id="parents_telephone_number" name="parents_telephone_number" value="{{ old('parents_telephone_number', $profile->parents_telephone_number) }}" class="{{ Auth::user()->hasRole('admin') ? '' : 'input-readonly' }}" {{ Auth::user()->hasRole('admin') ? '' : 'readonly' }}">
                    <div class="text-danger">
                        @error('parents_telephone_number')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Silahkan Masukkan Alamat ..." value="{{ old('address', $profile->address) }}">
                    <div class="text-danger">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            @endif

            @if(auth()->user()->hasRole('pelatih'))
                <h2>Edit Data Profile</h2>

                <div class="form-group">
                    <label>Email</label> <br>
                    @if (!Auth::user()->hasRole('admin'))
                        <small class="form-text text-muted" style="color: red;">Email Hanya Dapat Diubah Oleh Admin.</small>
                    @endif
                    <input type="email" name="email" placeholder="Silahkan Masukkan Email ..." value="{{ old('email', $profile->email) }}" class="{{ Auth::user()->hasRole('admin') ? '' : 'input-readonly' }}" {{ Auth::user()->hasRole('admin') ? '' : 'readonly' }}>
                    <div class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Pelatih</label>
                    <input type="text" name="name" placeholder="Silahkan Masukkan Nama Pelatih ..." value="{{ old('name', $profile->name) }}">
                    <div class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="gender">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('gender', $profile->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $profile->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <div class="text-danger">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '') }}">
                    <div class="text-danger">
                        @error('date_of_birth')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Kategori Pelatih</label> <br>
                    @if (!Auth::user()->hasRole('admin'))
                        <small class="form-text text-muted" style="color: red;">Kategori Pelatih Hanya Dapat Diubah Oleh Admin.</small>
                    @endif
                    <input type="text" name="coach_category" placeholder="Silahkan Masukkan Kategori Pelatih ..." value="{{ old('coach_category', $profile->coach_category) }}" class="{{ Auth::user()->hasRole('admin') ? '' : 'input-readonly' }}" {{ Auth::user()->hasRole('admin') ? '' : 'readonly' }}>
                </div>

                <div class="form-group">
                    <label>Pelatih Kelompok Usia</label> <br>
                    @if (!Auth::user()->hasRole('admin'))
                        <small class="form-text text-muted" style="color: red;">Kategori Pelatih Kelompok Usia Hanya Dapat Diubah Oleh Admin.</small>
                    @endif
                    <input type="text" name="age_group_coach_category" placeholder="Silahkan Masukkan Kelompok Usia ..." value="{{ old('age_group_coach_category', $profile->age_group_coach_category) }}" class="{{ Auth::user()->hasRole('admin') ? '' : 'input-readonly' }}" {{ Auth::user()->hasRole('admin') ? '' : 'readonly' }}>
                </div>

                <div class="form-group">
                    <label>Nomor Handphone</label>
                    <input type="text" name="phone_number" placeholder="Silahkan Masukkan Nomor Telephone Pelatih ..." value="{{ old('phone_number', $profile->phone_number) }}">
                    <div class="text-danger">
                        @error('phone_number')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" placeholder="Silahkan Masukkan Alamat Pelatih ..." value="{{ old('address', $profile->address) }}">
                    <div class="text-danger">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            @endif

            <button type="submit">Ubah Data Profile</button>
        </form>
    </div>
@endsection
