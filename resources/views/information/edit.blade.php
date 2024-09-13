@extends('layout.v_template')

@section('title', 'Edit Jadwal')
@section('content')

<link rel="stylesheet" href="{{ asset('style/information/editDataInformation.css') }}">

<form action="{{ route('information.update', $information->id) }}" method="POST">
    @csrf
    @method('PUT')
    <h2>Edit Jadwal</h2>

    <div class="form-group">
        <label>Type Agenda</label>
        <select name="heading" class="form-control">
            <option value="Latihan" {{ $information->heading == 'Latihan' ? 'selected' : '' }}>Latihan</option>
            <option value="Pertandingan" {{ $information->heading == 'Pertandingan' ? 'selected' : '' }}>Pertandingan</option>
        </select>
        <div class="text-danger">
            @error('heading')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Description</label>
        <input type="text" name="description" class="form-control" placeholder="Silahkan Masukkan Deskripsi ..." value="{{ $information->description }}">
        <div class="text-danger">
            @error('description')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Ubah Jadwal</button>
    </div>
</form>

@endsection
