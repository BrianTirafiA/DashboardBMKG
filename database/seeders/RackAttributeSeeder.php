<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RackAttribute;
use App\Models\RackType;

class RackAttributeSeeder extends Seeder
{
    public function run()
    {
        // Data atribut yang akan di-seed
        $attributes = [
            ['name' => 'Nama Device', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'Status', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'User', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'Brand', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'Tipe', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'Tahun', 'data_type' => 'integer', 'is_required' => false],
            ['name' => 'OS', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'Processor', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'RAM', 'data_type' => 'integer', 'is_required' => false], 
            ['name' => 'Disk', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'Fungsi', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'PDU', 'data_type' => 'json', 'is_required' => false],
            ['name' => 'Power', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'Serial Number', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'Hostname', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'IP', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'MAC Address', 'data_type' => 'string', 'is_required' => false],
            ['name' => 'Network Port', 'data_type' => 'string', 'is_required' => false],
        ];

        // Masukkan data ke database
        foreach ($attributes as $attr) {
            RackAttribute::create([
                'rack_type_id' => 1,
                'name' => $attr['name'],
                'data_type' => $attr['data_type'],
                'is_required' => $attr['is_required'],
            ]);
        }
    }
}
