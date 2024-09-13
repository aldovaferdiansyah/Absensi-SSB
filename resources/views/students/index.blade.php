@extends('layout.v_template')

@section('title', 'Informasi Siswa')
@section('content')

<link rel="stylesheet" href="{{ asset('style/siswa/siswa.css') }}">

<div class="container">
    <h1>Informasi Siswa</h1>

    @if (session('pesan'))
        <div class="success">
            {{ session('pesan') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Foto Siswa</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Kategori Kelompok Usia</th>
                <th>Nomor Telephone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $data)
                <tr>
                    <td data-label="Foto Siswa">
                        <img src="{{ asset('/' . $data->photo) }}" alt="{{ $data->name }}">
                    </td>
                    <td data-label="Nama Siswa">{{ $data->name }}</td>
                    <td data-label="Jenis Kelamin">{{ $data->gender }}</td>
                    <td data-label="Kategori Kelompok Usia">{{ $data->age_group_category }}</td>
                    <td data-label="Nomor Telephone">{{ $data->phone_number }}</td>
                    <td>
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('student.qr-code', ['id' => $data->id]) }}" class="action-btn detail-btn fa fa-qrcode"> Qr Code</a>
                        @endif
                        <a href="/siswa/detail/{{ $data->id }}" class="action-btn detail-btn fa fa-info-circle"> Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
