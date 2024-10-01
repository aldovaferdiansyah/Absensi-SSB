@extends('layout.v_template')

@section('title', 'Edit Data Akun User')
@section('content')

<link rel="stylesheet" href="{{ asset('style/schedule.css') }}">

<form action="{{ route('schedules.update', $schedules->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h2>Edit Data Jadwal</h2>

    <div class="form-group">
        <label>Judul Kegiatan</label>
        <select id="title" name="title">
            <option value="">Pilih Kategori</option>
            <option value="Latihan" {{ old('title', $schedules->title) == 'Latihan' ? 'selected' : '' }}>Latihan</option>
            <option value="Pertandingan" {{ old('title', $schedules->title) == 'Pertandingan' ? 'selected' : '' }}>Pertandingan</option>
        </select>
        <div class="text-danger">
            @error('title')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Tanggal Kegiatan</label>
        <input type="date" id="date" name="date" value="{{ old('date', $schedules->date ? $schedules->date->format('Y-m-d') : '') }}">
        <div class="text-danger">
            @error('date')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Deskripsi Kegiatan</label>
        <input type="text" id="description" name="description" value="{{ old('description', $schedules->description) }}">
        <div class="text-danger">
            @error('description')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Waktu Mulai Kegiatan</label>
        <input type="time" id="time_start" name="time_start" value="{{ old('time_start', $schedules->time_start) }}">
        <div class="text-danger">
            @error('time_start')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Waktu Selesai Kegiatan</label>
        <input type="time" id="time_end" name="time_end" value="{{ old('time_end', $schedules->time_end) }}">
        <div class="text-danger">
            @error('time_end')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <button type="submit">Ubah Data</button>
    </div>

</form>

@endsection
