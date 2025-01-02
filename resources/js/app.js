import './bootstrap';
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

document.addEventListener('DOMContentLoaded', () => {
    const map = L.map('map', {attributionControl: false,}).setView([-0.7893, 113.9213], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        // attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const bounds = [
        [-11.0, 95.0], // a Southwest corner (latitude, longitude)
        [6.5, 141.0]   // Northeast corner (latitude, longitude)
    ];
    map.setMaxBounds(bounds);

    // Set zoom limits
    map.setMinZoom(5);  // Minimum zoom level
    map.setMaxZoom(10); // Maximum zoom level

    // Function to get color based on value (0-9)
    function getColor(value) {
        const colors = [
            //valid
            '#0d4a70',
            //One flag
            '#228b3b',
            '#40ad5a',
            '#9ccb86',
            //Double flag
            '#eeb479',
            '#e9e29c',
            '#ffc61e',
            //Triple flag
            '#8f003b',
            //Missing
            '#ff1f5b' 
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

    // Example: Creating circle markers with different values
    createCircleMarker(-0.7893, 113.9213, 0);
    createCircleMarker(-0.7993, 114.9313, 1);
    createCircleMarker(-0.8093, 115.9413, 2);
    createCircleMarker(-1.4193, 113.9213, 3);
    createCircleMarker(-1.4293, 114.9313, 4);
    createCircleMarker(-1.4393, 115.9413, 5);
    createCircleMarker(-2.0493, 113.9213, 6);
    createCircleMarker(-2.0593, 114.9313, 7);
    createCircleMarker(-2.0693, 115.9413, 8);

});
