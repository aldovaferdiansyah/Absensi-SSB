@extends('layout.v_template')

@section('title', 'Pengaturan Scanner')
@section('content')

<link rel="stylesheet" href="{{ asset('style/settingscanner.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<div class="settings-wrapper">
    @if (auth()->user()->hasRole('pelatih'))
        <h1>Pengaturan Lokasi</h1>
    @elseif (auth()->user()->hasRole('siswa'))
        <h1>Lokasi Lapang</h1>
    @endif        

    <form action="{{ route('settingscanner.update') }}" method="POST">
        @csrf
        @if (auth()->user()->hasRole('pelatih'))
            <div class="form-group">
                <label for="scanner-visibility">Tampilkan Scanner:</label>
                <select id="scanner-visibility" name="scanner_visibility" class="form-control">
                    <option value="1" {{ $scannerVisibility ? 'selected' : '' }}>Buka Scanner</option>
                    <option value="0" {{ !$scannerVisibility ? 'selected' : '' }}>Tutup Scanner</option>
                </select>
            </div>
        @endif

        <div class="form-group">
            @if (auth()->user()->hasRole('pelatih'))
                <label for="location_name">Nama Tempat:</label>
            @elseif (auth()->user()->hasRole('siswa'))
                <label for="location_name">Lokasi Lapang:</label>
            @endif        
            <input type="text" id="location_name" name="location_name" class="form-control" value="{{ old('location_name') }}" readonly>
        </div>

        <div class="form-group">
            <label for="location">Pilih Lokasi:</label>
            <div id="map" style="height: 400px;"></div>
            <input type="hidden" id="latitude" name="latitude" value="{{ $latitude }}">
            <input type="hidden" id="longitude" name="longitude" value="{{ $longitude }}">
        </div>

        @if (auth()->user()->hasRole('pelatih'))
            <div class="form-group">
                <label for="radius">Radius (meter):</label>
                <input type="number" id="radius" name="radius" class="form-control" value="{{ $radius }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        @endif
    </form>
</div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var latitude = {{ $latitude }};
    var longitude = {{ $longitude }};
    var radius = {{ $radius }};
    var userRole = '{{ auth()->user()->roles->first()->name }}';
    var successMessage = '{{ session('success') }}';
</script>
<script src="{{ asset('js/settingscanner.js') }}"></script>

@endsection
