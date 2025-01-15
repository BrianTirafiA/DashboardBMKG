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

    <!-- UI Line -->
    <div class="min-h-full">
        <x-navbar-admin/>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard Quality Control AWS Center</h1>
            <h3>Showing the latest data from</h3>
                <ul>
                    @foreach ($distinct_dates as $date)
                        <li>• {{ \Carbon\Carbon::parse($date->date)->format('Y-m-d') }}</li>
                    @endforeach
                </ul>
                <h3>Stations Added in the Selected Range ({{ $addedStationsCount }}) data count({{ $fetchCount }})</h3>
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
                    <!-- Flag Type Dropdown -->
                    <div>
                        <label for="flagVal" class="font-semibold text-lg" style="font-weight: bold; color: #333;">Select Flag Type: </label>
                        <select id="flagVal" class="px-4 py-2 border rounded">
                            <option value="All">All Flag</option>
                            <option value="average_flag">Average Flag</option>
                            @foreach($dropdownOptions['flags'] as $flag)
                                <option value="{{ $flag }}">{{ ucfirst(str_replace('_', ' ', $flag)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Machine Type Dropdown -->
                    <div>
                        <label for="TypeVal" class="font-semibold text-lg" style="font-weight: bold; color: #333;">Select Machine Type: </label>
                        <select id="TypeVal" class="px-4 py-2 border rounded">
                            <option value="All">All Machine</option>
                            @foreach($dropdownOptions['machineTypes'] as $machineType)
                                <option value="{{ $machineType }}">{{ $machineType }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Province Filter Dropdown -->
                    <div>
                        <label for="provinceVal" class="font-semibold text-lg" style="font-weight: bold; color: #333;">Select Province: </label>
                        <select id="provinceVal" class="px-4 py-2 border rounded">
                            <option value="All">All Provinces</option>
                            @foreach($dropdownOptions['provinces'] as $province)
                                <option value="{{ $province }}">{{ $province }}</option>
                            @endforeach
                        </select>
                    </div>
                <div>
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
                <div id="map" class="mt-6"></div>
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
                    <canvas id="flagTypeChart"></canvas>
                    </div>
                </div>

                <!-- Second Chart Container (Shorter Chart) -->
                <div class="chart-container w-full sm:w-2/3 lg:w-1/3 lg:ml-auto">
                    <div class="relative h-[50vh] lg:h-[60vh] max-h-400px">
                    <canvas id="flagChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap justify-center items-start mt-4">
            <div class="chart-container w-full sm:w-3/4 lg:w-1/2">
                <canvas id="stationChart"></canvas>
            </div>
            </div>

            <!-- Script Line -->
             
            <!-- Initialyzing flatpickr for date range -->
            <script>
                flatpickr("#start_date", {
                    dateFormat: "Y-m-d",
                });

                flatpickr("#end_date", {
                    dateFormat: "Y-m-d",
                });
            </script>

            <!-- Basically everything map(Showing map and it boundary, pin, filtering map data) -->
            <script>
                const stations = @json($stations);

                document.addEventListener('DOMContentLoaded', () => {
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
                                <strong>Station Name:</strong> ${station.name_station} <br>
                                <strong>Station Type:</strong> ${station.tipe_station} <br>
                                <strong>Province :</strong> ${station.nama_propinsi} <br>
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
                    

                    // Function to trigger pin generation and filtering
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
                        // filteredStations.forEach(station => {
                        //     createCircleMarker(station.latt_station, station.long_station, station[selectedFlag], station);
                        // });
                    // }

                        if (selectedFlag === "All") {
                            // When "All" is selected, show only the average flag value
                            filteredStations.forEach(station => {
                                createCircleMarker(station.latt_station, station.long_station, station.average_flag, station);
                            });
                        } else {
                            // When a specific flag is selected, show the values for that flag
                            filteredStations.forEach(station => {
                                createCircleMarker(station.latt_station, station.long_station, station[selectedFlag], station);
                            });
                        }
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

                    document.getElementById('flagVal').addEventListener('change', addMarkers);
                    document.getElementById('TypeVal').addEventListener('change', addMarkers);
                    document.getElementById('provinceVal').addEventListener('change', addMarkers);
                });
            </script>

             <!-- Each station type flag chart -->
            <script>
            document.addEventListener('DOMContentLoaded', () => {
    const stations = @json($stations); // Ensure this JSON data matches your view schema

    let chartInstance = null;

    function updateChart() {
        const selectedFlag = document.getElementById('flagVal').value; // e.g., "rr_flag"
        const selectedType = document.getElementById('TypeVal').value;
        const selectedProvince = document.getElementById('provinceVal').value;

        if (!stations || stations.length === 0) {
            console.error("No station data available.");
            return;
        }

        // Filter stations based on dropdown selections
        const filteredStations = stations.filter((station) => {
            const matchesType = selectedType === 'All' || station.tipe_station === selectedType;
            const matchesProvince = selectedProvince === 'All' || station.nama_propinsi === selectedProvince;
            return matchesType && matchesProvince;
        });

        // Group data by machine type
        const groupedData = {};

        filteredStations.forEach((station) => {
            if (!groupedData[station.tipe_station]) {
                groupedData[station.tipe_station] = Array(10).fill(0);
            }
            for (let i = 0; i <= 9; i++) {
                const percentKey = `${selectedFlag}_${i}_percent`; // Example: "rr_flag_0_percent"
                if (station[percentKey] !== undefined) {
                    groupedData[station.tipe_station][i] += parseFloat(station[percentKey]) || 0;
                }
            }
        });

        const labels = Object.keys(groupedData);
        const datasets = [];
        const colors = [
            '#369bcf', '#28a79e', '#39b449', '#8cc63e',
            '#e1cf23', '#f8af3e', '#f7941f',
            '#ec5828', '#e91c23', '#b21a26',
        ];

        for (let i = 0; i <= 9; i++) {
            const data = labels.map((label) => groupedData[label][i]);
            datasets.push({
                label: `Value ${i}`,
                data,
                backgroundColor: colors[i],
            });
        }

        // Destroy the existing chart instance if it exists
        if (chartInstance) {
            chartInstance.destroy();
        }

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
                        max: 100,
                        ticks: {
                            callback: (value) => `${value}%`,
                        },
                    },
                },
            },
        });
    }

    // Attach event listeners for dropdown changes
    document.getElementById('flagVal').addEventListener('change', updateChart);
    document.getElementById('TypeVal').addEventListener('change', updateChart);
    document.getElementById('provinceVal').addEventListener('change', updateChart);

    // Initial rendering
    updateChart();
});

            </script>

            <!-- Combined station type flag chart -->
            <script>
document.addEventListener('DOMContentLoaded', () => {
    const stations = @json($stations); // Ensure this JSON data matches your view schema

    let chartInstance = null;

    function updateChart() {
        const selectedFlag = document.getElementById('flagVal').value; // e.g., "rr_flag"
        const selectedType = document.getElementById('TypeVal').value;
        const selectedProvince = document.getElementById('provinceVal').value;

        if (!stations || stations.length === 0) {
            console.error("No station data available.");
            return;
        }

        // Filter stations based on dropdown selections
        const filteredStations = stations.filter((station) => {
            const matchesType = selectedType === 'All' || station.tipe_station === selectedType;
            const matchesProvince = selectedProvince === 'All' || station.nama_propinsi === selectedProvince;
            return matchesType && matchesProvince;
        });

        // Aggregate percentages for the selected flag
        const flagCounts = Array(10).fill(0);

        filteredStations.forEach((station) => {
            for (let i = 0; i <= 9; i++) {
                const percentKey = `${selectedFlag}_${i}_percent`; // Example: "rr_flag_0_percent"
                if (station[percentKey] !== undefined) {
                    flagCounts[i] += parseFloat(station[percentKey]) || 0;
                }
            }
        });

        const totalPercentage = flagCounts.reduce((sum, count) => sum + count, 0);
        const flagPercentages = flagCounts.map((count) => (totalPercentage > 0 ? count.toFixed(2) : 0));

        // Destroy the existing chart instance if it exists
        if (chartInstance) {
            chartInstance.destroy();
        }

        const ctx = document.getElementById('flagChart').getContext('2d');
        chartInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                datasets: [{
                    label: `Flag Distribution (${selectedFlag})`,
                    data: flagPercentages,
                    backgroundColor: [
                        '#369bcf', '#28a79e', '#39b449', '#8cc63e',
                        '#e1cf23', '#f8af3e', '#f7941f',
                        '#ec5828', '#e91c23', '#b21a26',
                    ],
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `Value ${context.label}: ${context.raw}%`;
                            },
                        },
                    },
                },
            },
        });
    }

    // Attach event listeners for dropdown changes
    document.getElementById('flagVal').addEventListener('change', updateChart);
    document.getElementById('TypeVal').addEventListener('change', updateChart);
    document.getElementById('provinceVal').addEventListener('change', updateChart);

    // Initial rendering
    updateChart();
});

            </script>

            <!-- latest station count chart -->
            <script>
                const stationLabels = @json(array_column($stationCounts, 'tipe_station'));
                const stationData = @json(array_column($stationCounts, 'count'));

                // Calculate the total
                const totalStations = stationData.reduce((sum, value) => sum + value, 0);

                // Create the chart
                const ctx = document.getElementById('stationChart').getContext('2d');
                const stationChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: stationLabels,
                        datasets: [{
                            label: 'Number of Stations',
                            data: stationData,
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    generateLabels: function(chart) {
                                        const labels = chart.data.labels;
                                        const data = chart.data.datasets[0].data;
                                        const colors = chart.data.datasets[0].backgroundColor;

                                        // Generate legend items for each station type
                                        const stationLegends = labels.map((label, index) => ({
                                            text: `${label}: ${data[index]}`,
                                            fillStyle: colors[index],
                                            hidden: false,
                                            lineCap: 'butt',
                                            lineDash: [],
                                            lineDashOffset: 0,
                                            lineJoin: 'miter',
                                            pointStyle: 'circle',
                                            strokeStyle: colors[index],
                                            textAlign: 'left'
                                        }));

                                        // Add a "Total" legend item
                                        stationLegends.push({
                                            text: `Total: ${totalStations}`,
                                            fillStyle: 'rgba(0, 0, 0, 0)', // Transparent (no color block)
                                            hidden: false,
                                            lineCap: 'butt',
                                            lineDash: [],
                                            lineDashOffset: 0,
                                            lineJoin: 'miter',
                                            pointStyle: 'rect',
                                            strokeStyle: 'rgba(0, 0, 0, 0)',
                                            textAlign: 'left'
                                        });

                                        return stationLegends;
                                    }
                                },
                                onClick: null
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </main>
    </div>
</body>
</html>

// <!-- <script>
//                 const stations = @json($stations);

//                 document.addEventListener('DOMContentLoaded', () => {
//                     // Map visual setting
//                     const map = L.map('map', { attributionControl: false }).setView([-2.0, 118.0], 5);

//                     const initialCenter = [-2.0, 118.0]; // increase(+) or decrease(-) the value to change [+Higher -lower, +Right -left]
//                     const initialZoom = 5;

//                     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                         maxZoom: 19,
//                     }).addTo(map);

//                     // Map border
//                     const bounds = [
//                         [-20.0, 80.0], // increase(+) to make it smaller or decrease(-) to make it larger [+DecreaseSouth -InscreaseSouth, +DecreaseWest -InscreaseWest]
//                         [22.0, 151.0], // increase(+) to make it larger or decrease(-) to make it smaller [+InscreaseNorth -DecreaseNorth, +InscreaseEast -DecreaseEast]
//                     ];
//                     map.setMaxBounds(bounds);

//                     map.setMinZoom(5);
//                     map.setMaxZoom(15);

//                     // Color of pin
//                     function getColor(value) {
//                         const colors = [
//                             '#369bcf', '#28a79e', '#39b449', '#8cc63e',
//                             '#e1cf23', '#f8af3e', '#f7941f',
//                             '#ec5828', '#e91c23', '#b21a26',
//                         ];
//                         return colors[value];
//                     }

//                     // Adding the pin
//                     function createCircleMarker(lat, lon, value, station) {
//                         L.circleMarker([lat, lon], {
//                             radius: 10,
//                             fillColor: getColor(value),
//                             color: getColor(value),
//                             weight: 1,
//                             opacity: 1,
//                             fillOpacity: 0.6,
//                         })
//                             .addTo(map)
//                             // Click pin popup
//                             .bindPopup(`
//                                 <strong>Station Name:</strong> ${station.name_station} <br>
//                                 <strong>Station Type:</strong> ${station.tipe_station} <br>
//                                 <strong>Province :</strong> ${station.nama_propinsi} <br>
//                                 <strong>rr_flag:</strong> ${station.rr_flag} <br>
//                                 <strong>pp_air_flag:</strong> ${station.pp_air_flag} <br>
//                                 <strong>rh_avg_flag:</strong> ${station.rh_avg_flag} <br>
//                                 <strong>sr_avg_flag:</strong> ${station.sr_avg_flag} <br>
//                                 <strong>sr_max_flag:</strong> ${station.sr_max_flag} <br>
//                                 <strong>nr_flag:</strong> ${station.nr_flag} <br>
//                                 <strong>wd_avg_flag:</strong> ${station.wd_avg_flag} <br>
//                                 <strong>ws_avg_flag:</strong> ${station.ws_avg_flag} <br>
//                                 <strong>ws_max_flag:</strong> ${station.ws_max_flag} <br>
//                                 <strong>wl_flag:</strong> ${station.wl_flag} <br>
//                                 <strong>tt_air_avg_flag:</strong> ${station.tt_air_avg_flag} <br>
//                                 <strong>tt_air_min_flag:</strong> ${station.tt_air_min_flag} <br>
//                                 <strong>tt_air_max_flag:</strong> ${station.tt_air_max_flag} <br>
//                                 <strong>tt_sea_flag:</strong> ${station.tt_sea_flag} <br>
//                                 <strong>ws_50cm_flag:</strong> ${station.ws_50cm_flag} <br>
//                                 <strong>wl_pan_flag:</strong> ${station.wl_pan_flag} <br>
//                                 <strong>ev_pan_flag:</strong> ${station.ev_pan_flag} <br>
//                                 <strong>tt_pan_flag:</strong> ${station.tt_pan_flag} <br>
//                                 <strong>Average Flag Value:</strong> ${station.average_flag}
//                             `);
//                     }

//                     // Function to trigger pin generation and filtering
//                     function addMarkers() {
//                         const selectedFlag = document.getElementById('flagVal').value;
//                         const selectedType = document.getElementById('TypeVal').value;
//                         const selectedProvince = document.getElementById('provinceVal').value;

//                         map.eachLayer((layer) => {
//                             if (layer instanceof L.CircleMarker) {
//                                 map.removeLayer(layer);
//                             }
//                         });

//                         const filteredStations = stations.filter(station => {
//                             const matchesType = selectedType === 'All' || station.tipe_station === selectedType;
//                             const matchesProvince = selectedProvince === 'All' || station.nama_propinsi === selectedProvince;
//                             return matchesType && matchesProvince;
//                         });

//                     //     if (selectedFlag === "All") {
//                     //     const flagsToInclude = [
//                     //         "rr_flag", "pp_air_flag", "rh_avg_flag", "sr_avg_flag", "sr_max_flag",
//                     //         "nr_flag", "wd_avg_flag", "ws_avg_flag", "ws_max_flag", "wl_flag",
//                     //         "tt_air_avg_flag", "tt_air_min_flag", "tt_air_max_flag", "tt_sea_flag",
//                     //         "ws_50cm_flag", "wl_pan_flag", "ev_pan_flag", "tt_pan_flag"
//                     //     ];

//                     //     filteredStations.forEach(station => {
//                     //         flagsToInclude.forEach(flag => {
//                     //             createCircleMarker(station.latt_station, station.long_station, station[flag], station);
//                     //         });
//                     //     });
//                     // } else {
//                         // When a specific flag is selected, display only that flag
//                         // filteredStations.forEach(station => {
//                         //     createCircleMarker(station.latt_station, station.long_station, station[selectedFlag], station);
//                         // });
//                     // }

//                         if (selectedFlag === "All") {
//                             // When "All" is selected, show only the average flag value
//                             filteredStations.forEach(station => {
//                                 createCircleMarker(station.latt_station, station.long_station, station.average_flag, station);
//                             });
//                         } else {
//                             // When a specific flag is selected, show the values for that flag
//                             filteredStations.forEach(station => {
//                                 createCircleMarker(station.latt_station, station.long_station, station[selectedFlag], station);
//                             });
//                         }
//                     }

//                     // Reset view button
//                     const resetButton = L.control({ position: 'topright' });
//                     resetButton.onAdd = () => {
//                         const button = L.DomUtil.create('button', 'reset-button');
//                         button.innerHTML = 'Reset View';
//                         button.style.backgroundColor = '#fff';
//                         button.style.border = '1px solid #ccc';
//                         button.style.padding = '5px 10px';
//                         button.style.cursor = 'pointer';

//                         button.onclick = () => {
//                             map.setView(initialCenter, initialZoom);
//                         };

//                         return button;
//                     };
//                     resetButton.addTo(map);

//                     addMarkers();

//                     document.getElementById('flagVal').addEventListener('change', addMarkers);
//                     document.getElementById('TypeVal').addEventListener('change', addMarkers);
//                     document.getElementById('provinceVal').addEventListener('change', addMarkers);
//                 });
//             </script>

//             <!-- Each station type flag chart -->
//             <script>
//                 document.addEventListener('DOMContentLoaded', () => {
//                     const stations = @json($stations);

//                     let chartInstance = null;

//                     function updateChart() {
//                         const selectedFlag = document.getElementById('flagVal').value;
//                         const selectedType = document.getElementById('TypeVal').value;
//                         const selectedProvince = document.getElementById('provinceVal').value;

//                         const filteredStations = stations.filter((station) => {
//                             const matchesType = selectedType === 'All' || station.tipe_station === selectedType;
//                             const matchesProvince = selectedProvince === 'All' || station.nama_propinsi === selectedProvince;
//                             return matchesType && matchesProvince;
//                         });

//                         const flagsToInclude = [
//                             "rr_flag", "pp_air_flag", "rh_avg_flag", "sr_avg_flag", "sr_max_flag",
//                             "nr_flag", "wd_avg_flag", "ws_avg_flag", "ws_max_flag", "wl_flag",
//                             "tt_air_avg_flag", "tt_air_min_flag", "tt_air_max_flag", "tt_sea_flag",
//                             "ws_50cm_flag", "wl_pan_flag", "ev_pan_flag", "tt_pan_flag"
//                         ];

//                         // Group data by machine type and calculate percentages
//                         const groupedData = {};

//                         filteredStations.forEach((station) => {
//                             const applicableFlags = selectedFlag === 'All' ? flagsToInclude : [selectedFlag];
//                             applicableFlags.forEach((flag) => {
//                                 const flagValue = station[flag];
//                                 if (!groupedData[station.tipe_station]) {
//                                     groupedData[station.tipe_station] = Array(10).fill(0);
//                                 }
//                                 if (flagValue >= 0 && flagValue <= 9) {
//                                     groupedData[station.tipe_station][flagValue]++;
//                                 }
//                             });
//                         });

//                         // Calculate percentages for each value (0-9) per machine type
//                         const labels = Object.keys(groupedData);
//                         const datasets = [];
//                         const colors = [
//                             '#369bcf', '#28a79e', '#39b449', '#8cc63e',
//                             '#e1cf23', '#f8af3e', '#f7941f',
//                             '#ec5828', '#e91c23', '#b21a26',
//                         ];

//                         for (let i = 0; i < 10; i++) {
//                             const data = labels.map((label) => {
//                                 const totalForType = groupedData[label].reduce((sum, count) => sum + count, 0);
//                                 const percentage = totalForType > 0 ? (groupedData[label][i] / totalForType) * 100 : 0;
//                                 return percentage;
//                             });
//                             datasets.push({
//                                 label: `Value ${i}`,
//                                 data,
//                                 backgroundColor: colors[i],
//                             });
//                         }

//                         // Destroy existing chart if it exists
//                         if (chartInstance) {
//                             chartInstance.destroy();
//                         }

//                         // Create a new chart
//                         const ctx = document.getElementById('flagTypeChart').getContext('2d');
//                         chartInstance = new Chart(ctx, {
//                             type: 'bar',
//                             data: {
//                                 labels,
//                                 datasets,
//                             },
//                             options: {
//                                 responsive: true,
//                                 plugins: {
//                                     legend: {
//                                         position: 'top',
//                                     },
//                                     tooltip: {
//                                         callbacks: {
//                                             label: function (context) {
//                                                 return `${context.dataset.label}: ${context.raw.toFixed(2)}%`;
//                                             },
//                                         },
//                                     },
//                                 },
//                                 scales: {
//                                     x: {
//                                         stacked: true,
//                                     },
//                                     y: {
//                                         stacked: true,
//                                         beginAtZero: true,
//                                         max: 100,
//                                         ticks: {
//                                             callback: function (value) {
//                                                 return `${value}%`;
//                                             },
//                                         },
//                                     },
//                                 },
//                             },
//                         });
//                     }

//                     // Event listeners for dropdown changes
//                     document.getElementById('flagVal').addEventListener('change', updateChart);
//                     document.getElementById('TypeVal').addEventListener('change', updateChart);
//                     document.getElementById('provinceVal').addEventListener('change', updateChart);

//                     // Initial chart rendering
//                     updateChart();
//                 });
//             </script>

//             <!-- Combined station type flag chart -->
//             <script>
//                 document.addEventListener('DOMContentLoaded', () => {
//                     const stations = @json($stations);

//                     let chartInstance = null; // Variable to store chart instance

//                     // Function to update the chart
//                     function updateChart() {
//                         // Get filter values
//                         const selectedFlag = document.getElementById('flagVal').value;
//                         const selectedType = document.getElementById('TypeVal').value;
//                         const selectedProvince = document.getElementById('provinceVal').value;

//                         // Filter stations based on selected dropdown
//                         const filteredStations = stations.filter((station) => {
//                             const matchesType = selectedType === 'All' || station.tipe_station === selectedType;
//                             const matchesProvince = selectedProvince === 'All' || station.nama_propinsi === selectedProvince;
//                             return matchesType && matchesProvince;
//                         });

//                         // Gather flag data from filtered stations
//                         const flagCounts = Array(10).fill(0);

//                         if (selectedFlag === "All") {
//                             const flagsToInclude = [
//                                 "rr_flag", "pp_air_flag", "rh_avg_flag", "sr_avg_flag", "sr_max_flag",
//                                 "nr_flag", "wd_avg_flag", "ws_avg_flag", "ws_max_flag", "wl_flag",
//                                 "tt_air_avg_flag", "tt_air_min_flag", "tt_air_max_flag", "tt_sea_flag",
//                                 "ws_50cm_flag", "wl_pan_flag", "ev_pan_flag", "tt_pan_flag"
//                             ];

//                             flagsToInclude.forEach(flag => {
//                                 filteredStations.forEach((station) => {
//                                     const flagValue = station[flag];
//                                     if (flagValue >= 0 && flagValue <= 9) {
//                                         flagCounts[flagValue]++;
//                                     }
//                                 });
//                             });
//                         } else {
//                             // Use the selected flag to update the chart
//                             filteredStations.forEach((station) => {
//                                 const flagValue = station[selectedFlag];
//                                 if (flagValue >= 0 && flagValue <= 9) {
//                                     flagCounts[flagValue]++;
//                                 }
//                             });
//                         }

//                         const totalFlags = flagCounts.reduce((a, b) => a + b, 0);
//                         const flagPercentages = flagCounts.map((count) =>
//                             totalFlags > 0 ? ((count / totalFlags) * 100).toFixed(2) : 0
//                         );

//                         if (chartInstance) {
//                             chartInstance.destroy();
//                         }

//                         // Create or update the chart
//                         const ctx = document.getElementById('flagChart').getContext('2d');
//                         chartInstance = new Chart(ctx, {
//                             type: 'doughnut',
//                             data: {
//                                 labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
//                                 datasets: [{
//                                     label: `Flag Distribution (${selectedFlag})`,
//                                     data: flagPercentages, // Use the calculated percentages
//                                     backgroundColor: [
//                                 '#369bcf', '#28a79e', '#39b449', '#8cc63e',
//                                 '#e1cf23', '#f8af3e', '#f7941f',
//                                 '#ec5828', '#e91c23', '#b21a26',
//                             ],
//                                 }],
//                             },
//                             options: {
//                                 responsive: true,
//                                 plugins: {
//                                     legend: {
//                                         position: 'right',
//                                         labels: {
//                                             usePointStyle: true,
//                                             generateLabels: (chart) => {
//                                                 const data = chart.data;
//                                                 return data.labels.map((label, i) => {
//                                                     const value = data.datasets[0].data[i];
//                                                     const meta = chart.getDatasetMeta(0);
//                                                     const isHidden = meta.data[i].hidden || false;
//                                                     return {
//                                                         text: `${label} (${value}%)`,
//                                                         fillStyle: data.datasets[0].backgroundColor[i],
//                                                         hidden: isHidden,
//                                                         index: i,
//                                                     };
//                                                 });
//                                             },
//                                         },
//                                         onClick: (e, legendItem, legend) => {
//                                             const dataset = legend.chart.data.datasets[0];
//                                             const index = legendItem.index;
//                                             const meta = legend.chart.getDatasetMeta(0);

//                                             // Toggle visibility
//                                             meta.data[index].hidden = !meta.data[index].hidden;

//                                             // Recalculate and update the chart
//                                             legend.chart.update();
//                                         },
//                                     },
//                                     tooltip: {
//                                         callbacks: {
//                                             label: function(context) {
//                                                 const percentage = context.raw;
//                                                 return `Value ${context.label}: ${percentage}%`;
//                                             },
//                                         },
//                                     },
//                                 },
//                             },
//                         });
//                     }

//                     // Event listeners for dropdown changes
//                     document.getElementById('flagVal').addEventListener('change', updateChart);
//                     document.getElementById('TypeVal').addEventListener('change', updateChart);
//                     document.getElementById('provinceVal').addEventListener('change', updateChart);

//                     // Initial chart load
//                     updateChart();
//                 });

//             </script> -->
