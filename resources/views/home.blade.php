<!DOCTYPE html>
<html lang="en" class="h-full bg-[#f0f6fb]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QC Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <div id="table" class="border border-[#64719b] rounded-xl mb-6" style="padding: 15px;">
                    <div style="width: 100%; margin: auto;">
                        <form action="{{ route('stations.filter') }}" method="GET"
                            style="display: flex; flex-direction: column; gap: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="flex: 1; margin-right: 15px;">
                                    <label for="start_date"
                                        style="display: block; font-weight: bold; color: #333; margin-bottom: 18px;">Start
                                        Date</label>
                                    <input type="date" name="start_date" id="start_date" required
                                        placeholder="Select start date"
                                        style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;"
                                        value="{{ request('start_date') }}" />
                                </div>
                                <div style="flex: 1; position: relative;">
                                    <label for="end_date"
                                        style="display: block; font-weight: bold; color: #333; margin-bottom: 18px;">End
                                        Date</label>
                                    <input type="date" name="end_date" id="end_date" required
                                        placeholder="Select end date"
                                        style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;"
                                        value="{{ request('end_date') }}" />
                                    <button type="button" id="downloadAllDataButton"
                                        style="position: absolute; top: 0; right: 0; padding: 7px 12px; background-color: #007BFF; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;">
                                        Download Seluruh Data
                                    </button>

                                </div>
                            </div>


                            <div
                                style="display: flex; justify-content: space-between; align-items: stretch; width: 100%; gap: 10px;">
                                <div style="display: flex; flex-grow: 1; gap: 10px;">
                                    <button type="button" id="todayButton"
                                        style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s; flex: 1;">
                                        Today
                                    </button>
                                    <button type="button" id="last7DaysButton"
                                        style="padding: 10px 20px; background-color: #ffc107; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s; flex: 1;">
                                        Last 7 Days
                                    </button>
                                    <button type="button" id="last30DaysButton"
                                        style="padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s; flex: 1;">
                                        Last 30 Days
                                    </button>
                                </div>
                                <button type="submit"
                                    style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s; flex: 6;">
                                    Filter By Date
                                </button>
                            </div>


                        </form>
                    </div>


                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mt-8">
                        <div>
                            <label for="flagVal" class="block text-sm font-medium text-gray-700">Select Data
                                Type:</label>
                            <select style="padding: 10px;" id="flagVal"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                <option style="padding: 10px;" value="overall_value">All Data Reading</option>
                                @foreach($dropdownOptions['flags'] as $flag)
                                    <option value="{{ $flag }}">{{ ucfirst(str_replace('_', ' ', $flag)) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="TypeVal" class="block text-sm font-medium text-gray-700">Select Machine
                                Type:</label>
                            <select style="padding: 10px;" id="TypeVal"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                <option style="padding: 10px;" value="all">All Machines</option>
                                @foreach($dropdownOptions['machineTypes'] as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="provinceVal" class="block text-sm font-medium text-gray-700">Select
                                Province:</label>
                            <select style="padding: 10px;" id="provinceVal"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                <option style="padding: 10px;" value="all">All Provinces</option>
                                @foreach($dropdownOptions['provinces'] as $province)
                                    <option value="{{ $province }}">{{ $province }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div id="table" class="border border-[#64719b] rounded-xl mt- 6 mb-6" style="padding: 15px;">
                    <div id="map" class="rounded-xl"></div>
                </div>

                <div class="flex flex-wrap lg:flex-nowrap justify-between items-start gap-6 mt-10 w-full"
                    style="margin: auto;">
                    <!-- Bar Chart -->
                    <div class="chart-container w-full lg:w-4/5 border border-[#64719b] rounded-xl p-2">
                        <div class="relative h-[70vh] max-h-[600px]" id="bar-chart-container">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>

                    <!-- Pie/Doughnut Charts -->
                    <div class="flex flex-col w-full lg:w-1/5 relative h-[70vh] max-h-[500px] gap-4">
                        <div class="chart-container flex-1 border border-[#64719b] rounded-xl p-2">
                            <div class="relative h-full">
                                <canvas id="chart2"></canvas>
                            </div>
                        </div>
                        <div class="chart-container flex-1 border border-[#64719b] rounded-xl p-2">
                            <div class="relative h-full">
                                <canvas id="chart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    function captureChartAsImage(canvasId) {
                        const canvas = document.getElementById(canvasId);
                        if (!canvas) {
                            console.error("Chart canvas not found:", canvasId);
                            return null;
                        }
                        return canvas.toDataURL('image/png'); // Convert the chart to a base64 image
                    }


                    function downloadStationReport(stationName) {
                        // Fetch start_date and end_date from the URL
                        const startDate = document.getElementById('start_date').value;
                        const endDate = document.getElementById('end_date').value;
                        const selectedFlag = document.getElementById('flagVal').value;

                        // Fallback to defaults if dates are not present in the URL
                        if (!startDate || !endDate) {
                            const today = new Date();
                            const last7Days = new Date(today);
                            last7Days.setDate(today.getDate() - 6);

                            startDate = last7Days.toISOString().split('T')[0];
                            endDate = today.toISOString().split('T')[0];
                        }

                        // Capture the chart image
                        const chartImage = captureChartAsImage(`chart-${stationName.replace(/\s+/g, '-')}`);

                        // Build the URL with date parameters & chart image
                        const url = `/station/download-pdf?station_name=${encodeURIComponent(stationName)}&start_date=${startDate}&end_date=${endDate}&selected_flag=${encodeURIComponent(selectedFlag)}&chart_image=${encodeURIComponent(chartImage || '')}`;

                        window.open(url, '_blank');
                    }

                    document.getElementById("downloadAllDataButton").addEventListener("click", () => {
                        const startDate = document.getElementById('start_date').value;
                        const endDate = document.getElementById('end_date').value;
                        const selectedFlag = document.getElementById('flagVal').value;
                        const type = document.getElementById('TypeVal').value;
                        const province = document.getElementById('provinceVal').value;

                        if (!startDate || !endDate) {
                            alert("Please select a valid start date and end date.");
                            return;
                        }

                        // Capture chart images (same as displayed on screen)
                        const chart1Image = captureChartAsImage(`chart1`);
                        const chart2Image = captureChartAsImage(`chart2`);

                        // Construct URL with extracted chart data
                        const url = `/stations/download-all-pdf?start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}&selected_flag=${encodeURIComponent(selectedFlag)}&type=${encodeURIComponent(type)}&province=${encodeURIComponent(province)}&chart_image1=${encodeURIComponent(chart1Image || '')}&chart_image2=${encodeURIComponent(chart2Image || '')}`;

                        window.open(url, "_blank");
                    });




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
            <br>
            <button class="download-btn" style="padding: 7px 12px; background-color: #007BFF; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;"
                onclick="downloadStationReport('${station.name_station}')">
                Download Report Station
            </button>
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
                                groupedByDate[date].valid = ((groupedByDate[date].valid / total) * 100).toFixed(2);
                                groupedByDate[date].invalid = ((groupedByDate[date].invalid / total) * 100).toFixed(2);
                                groupedByDate[date].missing = ((groupedByDate[date].missing / total) * 100).toFixed(2);
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
                            }, 200); // Ensures the popup is fully rendered before initializing the chart

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
                            const validData = labels.map(label => Number(data[label].valid).toFixed(2));
                            const invalidData = labels.map(label => Number(data[label].invalid).toFixed(2));
                            const missingData = labels.map(label => Number(data[label].missing).toFixed(2));

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
                                ((overallSum.valid / overallSum.total) * 100).toFixed(2),
                                ((overallSum.invalid / overallSum.total) * 100).toFixed(2),
                                ((overallSum.missing / overallSum.total) * 100).toFixed(2)
                            ];

                            chart2Instance.update();
                        }

                        const processedData = normalizeData(processData(rawData));

                        const ctx1 = document.getElementById('chart1').getContext('2d');
                        chart1Instance = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: [],
                                datasets: [],
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'Persentase Validasi Berdasarkan Tipe Mesin', // Bar chart title
                                        font: {
                                            size: 16, // Title font size
                                            weight: 'bold', // Title font weight
                                        },
                                        padding: {
                                            top: 10,
                                            bottom: 10,
                                        },
                                    },
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        stacked: true,
                                        max: 100, // Maximum value for y-axis
                                    },
                                    x: {
                                        stacked: true, // Stacked bars
                                    },
                                },
                            },
                        });

                        const ctx2 = document.getElementById('chart2').getContext('2d');
                        chart2Instance = new Chart(ctx2, {
                            type: 'pie',
                            data: {
                                labels: [], // Example: ['Category A', 'Category B', 'Category C']
                                datasets: [
                                    {
                                        label: 'Overall Percentages',
                                        data: [], // Example: [40, 30, 30]
                                        backgroundColor: ['#006d7e', '#f7c92e', '#b12629'],
                                    },
                                ],
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'right',
                                        labels: {
                                            boxWidth: 10, // Smaller box size for legend
                                            usePointStyle: true, // Use point style instead of default square
                                            pointStyle: 'circle', // Change the legend symbol to a circle
                                        },
                                    },
                                    title: {
                                        display: true,
                                        text: 'Persentase Validasi Global', // Chart title
                                        font: {
                                            size: 16, // Title font size
                                            weight: 'bold', // Title font weight
                                        },
                                        padding: {
                                            top: 10,
                                            bottom: 10,
                                        },
                                    },
                                },
                            },
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

                        function calculateTotal(dataArray) {
                            return dataArray.reduce((acc, val) => acc + val, 0); // Sum all data values
                        }

                        chart3Instance = new Chart(ctx3, {
                            type: 'doughnut',
                            data: {
                                labels: [], // Example: ['Mesin A', 'Mesin B', 'Mesin C']
                                datasets: [
                                    {
                                        label: 'Jumlah Mesin',
                                        data: [], // Example: [10, 20, 30]
                                        backgroundColor: [], // Example: ['#FF6384', '#36A2EB', '#FFCE56']
                                    },
                                ],
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'right',
                                        labels: {
                                            boxWidth: 10, // Smaller box size for the color indicator
                                            usePointStyle: true, // Use a circular shape
                                            pointStyle: 'circle', // Set the shape to a circle
                                            generateLabels: (chart) => {
                                                const data = chart.data;
                                                const dataset = data.datasets[0];
                                                return data.labels.map((label, index) => {
                                                    const value = dataset.data[index];
                                                    return {
                                                        text: `${label}: ${value}`, // Combines the label and the value
                                                        fillStyle: dataset.backgroundColor[index],
                                                        hidden: false,
                                                        pointStyle: 'circle', // Ensures a circular style
                                                    };
                                                });
                                            },
                                        },
                                    },
                                    title: {
                                        display: true,
                                        text: (ctx) => {
                                            const total = calculateTotal(ctx.chart.data.datasets[0].data);
                                            return `Distribusi Mesin (Total=${total})`;
                                        }, // Dynamically updates the title
                                        font: {
                                            size: 16, // Title font size
                                            weight: 'bold', // Title font weight
                                        },
                                        padding: {
                                            top: 10,
                                            bottom: 10,
                                        },
                                    },
                                },
                            },
                        });

                        updateChart3();

                        document.getElementById('provinceVal').addEventListener('change', updateChart3);
                    });

                </script>
            </div>
        </main>
        <x-footer />
    </div>
</body>

</html>