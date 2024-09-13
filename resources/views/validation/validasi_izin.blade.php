@extends('layout.v_template')

@section('title', 'Validasi Pengajuan Izin')
@section('content')

<link rel="stylesheet" href="{{ asset('style/validasiIzin.css') }}">

<div class="container">
    <div class="header">
        <h1>Validasi Pengajuan Izin</h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>Alasan</th>
                <th>Jenis Izin</th>
                <th>Bukti</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($izins as $izin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $izin->name }}</td>
                    <td>{{ $izin->start_date->format('d M Y') }}</td>
                    <td>{{ $izin->end_date->format('d M Y') }}</td>
                    <td>{{ $izin->reason }}</td>
                    <td>{{ $izin->type }}</td>
                    <td>
                        @if($izin->proof)
                            <a href="{{ asset('uploads/' . $izin->proof) }}" target="_blank" class="btn btn-primary fa fa-picture-o"> Bukti</a>
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('izin.validate', $izin->id) }}" method="POST">
                            @csrf
                            <button type="submit" name="status" value="Diterima" class="btn btn-success fa fa-check-square"> Diterima</button>
                            <button type="submit" name="status" value="Ditolak" class="btn btn-danger fa fa-window-close"> Ditolak</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
