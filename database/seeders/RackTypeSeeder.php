<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RackType;

class RackTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rackTypes = [
            ['name' => 'STO', 'description' => 'Rak STO'],
            ['name' => 'Server', 'description' => 'Rak Server'],
            ['name' => 'Switch', 'description' => 'Rak Switch'],
        ];

        foreach ($rackTypes as $type) {
            RackType::create($type);
        }
    }
}
