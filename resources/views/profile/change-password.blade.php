@extends('layout.v_template')

@section('title', 'Ubah Password')
@section('content')

<link rel="stylesheet" href="{{ asset('style/profile/ubahPasswordProfile.css') }}">

<div class="form-container">
    <form action="{{ route('profile.change-password.post') }}" method="POST">
        @csrf

        <h2>Ubah Password</h2>

        <div class="form-group">
            <label>Password Saat Ini</label>
            <input type="password" name="current_password" placeholder="Silahkan Masukkan Password Saat Ini ..." value="{{ old('current_password') }}">
            <div class="text-danger">
                @error('current_password')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="new_password" placeholder="Silahkan Masukkan Password Baru Anda ..." value="{{ old('new_password') }}">
            <div class="text-danger">
                @error('new_password')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Confirm Password Baru</label>
            <input type="password" name="new_password_confirmation" placeholder="Konfirmasi Password Baru Anda ..." value="{{ old('new_password_confirmation') }}">
            <div class="text-danger">
                @error('new_password_confirmation')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit">Ubah Password</button>
        </div>
    </form>
</div>
@endsection
