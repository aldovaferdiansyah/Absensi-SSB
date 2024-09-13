@extends('layout.v_template')

@section('title', 'Rekap Absen Siswa')
@section('content')

<link rel="stylesheet" href="{{ asset('style/rekap/rekapAbsen.css') }}">

<div class="container">
    <div class="header">
        @if (auth()->user()->hasRole('siswa'))
            <h1>Rekap Absen Pribadi</h1>
        @endif

        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
            <h1>Rekap Absen Siswa</h1>
        @endif

        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
            <button class="print-button fa fa-print" onclick="printReport()"> Cetak</button>
        @endif
    </div>

    <div class="filters">
        <form method="GET" action="{{ route('attendances.absenSiswa') }}" class="filter-form">
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
                <div class="name-filter">
                    <label for="name">Cari Nama:</label>
                    <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Masukkan Nama..." class="full-width">
                </div>
            @endif

            <div class="other-filters">
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

                <label for="type">Pilih Tipe Absensi:</label>
                <select id="type" name="type" class="one-third-width">
                    <option value="">-- Semua Tipe --</option>
                    <option value="latihan" {{ request('type') == 'latihan' ? 'selected' : '' }}>Latihan</option>
                    <option value="pertandingan" {{ request('type') == 'pertandingan' ? 'selected' : '' }}>Pertandingan</option>
                </select>

                <button type="submit" class="filter-button">Tampilkan</button>
            </div>
        </form>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Type Absensi</th>
                <th>Waktu Kedatangan</th>
                <th>Waktu Pulang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->name }}</td>
                    <td>{{ $attendance->type }}</td>
                    <td class="local-time">{{ $attendance->arrival_at->format('d M Y H:i') }}</td>
                    <td class="local-time">{{ $attendance->departure_at ? $attendance->departure_at->format('d M Y H:i') : 'Belum Pulang' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data untuk ditampilkan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function printReport() {
        window.print();
    }
</script>

@endsection
