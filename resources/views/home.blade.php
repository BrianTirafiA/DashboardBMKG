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

    <div class="min-h-full">
        <x-navbar-admin />

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard Quality Control AWS Center</h1>
            </div>
        </header>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div style="max-width: 300px;">
                    <form action="{{ route('stations.filter') }}" method="GET"
                        style="display: flex; flex-direction: column; gap: 15px;">
                        <label for="start_date" style="font-weight: bold; color: #333;">Start Date</label>
                        <input type="date" name="start_date" id="start_date" required placeholder="Select start date"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">

                        <label for="end_date" style="font-weight: bold; color: #333;">End Date</label>
                        <input type="date" name="end_date" id="end_date" required placeholder="Select end date"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">

                        <div style="display: flex; gap: 10px; margin-top: 10px;">
                            <button type="button" id="todayButton"
                                style="padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;">
                                Today
                            </button>
                            <button type="button" id="last7DaysButton"
                                style="padding: 10px 15px; background-color: #ffc107; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;">
                                Last 7 Days
                            </button>
                            <button type="button" id="last30DaysButton"
                                style="padding: 10px 15px; background-color: #dc3545; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;">
                                Last 30 Days
                            </button>
                        </div>

                        <button type="submit"
                            style="padding: 10px 15px; background-color: #007BFF; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s;">
                            Filter
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mt-8">
                    <div>
                        <label for="flagVal" class="block text-sm font-medium text-gray-700">Select Data Type:</label>
                        <select id="flagVal" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="all">All Data Reading</option>
                            @foreach($dropdownOptions['flags'] as $flag)
                                <option value="{{ $flag }}">{{ ucfirst(str_replace('_', ' ', $flag)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="TypeVal" class="block text-sm font-medium text-gray-700">Select Machine
                            Type:</label>
                        <select id="TypeVal" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="all">All Machines</option>
                            @foreach($dropdownOptions['machineTypes'] as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="provinceVal" class="block text-sm font-medium text-gray-700">Select
                            Province:</label>
                        <select id="provinceVal" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="all">All Provinces</option>
                            @foreach($dropdownOptions['provinces'] as $province)
                                <option value="{{ $province }}">{{ $province }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="map" class="mt-6"></div>

                <div class="flex flex-wrap justify-center items-start gap-3 lg:gap-4 mt-4">
                    <div class="chart-container w-full sm:w-3/4 lg:w-1/2 lg:ml-auto">
                        <div class="relative h-[50vh] lg:h-[80vh] max-h-600px">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>

                    <div class="chart-container w-full sm:w-2/3 lg:w-1/3 lg:ml-auto">
                        <div class="relative h-[50vh] lg:h-[60vh] max-h-400px">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {

                        const startDateInput = document.getElementById('start_date');
                        const endDateInput = document.getElementById('end_date');

                        // Utility function to format dates as YYYY-MM-DD
                        function formatDate(date) {
                            const d = new Date(date);
                            const year = d.getFullYear();
                            const month = String(d.getMonth() + 1).padStart(2, '0');
                            const day = String(d.getDate()).padStart(2, '0');
                            return `${year}-${month}-${day}`;
                        }

                        const today = new Date();

                        // Button click handlers
                        document.getElementById('todayButton').addEventListener('click', () => {
                            const formattedToday = formatDate(today);
                            startDateInput.value = formattedToday;
                            endDateInput.value = formattedToday;
                        });

                        document.getElementById('last7DaysButton').addEventListener('click', () => {
                            const last7Days = new Date(today);
                            last7Days.setDate(today.getDate() - 6); // Last 7 days include today
                            startDateInput.value = formatDate(last7Days);
                            endDateInput.value = formatDate(today);
                        });

                        document.getElementById('last30DaysButton').addEventListener('click', () => {
                            const last30Days = new Date(today);
                            last30Days.setDate(today.getDate() - 29); // Last 30 days include today
                            startDateInput.value = formatDate(last30Days);
                            endDateInput.value = formatDate(today);
                        });

                        // Initialize flatpickr
                        flatpickr("#start_date", {
                            dateFormat: "Y-m-d",
                        });
                        flatpickr("#end_date", {
                            dateFormat: "Y-m-d",
                        });

                        const markerData = @json($markerData);
                        // Map visual setting
                        const map = L.map('map', { attributionControl: false }).setView([-2.0, 118.0], 5);
                        const initialCenter = [-2.0, 118.0]; // increase(+) or decrease(-) the value to change [+Higher -lower, +Right -left]
                        const initialZoom = 5;

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                        }).addTo(map);

                        // Map border
                        const bounds = [
                            [-20.0, 80.0], // increase(+) to make it smaller or decrease(-) to make it larger [+DecreaseSouth -InscreaseSouth, +DecreaseWest -InscreaseWest]
                            [22.0, 151.0], // increase(+) to make it larger or decrease(-) to make it smaller [+InscreaseNorth -DecreaseNorth, +InscreaseEast -DecreaseEast]
                        ];
                        map.setMaxBounds(bounds);
                        map.setMinZoom(5);
                        map.setMaxZoom(15);

                        function mapTipeStationToInt(tipeStation) {
                            const tipeStationMapping = {
                                'arg': 0,
                                'aaws': 1,
                                'aws': 2,
                                'soil': 3,
                                'awsship': 4,
                                'iklimmikro': 5,
                                'asrs': 6,
                                // Add more mappings as needed
                            };
                            // Fallback to a default index if tipeStation doesn't match any key
                            return tipeStationMapping[tipeStation] !== undefined ? tipeStationMapping[tipeStation] : 9;
                        }
                        // Color of pin
                        function getColor(value) {
                            const colors = [
                                '#369bcf', '#28a79e', '#39b449', '#8cc63e',
                                '#e1cf23', '#f8af3e', '#f7941f',
                                '#ec5828', '#e91c23', '#b21a26',
                            ];
                            return colors[value];
                        }
                        // Adding the pin
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
                                // Click pin popup
                                .bindPopup(`
                                <b>Station:</b> ${station.name_station}<br>
                    `);
                        }

                        // Function to trigger pin generation and filtering
                        function addMarkers() {
                            const uniqueStations = {};
                            const selectedType = document.getElementById('TypeVal').value;
                            const selectedProvince = document.getElementById('provinceVal').value;

                            map.eachLayer((layer) => {
                                if (layer instanceof L.CircleMarker) {
                                    map.removeLayer(layer);
                                }
                            });

                            const filteredStations = markerData.filter(station => {
                                const matchesType = selectedType === 'all' || station.tipe_station === selectedType;
                                const matchesProvince = selectedProvince === 'all' || station.nama_propinsi === selectedProvince;
                                return matchesType && matchesProvince;
                            });

                            filteredStations.forEach(station => {
                                if (!uniqueStations[station.name_station]) {
                                    uniqueStations[station.name_station] = true;
                                    createCircleMarker(station.lat, station.lon, mapTipeStationToInt(station.tipe_station), station);
                                }
                            });
                        }
                        // Reset view button
                        const resetButton = L.control({ position: 'topright' });
                        resetButton.onAdd = () => {
                            const button = L.DomUtil.create('button', 'reset-button');
                            button.innerHTML = 'Reset View';
                            button.style.backgroundColor = '#fff';
                            button.style.border = '1px solid #ccc';
                            button.style.padding = '5px 10px';
                            button.style.cursor = 'pointer';
                            button.onclick = () => {
                                map.setView(initialCenter, initialZoom);
                            };
                            return button;
                        };
                        resetButton.addTo(map);
                        addMarkers();

                        document.getElementById('TypeVal').addEventListener('change', addMarkers);
                        document.getElementById('provinceVal').addEventListener('change', addMarkers);
                    });

document.addEventListener('DOMContentLoaded', () => {
    const rawData = @json($markerData); // Assuming this contains raw station data passed from the controller
    let chart1Instance;

    // Group and normalize data by type and province dynamically
    function groupAndNormalizeData(rawData) {
        const groupedData = rawData.reduce((acc, station) => {
            const { tipe_station: type, nama_propinsi: province } = station;

            if (!acc[type]) {
                acc[type] = { values: {}, provinces: new Set() };
                for (let i = 0; i <= 9; i++) {
                    acc[type].values[`Value ${i}`] = 0;
                }
            }

            // Sum values for the current type
            for (let i = 0; i <= 9; i++) {
                acc[type].values[`Value ${i}`] += station.overall_values[i] || 0;
            }

            // Track provinces for this type
            acc[type].provinces.add(province);

            return acc;
        }, {});

        // Normalize percentages for each type
        Object.keys(groupedData).forEach((type) => {
            const total = Object.values(groupedData[type].values).reduce((sum, value) => sum + value, 0);
            groupedData[type].values = Object.keys(groupedData[type].values).reduce((normalized, key) => {
                normalized[key] = total > 0 ? (groupedData[type].values[key] / total) * 100 : 0;
                return normalized;
            }, {});
            groupedData[type].provinces = Array.from(groupedData[type].provinces);
        });

        return groupedData;
    }

    const tipeStationData = groupAndNormalizeData(rawData);

    // Filter and normalize data dynamically in the view
    function filterData() {
        const selectedType = document.getElementById('TypeVal').value;
        const selectedProvince = document.getElementById('provinceVal').value;

        // Filter `tipeStationData` by type and province
        const filteredData = Object.keys(tipeStationData)
            .filter((type) => {
                const matchesType = selectedType === 'all' || type === selectedType;
                const matchesProvince =
                    selectedProvince === 'all' || tipeStationData[type].provinces.includes(selectedProvince);
                return matchesType && matchesProvince;
            })
            .reduce((filtered, type) => {
                filtered[type] = tipeStationData[type].values;
                return filtered;
            }, {});

        return filteredData;
    }

    // Update the chart data
    function updateChartData(filteredData) {
        const labels = Object.keys(filteredData); // Station types
        const datasets = Object.keys(filteredData[labels[0]] || {}).map((key, index) => ({
            label: `Value ${key}`,
            data: labels.map((label) => filteredData[label][key]),
            backgroundColor: `rgba(${50 + index * 20}, ${100 + index * 10}, ${150 - index * 10}, 0.5)`,
        }));

        return { labels, datasets };
    }

    // Update the chart
    function updateChart() {
        const filteredData = filterData();
        const { labels, datasets } = updateChartData(filteredData);

        // Update the chart with new data
        chart1Instance.data.labels = labels;
        chart1Instance.data.datasets = datasets;
        chart1Instance.update();
    }

    // Initialize the chart with the full data
    const ctx1 = document.getElementById('chart1').getContext('2d');
    chart1Instance = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: Object.keys(tipeStationData),
            datasets: Object.keys(tipeStationData[Object.keys(tipeStationData)[0]].values).map((key, index) => ({
                label: `Value ${key}`,
                data: Object.keys(tipeStationData).map((type) => tipeStationData[type].values[key]),
                backgroundColor: `rgba(${50 + index * 20}, ${100 + index * 10}, ${150 - index * 10}, 0.5)`,
            })),
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
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

    // Add event listeners for dropdown changes
    document.getElementById('TypeVal').addEventListener('change', updateChart);
    document.getElementById('provinceVal').addEventListener('change', updateChart);
});



                    // Second Chart: Overall percentages
                    const ctx2 = document.getElementById('chart2').getContext('2d');
                    new Chart(ctx2, {
                        type: 'pie',
                        data: {
                            labels: {!! json_encode(array_keys($overallSum)) !!},
                            datasets: [{
                                label: 'Overall Percentages',
                                data: {!! json_encode(array_values($overallSum)) !!},
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(200, 99, 132, 0.2)',
                                    'rgba(100, 162, 235, 0.2)',
                                    'rgba(150, 206, 86, 0.2)',
                                    'rgba(175, 192, 192, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(200, 99, 132, 1)',
                                    'rgba(100, 162, 235, 1)',
                                    'rgba(150, 206, 86, 1)',
                                    'rgba(175, 192, 192, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                            },
                        }
                    });
                </script>

        </main>
    </div>
</body>

</html>