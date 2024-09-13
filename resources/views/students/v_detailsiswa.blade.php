@extends('layout.v_template')

@section('title', 'Detail Siswa')
@section('content')

<link rel="stylesheet" href="{{ asset('style/siswa/detailSiswa.css') }}">

    <div class="card">
        <img src="{{ url('/'. $student->photo) }}" alt="{{ $student->name }}">
        <div class="container">
            <h4><b>{{ $student->name }}</b></h4>
            <p class="detail-label">Email:</p>
            <p>{{ $student->email }}</p>
            <p class="detail-label">Jenis Kelamin:</p>
            <p>{{ $student->gender }}</p>
            <p class="detail-label">Tanggal Lahir:</p>
            <p>{{ $student->date_of_birth->format('d M Y') }}</p>
            <p class="detail-label">Kategori kelompok Usia:</p>
            <p>{{ $student->age_group_category }}</p>
            <p class="detail-label">Nomor Telepon:</p>
            <p>{{ $student->phone_number }}</p>
            <p class="detail-label">Nama Orang Tua:</p>
            <p>{{ $student->parents_name }}</p>
            <p class="detail-label">Nomor Telephone Orang Tua:</p>
            <p>{{ $student->parents_telephone_number }}</p>
            <p class="detail-label">Alamat:</p>
            <p>{{ $student->address }}</p>
        </div>
    </div>

@endsection
