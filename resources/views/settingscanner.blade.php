@extends('layout.v_template')

@section('title', 'Pengaturan Scanner')
@section('content')

<link rel="stylesheet" href="{{ asset('style/settingscanner.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<div class="settings-wrapper">
    <h1>Pengaturan Scanner</h1>

    <form action="{{ route('settingscanner.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="scanner-visibility">Tampilkan Scanner:</label>
            <select id="scanner-visibility" name="scanner_visibility" class="form-control">
                <option value="1" {{ $scannerVisibility ? 'selected' : '' }}>Buka Scanner</option>
                <option value="0" {{ !$scannerVisibility ? 'selected' : '' }}>Tutup Scanner</option>
            </select>
        </div>

        <div class="form-group">
            <label for="location">Pilih Lokasi:</label>
            <div id="map" style="height: 400px;"></div>
            <input type="hidden" id="latitude" name="latitude" value="{{ $latitude }}">
            <input type="hidden" id="longitude" name="longitude" value="{{ $longitude }}">
        </div>

        <div class="form-group">
            <label for="radius">Radius (meter):</label>
            <input type="number" id="radius" name="radius" class="form-control" value="{{ $radius }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
    </form>
</div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([{{ $latitude }}, {{ $longitude }}], 15);
        var marker = L.marker([{{ $latitude }}, {{ $longitude }}]).addTo(map);
        var circle = L.circle([{{ $latitude }}, {{ $longitude }}], { radius: {{ $radius }} }).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            circle.setLatLng([lat, lng]);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        document.getElementById('radius').addEventListener('input', function() {
            var newRadius = this.value;
            circle.setRadius(newRadius);
        });

        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>

@endsection
