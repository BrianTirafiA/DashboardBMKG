<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\RackAttribute;
use App\Models\RackAttributeValue;
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
        $rack = Rack::with(['values'])->findOrFail($rackId);

        // Ambil semua atribut dalam rack yang sesuai
        $rackAttributes = RackAttributeValue::where('rack_id', $rack->id)
            ->whereNotNull('value')
            ->where('value', '!=', '')
            ->get();

        // Mengelompokkan berdasarkan row_index
        $groupedAttributes = $rackAttributes->groupBy('row_index');

        return view('itasset.report-server-print', compact('rack', 'groupedAttributes'));
    }






}
