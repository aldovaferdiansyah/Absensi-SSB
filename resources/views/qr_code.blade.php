@extends('layout.v_template')

@section('title', 'QR Code User')
@section('content')

<link rel="stylesheet" href="{{ asset('style/codeQR.css') }}">

<div class="container">
    <div class="id-card">
        <div class="card-header">
            <h1><strong>{{ $pelatih->name ?? $student->name }}</strong></h1>
            <p>
                <strong>
                    @if (isset($pelatih))
                        Staff Pelatih
                    @elseif (isset($student))
                        Siswa
                    @endif
                </strong>
            </p>
            <p>
                <strong>
                    @if (isset($pelatih))
                        Kelompok Umur : {{ $pelatih->age_group_coach_category }}
                    @elseif (isset($student))
                        Kelompok Umur : {{ $student->age_group_category }}
                    @endif
                </strong>
            </p>
        </div>
        <div class="card-body">
            <div class="qr-code">
                {!! $qrCode !!}
            </div>
            <p><strong>Email: {{ $pelatih->email ?? $student->email }} </strong><br>
                <strong>Nomor Telepon: {{ $pelatih->phone_number ?? $student->phone_number }} </strong><br>
                <strong>Alamat: {{ $pelatih->address ?? $student->address }} </strong></p>
        </div>
    </div>

    <div class="button-group">
        <a class="button-link" onclick="window.print()">Cetak Kartu Absensi</a>
        @if (isset($pelatih))
            <a href="{{ route('pelatih.index') }}" class="button-link">Kembali ke Daftar Pelatih</a>
        @elseif (isset($student))
            <a href="{{ route('students.index') }}" class="button-link">Kembali ke Daftar Siswa</a>
        @endif
    </div>
</div>

@endsection
