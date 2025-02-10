<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\RackAttribute;
use App\Models\RackAttributeValue;
use App\Models\RackStatuses;
use App\Models\Device;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintServerReportController extends Controller
{
    public function generatePDF($rackId)
    {
        // Ambil data rak berdasarkan ID
        $rack = Rack::findOrFail($rackId);

        // Ambil data perangkat dalam rak
        $rackAttributes = RackAttributeValue::where('rack_id', $rack->id)
            ->whereNotNull('value')
            ->where('value', '!=', '')
            ->get();

        // Hitung jumlah perangkat
        $rack->devices_count = $rackAttributes->count();

        // Load Blade template dan kirim data
        $pdf = Pdf::loadView('print.rackAttributes', compact('rack', 'rackAttributes'))
            ->setPaper('a4', 'landscape');

        // Download file PDF
        return $pdf->download('Rack_Attributes_Report.pdf');
    }

    public function showReport($rackId)
    {
        // Pastikan rack_id yang dimasukkan valid
        $rack = Rack::findOrFail($rackId);

        // Ambil data rak beserta relasinya
        $attributeMap = [
            'Perangkat' => 'Nama Device',
            'Jenis' => 'Tipe',
            'Tahun' => 'Tahun',
            'Merek' => 'Brand',
            'PDU' => 'PDU',
            'Daya' => 'Power',
            'User' => 'User',
            'Fungsi' => 'Fungsi',
            'Keterangan' => 'Status'
        ];

        // Ambil ID attribute berdasarkan nama
        $attributes = RackAttribute::whereIn('name', array_values($attributeMap))->pluck('id', 'name');

        // Ambil hanya data dengan rack_id yang sesuai
        $rawData = RackAttributeValue::where('rack_id', $rackId)
            ->whereIn('attribute_id', $attributes->values())
            ->get();

        // Ambil status dari RackStatuses
        $statusList = RackStatuses::pluck('nama_status', 'id');

        // Ambil nama perangkat dari tabel Device
        $deviceNames = Device::pluck('name_device', 'id');

        // Ambil ID attribute untuk "Nama Device"
        $deviceAttributeId = $attributes['Nama Device'] ?? null;

        // Kelompokkan berdasarkan row_index
        $groupedAttributes = $rawData->groupBy('row_index');

        // Format Data untuk View
        $formattedData = [];
        foreach ($groupedAttributes as $rowIndex => $values) {
            $row = [];

            foreach ($attributeMap as $viewColumn => $dbColumn) {
                $attributeId = $attributes[$dbColumn] ?? null;
                $value = optional($values->firstWhere('attribute_id', $attributeId))->value;

                // Jika kolom adalah "Keterangan (Status)", ubah ID menjadi teks
                if ($viewColumn === 'Keterangan') {
                    $value = $statusList[$value] ?? null;
                }

                // Jika kolom adalah "Perangkat", cari di Device berdasarkan ID
                if ($viewColumn === 'Perangkat') {
                    $deviceId = optional($values->firstWhere('attribute_id', $deviceAttributeId))->value;
                    $value = $deviceNames[$deviceId] ?? null;
                }

                $row[$viewColumn] = $value;
            }

            // Hanya tambahkan row jika setidaknya satu kolom (selain No) memiliki nilai yang valid
            if (collect($row)->except('No')->filter()->isNotEmpty()) {
                $row['No'] = $rowIndex + 1;
                $formattedData[] = $row;
            }
        }

        // Urutkan berdasarkan kolom No
        $formattedData = collect($formattedData)->sortBy('No')->values()->toArray();

        // Kirim ke view
        return view('itasset.report-server-print', compact('formattedData','rack'));
    }

}
