<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = Storage::path('flag7days.csv');
        $handle = fopen($file, 'r');
        $header = true;
        $startRow = 0; // Adjust as needed
        $endRow = 332427; // Adjust as needed
        $currentRow = 0;
    
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $currentRow++;
    
            // // Skip rows before the start row
            // if ($currentRow < $startRow) {
            //     continue;
            // }
    
            // // Stop after the end row
            // if ($currentRow > $endRow) {
            //     break;
            // }
    
            if ($header) {
                $header = false; // Skip the header row
                continue;
            }
    
            // Adjust date parsing for timezone-aware format
            try {
                $tanggal = Carbon::createFromFormat('m/d/Y H:i:sP', $row[0])->format('Y-m-d H:i:s');
            } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                // Handle invalid date format
                echo "Invalid date format: " . $row[0];
                continue;
            }
    
            DB::table('stations')->insert([
                'tanggal' => $tanggal,
                'long_station' => $row[1],
                'latt_station' => $row[2],
                'name_station' => $row[3],
                'nama_propinsi' => $row[4],
                'nama_kota' => $row[5],
                'tipe_station' => $row[6],
                'rr_flag' => $row[7],
                'pp_air_flag' => $row[8],
                'rh_avg_flag' => $row[9],
                'sr_avg_flag' => $row[10],
                'sr_max_flag' => $row[11],
                'nr_flag' => $row[12],
                'wd_avg_flag' => $row[13],
                'ws_avg_flag' => $row[14],
                'ws_max_flag' => $row[15],
                'wl_flag' => $row[16],
                'tt_air_avg_flag' => $row[17],
                'tt_air_min_flag' => $row[18],
                'tt_air_max_flag' => $row[19],
                'tt_sea_flag' => $row[20],
                'ws_50cm_flag' => $row[21],
                'wl_pan_flag' => $row[22],
                'ev_pan_flag' => $row[23],
                'tt_pan_flag' => $row[24],
            ]);
        }
    
        fclose($handle);
    }
    
}
