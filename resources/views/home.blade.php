<!DOCTYPE html>
<html lang="en" class="h-full bg-[#f0f6fb]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #map {
            height: 500px;
        }
    </style>
</head>
<body class="h-full">

    <!-- UI Line -->
    <div class="min-h-full">
        <x-navbar-admin/>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard Quality Control AWS Center</h1>

            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div style="max-width: 300px;">
                    <form action="{{ route('stations.filter') }}" method="GET" style="display: flex; flex-direction: column; gap: 15px;">
                        <label for="start_date" style="font-weight: bold; color: #333;">Start Date</label>
                        <input type="date" name="start_date" id="start_date" required placeholder="Select start date" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">

                        <label for="end_date" style="font-weight: bold; color: #333;">End Date</label>
                        <input type="date" name="end_date" id="end_date" required placeholder="Select end date" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">

                        <button type="submit" style="padding: 10px 15px; background-color: #007BFF; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s;">
                            Filter
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mt-8">
                <div>
                    <label for="flagVal">Select Flag Type:</label>
                    <select id="flagVal">
                        <option value="all">All Flags</option>
                        @foreach($dropdownOptions['flags'] as $flag)
                            <option value="{{ $flag }}">{{ ucfirst(str_replace('_', ' ', $flag)) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="TypeVal">Select Machine Type:</label>
                    <select id="TypeVal">
                        <option value="all">All Machines</option>
                        @foreach($dropdownOptions['machineTypes'] as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="provinceVal">Select Province:</label>
                    <select id="provinceVal">
                        <option value="all">All Provinces</option>
                        @foreach($dropdownOptions['provinces'] as $province)
                            <option value="{{ $province }}">{{ $province }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <style>
                form input[type="date"]:focus,
                form button:focus {
                    outline: none;
                    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
                }
                form button:hover {
                    background-color: #0056b3;
                }
            </style>

            </div>
                <div id="map" class="mt-2"></div>
            </div>

            <style>
                .reset-button:hover {
                    background-color: #f0f0f0;
                }
            </style>


            <div class="flex flex-wrap justify-center items-start gap-3 lg:gap-4 mt-4">
                <!-- First Chart Container (Taller Chart) -->
                <div class="chart-container w-full sm:w-3/4 lg:w-1/2 lg:ml-auto">
                    <div class="relative h-[50vh] lg:h-[80vh] max-h-600px">
                    <canvas id="chart1"></canvas>
                    </div>
                </div>

                <!-- Second Chart Container (Shorter Chart) -->
                <div class="chart-container w-full sm:w-2/3 lg:w-1/3 lg:ml-auto">
                    <div class="relative h-[50vh] lg:h-[60vh] max-h-400px">
                    <canvas id="chart2"></canvas>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap justify-center items-start mt-4">
            <div class="chart-container w-full sm:w-3/4 lg:w-1/2">
                <canvas id="stationChart"></canvas>
            </div>
            </div>

        <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize date pickers
        flatpickr("#start_date", { dateFormat: "Y-m-d" });
        flatpickr("#end_date", { dateFormat: "Y-m-d" });

        // DOM elements
        const flagDropdown = document.getElementById('flagVal');
        const typeDropdown = document.getElementById('TypeVal');
        const provinceDropdown = document.getElementById('provinceVal');

        // Initialize Map
        const map = L.map('map').setView([-2.0, 118.0], 5); // Center map to Indonesia
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Helper Function: Get color for map markers based on value
        function getColor(value) {
            const colors = [
                '#369bcf', '#28a79e', '#39b449', '#8cc63e', '#e1cf23',
                '#f8af3e', '#f7941f', '#ec5828', '#e91c23', '#b21a26',
            ];
            return colors[value] || '#000';
        }

        // Display markers on the map
        function displayMarkers(data) {
            if (!data || data.length === 0) {
                console.error('No marker data available.');
                return;
            }
            // Remove existing markers
            map.eachLayer(layer => {
                if (layer instanceof L.CircleMarker) map.removeLayer(layer);
            });

            // Add new markers
            data.forEach(station => {
                const maxIndex = station.overall_values.indexOf(Math.max(...station.overall_values));
                L.circleMarker([station.lat, station.lon], {
                    radius: 10,
                    fillColor: getColor(maxIndex),
                    color: getColor(maxIndex),
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.6,
                })
                    .addTo(map)
                    .bindPopup(`
                        <strong>Station Name:</strong> ${station.name_station}<br>
                        <strong>Type:</strong> ${station.tipe_station}<br>
                        <strong>Province:</strong> ${station.nama_propinsi}<br>
                        <strong>Highest Percentage:</strong> Value ${maxIndex}
                    `);
            });
        }

        // Initialize Charts
        const ctx1 = document.getElementById('chart1').getContext('2d');
        const chart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: [], // Placeholder
                datasets: Array.from({ length: 10 }, (_, i) => ({
                    label: `Value ${i}`,
                    data: [], // Placeholder
                    backgroundColor: `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 0.5)`,
                })),
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true,
                        max: 100,
                    },
                    x: {
                        stacked: true,
                    },
                },
            },
        });

        const ctx2 = document.getElementById('chart2').getContext('2d');
        const chart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: [], // Placeholder
                datasets: [{
                    data: [], // Placeholder
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)',
                        'rgba(200, 99, 132, 0.2)', 'rgba(100, 162, 235, 0.2)',
                        'rgba(150, 206, 86, 0.2)', 'rgba(175, 192, 192, 0.2)',
                    ],
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                },
            },
        });

        // Helper Function: Update chart data
        function updateChart(chart, data, type) {
            if (!data || Object.keys(data).length === 0) {
                console.error('No data available for the chart.');
                return;
            }

            if (type === 'bar') {
                chart.data.labels = Object.keys(data);
                chart.data.datasets.forEach((dataset, index) => {
                    dataset.data = Object.values(data).map(d => d[`Value ${index}`] || 0);
                });
            } else if (type === 'pie') {
                chart.data.labels = Object.keys(data);
                chart.data.datasets[0].data = Object.values(data);
            }

            chart.update();
        }

        // Fetch filtered data
        function fetchFilteredData() {
            const flag = flagDropdown.value;
            const type = typeDropdown.value;
            const province = provinceDropdown.value;

            fetch(`/admin/qcdashboard?flag=${flag}&type=${type}&province=${province}`)
                .then(response => response.json())
                .then(data => {
                    displayMarkers(data.markerData); // Update map markers
                    updateChart(chart1, data.tipeStationData, 'bar'); // Update Bar Chart
                    updateChart(chart2, data.overallSum, 'pie'); // Update Pie Chart
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Attach event listeners to dropdowns
        [flagDropdown, typeDropdown, provinceDropdown].forEach(dropdown =>
            dropdown.addEventListener('change', fetchFilteredData)
        );

        // Initial Fetch
        fetchFilteredData();
    });
    </script>

        </main>
    </div>
</body>
</html>
