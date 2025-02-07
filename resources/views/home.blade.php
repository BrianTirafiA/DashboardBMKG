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

                    <div class="chart-container w-full sm:w-2/3 lg:w-1/3 lg:ml-auto">
                        <div class="relative h-[50vh] lg:h-[60vh] max-h-400px">
                            <canvas id="chart3"></canvas>
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

                        // Set today as default
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

                        let selectedFlag = 'overall_value';
                        // Map visual setting
                        const map = L.map('map', { attributionControl: false }).setView([-2.0, 118.0], 5);
                        const initialCenter = [-2.0, 118.0]; // increase(+) or decrease(-) the value to change [+Higher -lower, +Right -left]
                        const initialZoom = 5;

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
                        map.setMaxBounds([[-20.0, 80.0], [22.0, 151.0]]);
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
                                <canvas id="chart-${station.name_station.replace(/\s+/g, '-')}"></canvas>
                                `)
                                .on('popupopen', () => generatePopupChart(station));
                        }

                        function generatePopupChart(station) {
                            const stationData = markerData.filter(s => s.name_station === station.name_station);

                            const groupedByDate = {};
                            stationData.forEach(data => {
                                const date = data.date_only;
                                if (!groupedByDate[date]) {
                                    groupedByDate[date] = { valid: 0, invalid: 0, missing: 0, total: 0 };
                                }
                                for (let i = 0; i <= 9; i++) {
                                    const value = data[`${selectedFlag}_${i}_percent`] || 0;
                                    groupedByDate[date].total += value;
                                    if (i === 0) groupedByDate[date].valid += value;
                                    else if (i >= 1 && i <= 8) groupedByDate[date].invalid += value;
                                    else if (i === 9) groupedByDate[date].missing += value;
                                }
                            });

                            Object.keys(groupedByDate).forEach(date => {
                                const total = groupedByDate[date].total || 1;
                                groupedByDate[date].valid = (groupedByDate[date].valid / total) * 100;
                                groupedByDate[date].invalid = (groupedByDate[date].invalid / total) * 100;
                                groupedByDate[date].missing = (groupedByDate[date].missing / total) * 100;
                            });

                            const dates = Object.keys(groupedByDate).sort();
                            const validData = dates.map(date => groupedByDate[date].valid);
                            const invalidData = dates.map(date => groupedByDate[date].invalid);
                            const missingData = dates.map(date => groupedByDate[date].missing);

                            setTimeout(() => {
                                const ctx = document.getElementById(`chart-${station.name_station.replace(/\s+/g, '-')}`).getContext('2d');
                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: dates, // Each label is a date
                                        datasets: [
                                            { label: 'Valid', data: validData, backgroundColor: '#006d7e' },
                                            { label: 'Invalid', data: invalidData, backgroundColor: '#f7c830' },
                                            { label: 'Missing', data: missingData, backgroundColor: '#b12629' },
                                        ],
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: { legend: { position: 'top' } },
                                        scales: {
                                            y: { beginAtZero: true, stacked: true, max: 100 }, // Y-axis always stacks to 100%
                                            x: { stacked: true },
                                        },
                                    },
                                });
                            }, 500); // Ensures the popup is fully rendered before initializing the chart

                            return `
        <b>Station:</b> ${station.name_station}<br>
        <canvas id="chart-${station.name_station.replace(/\s+/g, '-')}"></canvas>
    `;
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
                                    createCircleMarker(station.latt_station, station.long_station, mapTipeStationToInt(station.tipe_station), station);
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

                        document.getElementById('flagVal').addEventListener('change', (event) => {
                            selectedFlag = event.target.value; // Update selected flag
                            updateCharts(); // Refresh the charts
                        });

                        addMarkers();

                        document.getElementById('TypeVal').addEventListener('change', addMarkers);
                        document.getElementById('provinceVal').addEventListener('change', addMarkers);
                    });
                    document.addEventListener('DOMContentLoaded', () => {
                        const rawData = @json($markerData);
                        let chart1Instance, chart2Instance;

                        // Default selected flag
                        let selectedFlag = 'overall_value';

                        function processData(data) {
                            return data.reduce((acc, station) => {
                                const type = station.tipe_station;
                                if (!acc[type]) {
                                    acc[type] = { valid: 0, invalid: 0, missing: 0, total: 0, provinces: new Set() };
                                }

                                for (let i = 0; i <= 9; i++) {
                                    const value = station[`${selectedFlag}_${i}_percent`] || 0;
                                    acc[type].total += value;
                                    if (i === 0) acc[type].valid += value;
                                    else if (i >= 1 && i <= 8) acc[type].invalid += value;
                                    else if (i === 9) acc[type].missing += value;
                                }
                                acc[type].provinces.add(station.nama_propinsi);
                                return acc;
                            }, {});
                        }

                        function normalizeData(data) {
                            Object.keys(data).forEach(type => {
                                const total = data[type].total || 1;
                                data[type].valid = (data[type].valid / total) * 100;
                                data[type].invalid = (data[type].invalid / total) * 100;
                                data[type].missing = (data[type].missing / total) * 100;
                            });
                            return data;
                        }

                        function filterData() {
                            const selectedType = document.getElementById('TypeVal').value;
                            const selectedProvince = document.getElementById('provinceVal').value;

                            const filteredData = rawData.filter(station => {
                                return (selectedType === 'all' || station.tipe_station === selectedType) &&
                                    (selectedProvince === 'all' || station.nama_propinsi === selectedProvince);
                            });

                            return normalizeData(processData(filteredData));
                        }

                        function updateCharts() {
                            const filteredData = filterData();
                            updateChart1(filteredData);
                            updateChart2(filteredData);
                        }

                        function updateChart1(data) {
                            const labels = Object.keys(data);
                            const validData = labels.map(label => data[label].valid);
                            const invalidData = labels.map(label => data[label].invalid);
                            const missingData = labels.map(label => data[label].missing);

                            chart1Instance.data.labels = labels;
                            chart1Instance.data.datasets = [
                                { label: 'Valid', data: validData, backgroundColor: '#006d7e' },
                                { label: 'Invalid', data: invalidData, backgroundColor: '#f7c92e' },
                                { label: 'Missing', data: missingData, backgroundColor: '#af2729' },
                            ];
                            chart1Instance.update();
                        }

                        function updateChart2(data) {
                            let overallSum = { valid: 0, invalid: 0, missing: 0, total: 0 };

                            Object.keys(data).forEach(type => {
                                overallSum.valid += data[type].valid;
                                overallSum.invalid += data[type].invalid;
                                overallSum.missing += data[type].missing;
                                overallSum.total += 100; // Since each type's values already sum to 100%
                            });

                            chart2Instance.data.labels = ['Valid', 'Invalid', 'Missing'];
                            chart2Instance.data.datasets[0].data = [
                                (overallSum.valid / overallSum.total) * 100,
                                (overallSum.invalid / overallSum.total) * 100,
                                (overallSum.missing / overallSum.total) * 100
                            ];
                            chart2Instance.update();
                        }

                        const processedData = normalizeData(processData(rawData));

                        const ctx1 = document.getElementById('chart1').getContext('2d');
                        chart1Instance = new Chart(ctx1, {
                            type: 'bar',
                            data: { labels: [], datasets: [] },
                            options: {
                                responsive: true,
                                plugins: { legend: { position: 'top' } },
                                scales: { y: { beginAtZero: true, stacked: true, max: 100 }, x: { stacked: true } },
                            },
                        });

                        const ctx2 = document.getElementById('chart2').getContext('2d');
                        chart2Instance = new Chart(ctx2, {
                            type: 'pie',
                            data: { labels: [], datasets: [{ label: 'Overall Percentages', data: [], backgroundColor: ['#006d7e', '#f7c92e', '#b12629'] }] },
                            options: { responsive: true, plugins: { legend: { position: 'top' } } },
                        });

                        document.getElementById('flagVal').addEventListener('change', (event) => {
                            selectedFlag = event.target.value; // Update selected flag
                            updateCharts(); // Refresh the charts
                        });

                        updateCharts();
                        document.getElementById('TypeVal').addEventListener('change', updateCharts);
                        document.getElementById('provinceVal').addEventListener('change', updateCharts);
                    });

                    document.addEventListener('DOMContentLoaded', () => {
    const rawData = @json($markerData);
    let chart3Instance;

    function countUniqueStationsByType(data) {
        const selectedProvince = document.getElementById('provinceVal').value;
        const uniqueStations = {};

        data.forEach(station => {
            if (selectedProvince === 'all' || station.nama_propinsi === selectedProvince) {
                uniqueStations[station.name_station] = station.tipe_station;
            }
        });

        const typeCounts = {};
        Object.values(uniqueStations).forEach(type => {
            typeCounts[type] = (typeCounts[type] || 0) + 1;
        });

        return typeCounts;
    }

    function updateChart3() {
        const uniqueCounts = countUniqueStationsByType(rawData);
        const labels = Object.keys(uniqueCounts);
        const counts = Object.values(uniqueCounts);
        const colors = ['#369bcf', '#28a79e', '#39b449', '#8cc63e', '#e1cf23', '#f8af3e', '#f7941f'];

        chart3Instance.data.labels = labels;
        chart3Instance.data.datasets[0].data = counts;
        chart3Instance.data.datasets[0].backgroundColor = colors.slice(0, labels.length);
        chart3Instance.update();
    }

    const ctx3 = document.getElementById('chart3').getContext('2d');
    chart3Instance = new Chart(ctx3, {
        type: 'doughnut',
        data: { labels: [], datasets: [{ label: 'Jumlah Mesin', data: [], backgroundColor: [] }] },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true } },
        },
    });

    updateChart3();

    document.getElementById('provinceVal').addEventListener('change', updateChart3);
});

                </script>

        </main>
    </div>
</body>

</html>