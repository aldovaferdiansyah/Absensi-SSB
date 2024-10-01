@extends('layout.v_template')

@section('title', 'Scanner Presensi')
@section('content')

<link rel="stylesheet" href="{{ asset('style/qrScanner/qrScanner.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@if (Cache::get('scanner_visibility', true))
    <div class="scanner-wrapper">
        <div class="scanner-container">
            <h1>Presensi</h1>
            <select id="attendance-type" class="form-control">
                <option value="latihan">Latihan</option>
                <option value="pertandingan">Pertandingan</option>
            </select>
            <video id="preview"></video>
            <p id="current-time" class="footer"></p>
            <p class="footer">Arahkan Kamera Anda Pada QR Code</p>
        </div>
    </div>
@else
<div class="alert alert-warning">
    <div class="alert-content">
        <span class="alert-icon">⚠️</span>
        <span class="alert-text">Scanner belum tersedia saat ini.</span>
    </div>
</div>
@endif

<!-- Pastikan jQuery dimuat sebelum skrip lainnya -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>
<script src="https://unpkg.com/@zxing/library@latest"></script>
<script src="{{ asset('template/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('template/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('template/dist/js/demo.js') }}"></script>

<script>
    window.addEventListener('load', function () {
        let selectedDeviceId;
        const codeReader = new ZXing.BrowserQRCodeReader();
        console.log('ZXing code reader initialized');
        let alertShown = false;

        function updateTime() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('current-time').textContent = `Waktu Saat Ini: ${hours}:${minutes}:${seconds}`;
        }

        setInterval(updateTime, 1000);
        updateTime();

        function checkLocationPermission() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        startScanner(position.coords.latitude, position.coords.longitude);
                    },
                    function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lokasi Tidak Ditemukan',
                            text: 'Tidak dapat mengakses lokasi Anda.'
                        });
                    }
                );
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Browser Tidak Mendukung',
                    text: 'Geolocation tidak didukung oleh browser Anda.'
                });
            }
        }

        function startScanner(latitude, longitude) {
            codeReader.getVideoInputDevices()
                .then((videoInputDevices) => {
                    const firstDeviceId = videoInputDevices[0].deviceId;
                    selectedDeviceId = firstDeviceId;
                    codeReader.decodeFromVideoDevice(selectedDeviceId, 'preview', (result, err) => {
                        if (result && !alertShown) {
                            alertShown = true;
                            const attendanceType = document.getElementById('attendance-type').value;
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            fetch('{{ route("scanner.attendance.store") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify({
                                    qr_code: result.text,
                                    type: attendanceType,
                                    latitude: latitude,
                                    longitude: longitude
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: data.success
                                    }).then(() => {
                                        alertShown = false;
                                    });
                                } else if (data.error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: data.error
                                    }).then(() => {
                                        alertShown = false;
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan',
                                    text: 'Terjadi kesalahan: ' + error.message
                                }).then(() => {
                                    alertShown = false;
                                });
                            });
                        }
                        if (err && !(err instanceof ZXing.NotFoundException) && !alertShown) {
                            alertShown = true;
                            console.error(err);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan',
                                text: 'Coba scan ulang: ' + err.message
                            }).then(() => {
                                alertShown = false;
                            });
                        }
                    });
                    console.log(`Started continuous decode from camera with id ${firstDeviceId}`);
                })
                .catch((err) => {
                    console.error(err);
                    if (!alertShown) {
                        alertShown = true;
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Tidak dapat memulai scanner: ' + err.message
                        });
                    }
                });
        }

        checkLocationPermission();
    });
</script>

@endsection
