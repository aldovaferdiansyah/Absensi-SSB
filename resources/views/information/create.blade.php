@extends('layout.v_template')

@section('title', 'Tambah Jadwal')
@section('content')

<link rel="stylesheet" href="{{ asset('style/information/tambahDataInformation.css') }}">

<form action="{{ route('information.store') }}" method="POST">
    @csrf
    <h2>Tambah Informasi</h2>

    <div class="form-group">
        <label>Judul</label>
        <input type="text" class="form-control" placeholder="Silahkan Masukkan Judul ..." id="heading" name="heading" value="{{ old('heading') }}">
        <div class="text-danger">
            @error('heading')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" placeholder="Silahkan Masukkan Deskripsi ..." rows="4">{{ old('description') }}</textarea>
        <div class="text-danger">
            @error('description')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Tambah</button>
    </div>
</form>

@endsection
