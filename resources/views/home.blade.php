<!DOCTYPE html>
<html lang="en" class="h-full bg-[#f0f6fb]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QC Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <div class="text-center mt-4">
        <label for="flagVal" class="font-semibold text-lg">Select Flag Type: </label>
        <select id="flagVal" class="px-4 py-2 border rounded">
            <option value="average_flag">Average Flag</option>
            <option value="rr_flag">RR Flag</option>
            <option value="pp_air_flag">PP Air Flag</option>
            <option value="rh_avg_flag">RH Avg Flag</option>
            <option value="sr_avg_flag">SR Avg Flag</option>
            <option value="sr_max_flag">SR Max Flag</option>
            <option value="nr_flag">NR Flag</option>
            <option value="wd_avg_flag">WD Avg Flag</option>
            <option value="ws_avg_flag">WS Avg Flag</option>
            <option value="ws_max_flag">WS Max Flag</option>
            <option value="wl_flag">WL Flag</option>
            <option value="tt_air_avg_flag">TT Air Avg Flag</option>
            <option value="tt_air_min_flag">TT Air Min Flag</option>
            <option value="tt_air_max_flag">TT Air Max Flag</option>
            <option value="tt_sea_flag">TT Sea Flag</option>
            <option value="ws_50cm_flag">WS 50cm Flag</option>
            <option value="wl_pan_flag">WL Pan Flag</option>
            <option value="ev_pan_flag">EV Pan Flag</option>
            <option value="tt_pan_flag">TT Pan Flag</option>
        </select>
        </div>
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
                [-20.0, 80.0], // Southwest corner (latitude, longitude)
                [22.0, 151.0]   // Northeast corner (latitude, longitude)
            ];
            map.setMaxBounds(bounds);

            // Set zoom limits
            map.setMinZoom(5);  // Minimum zoom level
            map.setMaxZoom(15); // Maximum zoom level

            // Function to get color based on value (0-9)
            function getColor(value) {
                const colors = [
                    '#0d4a70', //mostly valid 0
                    '#228b3b', '#40ad5a', '#9ccb86', //mostly One flag 1,2,3
                    '#eeb479', '#e9e29c', '#ffc61e', //mostly Double flag 4,5,6
                    '#8f003b', //mostly Triple flag 7
                    '#9A194E', //8
                    '#ff1f5b' //mostly Missing 9
                ];
                return colors[value];
            }

            

            // Function to create a circle marker
            function createCircleMarker(lat, lon, value, station) {
                L.circleMarker([lat, lon], {
                    radius: 10, // Size of the circle
                    fillColor: getColor(value), // Color based on value
                    color: getColor(value), // Border color
                    weight: 1, // Border width
                    opacity: 1, // Border opacity
                    fillOpacity: 0.6 // Fill opacity
                }).addTo(map)
                .bindPopup(`
                <strong>Station Name:</strong> ${station.name_station} <br>
                <strong>Station Type:</strong> ${station.tipe_station} <br>
                <strong>rr_flag:</strong> ${station.rr_flag} <br>
                <strong>pp_air_flag:</strong> ${station.pp_air_flag} <br>
                <strong>rh_avg_flag:</strong> ${station.rh_avg_flag} <br>
                <strong>sr_avg_flag:</strong> ${station.sr_avg_flag} <br>
                <strong>sr_max_flag:</strong> ${station.sr_max_flag} <br>
                <strong>nr_flag:</strong> ${station.nr_flag} <br>
                <strong>wd_avg_flag:</strong> ${station.wd_avg_flag} <br>
                <strong>ws_avg_flag:</strong> ${station.ws_avg_flag} <br>
                <strong>ws_max_flag:</strong> ${station.ws_max_flag} <br>
                <strong>wl_flag:</strong> ${station.wl_flag} <br>
                <strong>tt_air_avg_flag:</strong> ${station.tt_air_avg_flag} <br>
                <strong>tt_air_min_flag:</strong> ${station.tt_air_min_flag} <br>
                <strong>tt_air_max_flag:</strong> ${station.tt_air_max_flag} <br>
                <strong>tt_sea_flag:</strong> ${station.tt_sea_flag} <br>
                <strong>ws_50cm_flag:</strong> ${station.ws_50cm_flag} <br>
                <strong>wl_pan_flag:</strong> ${station.wl_pan_flag} <br>
                <strong>ev_pan_flag:</strong> ${station.ev_pan_flag} <br>
                <strong>tt_pan_flag:</strong> ${station.tt_pan_flag} <br>
                <strong>Average Flag Value:</strong> ${station.average_flag}
            `);
            }

            function addMarkers() {
        const selectedFlag = document.getElementById('flagVal').value;
        map.eachLayer((layer) => {
            if (layer instanceof L.CircleMarker) {
                map.removeLayer(layer);
            }
        });
        stations.forEach((station) => {
            createCircleMarker(station.latt_station, station.long_station, station[selectedFlag], station);
        });
    }

    // Add initial markers
    addMarkers();

    // Update markers when dropdown changes
    document.getElementById('flagVal').addEventListener('change', addMarkers);
        });
      </script>

<div class="chart-container" style="max-width: 400px; margin: 0 auto; border: 2px solid #000;">
    <div class="text-center mt-4">
        <label for="flagType" class="font-semibold text-lg">Select Flag Type: </label>
        <select id="flagType" class="px-4 py-2 border rounded">
            <option value="average_flag">Average Flag</option>
            <option value="rr_flag">RR Flag</option>
            <option value="pp_air_flag">PP Air Flag</option>
            <option value="rh_avg_flag">RH Avg Flag</option>
            <option value="sr_avg_flag">SR Avg Flag</option>
            <option value="sr_max_flag">SR Max Flag</option>
            <option value="nr_flag">NR Flag</option>
            <option value="wd_avg_flag">WD Avg Flag</option>
            <option value="ws_avg_flag">WS Avg Flag</option>
            <option value="ws_max_flag">WS Max Flag</option>
            <option value="wl_flag">WL Flag</option>
            <option value="tt_air_avg_flag">TT Air Avg Flag</option>
            <option value="tt_air_min_flag">TT Air Min Flag</option>
            <option value="tt_air_max_flag">TT Air Max Flag</option>
            <option value="tt_sea_flag">TT Sea Flag</option>
            <option value="ws_50cm_flag">WS 50cm Flag</option>
            <option value="wl_pan_flag">WL Pan Flag</option>
            <option value="ev_pan_flag">EV Pan Flag</option>
            <option value="tt_pan_flag">TT Pan Flag</option>
        </select>
    </div>
    <canvas id="flagChart"></canvas>
</div>

<!-- Dropdown for selecting flag type -->


<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Get the station data
        const stations = @json($stations);

        let chartInstance = null; // Variable to store chart instance

        // Function to update chart based on selected flag type
        function updateChart(flagType) {
            // Step 1: Gather flag data
            const flagCounts = Array(10).fill(0); // Array to store counts for values 0-9

            stations.forEach((station) => {
                const flagValue = station[flagType]; // Use selected flag type
                if (flagValue >= 0 && flagValue <= 9) {
                    flagCounts[flagValue]++;
                }
            });

            // Step 2: Calculate percentages
            const totalFlags = flagCounts.reduce((a, b) => a + b, 0);
            const flagPercentages = flagCounts.map((count) => ((count / totalFlags) * 100).toFixed(2));

            // If chart instance already exists, destroy it to avoid duplicate charts
            if (chartInstance) {
                chartInstance.destroy();
            }

            // Step 3: Create the chart
            const ctx = document.getElementById('flagChart').getContext('2d');
            chartInstance = new Chart(ctx, {
                type: 'pie', // Change to 'bar' for a bar chart
                data: {
                    labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                    datasets: [{
                        label: `Flag Distribution (${flagType})`,
                        data: flagPercentages,
                        backgroundColor: [
                            '#0d4a70', '#228b3b', '#40ad5a', '#9ccb86',
                            '#eeb479', '#e9e29c', '#ffc61e', '#8f003b',
                            '#000000', '#ff1f5b'
                        ],
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    return `${value}%`;
                                }
                            }
                        }
                    },

                    layout: {
                        padding: {
                            top: 10,
                            right: 10,
                            bottom: 10,
                            left: 10
                        }
                    },
                },
            });
        }

        // Initial chart load with 'average_flag'
        updateChart('average_flag');

        // Event listener for dropdown change
        document.getElementById('flagType').addEventListener('change', (event) => {
            updateChart(event.target.value);
        });
    });
</script>



    </div>
  </main>
</div>
</body>
</html>
