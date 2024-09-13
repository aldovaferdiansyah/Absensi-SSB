@extends('layout.v_template')

@section('title', 'Settings')
@section('content')

<link rel="stylesheet" href="{{ asset('style/settings.css') }}">

<div class="container">
    <h2>Update Settings</h2>

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_SSB">Nama SSB</label>
            <input type="text" name="nama_SSB" id="nama_SSB" value="{{ old('nama_SSB', $settings->nama_SSB ?? '') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $settings->alamat ?? '') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="logo_SSB">Logo SSB</label>
            <input type="file" name="logo_SSB" id="logo_SSB" class="form-control">
            @if(isset($settings->logo_SSB))
                <div class="mt-2">
                    <img src="{{ asset('foto_logo/' . $settings->logo_SSB) }}" alt="Current Logo" class="img-logo">
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="profile_title">Judul Profil</label>
            <input type="text" name="profile_title" id="profile_title" value="{{ old('profile_title', $settings->profile_title ?? '') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="profile_content">Konten Profil</label>
            <textarea name="profile_content" id="profile_content" class="form-control">{{ old('profile_content', $settings->profile_content ?? '') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    @endif
</script>

@endsection
