@extends('layout.v_template')

@section('title', 'Detail Pelatih')
@section('content')

<link rel="stylesheet" href="{{ asset('style/pelatih/detailPelatih.css') }}">

    <div class="card">
        <img src="{{ url('/'. $pelatih->photo) }}" alt="{{ $pelatih->name }}">
        <div class="container">
            <h4><b>{{ $pelatih->name }}</b></h4>
            <p class="detail-label">Email:</p>
            <p>{{ $pelatih->email }}</p>
            <p class="detail-label">Jenis Kelamin:</p>
            <p>{{ $pelatih->gender }}</p>
            <p class="detail-label">Tanggal Lahir:</p>
            <p>{{ $pelatih->date_of_birth->format('d M Y') }}</p>
            <p class="detail-label">Kategori Pelatih:</p>
            <p>{{ $pelatih->coach_category }}</p>
            <p class="detail-label">Kategori Pelatih Kelompok Usia:</p>
            <p>{{ $pelatih->age_group_coach_category }}</p>
            <p class="detail-label">Nomor Telepon:</p>
            <p>{{ $pelatih->phone_number }}</p>
            <p class="detail-label">Alamat:</p>
            <p>{{ $pelatih->address }}</p>
        </div>
    </div>

@endsection
