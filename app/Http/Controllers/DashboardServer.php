<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\RackAttribute;
use App\Models\RackAttributeValue;
use App\Models\RackStatuses;
use App\Models\Device;

use App\Models\RakPanel;
use App\Models\Panel;
use Illuminate\Http\Request;

class DashboardServer extends Controller
{
    public function index()
    {
        // Ambil semua rak yang ada dan urutkan berdasarkan nama
        $racks = Rack::all()->sortBy('name');

        $rackData = $racks->map(function ($rack) {
            // Hitung jumlah unik row_index yang sudah terisi
            $filledRows = RackAttributeValue::where('rack_id', $rack->id)
                ->whereNotNull('value')
                ->distinct('row_index') // Hitung hanya row_index unik
                ->count();

            return [
                'name' => $rack->name,
                'filled' => $filledRows, // Jumlah row terisi
                'total' => 43, // Total row tetap 43
            ];
        });

        // Ambil semua rak panel yang ada dan urutkan berdasarkan nama
        $rakPanels = RakPanel::with('panels')->get()->sortBy('name');

        $rackPanelData = $rakPanels->map(function ($rakPanel) {
            // Hitung jumlah panel yang memiliki atribut "rak" yang sudah terisi
            $filledPanels = $rakPanel->panels->filter(function ($panel) {
                return !empty($panel->rak); // Pastikan atribut "rak" tidak kosong
            })->count();

            return [
                'name' => $rakPanel->name,
                'filled' => $filledPanels,
                'total' => $rakPanel->panels->count(), // Total panel dalam rak panel
            ];
        });

        // Ambil attribute_id dari atribut dengan nama "Status"
        $statusAttribute = RackAttribute::where('name', 'Status')->first();

        $percentages = [];
        $colors = [];
        $labels = [];
        $statusCounts = [];

        // Mapping warna sesuai status
        $statusColorMapping = [
            'Beroperasi' => '#2ecc71', // Hijau
            'Stand By' => '#ffcc00',   // Kuning
            'Tidak Beroperasi' => '#e74c3c' // Merah
        ];

        if ($statusAttribute) {
            $statusData = RackAttributeValue::where('attribute_id', $statusAttribute->id)
                ->whereNotNull('value') // Mengabaikan yang NULL
                ->selectRaw('value, COUNT(*) as count')
                ->groupBy('value')
                ->get();

            $totalStatus = $statusData->sum('count');

            foreach ($statusData as $status) {
                // Ambil nama status dari tabel RackStatus berdasarkan ID yang tersimpan di RackAttributeValue
                $statusName = RackStatuses::where('id', $status->value)->value('nama_status');

                if ($statusName) { // Pastikan ada nama status
                    $percentage = round(($status->count / $totalStatus) * 100, 1);

                    $percentages[] = $percentage;
                    $labels[] = "{$statusName} ({$status->count} Unit - {$percentage}%)";
                    $colors[] = $statusColorMapping[$statusName] ?? '#3498db'; // Gunakan warna default jika status tidak dikenal
                    $statusCounts[] = [
                        'status' => $statusName,
                        'count' => $status->count
                    ];
                }
            }
        }

        $deviceAttribute = RackAttribute::where('name', 'Nama Device')->first();

        $rackSummary = $racks->map(function ($rack) use ($deviceAttribute) {
            if (!$deviceAttribute) {
                return null; // Jika atribut "Nama Device" tidak ditemukan, return null
            }

            // Ambil hanya nilai dengan attribute_id dari "Nama Device"
            $devices = RackAttributeValue::where('rack_id', $rack->id)
                ->where('attribute_id', $deviceAttribute->id) // Filter hanya "Nama Device"
                ->whereNotNull('value')
                ->pluck('value', 'row_index') // Ambil nilai (ID device) dengan row_index sebagai key
                ->toArray();

            // Konversi ID device menjadi nama device
            $deviceNames = Device::whereIn('id', array_values($devices))
                ->pluck('name_device', 'id')
                ->toArray();

            // Buat array 43 row (0-42), isi dengan nama device atau kosong
            $rows = [];
            for ($i = 0; $i < 43; $i++) { // Mulai dari 0 hingga 42
                $deviceId = $devices[$i] ?? null;
                $rows[$i] = $deviceId ? ($deviceNames[$deviceId] ?? 'Unknown Device') : ''; // Ambil nama atau kosong
            }

            return [
                'rack_name' => $rack->name,
                'rows' => $rows,
            ];
        })->filter(); // Filter out null values jika ada rak tanpa "Nama Device"


        // Kirim data ringkasan ke view
        return view('itAsset.dashboard', compact(
            'rackData',
            'rackPanelData',
            'percentages',
            'colors',
            'labels',
            'statusCounts',
            'rackSummary'
        ));
    }
}
