<ul class="sidebar-menu" data-widget="tree">

        <li class="{{ request()->is('v_home') ? 'active' : '' }}"><a href="/v_home"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="{{ request()->is('dashboard.v_dashboard') ? 'active' : '' }}"><a href="/dashboard.v_dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

        <!-- hak akses admin -->
        @if (auth()->user()->hasRole('admin'))
            <li class="{{ request()->is('users') ? 'active' : '' }}"><a href="/users"><i class="fa fa-users"></i> <span>Data Users</span></a></li>
        @endif

        <!-- hak akses admin dan siswa -->
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('siswa'))
            <li class="{{ request()->is('pelatih.index') ? 'active' : '' }}"><a href="/pelatih.index"><i class="fa fa-futbol-o"></i> <span>Pelatih</span></a></li>
        @endif

        <!-- hak akses admin dan pelatih -->
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->is('students.index') ? 'active' : '' }}"><a href="/students.index"><i class="fa fa-user"></i> <span>Siswa</span></a></li>
        @endif

        <!-- hak akses siswa dan pelatih -->
        @if (auth()->user()->hasRole('siswa') || auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->is('/scanner.scannerAbsensi') ? 'active' : '' }}"><a href="/scanner.scannerAbsensi"><i class="fa fa-camera"></i> <span>Scanner Absensi</span></a></li>
        @endif

        <!-- hak akses siswa -->
        @if (auth()->user()->hasRole('siswa'))
        <li class="{{ request()->routeIs('attendances.absenSiswa') ? 'active' : '' }}"><a href="{{ route('attendances.absenSiswa') }}"><i class="fa fa-circle-o"></i><span>Rekap Absen Pribadi</span></a></li>
        @endif

        <!-- hak akses pelatih -->
        @if (auth()->user()->hasRole('pelatih'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Rekap</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->routeIs('attendances.absenPelatih') ? 'active' : '' }}">
                        <a href="{{ route('attendances.absenPelatih') }}">
                            <i class="fa fa-circle-o"></i><span>Rekap Absen Pribadi</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('attendances.absenSiswa') ? 'active' : '' }}">
                        <a href="{{ route('attendances.absenSiswa') }}">
                            <i class="fa fa-circle-o"></i><span>Rekap Absen Siswa</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('rekap.v_rekapizin') ? 'active' : '' }}">
                        <a href="/rekap.v_rekapizin">
                            <i class="fa fa-circle-o"></i><span>Rekap Pengajuan Izin</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

         <!-- hak akses admin -->
        @if (auth()->user()->hasRole('admin'))
            <li class="treeview">
            <a href="#">
                <i class="fa fa-book"></i>
                <span>Rekap Absen</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->routeIs('attendances.absenPelatih') ? 'active' : '' }}">
                    <a href="{{ route('attendances.absenPelatih') }}">
                        <i class="fa fa-circle-o"></i> <span>Rekap Absen Pelatih</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('attendances.absenSiswa') ? 'active' : '' }}">
                    <a href="{{ route('attendances.absenSiswa') }}">
                        <i class="fa fa-circle-o"></i> <span>Rekap Absen Siswa</span>
                    </a>
                </li>
                <li class="{{ request()->is('rekap.v_rekapizin') ? 'active' : '' }}">
                    <a href="/rekap.v_rekapizin">
                        <i class="fa fa-circle-o"></i> <span>Rekap Pengajuan Izin</span>
                    </a>
                </li>
            </ul>
            </li>
        @endif

        <!-- hak akses admin dan pelatih -->
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->routeIs('izin.validate.index') ? 'active' : '' }}">
                <a href="{{ route('izin.validate.index') }}">
                    <i class="fa fa-file-text"></i> <span>Validasi Izin</span>
                </a>
            </li>
        @endif

        <!-- hak akses siswa -->
        @if (auth()->user()->hasRole('siswa'))
            <li class="{{ request()->is('permission.pengajuanizin') ? 'active' : '' }}"><a href="/permission.pengajuanizin"><i class="fa fa-file-text-o"></i> <span>Pengajuan Izin</span></a></li>
        @endif

        @if (auth()->user()->hasRole('pelatih'))
            <li class="{{ request()->is('information.v_information') ? 'active' : '' }}">
                <a href="/information.v_information">
                    <i class="fa fa-info"></i> <span>Informasi</span>
                </a>
            </li>
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
                    <span>Pengaturan</span>
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
