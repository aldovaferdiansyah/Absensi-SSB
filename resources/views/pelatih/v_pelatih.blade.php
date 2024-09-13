@extends('layout.v_template')

@section('title', 'Informasi Pelatih')
@section('content')

<link rel="stylesheet" href="{{ asset('style/pelatih/pelatih.css') }}">

<div class="container">
    <h1>Informasi Pelatih</h1>

    @if (session('pesan'))
        <div class="success">
            {{ session('pesan') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Foto Pelatih</th>
                <th>Nama Pelatih</th>
                <th>Usia</th>
                <th>Kategori Pelatih</th>
                <th>Pelatih Kelompok Usia</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelatih as $data)
                <tr>
                    <td data-label="Foto Pelatih">
                        <img src="{{ asset('/' . $data->photo) }}" alt="{{ $data->name }}">
                    </td>
                    <td data-label="Nama Pelatih">{{ $data->name }}</td>
                    <td data-label="Jenis Kelamin">{{ $data->gender }}</td>
                    <td data-label="Kategori Pelatih">{{ $data->coach_category }}</td>
                    <td data-label="Pelatih Kelompok Usia">{{ $data->age_group_coach_category }}</td>
                    <td>
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('pelatih.qr-code', ['id' => $data->id]) }}" class="action-btn detail-btn fa fa-qrcode"> QR Code</a>
                        @endif
                        <a href="/pelatih/detail/{{ $data->id }}" class="action-btn detail-btn fa fa-info-circle"> Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
