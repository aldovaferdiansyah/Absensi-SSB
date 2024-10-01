<ul class="sidebar-menu" data-widget="tree">

        <li class="{{ request()->is('v_home') ? 'active' : '' }}"><a href="/v_home"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="{{ request()->is('dashboard.v_dashboard') ? 'active' : '' }}"><a href="/dashboard.v_dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

        <!-- hak akses admin -->
        @if (auth()->user()->hasRole('admin'))
            <li class="{{ request()->is('users') ? 'active' : '' }}"><a href="/users"><i class="fa fa-users"></i> <span>Data Users</span></a></li>
        @endif

        <!-- hak akses admin dan siswa -->
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('siswa'))
            <li class="{{ request()->is('pelatih.index') ? 'active' : '' }}"><a href="/pelatih.index"><i class="fa fa-user"></i> <span>Data Pelatih</span></a></li>
        @endif

        <!-- hak akses admin dan pelatih -->
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->is('students.index') ? 'active' : '' }}"><a href="/students.index"><i class="fa fa-user"></i> <span>Data Siswa</span></a></li>
        @endif

        <!-- hak akses siswa dan pelatih -->
        @if (auth()->user()->hasRole('siswa') || auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->is('/scanner.scannerAbsensi') ? 'active' : '' }}"><a href="/scanner.scannerAbsensi"><i class="fa fa-camera"></i> <span>Scanner Presensi</span></a></li>
        @endif

        <!-- hak akses siswa -->
        @if (auth()->user()->hasRole('siswa'))
        <li class="{{ request()->routeIs('attendances.absenSiswa') ? 'active' : '' }}"><a href="{{ route('attendances.absenSiswa') }}"><i class="fa fa-book"></i><span>Laporan Presensi Pribadi</span></a></li>
        @endif

        <!-- hak akses pelatih -->
        @if (auth()->user()->hasRole('pelatih'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Data Laporan Presensi</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->routeIs('attendances.absenPelatih') ? 'active' : '' }}">
                        <a href="{{ route('attendances.absenPelatih') }}">
                            <i class="fa fa-circle-o"></i><span>Laporan Presensi Pribadi</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('attendances.absenSiswa') ? 'active' : '' }}">
                        <a href="{{ route('attendances.absenSiswa') }}">
                            <i class="fa fa-circle-o"></i><span>Laporan Presensi Siswa</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('rekap.v_rekapizin') ? 'active' : '' }}">
                        <a href="/rekap.v_rekapizin">
                            <i class="fa fa-circle-o"></i><span>Laporan Pengajuan Izin</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('report.siswa') ? 'active' : '' }}">
                <a href="{{ route('report.siswa') }}">
                    <i class="fa fa-line-chart"></i>
                    <span>Data Rekap Presensi Siswa</span>
                </a>
            </li>
        @endif

        <!-- hak akses admin -->
        @if (auth()->user()->hasRole('admin'))
            <li class="treeview">
            <a href="#">
                <i class="fa fa-book"></i>
                <span>Data Laporan Presensi</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->routeIs('attendances.absenPelatih') ? 'active' : '' }}">
                    <a href="{{ route('attendances.absenPelatih') }}">
                        <i class="fa fa-circle-o"></i> <span>Laporan Presensi Pelatih</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('attendances.absenSiswa') ? 'active' : '' }}">
                    <a href="{{ route('attendances.absenSiswa') }}">
                        <i class="fa fa-circle-o"></i> <span>Laporan Presensi Siswa</span>
                    </a>
                </li>
                <li class="{{ request()->is('rekap.v_rekapizin') ? 'active' : '' }}">
                    <a href="/rekap.v_rekapizin">
                        <i class="fa fa-circle-o"></i> <span>Laporan Pengajuan Izin</span>
                    </a>
                </li>
            </ul>
            </li>

            <li class="treeview">
            <a href="#">
                <i class="fa fa-line-chart"></i>
                <span>Data Rekap Presensi</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->routeIs('report.pelatih') ? 'active' : '' }}">
                    <a href="{{ route('report.pelatih') }}">
                        <i class="fa fa-circle-o"></i>
                        <span>Data Rekap Presensi Pelatih</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('report.siswa') ? 'active' : '' }}">
                    <a href="{{ route('report.siswa') }}">
                        <i class="fa fa-circle-o"></i>
                        <span>Data Rekap Presensi Siswa</span>
                    </a>
                </li>
            </ul>
            </li>
        @endif

        @if (auth()->user()->hasRole('siswa') || auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->is('permission.pengajuanizin') ? 'active' : '' }}"><a href="/permission.pengajuanizin"><i class="fa fa-file-text-o"></i> <span>Pengajuan Izin</span></a></li>
        @endif

        @if (auth()->user()->hasRole('admin'))
            <li class="{{ request()->routeIs('izin.validate.index') ? 'active' : '' }}">
                <a href="{{ route('izin.validate.index') }}">
                    <i class="fa fa-file-text"></i> <span>Validasi Izin Pelatih</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->routeIs('izin.validate.index') ? 'active' : '' }}">
                <a href="{{ route('izin.validate.index') }}">
                    <i class="fa fa-file-text"></i> <span>Validasi Izin Siswa</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->routeIs('schedules.index') ? 'active' : '' }}">
                <a href="{{ route('schedules.index') }}">
                    <i class="fa fa-calendar"></i> <span>Jadwal Kegiatan</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->is('settingscanner') ? 'active' : '' }}">
                <a href="{{ route('settingscanner') }}">
                    <i class="fa fa-cogs"></i> <span>Pengaturan Scanner</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->hasRole('admin'))
            <li class="{{ request()->is('settings') ? '' : '' }}">
                <a href="{{ route('settings.index') }}">
                    <i class="fa fa-cog"></i>
                    <span>Pengaturan Data SSB</span>
                </a>
            </li>
        @endif

        <li>
            <a href="#" onclick="event.preventDefault(); confirmLogout();">
                <i class="fa fa-sign-out" style="color: red;"></i> <span style="color:red;">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
</ul>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
  function confirmLogout() {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Anda akan keluar dari sesi ini.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#28a745',
      confirmButtonText: 'Ya, Logout!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
      }
    });
  }
</script>
