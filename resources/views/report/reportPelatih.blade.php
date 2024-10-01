@extends('layout.v_template')

@section('title', 'Report Absen Pelatih')
@section('content')

<link rel="stylesheet" href="{{ asset('style/rekap/rekapAbsen.css') }}">

<div class="container">
    <div class="header">
        <h1>Rekap Presensi Pelatih</h1>
        <button class="print-button fa fa-print" onclick="printReport()"> Cetak</button>
    </div>

    <div class="filters">
        <form method="GET" action="{{ route('report.pelatih') }}" class="filter-form">
            <div class="name-filter">
                <label for="name">Cari Nama :</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Masukkan Nama..." class="full-width">
            </div>

            <div class="other-filters">
                <label for="month">Pilih Bulan :</label>
                <select id="month" name="month" class="one-third-width">
                    <option value="">-- Semua Bulan --</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ (request('month') == $i || (!request('month') && $i == \Carbon\Carbon::now()->month)) ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                        </option>
                    @endfor
                </select>

                <label for="year">Tahun:</label>
                <select name="year" id="year" class="one-third-width">
                    @for ($i = Carbon\Carbon::now()->year; $i >= 2000; $i--)
                        <option value="{{ $i }}" {{ (request('year') == $i) ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>

                <label for="type">Pilih Tipe Kegiatan :</label>
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
                <th>Nama Pelatih</th>
                <th>Total Agenda (Perbulan)</th>
                <th>Total Kehadiran</th>
                <th>Total Izin</th>
                <th>Presentase Kehadiran</th>
                <th>Kehadiran Tepat Waktu (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $data)
                <tr>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['total_agenda'] }}</td>
                    <td>{{ $data['total_attendance'] }}</td>
                    <td>{{ $data['total_permits'] }}</td>
                    <td>{{ number_format($data['attendance_percentage'], 2) }}%</td>
                    <td>{{ number_format($data['on_time_percentage'], 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function printReport() {
        window.print();
    }
</script>

@endsection
