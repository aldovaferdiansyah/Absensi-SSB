@extends('layout.v_template')

@section('title', 'Dashboard')
@section('content')

<link rel="stylesheet" href="{{ asset('style/dashboard.css') }}">

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

    @if (auth()->user()->hasRole('siswa'))
        <div class="grid-item">
            <div class="responsive-box">
                <div class="small-box bg-location">
                    <div class="inner">
                        <h3>Lokasi Lapang</h3>
                        <p>
                            <a href="{{ route('settingscanner') }}" class="custom-link">
                                <span>Klick detail</span>
                            </a>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasRole('siswa'))
        <div class="grid-item">
            <div class="izin-box">
                <div class="small-box bg-siswa">
                    <div class="inner">
                        <h3>{{ $totalAgendaThisMonth }}</h3>
                        <p>Total Agenda Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-files-o"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="absen-box">
                <div class="small-box bg-pelatih">
                    <div class="inner">
                        <h3>{{ $totalAbsenThisMonth }}</h3>
                        <p>Total Absen Bulan Ini (Pribadi)</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="pelatih-box">
                <div class="small-box bg-izin">
                    <div class="inner">
                        <h3>{{ round($personalAttendancePercentage, 2) }}%</h3>
                        <p>Kehadiran Pribadi Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="siswa-box">
                <div class="small-box bg-absen">
                    <div class="inner">
                        <h3>{{ round($ontimePercentageUser, 2) }}%</h3>
                        <p>Hadir Tepat Waktu Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasRole('pelatih'))
        <div class="grid-item">
            <div class="izin-box">
                <div class="small-box bg-siswa">
                    <div class="inner">
                        <h3>{{ $totalAgendaThisMonth }}</h3>
                        <p>Total Agenda Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-files-o"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="absen-box">
                <div class="small-box bg-pelatih">
                    <div class="inner">
                        <h3>{{ $totalAbsenThisMonth }}</h3>
                        <p>Total Absen Bulan Ini (Pribadi)</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="pelatih-box">
                <div class="small-box bg-izin">
                    <div class="inner">
                        <h3>{{ round($personalAttendancePercentage, 2) }}%</h3>
                        <p>Kehadiran Pribadi Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="siswa-box">
                <div class="small-box bg-absen">
                    <div class="inner">
                        <h3>{{ round($ontimePercentageUser, 2) }}%</h3>
                        <p>Hadir Tepat Waktu Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="izin-box">
                <div class="small-box bg-users">
                    <div class="inner">
                        <h3>{{ $pendingRequests }}</h3>
                        <p>Permohonan Pengajuan Izin</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-files-o"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasRole('admin'))
        <div class="grid-item">
            <div class="izin-box">
                <div class="small-box bg-users">
                    <div class="inner">
                        <h3>{{ $totalAgendaThisMonth }}</h3>
                        <p>Total Agenda Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-files-o"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="absen-box">
                <div class="small-box bg-absen">
                    <div class="inner">
                        <h3>{{ $attendanceToday }}</h3>
                        <p>Total Absen hari ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="siswa-box">
                <div class="small-box bg-siswa">
                    <div class="inner">
                        <h3>{{ round($ontimeAttendancePercentage, 2) }}%</h3>
                        <p>Kehadiran Tepat Waktu Bulan Ini</p>
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
                        <h3>{{ round($lateAttendancePercentage, 2) }}%</h3>
                        <p>Kehadiran Terlambat Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item">
            <div class="izin-box">
                <div class="small-box bg-izin">
                    <div class="inner">
                        <h3>{{ $pendingRequests }}</h3>
                        <p>Permohonan Pengajuan Izin</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-files-o"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@if (auth()->user()->hasRole('admin'))
    <div class="grid-container-two">
        <a href="{{ route('report.siswa') }}">
            <div class="grid-item-chart">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chart Rekap Presensi Kehadiran Siswa (%)</h3>
                    </div>
                    <div class="box-body chart-responsive">
                        <canvas id="student-chart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('report.pelatih') }}">
            <div class="grid-item-chart">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chart Rekap Presensi Kehadiran Pelatih (%)</h3>
                    </div>
                    <div class="box-body chart-responsive">
                        <canvas id="coach-chart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endif

@if (auth()->user()->hasRole('pelatih'))
    <div class="grid-container-khususpelatih">
        <a href="{{ route('report.siswa') }}">
            <div class="grid-item-chart-khususpelatih">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chart Rekap Presensi Kehadiran Siswa (%)</h3>
                    </div>
                    <div class="box-body chart-responsive">
                        <canvas id="student-chart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endif

@if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih') || auth()->user()->hasRole('siswa'))
    <div class="grid-container-three">
        <div class="grid-item">
            <div class="box box-solid bg-blue-gradient p-4 rounded">
                <div class="box-header">
                    <i class="fa fa-calendar"></i>
                    <h3 class="box-title">Kalender</h3>
                </div>
                <div class="calendar-container">
                    <div class="calendar-wrapper">
                        <div class="calendar-navigation">
                            <button id="prevMonth" class="nav-button">&laquo;</button>
                            <span id="calendarMonthYear" class="calendar-month-year"></span>
                            <button id="nextMonth" class="nav-button">&raquo;</button>
                        </div>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script src="{{ asset('js/dashboard.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const studentData = {!! json_encode($studentAttendance) !!};
    const coachData = {!! json_encode($pelatihAttendance) !!};

    const studentsMonth = studentData.map(s => s.month);
    const studentPercentages = studentData.map(s => s.attendance_percentage);

    const ctx1 = document.getElementById('student-chart').getContext('2d');
    const studentChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: studentsMonth,
            datasets: [{
                label: 'Persentase Kehadiran',
                data: studentPercentages,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Total Siswa',
                data: Array(studentsMonth.length).fill({{ $studentCount }}),
                backgroundColor: 'rgba(128, 0, 128, 0.3)',
                borderColor: 'rgba(128, 0, 128, 1)',
                borderWidth: 1,
                type: 'line'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });

    const coachMonth = coachData.map(c => c.month);
    const coachPercentages = coachData.map(c => c.attendance_percentage);

    const ctx2 = document.getElementById('coach-chart').getContext('2d');
    const coachChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: coachMonth,
            datasets: [{
                label: 'Persentase Kehadiran',
                data: coachPercentages,
                backgroundColor: 'rgba(128, 0, 128, 0.6)',
                borderColor: 'rgba(128, 0, 128, 1)',
                borderWidth: 1
            }, {
                label: 'Total Pelatih',
                data: Array(coachMonth.length).fill({{ $pelatihCount }}),
                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                type: 'line'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const schedules = {!! json_encode($schedules) !!};
    console.log(schedules);

    createCalendar(currentMonth, currentYear, schedules);
});
</script>

@endsection
