<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RackStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rack_statuses')->insert([
            ['nama_status' => 'Beroperasi'],
            ['nama_status' => 'Stand By'],
            ['nama_status' => 'Tidak Beroperasi'],
        ]);
    }
}
