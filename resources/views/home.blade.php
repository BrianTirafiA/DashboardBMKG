<!DOCTYPE html>
<html lang="en" class="h-full bg-[#f0f6fb]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QC Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #map {
            height: 500px; /* Set a height for the map */
        }
    </style>
</head>
<body class="h-full">
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<div class="min-h-full">
  <x-navbar :menu-items="[
    ['label' => 'QC Dashboard', 'link' => '/qcdashboard', 'active' => true],
    ['label' => 'It Asset', 'link' => '/itasset', 'active' => false],
    ['label' => 'Projects', 'link' => '#', 'active' => false],
    ['label' => 'Calendar', 'link' => '#', 'active' => false],
    ['label' => 'Reports', 'link' => '#', 'active' => false],
  ]" />


  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard Quality Control AWS Center</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div id="map"></div>

        <script>
        // Get the station data passed from the controller
        const stations = @json($stations);

        document.addEventListener('DOMContentLoaded', () => {
            const map = L.map('map', {attributionControl: false,}).setView([-0.7893, 113.9213], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            const bounds = [
                [-11.0, 95.0], // Southwest corner (latitude, longitude)
                [6.5, 141.0]   // Northeast corner (latitude, longitude)
            ];
            map.setMaxBounds(bounds);

            // Set zoom limits
            map.setMinZoom(5);  // Minimum zoom level
            map.setMaxZoom(10); // Maximum zoom level

            // Function to get color based on value (0-9)
            function getColor(value) {
                const colors = [
                    '#0d4a70', //valid
                    '#228b3b', '#40ad5a', '#9ccb86', //One flag
                    '#eeb479', '#e9e29c', '#ffc61e', //Double flag
                    '#8f003b', //Triple flag
                    '#ff1f5b' //Missing
                ];
                return colors[value];
            }

            

            // Function to create a circle marker
            function createCircleMarker(lat, lon, value) {
                L.circleMarker([lat, lon], {
                    radius: 10, // Size of the circle
                    fillColor: getColor(value), // Color based on value
                    color: getColor(value), // Border color
                    weight: 1, // Border width
                    opacity: 1, // Border opacity
                    fillOpacity: 0.6 // Fill opacity
                }).addTo(map)
                .bindPopup('Value: ' + value);
            }

            // Iterate over the stations and create markers on the map
            stations.forEach((station) => {
                createCircleMarker(station.latt_station, station.long_station, station.rr_flag);
            });
        });
    </script>
    </div>
  </main>
</div>
</body>
</html>
