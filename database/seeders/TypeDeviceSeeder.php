<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeDevice;

class TypeDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data ke tabel type_devices
        $devices = [
            'KVM',
            'UPS',
            'Server',
            'Console Switch',
            'Switch',
            'Firewall',
            'Tape Library',
        ];

        foreach ($devices as $device) {
            TypeDevice::create([
                'name_type' => $device,
            ]);
        }
    }
}
