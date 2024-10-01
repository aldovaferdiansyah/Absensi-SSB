@extends('layout.v_template')

@section('title', 'Daftar Jadwal Kegiatan')
@section('content')

<link rel="stylesheet" href="{{ asset('style/dataAkun/dataAkun.css') }}">

<div class="container">
    <div class="header">
        <h1>Daftar Jadwal Kegiatan</h1>
    </div>

    <a href="{{ route('schedules.create') }}" class="btn-tambah fa fa-plus-square"> Jadwal Baru</a>

    <div class="filters">
        <form method="GET" action="{{ route('schedules.index') }}" style="display: flex; flex-wrap: wrap; align-items: center;">

            <label for="date">Pilih Tanggal :</label>
            <input type="date" id="date" name="date" value="{{ request('date') }}" class="one-third-width">

            <label for="month">Pilih Bulan :</label>
            <select id="month" name="month" class="one-third-width">
                <option value="">-- Semua Bulan --</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
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
        </form>
    </div>


    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Judul Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Deskripsi Kegiatan</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $data)
                <tr>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->date->format('d M Y') }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->time_start }}</td>
                    <td>{{ $data->time_end }}</td>
                    <td>
                        @if (!$data->hasRole('admin'))
                        <a href="{{ route('schedules.edit', $data->id) }}" class="btn btn-warning fa fa-pencil-square-o"> Edit</a>
                            <form id="delete-form-{{ $data->id }}" action="{{ route('schedules.destroy', $data->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger fa fa-trash" onclick="confirmDelete('{{ $data->id }}')"> Hapus</button>
                            </form>
                        @else
                            <button type="button" class="btn btn-secondary fa fa-trash" disabled> Hapus</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data ini akan dihapus secara permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#28a745',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>

@endsection
