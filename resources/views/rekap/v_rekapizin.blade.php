@extends('layout.v_template')

@section('title', 'Rekap Izin')
@section('content')

<link rel="stylesheet" href="{{ asset('style/rekap/rekapIzin.css') }}">

<div class="container">
    <div class="header">
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
            <h1>Rekap Izin</h1>
            <button class="print-button fa fa-print" onclick="window.print()"> Cetak</button>
        @endif
        @if (auth()->user()->hasRole('siswa'))
            <h1>Status Pengajuan</h1>
        @endif
    </div>

    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
    <div class="filters">
        <form method="GET" action="{{ route('rekapizin.index') }}" style="display: flex; flex-wrap: wrap; align-items: center;">

            <label for="name">Cari Nama:</label>
            <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Masukkan Nama ..." class="full-width">

            <label for="date">Pilih Tanggal:</label>
            <input type="date" id="date" name="date" value="{{ request('date') }}" class="one-third-width">

            <label for="month">Pilih Bulan:</label>
            <select id="month" name="month" class="one-third-width">
                <option value="">-- Semua Bulan --</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select>

            <button type="submit" class="filter-button">Tampilkan</button>
        </form>
    </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
                <th>Tanggal Akhir</th>
                <th>Alasan</th>
                <th>Jenis Izin</th>
                @endif
                <th>Status</th>
                @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
                <th class="bukti">Bukti</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($izins as $izin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $izin->name }}</td>
                    <td>{{ $izin->start_date }}</td>
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
                    <td>{{ $izin->end_date }}</td>
                    <td>{{ $izin->reason }}</td>
                    <td>{{ $izin->type }}</td>
                    @endif
                    <td>{{ $izin->status}}</td>
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
                    <td class="bukti">
                        @if($izin->proof)
                            <a href="{{ asset('uploads/' . $izin->proof) }}" target="_blank" class="btn btn-primary fa fa-picture-o"> Bukti</a>
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
