@extends('layout.v_template')

@section('title', 'Informasi Siswa')
@section('content')

<link rel="stylesheet" href="{{ asset('style/siswa/siswa.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                <th>Kategori Usia</th>
                @if (auth()->user()->hasRole('admin'))
                    <th>Nomor Telephone</th>
                @endif
                <th>Status</th>
                @if (auth()->user()->hasRole('admin'))
                    <th></th>
                @endif
                @if (auth()->user()->hasRole('pelatih'))
                    <th>Action</th>
                    <th>Catatkan Presensi Siswa</th>
                @endif
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
                    @if (auth()->user()->hasRole('admin'))
                        <td data-label="Nomor Telephone">{{ $data->phone_number }}</td>
                    @endif
                    <td data-label="Status User">{{ $data->status_user }}</td>
                    <td>
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('student.qr-code', ['id' => $data->id]) }}" class="action-btn detail-btn fa fa-qrcode"> Qr Code</a>
                        @endif
                        <a href="/siswa/detail/{{ $data->id }}" class="action-btn detail-btn fa fa-info-circle"> Detail</a>
                    </td>
                    @if (auth()->user()->hasRole('pelatih'))
                    <td>
                        <button type="button" class="action-btn kehadiran_siswa-btn fa fa-check-circle"
                                onclick="manualAttendance({{ $data->id }}, 'arrival_at')" data-user-id="{{ $data->id }}">
                            Kedatangan
                        </button>
                        <button type="button" class="action-btn kehadiran_siswa-btn fa fa-check-circle"
                                onclick="manualDeparture({{ $data->id }}, 'departure_at')" data-user-id="{{ $data->id }}">
                            Kepulangan
                        </button>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<script>
function manualAttendance(userId, type) {
    let token = '{{ csrf_token() }}';

    fetch('/pelatih/attendance/manual', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            user_id: userId,
            type: type
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.success
            });
        } else if (data.error) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: data.error
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Terjadi kesalahan saat memproses permintaan.'
        });
    });
}

function manualDeparture(userId, type) {
    let token = '{{ csrf_token() }}';

    fetch('/pelatih/departure/manual', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            user_id: userId,
            type: type
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.success
            });
        } else if (data.error) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: data.error
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Terjadi kesalahan saat memproses permintaan.'
        });
    });
}
</script>
