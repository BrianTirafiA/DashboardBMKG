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
    <div class="flex items-center space-x-4">
        <!-- Flag Type Dropdown -->
        <div>
            <label for="flagVal" class="font-semibold text-lg">Select Flag Type: </label>
            <select id="flagVal" class="px-4 py-2 border rounded">
                <option value="All">All Flag</option>
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

        <!-- Machine Type Dropdown -->
        <div>
            <label for="TypeVal" class="font-semibold text-lg">Select Machine Type: </label>
            <select id="TypeVal" class="px-4 py-2 border rounded">
                <option value="All">All Machine</option>
                <option value="aws">AWS</option>
                <option value="arg">ARG</option>
                <option value="aaws">AAWS</option>
                <option value="asrs">ASRS</option>
                <option value="iklimmikro">IKRO</option>
                <option value="awsship">AWS Ship</option>
                <option value="soil">SOIL</option>
            </select>
        </div>

        <!-- Province Filter Dropdown -->
        <div>
            <label for="provinceVal" class="font-semibold text-lg">Select Province: </label>
            <select id="provinceVal" class="px-4 py-2 border rounded">
                <option value="All">All Provinces</option>
                <option value="Bali">Bali</option>
                <option value="Banten">Banten</option>
                <option value="Bengkulu">Bengkulu</option>
                <option value="DI Yogyakarta">DI Yogyakarta</option>
                <option value="DKI Jakarta">DKI Jakarta</option>
                <option value="Gorontalo">Gorontalo</option>
                <option value="Jambi">Jambi</option>
                <option value="Jawa Barat">Jawa Barat</option>
                <option value="Jawa Tengah">Jawa Tengah</option>
                <option value="Jawa Timur">Jawa Timur</option>
                <option value="Kalimantan Barat">Kalimantan Barat</option>
                <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                <option value="Kalimantan Timur">Kalimantan Timur</option>
                <option value="Kalimantan Utara">Kalimantan Utara</option>
                <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                <option value="Kepulauan Riau">Kepulauan Riau</option>
                <option value="Lampung">Lampung</option>
                <option value="Maluku">Maluku</option>
                <option value="Maluku Utara">Maluku Utara</option>
                <option value="Nanggroe Aceh Darusalam">Nanggroe Aceh Darusalam</option>
                <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                <option value="Papua">Papua</option>
                <option value="Papua Barat">Papua Barat</option>
                <option value="Riau">Riau</option>
                <option value="Sulawesi Barat">Sulawesi Barat</option>
                <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                <option value="Sulawesi Utara">Sulawesi Utara</option>
                <option value="Sumatera Barat">Sumatera Barat</option>
                <option value="Sumatera Selatan">Sumatera Selatan</option>
                <option value="Sumatera Utara">Sumatera Utara</option>
            </select>
        </div>
    </div>
    <div id="map" class="mt-6"></div>
</div>

<script>
    // Get the station data and province list from the controller
    const stations = @json($stations);

    document.addEventListener('DOMContentLoaded', () => {
        const map = L.map('map', { attributionControl: false }).setView([-0.7893, 113.9213], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        const bounds = [
            [-20.0, 80.0], // Southwest corner (latitude, longitude)
            [22.0, 151.0], // Northeast corner (latitude, longitude)
        ];
        map.setMaxBounds(bounds);

        map.setMinZoom(5);
        map.setMaxZoom(15);

        function getColor(value) {
            const colors = [
                '#0d4a70', '#228b3b', '#40ad5a', '#9ccb86',
                '#eeb479', '#e9e29c', '#ffc61e',
                '#8f003b', '#9A194E', '#ff1f5b',
            ];
            return colors[value];
        }

        function createCircleMarker(lat, lon, value, station) {
            L.circleMarker([lat, lon], {
                radius: 10,
                fillColor: getColor(value),
                color: getColor(value),
                weight: 1,
                opacity: 1,
                fillOpacity: 0.6,
            })
                .addTo(map)
                .bindPopup(`
                    <strong>Station Name:</strong> ${station.name_station} <br>
                    <strong>Province:</strong> ${station.nama_propinsi} <br>
                    <strong>Station Type:</strong> ${station.tipe_station} <br>
                    <strong>rr_flag:</strong> ${station.rr_flag} <br>
                    <strong>Average Flag Value:</strong> ${station.average_flag}
                `);
        }

        function addMarkers() {
            const selectedFlag = document.getElementById('flagVal').value;
            const selectedType = document.getElementById('TypeVal').value;
            const selectedProvince = document.getElementById('provinceVal').value;

            map.eachLayer((layer) => {
                if (layer instanceof L.CircleMarker) {
                    map.removeLayer(layer);
                }
            });

            const filteredStations = stations.filter(station => {
                const matchesType = selectedType === 'All' || station.tipe_station === selectedType;
                const matchesProvince = selectedProvince === 'All' || station.nama_propinsi === selectedProvince;
                return matchesType && matchesProvince;
            });

        //     if (selectedFlag === "All") {
        //     const flagsToInclude = [
        //         "rr_flag", "pp_air_flag", "rh_avg_flag", "sr_avg_flag", "sr_max_flag",
        //         "nr_flag", "wd_avg_flag", "ws_avg_flag", "ws_max_flag", "wl_flag",
        //         "tt_air_avg_flag", "tt_air_min_flag", "tt_air_max_flag", "tt_sea_flag",
        //         "ws_50cm_flag", "wl_pan_flag", "ev_pan_flag", "tt_pan_flag"
        //     ];

        //     filteredStations.forEach(station => {
        //         flagsToInclude.forEach(flag => {
        //             createCircleMarker(station.latt_station, station.long_station, station[flag], station);
        //         });
        //     });
        // } else {
            // When a specific flag is selected, display only that flag
            filteredStations.forEach(station => {
                createCircleMarker(station.latt_station, station.long_station, station[selectedFlag], station);
            });
        // }
        }

        addMarkers();

        document.getElementById('flagVal').addEventListener('change', addMarkers);
        document.getElementById('TypeVal').addEventListener('change', addMarkers);
        document.getElementById('provinceVal').addEventListener('change', addMarkers);
    });
</script>


<div class="flex justify-center items-start space-x-6 mt-6">
    <!-- First Chart Container (Taller Chart) -->
    <div class="chart-container" style="width: 600px; height: 400px;">
        <canvas id="flagTypeChart"></canvas>
    </div>

    <!-- Second Chart Container (Shorter Chart) -->
    <div class="chart-container" style="width: 400px; height: 300px;">
        <canvas id="flagChart"></canvas>
    </div>
</div>

<!-- Dropdown for selecting flag type -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const stations = @json($stations);

        let chartInstance = null;

        function updateChart() {
            const selectedFlag = document.getElementById('flagVal').value;
            const selectedType = document.getElementById('TypeVal').value;
            const selectedProvince = document.getElementById('provinceVal').value;

            const filteredStations = stations.filter((station) => {
                const matchesType = selectedType === 'All' || station.tipe_station === selectedType;
                const matchesProvince = selectedProvince === 'All' || station.nama_propinsi === selectedProvince;
                return matchesType && matchesProvince;
            });

            // Group data by machine type and calculate percentages
            const groupedData = {};
            filteredStations.forEach((station) => {
                const flagValue = station[selectedFlag];
                if (!groupedData[station.tipe_station]) {
                    groupedData[station.tipe_station] = Array(10).fill(0);
                }
                if (flagValue >= 0 && flagValue <= 9) {
                    groupedData[station.tipe_station][flagValue]++;
                }
            });

            // Calculate percentages for each value (0-9) per machine type
            const labels = Object.keys(groupedData);
            const datasets = [];
            const colors = ['#0d4a70', '#228b3b', '#40ad5a', '#9ccb86', '#eeb479', '#e9e29c', '#ffc61e', '#8f003b', '#9A194E', '#ff1f5b'];

            for (let i = 0; i < 10; i++) {
                const data = labels.map((label) => {
                    const totalForType = groupedData[label].reduce((sum, count) => sum + count, 0);
                    const percentage = totalForType > 0 ? (groupedData[label][i] / totalForType) * 100 : 0;
                    return percentage;
                });
                datasets.push({
                    label: `Value ${i}`,
                    data,
                    backgroundColor: colors[i],
                });
            }

            // Destroy existing chart if it exists
            if (chartInstance) {
                chartInstance.destroy();
            }

            // Create a new chart
            const ctx = document.getElementById('flagTypeChart').getContext('2d');
            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets,
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.raw.toFixed(2)}%`;
                                },
                            },
                        },
                    },
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            max: 100, // Ensure the Y-axis max is 100%
                            ticks: {
                                callback: function (value) {
                                    return `${value}%`;
                                },
                            },
                        },
                    },
                },
            });
        }

        // Event listeners for dropdown changes
        document.getElementById('flagVal').addEventListener('change', updateChart);
        document.getElementById('TypeVal').addEventListener('change', updateChart);
        document.getElementById('provinceVal').addEventListener('change', updateChart);

        // Initial chart rendering
        updateChart();
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', () => {
    // Get the station data
    const stations = @json($stations);

    let chartInstance = null; // Variable to store chart instance

    // Function to update the chart
    function updateChart() {
        // Get filter values
        const selectedFlag = document.getElementById('flagVal').value;
        const selectedType = document.getElementById('TypeVal').value;
        const selectedProvince = document.getElementById('provinceVal').value;

        // Step 1: Filter stations based on selected criteria
        const filteredStations = stations.filter((station) => {
            const matchesType = selectedType === 'All' || station.tipe_station === selectedType;
            const matchesProvince = selectedProvince === 'All' || station.nama_propinsi === selectedProvince;
            return matchesType && matchesProvince;
        });

        // Step 2: Gather flag data from filtered stations
        const flagCounts = Array(10).fill(0);

        filteredStations.forEach((station) => {
            const flagValue = station[selectedFlag];
            if (flagValue >= 0 && flagValue <= 9) {
                flagCounts[flagValue]++;
            }
        });

        // Step 3: Calculate total and percentages
        const totalFlags = flagCounts.reduce((a, b) => a + b, 0);
        const flagPercentages = flagCounts.map((count) =>
            totalFlags > 0 ? ((count / totalFlags) * 100).toFixed(2) : 0
        );

        // If chart instance already exists, destroy it
        if (chartInstance) {
            chartInstance.destroy();
        }

        // Step 4: Create or update the chart
        const ctx = document.getElementById('flagChart').getContext('2d');
        chartInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                datasets: [{
                    label: `Flag Distribution (${selectedFlag})`,
                    data: flagPercentages, // Use the calculated percentages
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
                        position: 'right', // Set legend position
                        labels: {
                            usePointStyle: true, // Use points in the legend
                            generateLabels: (chart) => {
                                const data = chart.data;
                                return data.labels.map((label, i) => {
                                    const value = data.datasets[0].data[i];
                                    const meta = chart.getDatasetMeta(0);
                                    const isHidden = meta.data[i].hidden || false;
                                    return {
                                        text: `${label} (${value}%)`,
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        hidden: isHidden,
                                        index: i,
                                    };
                                });
                            },
                        },
                        onClick: (e, legendItem, legend) => {
                            const dataset = legend.chart.data.datasets[0];
                            const index = legendItem.index;
                            const meta = legend.chart.getDatasetMeta(0);

                            // Toggle visibility
                            meta.data[index].hidden = !meta.data[index].hidden;

                            // Recalculate and update the chart
                            legend.chart.update();
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const percentage = context.raw;
                                return `Value ${context.label}: ${percentage}%`;
                            },
                        },
                    },
                },
            },
        });
    }

    // Event listeners for dropdown changes
    document.getElementById('flagVal').addEventListener('change', updateChart);
    document.getElementById('TypeVal').addEventListener('change', updateChart);
    document.getElementById('provinceVal').addEventListener('change', updateChart);

    // Initial chart load
    updateChart();
});

</script>



    </div>
  </main>
</div>
</body>
</html>
