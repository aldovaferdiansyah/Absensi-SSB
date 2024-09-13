@extends('layout.v_template')

@section('title', 'Profile Pelatih')
@section('content')

<link rel="stylesheet" href="{{ asset('style/profile/profile.css') }}">

<div class="form-container">
    <div class="box box-secondary">
        <div class="box-body box-profile text-center">
            <img class="profile-user-img img-circle img-bordered-sm" src="{{ asset('/' . $profile->photo) }}" alt="{{ $profile->name }}">
            <h3 class="profile-username">{{ $profile->name }}</h3>
            <p class="text-muted">{{ $profile->email }}</p>
            <ul class="list-group list-group-unbordered text-left">
                <li class="list-group-item">
                    <b>Jenis Kelamin</b> <a class="pull-right">{{ $profile->gender }}</a>
                </li>
                <li class="list-group-item">
                    <b>Tanggal Lahir</b> <a class="pull-right">{{ $profile->date_of_birth->format('d M Y') }}</a>
                </li>
                <li class="list-group-item">
                    <b>Kategori Pelatih</b> <a class="pull-right">{{ $profile->coach_category }}</a>
                </li>
                <li class="list-group-item">
                    <b>Pelatih Kategori Kelompok Usia</b> <a class="pull-right">{{ $profile->age_group_coach_category }}</a>
                </li>
                <li class="list-group-item">
                    <b>Nomor Handphone</b> <a class="pull-right">{{ $profile->phone_number }}</a>
                </li>
                <li class="list-group-item">
                    <b>Alamat</b> <a class="pull-right">{{ $profile->address }}</a>
                </li>
            </ul>

            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block">Edit Data Profile</a>
            <a href="{{ route('profile.change-password') }}" class="btn btn-danger btn-block">Ubah Password</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>

@endsection
