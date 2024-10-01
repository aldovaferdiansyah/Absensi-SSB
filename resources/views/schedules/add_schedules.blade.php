@extends('layout.v_template')

@section('title', 'Tambah Jadwal')
@section('content')

<link rel="stylesheet" href="{{ asset('style/schedule.css') }}">

    <form action="{{ route('schedules.store') }}" method="POST" enctype="multipart/form-data">
        <h2>Tambah Jadwal</h2>
        @csrf
        <div class="form-group">
            <label>Judul Kegiatan</label>
            <select id="title" name="title">
                <option value="">Pilih Kategori</option>
                <option value="Latihan" {{ old('title') == 'Latihan' ? 'selected' : '' }}>Latihan</option>
                <option value="Pertandingan" {{ old('title') == 'Pertandingan' ? 'selected' : '' }}>Pertandingan</option>
            </select>
            <div class="text-danger">
                @error('title')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Tanggal Kegiatan</label>
            <input type="date" id="date" name="date" value="{{ old('date') }}">
            <div class="text-danger">
                @error('date')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Deskripsi Kegiatan</label>
            <input type="text" id="description" placeholder="Silahkan Masukkan Deskripsi Kegiatan ..." name="description" value="{{ old('description') }}">
            <div class="text-danger">
                @error('date')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Waktu Mulai Kegiatan</label>
            <input type="time" id="time_start" name="time_start" value="{{ old('time_start') }}">
            <div class="text-danger">
                @error('time_start')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Waktu Selesai Kegiatan</label>
            <input type="time" id="time_end" name="time_end" value="{{ old('time_end') }}">
            <div class="text-danger">
                @error('time_end')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Tambahkan Jadwal</button>
    </form>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    @endif
</script>

@endsection
