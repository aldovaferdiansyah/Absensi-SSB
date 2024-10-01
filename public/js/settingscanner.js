document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('map').setView([latitude, longitude], 15);

    var marker = L.marker([latitude, longitude]).addTo(map);

    var markerLabel = L.divIcon({
        className: 'marker-label',
        html: '<div class="location-label">Lokasi 1</div>',
        iconSize: [100, 20],
        iconAnchor: [50, 0]
    });

    var labelMarker = L.marker([latitude, longitude], { icon: markerLabel }).addTo(map);

    var circle = L.circle([latitude, longitude], { radius: radius }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            var userMarker = L.marker([lat, lng]).addTo(map).bindPopup('Lokasi GPS Anda');

            var userLabel = L.divIcon({
                className: 'marker-label',
                html: '<div class="location-label">Lokasi Anda</div>',
                iconSize: [100, 20],
                iconAnchor: [50, 0]
            });

            L.marker([lat, lng], { icon: userLabel }).addTo(map);

            map.setView([lat, lng], 15);
        }, function () {
            alert('GPS tidak diizinkan atau tidak tersedia.');
        });
    } else {
        alert('Peramban ini tidak mendukung geolokasi.');
    }

    if (userRole === 'pelatih') {
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            labelMarker.setLatLng([lat, lng]);
            circle.setLatLng([lat, lng]);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    var locationName = data.display_name || 'Nama tempat tidak ditemukan';
                    document.getElementById('location_name').value = locationName;
                    labelMarker.setIcon(L.divIcon({
                        className: 'marker-label',
                        html: `<div class="location-label">Lokasi 1</div>`,
                        iconSize: [100, 20],
                        iconAnchor: [50, 0]
                    }));
                })
                .catch(error => {
                    console.error('Error fetching location name:', error);
                    document.getElementById('location_name').value = 'Nama tempat tidak ditemukan';
                });
        });
    }

    marker.on('click', function() {
        var lat = marker.getLatLng().lat;
        var lng = marker.getLatLng().lng;

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                var locationName = data.display_name || 'Nama tempat tidak ditemukan';
                document.getElementById('location_name').value = locationName;
                labelMarker.setIcon(L.divIcon({
                    className: 'marker-label',
                    html: `<div class="location-label">Lokasi 1</div>`,
                    iconSize: [100, 20],
                    iconAnchor: [50, 0]
                }));
            })
            .catch(error => {
                console.error('Error fetching location name:', error);
                document.getElementById('location_name').value = 'Nama tempat tidak ditemukan';
            });
    });

    document.getElementById('radius').addEventListener('input', function() {
        var newRadius = this.value;
        circle.setRadius(newRadius);
    });

    if (successMessage) {
        Swal.fire({
            title: 'Berhasil!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
});