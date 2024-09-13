@extends('layout.v_template')

@section('title', 'Dashboard')
@section('content')

<link rel="stylesheet" href="{{ asset('style/dashboard.css') }}">

    @if (auth()->user()->hasRole('siswa'))
        <div class="grid-item">
            <div class="information-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($information as $index => $info)
                        <tr>
                            <td class="text-center">{{ $info->heading }}</td>
                            <td class="text-center">{{ $info->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

<div class="grid-container">
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih') || auth()->user()->hasRole('siswa'))
        <div class="grid-item">
            <div class="responsive-box">
                <div class="small-box bg-time">
                    <div class="inner">
                        <h3 id="currentTime"></h3>
                        <p>Waktu Sekarang</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
        <div class="grid-item">
            <div class="siswa-box">
                <div class="small-box bg-siswa">
                    <div class="inner">
                        <h3>{{ $studentCount }}</h3>
                        <p>Jumlah Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="pelatih-box">
                <div class="small-box bg-pelatih">
                    <div class="inner">
                        <h3>{{ $pelatihCount }}</h3>
                        <p>Jumlah Pelatih</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="absen-box">
                <div class="small-box bg-absen">
                    <div class="inner">
                        <h3>{{ $attendanceToday }}</h3>
                        <p>Absen hari ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="izin-box">
                <div class="small-box bg-izin">
                    <div class="inner">
                        <h3>{{ $pendingRequests }}</h3>
                        <p>Pengajuan Izin</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-files-o"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih') || auth()->user()->hasRole('siswa'))
        <div class="grid-item">
            <div class="calendar-container">
                <div class="calendar-wrapper">
                    <div class="calendar-navigation">
                        <button id="prevMonth" class="nav-button">&laquo;</button>
                        <button id="nextMonth" class="nav-button">&raquo;</button>
                        <span id="calendarMonthYear" class="calendar-month-year"></span>
                    </div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    @endif






</div>
<script src="{{ asset('js/dashboard.js') }}"></script>

@endsection
