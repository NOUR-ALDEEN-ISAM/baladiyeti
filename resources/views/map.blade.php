<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خريطة المواقع</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" crossorigin=""/>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
        }

        #mapid {
            height: 600px;
            margin: 20px 0;
            border: 2px solid #007bff;
            border-radius: 10px;
        }

        .container {
            margin-top: 20px;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 10px;
        }

        .leaflet-popup-content {
            font-size: 1.1rem;
        }

        .leaflet-popup-content h5 {
            margin-top: 0;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">خريطة المواقع</h1>
        <div id="mapid"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" crossorigin=""></script>
    <script>
        var map = L.map('mapid').setView([31.7683, 35.2137], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'//مفتاح /KEY
        }).addTo(map);

        @foreach ($locations as $location)
            @if ($location->latitude && $location->longitude)
                L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map)
                    .bindPopup('<h5>{{ $location->name }}</h5><p>{{ $location->description }}</p>');
            @endif
        @endforeach

        map.on('click', function(e) {
            var latitude = e.latlng.lat;
            var longitude = e.latlng.lng;
            var marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('New Location<br>Latitude: ' + latitude + '<br>Longitude: ' + longitude)
                .openPopup();

            var name = prompt('أدخل اسم الموقع:');
            var description = prompt('أدخل وصفاً للموقع:');

            if (name && description) {
                fetch('{{ route("locations.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: name,
                        description: description,
                        latitude: latitude,
                        longitude: longitude
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('تم إضافة الموقع بنجاح!');
                        marker.bindPopup('<h5>' + name + '</h5><p>' + description + '</p>');
                    } else {
                        alert('حدث خطأ أثناء إضافة الموقع');
                    }
                })
                .catch(error => console.error('Error:', error));
            } else {
                map.removeLayer(marker);
                alert('يجب إدخال اسم ووصف الموقع.');
            }
        });
    </script>
</body>
</html>
