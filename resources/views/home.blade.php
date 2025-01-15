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
        //date filter
        flatpickr("#start_date", {
                dateFormat: "Y-m-d",
            });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
        });

        //Basically everything map(Showing map and it boundary, pin, filtering map data)
        document.addEventListener('DOMContentLoaded', () => {

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

                    `);
            }
            

            // Function to trigger pin generation and filtering
            function addMarkers() {
            const uniqueStations = {};

            markerData.forEach((station) => {
                const stationName = station.name_station;

                if (!uniqueStations[stationName]) {
                    uniqueStations[stationName] = true;

                    // Find the largest overall percentage value
                    const maxIndex = station.overall_values.indexOf(
                        Math.max(...station.overall_values)
                    );

                    // Add the marker to the map
                    createCircleMarker(
                        station.lat,
                        station.lon,
                        maxIndex,
                        station
                    );
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

            addMarkers(markerData);
        });



        // First Chart: Stacked bar for tipe_station
        const ctx1 = document.getElementById('chart1').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($tipeStationData->keys()) !!},
                datasets: [
                    {
                        label: 'Value 0',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 0'])->values()) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    },
                    {
                        label: 'Value 1',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 1'])->values()) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    },
                    {
                        label: 'Value 2',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 2'])->values()) !!},
                        backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    },
                    {
                        label: 'Value 3',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 3'])->values()) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    },
                    {
                        label: 'Value 4',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 4'])->values()) !!},
                        backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    },
                    {
                        label: 'Value 5',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 5'])->values()) !!},
                        backgroundColor: 'rgba(255, 159, 64, 0.5)',
                    },
                    {
                        label: 'Value 6',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 6'])->values()) !!},
                        backgroundColor: 'rgba(200, 99, 132, 0.5)',
                    },
                    {
                        label: 'Value 7',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 7'])->values()) !!},
                        backgroundColor: 'rgba(100, 162, 235, 0.5)',
                    },
                    {
                        label: 'Value 8',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 8'])->values()) !!},
                        backgroundColor: 'rgba(150, 206, 86, 0.5)',
                    },
                    {
                        label: 'Value 9',
                        data: {!! json_encode($tipeStationData->map(fn($values) => $values['Value 9'])->values()) !!},
                        backgroundColor: 'rgba(175, 192, 192, 0.5)',
                    }
                ]
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
                        max: 100 // Ensure the Y-axis maximum is set to 100
                    },
                    x: {
                        stacked: true
                    }
                }
            }
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
