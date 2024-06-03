<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Street Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
   
</head>

<body>
    <div id="mi_mapa" style="width: 100%; height: 500px;"></div>

    <script>
        let map = L.map('mi_mapa').setView([5.5337, -73.3670], 16)

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([5.53355, -73.36742]).addTo(map).bindPopup("Distribuidora San Luis Topo").openPopup()
        L.marker([5.53721, -73.37065]).addTo(map).bindPopup("Distribuidora San Luis Milagro").openPopup()

        map.on('click', onMapClick)

        function onMapClick(e) {
            alert("Posición: " + e.latlng)
        }
    </script>
</body>

</html>